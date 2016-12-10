<?php
	require_once('includes/database.php');
	require_once("classes/Utils.php");

	class Users {

		public static function dropCompetition($comp)
		{
			global $db;
			$user = Utils::getCurrentUser();
			if ($comp == "GullCode") {
				$teamid = $db->where("id", $user["id"])->getone("gullcode_users_on_teams");
				if($teamid["team_id"] != 0) {
					$teammembers = $db->where("team_id", $teamid["team_id"])->get("gullcode_users_on_teams");
					if(sizeof($teammembers) == 1) {
						$db->where("team_id", $teamid["team_id"])->delete("gullcode_teams");
					}
				}
				$db->where("id", $user["id"])->delete("gullcode_users_on_teams");
			}
			elseif ($comp == "MathChallenge") {
				$teamid = $db->where("id", $user["id"])->getone("math_challenge_users_on_teams");
				if($teamid["team_id"] != 0) {
					$teammembers = $db->where("team_id", $teamid["team_id"])->get("math_challenge_users_on_teams");
					if(sizeof($teammembers) == 1) {
						$db->where("team_id", $teamid["team_id"])->delete("math_challenge_teams");
					}
				}
				$db->where("id", $user["id"])->delete("math_challenge_users_on_teams");
			}
		}
	}
