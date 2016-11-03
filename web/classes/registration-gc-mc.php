<?php
    require_once __DIR__."/../includes/database.php";
    require_once("classes/Utils.php");



class math_challenge{
    public $errors = array();
    public function __construct(){
        if (isset($_POST["mc-register"])) {
            $this->registerNewMathChallenge();
        }
    }

    public function teamcheck($id){
        global $db;
        $teamid = $db->where('team_name',$id)->getOne('math_challenge_teams');
        print_r($teamid);
        if($teamid){
            $members = $db->where('team_id', $teamid['team_id'])->get('math_challenge_users_on_teams');
            if(sizeof($members) < 3){
                return true;
            }
            else{
                return false;
            }
        }

        return true;
    }

    private function registerNewMathChallenge(){
    	$user = Utils::getCurrentUser();
        global $db;

         $or = $_POST['registert-as'];       
     
        if( $or != 0 && strlen($_POST['team-name']) > 4 && strlen($_POST['team-name']) < 32 && $this->teamcheck($_POST['team-name'])){
           
            $data = array('team_name' => $_POST['team-name']);
            $id = $db -> insert("math_challenge_teams",$data);

            $team = $db->where("team_name", $_POST['team-name'])->getOne("math_challenge_teams");
            $data = array('id'=> $user['id'],'team_id' => $team['team_id']);
           $id = $db->insert('math_challenge_users_on_teams',$data);
        }
        elseif ($or != 0 && strlen($_POST['team-name']) < 4) {
             echo "<br><br><center><div  style='color:red; width:20%; background-color:white; border-color:black;border-style: ridge;border-width:auto;  padding: 6px 12px;'><b>Error:</b><br>Math Challenge Team Name is too short</center>";
        }
        elseif ($or != 0 && strlen($_POST['team-name']) > 32) {
            echo "<br><br><center><div  style='color:red; width:10%; background-color:white; border-color:black;border-style: ridge;border-width:auto;  padding: 6px 12px;'>Error:Math Challenge Team Name is too long</center>";
        }
        elseif($or != 0 && !$this->teamcheck($_POST['team-name'])){
            echo "<br><br><center><div  style='color:red; width:10%; background-color:white; border-color:black;border-style: ridge;border-width:auto;  padding: 6px 12px;'>Error:The team, ". $_POST['team-name'] .", is full, please join/make another team.</center>";
        }
        else{
        	$data = array('id' => $user['id'],'team_id' => 0 );
            $id = $db->insert('math_challenge_users_on_teams', $data);
        }
            
        $data = array('t_size' => $_POST['t-size']);
        $db->where("id", $user['id']);
        $id = $db ->update('users',$data);
    }
}

class gullcode{
    public $errors = array();

    public function __construct(){
        if (isset($_POST["gc-register"])) {
            $this->registerNewGullCode();
        }
    }

    public function teamcheck($id){
        global $db;
        $teamid = $db->where('team_name',$id)->getOne('gullcode_teams');
        print_r($teamid);
        if($teamid){
            $members = $db->where('team_id', $teamid['team_id'])->get('gullcode_users_on_teams');
            if(sizeof($members) < 3){
                return true;
            }
            else{
                return false;
            }
        }
        return true;
    }

    private function registerNewGullCode(){
        $user = Utils::getCurrentUser();
        global $db;

        $or = $_POST['registert-as'];       
     
        if( $or != 0 && strlen($_POST['team-name']) > 4 && strlen($_POST['team-name']) < 32 && $this->teamcheck($_POST['team-name'])){
           
            $data = array('team_name' => $_POST['team-name']);
            $id = $db -> insert("gullcode_teams",$data);

            $team = $db->where("team_name", $_POST['team-name'])->getOne("gullcode_teams");
            $data = array('id'=> $user['id'],'team_id' => $team['team_id']);
            $id = $db->insert('gullcode_users_on_teams',$data);
        }
        elseif ($or != 0 && strlen($_POST['team-name']) < 4) {
             echo "<br><br><center><div  style='color:red; width:10%; background-color:white; border-color:black;border-style: ridge;border-width:auto;  padding: 6px 12px;'>Error:<br>GullCode Team Name is too short</center>";
        }
        elseif ($or != 0 && strlen($_POST['team-name']) > 32) {
               echo "<br><br><center><div  style='color:red; width:10%; background-color:white; border-color:black;border-style: ridge;border-width:auto;  padding: 6px 12px;'>Error:GullCode Team Name is too long</center>";
        }
        elseif($or != 0 && !$this->teamcheck($_POST['team-name']))
        {
            echo "<br><br><center><div  style='color:red; width:10%; background-color:white; border-color:black;border-style: ridge;border-width:auto;  padding: 6px 12px;'>Error:The team, ". $_POST['team-name'] .", is full, please join/make another team.</center>";
        }
        else{
            $data = array('id' => $user['id'],'team_id' => 0 );
                    
            $id = $db->insert('gullcode_users_on_teams', $data);
        }

        $data = array('t_size' => $_POST['t-size']);
        $db->where("id", $user['id']);
        $id = $db ->update('users',$data);
    }
}
?>