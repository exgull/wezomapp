<?php
require_once('../lib/User.php');
if (!$user = User::auth()) {
	header("Location: index.php");
}
?>
<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
	<div class="panel panel-default">
<!--		<div class="panel-heading"></div>-->
		<table id="contents" class="table table-hover">

		</table>
	</div>
</div>

<div id="add_modal"></div>