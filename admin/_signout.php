<?php

require_once('../lib/User.php');

User::logout();
header("Location: index.php");