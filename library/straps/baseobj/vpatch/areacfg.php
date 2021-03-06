<?php
/* Copyright 2014, Charlie Fyvie-Gauld (Carrotsrg.org)
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */
	class areacfg extends StrapBase
	{
		public function process(&$xml)
		{
			while(($tag = $xml->getNextTag()) != null) {
				if($tag->name == "/obj")
					break;

				if($tag->name == "area")
					$this->handleArea($tag);
			}
		}


		public function handleArea($tag)
		{
			$name = $tag->attributes['name'];

			$out = null;
			$rout = null;
			global $log;

			if(isset($tag->attributes['out']))
				$out = $tag->attributes['out'];

			if(isset($tag->attributes['rout']))
				$rout = $tag->attributes['rout'];

			if(($id = $this->db->sendQuery("SELECT id FROM areapool WHERE name='$name';"))) {
				$id = $id[0]['id'];
				$log[] = "< Retrieved Area('$name') => $id";

				if($out != null)
					setVariable($out, $id);

				if($rout != null) {
					$rid = $this->resManager->queryAssoc("Area('$id');");
					if($rid)
						setVariable($rout, $rid[0]['id']);
				}
				return;
			}

			$sql = "";

			$sql = "INSERT INTO `areapool` (`name`, `s_id`, `st_id`) VALUES (";
			$sql .= "'$name', '{$tag->attributes['surround']}', '{$tag->attributes['template']}');";
			if(!$this->db->sendQuery($sql, false, false)) {
				$log[] = "! Failed to create Area('$name')";
				return;
			}

			$id = $this->db->getLastId();
			$rid = $this->resManager->addResource("Area", $id, $name);
			$log[] = "+ Created Area('$name') => $id - S{$tag->attributes['surround']} / T{$tag->attributes['template']}";

			if($out != null)
				setVariable($out, $id);

			if($rout != null)
				setVariable($rout, $rid);
		}
	}
?>
