<?php
require_once 'include/bootsrap.php';
require_once 'functions/common_function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Toggle Example</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="liveAlertPlaceholder"></div>
<button type="button" class="btn btn-primary" id="liveAlertBtn">Show live alert</button>
</body>
<?php
login_notification('liveAlertPlaceholder', 'liveAlertBtn');
?>
</html>
