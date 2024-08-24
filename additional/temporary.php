<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration with T&C</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .registration-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }

        .registration-form input[type="text"],
        .registration-form input[type="email"],
        .registration-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .registration-form input[type="checkbox"] {
            margin-right: 10px;
        }

        .registration-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .registration-form button:disabled {
            background-color: #aaa;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="registration-form">
        <h2>Register</h2>
        <form id="registrationForm">
            <input type="text" placeholder="Username" required><br>
            <input type="email" placeholder="Email" required><br>
            <input type="password" placeholder="Password" required><br>
            
            <label>
                <input type="checkbox" id="termsCheckbox"> I agree to the <a href="#">Terms and Conditions</a>
            </label><br><br>
            
            <button type="submit" id="submitButton" disabled>Register</button>
        </form>
    </div>

    <script>
        // JavaScript to handle enabling/disabling the submit button
        const termsCheckbox = document.getElementById('termsCheckbox');
        const submitButton = document.getElementById('submitButton');

        termsCheckbox.addEventListener('change', function() {
            submitButton.disabled = !termsCheckbox.checked;
        });
    </script>
</body>
</html>
