<?php
require_once('../lib/User.php');
if (!$user = User::auth()) {
    header("Location: index.php");
}
?>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    <ul class="list-group">
        <li id="getProduct" class="list-group-item">Product</li>
        <li id="getCategory" class="list-group-item">Category</li>
        <a href="_signout.php" class="list-group-item">LogOut</a>
    </ul>
</div>