<?php
require_once __DIR__."/../includes/database.php";

class math_challenge{
	 public $errors = array();

    public function __construct()
    {
        if (isset($_POST["mc-register"])) {
            $this->registerNewMathChallenge();
        }
    }

 private function registerNewMathChallenge()
    {
    	$team_id_counter;
        if (empty($_POST['register-as'])) {
            $this->errors[] = "No Placement Selected";
        
        } elseif (strlen($_POST['team-name']) < 4) {
            $this->errors[] = "Team Name has a minimum length of 4 characters";
        } elseif (strlen($_POST['team-name']) > 32) {
            $this->errors[] = "Email cannot be longer than 32 characters";
        }
        else
        	
        	$data = array(
                    'team_name' => $_POST['team-name']);
                    
$id = $db->insert('math_challenge_teams', $data);
}
}

class gullcode{
     public $errors = array();

    public function __construct()
    {
        if (isset($_POST["gc-register"])) {
            $this->registerNewMathChallenge();
        }
    }

 private function registerNewMathChallenge()
    {
        $team_id_counter;
        if (empty($_POST['register-as'])) {
            $this->errors[] = "No Placement Selected";
        
        } elseif (strlen($_POST['team-name']) < 4) {
            $this->errors[] = "Team Name has a minimum length of 4 characters";
        } elseif (strlen($_POST['team-name']) > 32) {
            $this->errors[] = "Email cannot be longer than 32 characters";
        }
        else
            
            $data = array(
                    'team_name' => $_POST['team-name']);
                    
$id = $db->insert('gullcode_teams', $data);
}
}

?>
?>