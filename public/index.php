<?php
session_start();

require_once('../Controllers/RegistrationController.php');
require_once('../Controllers/LoginController.php');
require_once "router.php";

route('/registration_post', function () {
    return (new RegistrationController)->register();
});

route('/login_post', function () {
    return (new LoginController)->login();
});

route('/', function () {
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        //header('login.php');
        echo '<script type="text/javascript">location.href = \'login.php\';</script>';
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        //header('login.php');
        echo '<script type="text/javascript">location.href = \'login.php\';</script>';
    }
});

$action = $_SERVER['REQUEST_URI'];
dispatch($action);








/*
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}
*/

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="header">
    <h2>Wall Family Europe User Registration Task</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>

</body>
</html>