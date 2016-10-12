<?php

require_once('../lib/User.php');

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $user = User::get('username', $username, true);
    if (is_object($user) && $user->password === $password) {
        $user->login();
    } else {
        unset($user);
    }
}

header("Location: index.php");