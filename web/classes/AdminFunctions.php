<?php
	require_once('includes/database.php');

	class Admins {
		public static function updateRegistraion($key){
			global  $db;
			if ($key == "openGc") {
				$data = array("switch" => 1);
				$db->where("admin_controls", "gullcode_register");
				$id = $db->update("admin_controls", $data);
			}
			elseif ($key == "openMc") {
				$data = array("switch" => 1);
				$db->where("admin_controls", "math_challenge_register");
				$id = $db->update("admin_controls", $data);
			}
			elseif ($key == "closeGc") {
				$data = array("switch" => 0);
				$db->where("admin_controls", "gullcode_register");
				$id = $db->update("admin_controls", $data);
			}
			elseif ($key == "closeMc") {
				$data = array("switch" => 0);
				$db->where("admin_controls", "math_challenge_register");
				$id = $db->update("admin_controls", $data);
			}
		}
	}

?>