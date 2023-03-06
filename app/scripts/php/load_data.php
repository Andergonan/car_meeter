<?php

    $meets="";
    $myMeets="";
    $actionCalendar="";

    $mysql_meets = "SELECT meet_id, organizer, title, organizing, car_specs, datetime, town, address, place, gps_location, description FROM meets";

    if (isset($_SESSION['loggedin'])) {
        $user_id = $_SESSION['id'];

        $mysql_myMeets = "SELECT meet_id, meet_hash, title, datetime, town, address, gps_location, description FROM meets where organizer_id=$user_id";
        $mysql_actionCalendar = "SELECT meet_id, organizer, title, organizing, car_specs, datetime, town, address, place, gps_location, description FROM meets WHERE FIND_IN_SET($user_id, party) > 0";
        
        $result_myMeets = $conn->query($mysql_myMeets);
        $result_actionCalendar = $conn->query($mysql_actionCalendar);
        include_once('meets/load_my_meet.php');
        include_once('meets/load_action_calendar.php');
    }
    
    
    $result_meets = $conn->query($mysql_meets);
    
    $conn->close();

    include_once('meets/load_meet.php');

?>