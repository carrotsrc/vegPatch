<?php
/* Copyright 2014, Charlie Fyvie-Gauld (Carrotsrg.org)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
	
	if(!defined('_ROOT_TOOL'))
		die("Not logged in");
?>
<style>
	.log {
		background-color: #EFEFEF;
		border: 1px solid #909090;
		/*float: left;*/
		margin-top: 20px;
		/*margin-left: 30px;*/
		padding: 10px;
		width: 600px;
		overflow-y: auto;
		height: 250px;
		height: 60%;
	}
</style>
<?php
	include(SystemConfig::relativeAppPath("system/resource/resman.php"));
	include(SystemConfig::relativeAppPath("system/managers.php"));
	include(SystemConfig::relativeAppPath("system/helpers/strings.php"));
	include("lib.php");

	$panel = "";

	$rman = new ResMan($db);
	Managers::setResourceManager($rman);

	if(isset($_GET['mode']) && $_GET['mode'] == "root") {
		ob_start();
		strapRootPanel($fm, $db, $rman);
		$panel = ob_get_contents();
		ob_end_clean();
	}
	else
	if(isset($_GET['mode']) && $_GET['mode'] == "system") {
		ob_start();
		strapSystemPanel($fm, $db, $rman);
		$panel = ob_get_contents();
		ob_end_clean();
	}
	else
	if(isset($_GET['mode']) && $_GET['mode'] == "pad") {
		ob_start();
		strapPostPanel($fm, $db, $rman);
		$panel = ob_get_contents();
		ob_end_clean();
	} else {
		ob_start();
		strapRootPanel($fm, $db, $rman);
		$panel = ob_get_contents();
		ob_end_clean();
	}
?>
<div id="kr-layout">
	<div class="tools">
		<div class="tool-panel">
		<b>Straps</b>
		<form method="post" action="index.php?tool=strap&mode=root">
			<input type="submit" value="Root System" class="form-button" />
		</form>
		<form method="post" action="index.php?tool=strap&mode=system">
			<input type="submit" value="Other Systems" class="form-button" />
		</form>
		</div>
		<form method="post" action="index.php?tool=strap&mode=pad">
			<input type="submit" value="Pad" class="form-button" />
		</form>
	</div>

	<div class="panel">
		<?php echo $panel; ?>
	</div>
</div>
