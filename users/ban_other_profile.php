<?php
session_start();
require_once '../include/connect.php';

$user_no = $_SESSION['user_no'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content not available</title>
    <style>
        .content{
            height: 90vh;
            width: 100%;

        }
        .a{
            height: 10%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding-left: 20px;

        }
        .b{
            height: 90%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: larger;
        }
    </style>
</head>
<body>
    <div class="container-fluid content">
        <div class="container-fluid a"><a href="../index.php?newsfeed=<?php echo htmlspecialchars($user_no) ?>">Back</a></div>
        <div class="container-fluid b">
         This content is not available right now</div>
    </div>
</body>
</html>