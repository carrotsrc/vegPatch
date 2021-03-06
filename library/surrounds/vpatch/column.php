<?php
/* Copyright 2014, Charlie Fyvie-Gauld (Carrotsrg.org)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $vars->app->title; ?> System</title>
<?php
	foreach($vars->assets['css'] as $a)
		echo "$a\n";
	foreach($vars->assets['js'] as $a)
		echo "$a\n";
?>
<script>
	window.onload = function () {
<?php
	if(!$vars->nodym)
		echo $vars->onload;
?>
	}
</script>
</head>

<body>
<div id="kr-header" class="solidbg2">
	<div id="kr-version">
		VegPatch v1.0
	</div>

	<div id="kr-title">
		VPatch
	</div>

</div>

<div id="kr-layout-column">
<?php
	echo $vars->app->layout;
?>
</div>
</body>

