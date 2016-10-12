<?php
require_once('../lib/User.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wezom</title>
    <link rel="stylesheet" href="../public/src/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="/src/css/main.css">-->
</head>
<body>
<?php if (!$user = User::auth()) { ?>
    <?php include_once('auth.php') ?>
<?php } else { ?>
    <div class="container">
        <div id="global" class="row">
            <?php include_once('menu.php') ?>
            <?php include_once('view.php') ?>
        </div>
    </div>
<?php } ?>

<script src="../public/src/js/jquery-3.1.1.min.js"></script>
<script src="../public/src/js/function.js"></script>
<script src="../public/src/js/admin.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>