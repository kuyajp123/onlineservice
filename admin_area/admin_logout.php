<?php
session_name('admin_session');
session_start();
require_once '../include/connect.php';
session_unset();
session_destroy();
header('location: admin_login.php');
?>