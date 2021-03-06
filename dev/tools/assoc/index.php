<?php
/* Copyright 2014, Charlie Fyvie-Gauld (Carrotsrg.org)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
	
	if(!defined('_ROOT_TOOL'))
		die("Not logged in");

	include(SystemConfig::relativeAppPath("system/resource/resman.php"));
	include(SystemConfig::relativeAppPath("system/helpers/strings.php"));
	include("lib.php");

	$rman = new ResMan($db);
	$panel = "";

	if(isset($_GET['mode']) && $_GET['mode'] == "newrel" || !isset($_GET['mode'])) {
		$prq = $crq = null;

		if(isset($_POST['prq']))
			$prq = string_clean_escapes($_POST['prq']);

		if(isset($_POST['crq']))
			$crq = string_clean_escapes($_POST['crq']);
		
		if(isset($_POST['op']) && $_POST['op'] == 1) {
			createRelationship($_POST['edge'], $rman);
		}
		ob_start();
		relationshipPanel($prq, $crq, $rman, $db);
		$panel = ob_get_contents();
		ob_end_clean();
	}
	else
	if(isset($_GET['mode']) && $_GET['mode'] == "manrel") {
		$prq = $crq = null;

		if(isset($_POST['query']))
			$prq = $_POST['query'];

		if(isset($_POST['op']) && $_POST['op'] == 1) {
		//	createRelationship($_POST['edge'], $rman);
		}
		else
		if(isset($_POST['op']) && $_POST['op'] == 2) {
			removeRelationships($rman);
		}
		ob_start();
		managePanel($prq, $rman, $db);
		$panel = ob_get_contents();
		ob_end_clean();
	}
	else
	if(isset($_GET['mode']) && $_GET['mode'] == "edge") {

		ob_start();
		edgePanel($rman, $db);
		$panel = ob_get_contents();
		ob_end_clean();
	}
?>
	<div id="kr-layout">
		<div class="tools">
			<div class="tool-panel">
			<b>Relationships</b>
			<form method="post" action="index.php?tool=assoc&mode=newrel">
				<input type="submit" class="form-button" value="Create Assoc" />
			</form>
			<form method="post" action="index.php?tool=assoc&mode=manrel">
				<input type="submit" class="form-button" value="Manage Assoc" />
			</form>
			<form method="post" action="index.php?tool=assoc&mode=edge">
				<input type="submit" class="form-button" value="Manage Edges" />
			</form>
			</div>
		</div>

			<div class="panel">
				<?php echo $panel; ?>
			</div>
		</div>
</div>
