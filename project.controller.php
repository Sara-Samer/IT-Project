<?php
require 'db.inc.php';
session_start();
$pm = isset($_SESSION['pm'])? $_SESSION['pm'] : 0;
ini_set('display_errors', true);

$action = isset($_POST['action']) ? $_POST['action'] : null;
 
switch($action){
    case 'set_task_complete':
        $tid = $_POST['task_id'];
        $wh = $_POST['working_hours'];
        $stmt = $link->prepare('UPDATE `task` SET `is-complete` = 1, `actual-working-hours` = ? WHERE `id` = ?');
        $stmt->bind_param('ii', $wh, $tid);
        $stmt->execute();
        break;
    case "add-member":
        $member_name = $_POST['member'];
        $stmt = $link->prepare('INSERT INTO `member` VALUES (null, ?) ');
        $stmt->bind_param('s', $member_name);
        $stmt->execute();
        break;
    case "add-task":
        $pid = $_POST['project-id'];
        $task_name = $_POST['task-name'];
        $start_date = $_POST['start-date'];
        $end_date = $_POST['end-date'];
        $working_hrs = $_POST['working-hrs'];
        $milestone = isset($_POST['milestone']);
        $predecessors = $_POST['predecessors'];
        $parent = $_POST['parent'];
        $stmt = $link->prepare('INSERT INTO `task` (`name`, `start-date`, `end-date`, `working-hours`, `parent-task-id`, `is-milestone`, `project-id`) VALUES (?,?,?,?,NULLIF(?,0),?,?)');
        $stmt->bind_param('sssiiii',$task_name, $start_date, $end_date, $working_hrs, $parent, $milestone, $pid);
        $stmt->execute();
        $tid = mysqli_insert_id($link);
        foreach($predecessors as $pre){
            $stmt = $link->prepare('INSERT INTO `task-dependency` VALUES (?,?)');
            $stmt->bind_param('ii', $pre, $tid);
            $stmt->execute();
        }
        header('Location:Project_info.php?id='.$pid);
    break;
    case "add-project":
        $deliverables = $_POST['deliverables'];
        $name = $_POST["Name"];
        $StartDate = $_POST["StartDate"];
        $EndDate = $_POST["EndDate"];
        $Cost = $_POST["Cost"];
        $HoursperDay = $_POST["HoursperDay"];
        $sql = "INSERT INTO project (name, 	`hours-per-day`, cost , 	`start-date` , 	`end-date`) VALUES ('$name','$HoursperDay', '$Cost', '$StartDate', '$EndDate')";
        mysqli_query($link, $sql);
        $id = mysqli_insert_id($link);
        foreach($deliverables as $deliverable){
            $insert = $link->prepare('INSERT INTO `deliverables` (`project-id`, `title`) VALUES (?,?)');
            $insert->bind_param('is', $id, $deliverable);
            $insert->execute();
        }
        
        header('Location:Projects.php');
    break;    
    case "add-manager":
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $link->prepare("INSERT INTO `project-managers` (name, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $username, $password);
        $stmt->execute();
        header('Location:login.php');
    break;
    case "check-username":
        $username = $_POST['username'];
        $stmt = $link -> prepare("SELECT * FROM `project-managers` WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        if($stmt -> fetch())
            echo "EXISTS";
            else
            echo "ADD";
        break;
    case "login":
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $link->prepare("SELECT id, name FROM `project-managers` WHERE username = ? AND password = ?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->bind_result($id, $name);
        $stmt->execute();
        if($stmt->fetch()) {
            header('Location:Projects.php?pm-name='.$name);
            $_SESSION['pm'] = $id;
        }else{
            echo "<script> alert ('invalid username or Password'); </script>";
            header('Location:login.php');
        }

    break;
    case "plan-config":
        $day = $_POST['day'];
        $hrs = $_POST['hrs'];
        $stmt = $link->prepare("SELECET day, `hrs-per-day` FROM `plan-cfg` WHERE `pm-id` = ? ");
        $stmt->bind_param('i', $pm);
        $stmt->bind_result($d, $h);
        $stmt->execute();
        if(!$stmt->fetch()){
            $insert = $link->prepare("INSERT INTO `plan-cfg` (`pm-id`, day, `hrs-per-day`) VALUES (?, ?, ?)");
            $insert->bind_param('iii',$pm, $day, $hrs);
            $insert->execute();
        }else{
            $update = $link->prepare("UPDATE `plan-cfg` SET `day` = ?, `hrs-per-day` = ?  WHERE `pm-id` = ?");
            $update->bind_param('iii', $day, $hrs, $pm);
            $update->execute();
        }
    break;
    case "delete-project":
        $stmt = $link->prepare("SELECT * FROM `project` WHERE pid = ? AND pm-id = ?");
    break;


}
