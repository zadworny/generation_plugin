<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8"/>
	<?php $DExit_redirect_get = $_GET['url']; $DExit_redirect = str_replace(":DOT:",".",$DExit_redirect_get); ?>
	<script type="text/javascript">if (top!=self) {<?php $redirecting="on"; ?>}</script>
	<?php if ($redirecting=="on") {echo '<meta http-equiv="refresh" content="0;url='.$DExit_redirect.'">';} ?>
	</head>
	<body></body>
</html>