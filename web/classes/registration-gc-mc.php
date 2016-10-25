<?php
require_once __DIR__."/../includes/database.php";
    require_once("classes/Utils.php");



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
    	$user = Utils::getCurrentUser();
        global $db;

         $or = $_POST['registert-as'];       
     
        if( $or != 0)
        {
           
            $data = array(

                    'team_name' => $_POST['team-name']);
            $id = $db -> insert("math_challenge_teams",$data);

            $team = $db->where("team_name", $_POST['team-name'])->getOne("math_challenge_teams");
             $data = array(
                    'id'=> $user['id'],
                    'team_id' => $team['team_id']
                    );
           $id = $db->insert('math_challenge_users_on_teams',$data);
        }

         elseif (strlen($_POST['team-name']) < 4) {
            $this->errors[] = "Team Name has a minimum length of 4 characters";
        } elseif (strlen($_POST['team-name']) > 32) {
            $this->errors[] = "Email cannot be longer than 32 characters";
        }
        else{
        	$data = array('id' => $user['id'],
                    'team_id' => 0 );
                    
            $id = $db->insert('math_challenge_users_on_teams', $data);
}
            
             $data = array(

                    't_size' => $_POST['t-size']);
             $db->where("id", $user['id']);
            $id = $db ->update('users',$data);
      
    }
}
class gullcode{
     public $errors = array();

    public function __construct()
    {
        if (isset($_POST["gc-register"])) {
            $this->registerNewGullCode();
        }
    }

 private function registerNewGullCode()
    {
        $user = Utils::getCurrentUser();
        global $db;

         $or = $_POST['registert-as'];       
     
        if( $or != 0)
        {
           
            $data = array(

                    'team_name' => $_POST['team-name']);
            $id = $db -> insert("gullcode_teams",$data);

            $team = $db->where("team_name", $_POST['team-name'])->getOne("gullcode_teams");
             $data = array(
                    'id'=> $user['id'],
                    'team_id' => $team['team_id']
                    );
           $id = $db->insert('gullcode_users_on_teams',$data);
        }

         elseif (strlen($_POST['team-name']) < 4) {
            $this->errors[] = "Team Name has a minimum length of 4 characters";
        } elseif (strlen($_POST['team-name']) > 32) {
            $this->errors[] = "Email cannot be longer than 32 characters";
        }
        else{

            $data = array('id' => $user['id'],
                    'team_id' => 0 );
                    
            $id = $db->insert('gullcode_users_on_teams', $data);
}
            
             $data = array(

                    't_size' => $_POST['t-size']);
             $db->where("id", $user['id']);
            $id = $db ->update('users',$data);
      
    }
}


?>