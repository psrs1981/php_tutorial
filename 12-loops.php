<?php $fruits = ["Apple", "Banana", "Mango"]; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Loops</title>
    <style>
        :root {
            --ink: #172121;
            --paper: #f5f1e7;
            --green: #087f6b;
            --coral: #e7583e;
            --gold: #f4b942;
            --blue: #287aa1;
            --line: #c9c2b2;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
            background-image: radial-gradient(#cbc3b2 1px, transparent 1px);
            background-size: 22px 22px;
            font-family: "Trebuchet MS", sans-serif;
        }

        main { width: min(1040px, calc(100% - 28px)); margin: auto; padding: 42px 0 64px; }

        header {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--ink);
        }

        h1, h2 { font-family: Georgia, serif; }
        h1 { margin: 0 0 6px; font-size: 44px; }
        h2 { margin: 0 0 7px; font-size: 26px; }
        p { margin: 0; line-height: 1.55; }

        button {
            padding: 10px 15px;
            border: 2px solid var(--ink);
            background: var(--gold);
            box-shadow: 4px 4px 0 var(--ink);
            color: var(--ink);
            font: bold 14px "Trebuchet MS", sans-serif;
            cursor: pointer;
        }

        button:active { transform: translate(4px, 4px); box-shadow: none; }

        .lesson {
            display: grid;
            grid-template-columns: minmax(260px, 0.9fr) minmax(320px, 1.1fr);
            gap: 24px;
            margin-top: 22px;
            padding: 24px;
            border: 2px solid var(--ink);
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 7px 7px 0 var(--line);
        }

        .label {
            display: inline-block;
            margin-bottom: 10px;
            padding: 4px 8px;
            background: var(--green);
            color: white;
            font: bold 13px Consolas, monospace;
        }

        pre {
            margin: 16px 0 0;
            padding: 16px;
            overflow-x: auto;
            border-left: 5px solid var(--coral);
            background: #172121;
            color: #f8f3e7;
            line-height: 1.5;
            font: 14px Consolas, monospace;
        }

        .stage {
            display: flex;
            min-height: 210px;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            border: 1px dashed #aaa18e;
            background: #fbfaf6;
            overflow: hidden;
        }

        .track {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 20px 4px;
        }

        .track::before {
            position: absolute;
            right: 20px;
            left: 20px;
            height: 3px;
            background: var(--line);
            content: "";
        }

        .item {
            position: relative;
            z-index: 1;
            display: grid;
            min-width: 48px;
            height: 48px;
            place-items: center;
            padding: 0 8px;
            border: 2px solid var(--ink);
            border-radius: 50%;
            background: white;
            font-weight: bold;
            animation: visit 4.5s infinite;
            animation-delay: calc(var(--order) * 0.65s);
        }

        .fruit { min-width: 86px; border-radius: 5px; }

        .flow {
            display: grid;
            grid-template-columns: 1fr auto 1fr auto 1fr;
            align-items: center;
            gap: 8px;
        }

        .flow-step {
            min-height: 74px;
            display: grid;
            place-items: center;
            padding: 10px;
            border: 2px solid var(--ink);
            background: white;
            text-align: center;
            animation: flow 4.5s infinite;
            animation-delay: calc(var(--order) * 0.9s);
        }

        .arrow { color: var(--coral); font-size: 24px; font-weight: bold; }

        .output {
            margin-top: 18px;
            padding: 10px 12px;
            border-left: 5px solid var(--blue);
            background: #eaf5f7;
            font-family: Consolas, monospace;
        }

        .runner {
            width: 16px;
            height: 16px;
            margin-top: 20px;
            border-radius: 50%;
            background: var(--coral);
            box-shadow: 0 0 0 6px rgba(231, 88, 62, 0.18);
            animation: travel 4.5s ease-in-out infinite;
        }

        code { font-family: Consolas, monospace; }

        @keyframes visit {
            0%, 12% { background: white; color: var(--ink); transform: translateY(0) scale(1); }
            17%, 30% { background: var(--gold); transform: translateY(-12px) scale(1.08); box-shadow: 0 10px 0 rgba(23, 33, 33, 0.12); }
            38%, 100% { background: white; transform: translateY(0) scale(1); box-shadow: none; }
        }

        @keyframes flow {
            0%, 14% { background: white; transform: translateY(0); }
            20%, 36% { background: var(--green); color: white; transform: translateY(-7px); }
            46%, 100% { background: white; color: var(--ink); transform: translateY(0); }
        }

        @keyframes travel {
            0% { transform: translateX(0); }
            70% { transform: translateX(min(360px, 55vw)); }
            82% { opacity: 1; }
            83% { opacity: 0; transform: translateX(min(360px, 55vw)); }
            84% { opacity: 0; transform: translateX(0); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @media (max-width: 760px) {
            main { padding-top: 24px; }
            header { align-items: start; flex-direction: column; }
            h1 { font-size: 36px; }
            .lesson { grid-template-columns: 1fr; padding: 17px; }
            .stage { min-height: 180px; }
            .flow { grid-template-columns: 1fr; }
            .arrow { transform: rotate(90deg); text-align: center; }
            .runner { display: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 1ms !important; animation-iteration-count: 1 !important; }
        }
    </style>
</head>
<body>
<main id="page">
    <header>
        <div>
            <h1>PHP Loops</h1>
            <p>Read the code, then follow the highlighted steps to see how it repeats.</p>
        </div>
        <button id="replay" type="button">Replay animations</button>
    </header>

    <section class="lesson">
        <div>
            <span class="label">for</span>
            <h2>Count from 1 to 5</h2>
            <p>Use a <code>for</code> loop when the number of repetitions is known.</p>
            <pre><code>for ($number = 1; $number &lt;= 5; $number++) {
    echo $number . ' ';
}</code></pre>
        </div>
        <div class="stage">
            <div class="track">
                <?php for ($number = 1; $number <= 5; $number++) { ?>
                    <span class="item" style="--order: <?= $number - 1 ?>"><?= $number ?></span>
                <?php } ?>
            </div>
            <div class="output"><strong>Output:</strong> 1 2 3 4 5</div>
        </div>
    </section>

    <section class="lesson">
        <div>
            <span class="label">foreach</span>
            <h2>Visit every array item</h2>
            <p>Each fruit is placed in <code>$fruit</code>, one item at a time.</p>
            <pre><code>$fruits = ["Apple", "Banana", "Mango"];

foreach ($fruits as $fruit) {
    echo $fruit . ' ';
}</code></pre>
        </div>
        <div class="stage">
            <div class="track">
                <?php foreach ($fruits as $index => $fruit) { ?>
                    <span class="item fruit" style="--order: <?= $index ?>"><?= $fruit ?></span>
                <?php } ?>
            </div>
            <div class="output"><strong>Output:</strong> <?= implode(' ', $fruits) ?></div>
        </div>
    </section>

    <section class="lesson">
        <div>
            <span class="label">while</span>
            <h2>Check first, then run</h2>
            <p>The loop runs only when <code>$number &lt;= 5</code> is true.</p>
            <pre><code>$number = 1;

while ($number &lt;= 5) {
    echo $number . ' ';
    $number++;
}</code></pre>
        </div>
        <div class="stage">
            <div class="flow">
                <div class="flow-step" style="--order: 0">1. Check<br><code>$number &lt;= 5</code></div>
                <span class="arrow">&rarr;</span>
                <div class="flow-step" style="--order: 1">2. Print<br>the number</div>
                <span class="arrow">&rarr;</span>
                <div class="flow-step" style="--order: 2">3. Add 1<br>and repeat</div>
            </div>
            <div class="runner"></div>
            <div class="output"><strong>Output:</strong> 1 2 3 4 5</div>
        </div>
    </section>

    <section class="lesson">
        <div>
            <span class="label">do...while</span>
            <h2>Run first, then check</h2>
            <p>The code always runs once before PHP checks the condition.</p>
            <pre><code>$number = 1;

do {
    echo $number . ' ';
    $number++;
} while ($number &lt;= 5);</code></pre>
        </div>
        <div class="stage">
            <div class="flow">
                <div class="flow-step" style="--order: 0">1. Print<br>the number</div>
                <span class="arrow">&rarr;</span>
                <div class="flow-step" style="--order: 1">2. Add 1</div>
                <span class="arrow">&rarr;</span>
                <div class="flow-step" style="--order: 2">3. Check<br>and repeat</div>
            </div>
            <div class="runner"></div>
            <div class="output"><strong>Output:</strong> 1 2 3 4 5</div>
        </div>
    </section>
</main>

<script>
    const replayButton = document.querySelector('#replay');

    replayButton.addEventListener('click', () => {
        document.querySelectorAll('.item, .flow-step, .runner').forEach((element) => {
            element.style.animation = 'none';
            void element.offsetWidth;
            element.style.animation = '';
        });
    });
</script>
</body>
</html>
