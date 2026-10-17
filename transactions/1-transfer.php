<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$message = 'Choose a button to transfer 100.00 from Ravi to Sita.';

try {
    $conn = connectDatabase();
    createDemoAccounts($conn);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        if ($action !== 'commit' && $action !== 'rollback') {
            http_response_code(400);
            exit('Please choose a valid transfer action.');
        }

        $message = transferMoney($conn, $action === 'rollback');
    }

    $accounts = $conn->query('SELECT name, balance_cents FROM demo_transaction_accounts ORDER BY id')
        ->fetch_all(MYSQLI_ASSOC);
    $conn->close();
} catch (mysqli_sql_exception $exception) {
    error_log('Transaction demo database error: ' . $exception->getMessage());
    http_response_code(500);
    exit('The transaction demo could not access MySQL. Check your root .env settings and the PHP error log.');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MySQLi Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container py-5">
        <h1>Money Transfer: Commit and Rollback</h1>
        <p>A transaction makes a group of database changes succeed or fail together.</p>
        <p>This demo starts every request with Ravi holding 1,000.00 and Sita holding 500.00.
            It uses a temporary InnoDB table, which disappears when the connection closes.
            No real accounts or existing records are changed.</p>

        <form method="post" class="mb-3">
            <button type="submit" name="action" value="commit" class="btn btn-primary">Transfer 100.00 (Commit)</button>
            <button type="submit" name="action" value="rollback" class="btn btn-secondary">Simulate Failure (Rollback)</button>
        </form>

        <p role="status"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        <table class="table table-bordered">
            <thead>
                <tr><th scope="col">Account</th><th scope="col">Balance after this request</th></tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $account): ?>
                    <tr>
                        <td><?= htmlspecialchars($account['name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= number_format($account['balance_cents'] / 100, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Execution flow</h2>
        <ol>
            <li><code>begin_transaction()</code> starts the transaction.</li>
            <li>Subtract 100.00 from Ravi.</li>
            <li>Add 100.00 to Sita.</li>
            <li><code>commit()</code> keeps both updates when they succeed.</li>
            <li><code>rollback()</code> undoes the debit if the credit fails.</li>
        </ol>
        <p>The failure button deliberately stops after the debit, before the credit.
            Rollback restores Ravi's balance. Without a transaction, Ravi could lose money
            without Sita receiving it.</p>
        <p>Successful transfer: Ravi = 900.00, Sita = 600.00.
            Failed transfer: Ravi = 1,000.00, Sita = 500.00.</p>
    </main>
</body>
</html>
<?php

function connectDatabase(): mysqli
{
    $envFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
    $settings = parse_ini_file($envFile, false, INI_SCANNER_RAW);

    if ($settings === false) {
        http_response_code(500);
        exit('Unable to read the root .env file.');
    }

    foreach (['MYSQL_SERVERNAME', 'MYSQL_USERNAME', 'MYSQL_PASSWORD', 'MYSQL_DBNAME', 'MYSQL_PORT'] as $key) {
        if (!isset($settings[$key]) || !is_string($settings[$key])) {
            http_response_code(500);
            exit('Missing or invalid database setting: ' . $key);
        }
    }

    $conn = new mysqli(
        $settings['MYSQL_SERVERNAME'],
        $settings['MYSQL_USERNAME'],
        $settings['MYSQL_PASSWORD'],
        $settings['MYSQL_DBNAME'],
        (int) $settings['MYSQL_PORT']
    );
    $conn->set_charset('utf8mb4');
    return $conn;
}

function createDemoAccounts(mysqli $conn): void
{
    // Integer cents avoid floating-point arithmetic when updating money.
    $conn->query(
        'CREATE TEMPORARY TABLE demo_transaction_accounts (
            id INT PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            balance_cents INT NOT NULL
        ) ENGINE=InnoDB'
    );
    $conn->query(
        "INSERT INTO demo_transaction_accounts (id, name, balance_cents)
        VALUES (1, 'Ravi', 100000), (2, 'Sita', 50000)"
    );
}

function transferMoney(mysqli $conn, bool $simulateFailure): string
{
    $amountCents = 10000;
    $senderId = 1;
    $receiverId = 2;

    $conn->begin_transaction();

    try {
        $debit = $conn->prepare(
            'UPDATE demo_transaction_accounts
            SET balance_cents = balance_cents - ?
            WHERE id = ? AND balance_cents >= ?'
        );
        $debit->bind_param('iii', $amountCents, $senderId, $amountCents);
        $debit->execute();
        $senderUpdated = $debit->affected_rows;
        $debit->close();

        if ($senderUpdated !== 1) {
            $conn->rollback();
            return 'Transfer rejected: sender is missing or has insufficient funds. No money was moved.';
        }

        if ($simulateFailure) {
            $conn->rollback();
            return 'Simulated failure after debiting Ravi: rollback restored the original balances.';
        }

        $credit = $conn->prepare(
            'UPDATE demo_transaction_accounts SET balance_cents = balance_cents + ? WHERE id = ?'
        );
        $credit->bind_param('ii', $amountCents, $receiverId);
        $credit->execute();
        $receiverUpdated = $credit->affected_rows;
        $credit->close();

        if ($receiverUpdated !== 1) {
            $conn->rollback();
            return 'Transfer rejected: receiver is missing. Rollback restored the sender balance.';
        }

        $conn->commit();
        return 'Transfer committed: Ravi sent 100.00 to Sita.';
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        throw $exception;
    }
}
