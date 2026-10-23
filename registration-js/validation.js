// Check that every field is filled in before the form is submitted.
document.getElementById('registration-form').addEventListener('submit', function (event) {
    const fields = this.querySelectorAll('input, select, textarea');
    let isValid = true;

    fields.forEach(function (field) {
        let error = document.getElementById(field.id + '-error');
        if (!error) {
            error = document.createElement('div');
            error.id = field.id + '-error';
            error.className = 'invalid-feedback';
            field.insertAdjacentElement('afterend', error);
            field.setAttribute('aria-describedby', error.id);
        }

        if (field.value.trim() === '') {
            field.classList.add('is-invalid');
            field.setAttribute('aria-invalid', 'true');
            error.textContent = 'This field is required.';
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
            field.removeAttribute('aria-invalid');
            error.textContent = '';
        }
    });

    // Stop the submission if any field is empty; otherwise the form is sent to PHP and saved in MySQL.
    if (!isValid) {
        event.preventDefault();
    }
});
