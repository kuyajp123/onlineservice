<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .is-invalid {
            border-color: #dc3545;
        }
        .tooltip-inner {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>

<form id="myForm" action="" method="post">
    <!-- username field -->
    <div class="mb-3 names">
        <div class="form-floating form-outline name">
            <input type="text" class="form-control" id="user_fname" placeholder="First name" autocomplete="off" required name="user_fname">
            <label for="user_fname">First name</label>
        </div>
        <div class="form-floating form-outline name">
            <input type="text" class="form-control" id="user_lname" placeholder="Last name" autocomplete="off" required name="user_lname">
            <label for="user_lname">Last name</label>
        </div>
    </div>

    <!-- email field -->
    <div class="form-floating mb-3 form-outline">
        <input type="email" class="form-control" id="user_email" placeholder="CVSU Email" autocomplete="off" required name="user_email">
        <label for="user_email">CVSU Email</label>
    </div>

    <!-- student number field -->
    <span>Student Number</span>
    <div class="form-floating mb-0 stdnum form-outline">
        <div class="form-floating mb-3">
            <input type="text" class="form-control std_num" id="user_std_num1" placeholder="Student number1" autocomplete="off" required name="user_std_num1">
            <label for="user_std_num1">0000</label>
        </div>-
        <div class="form-floating mb-3">
            <input type="text" class="form-control std_num" id="user_std_num2" placeholder="Student number2" autocomplete="off" required name="user_std_num2">
            <label for="user_std_num2">000</label>
        </div>-
        <div class="form-floating mb-3">
            <input type="text" class="form-control std_num" id="user_std_num3" placeholder="Student number3" autocomplete="off" required name="user_std_num3">
            <label for="user_std_num3">0000</label>
        </div>
    </div>

    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 150px; resize: none;"></textarea>
        <label for="floatingTextarea2">Message (Optional)</label>
    </div>

    <div class="mt-3 submitappeal">
        <input type="submit" value="Send" class="py-2 border-0 px-4" style="border-radius: 5px; color: #fff; background-color: #006400;" name="user_appeal">
        <div class="container-fluid notification">
            Put notification here
        </div>
    </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const emailInput = document.getElementById('user_email');
    const form = document.getElementById('myForm');

    emailInput.addEventListener('input', function() {
        const emailValue = emailInput.value;
        const prefix = 'tmc.';
        const domain = '@cvsu.edu.ph';

        // Check if email starts with the specific prefix and ends with the specific domain
        const isValid = emailValue.startsWith(prefix) && emailValue.endsWith(domain);

        // If email is invalid, show the tooltip
        if (!isValid) {
            emailInput.setAttribute('data-bs-toggle', 'tooltip');
            emailInput.setAttribute('title', 'Email must start with "tmc." and end with "@cvsu.edu.ph".');
            emailInput.classList.add('is-invalid');

            // Initialize the tooltip if not already done
            let tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
            if (!tooltipInstance) {
                tooltipInstance = new bootstrap.Tooltip(emailInput);
            }
            tooltipInstance.show();
        } else {
            const tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
            if (tooltipInstance) {
                tooltipInstance.hide();
            }
            emailInput.removeAttribute('data-bs-toggle');
            emailInput.removeAttribute('title');
            emailInput.classList.remove('is-invalid');
        }
    });

    emailInput.addEventListener('blur', function() {
        const tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
        if (tooltipInstance) {
            tooltipInstance.hide();
        }
    });

    form.addEventListener('submit', function(event) {
        const emailValue = emailInput.value;
        const prefix = 'tmc.';
        const domain = '@cvsu.edu.ph';

        // Check if email starts with the specific prefix and ends with the specific domain
        const isValid = emailValue.startsWith(prefix) && emailValue.endsWith(domain);

        if (!isValid) {
            event.preventDefault(); // Prevent form submission
            emailInput.setAttribute('data-bs-toggle', 'tooltip');
            emailInput.setAttribute('title', 'Email must start with "tmc." and end with "@cvsu.edu.ph".');
            emailInput.classList.add('is-invalid');

            // Initialize the tooltip if not already done
            let tooltipInstance = bootstrap.Tooltip.getInstance(emailInput);
            if (!tooltipInstance) {
                tooltipInstance = new bootstrap.Tooltip(emailInput);
            }
            tooltipInstance.show();
        }
    });
});
</script>

</body>
</html>
