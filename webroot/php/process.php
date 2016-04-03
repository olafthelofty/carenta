<?php

// see http://www.jqueryajaxphp.com/fullcalendar-crud-with-jquery-and-php/

include('config.php');

$type = $_POST['type'];

if($type == 'delete')
{
   
    $empid = $_POST['empID'];
	$delete = mysqli_query($con,"DELETE FROM events where employee_id='$empid'");
	if($delete)
		echo json_encode(array('status'=>'event delete success'));
	else
		echo json_encode(array('status'=>'event delete failed'));
}

if($type == 'patternevent')
{
    //$_POST['newEvents'];
    
    // $empid = $_POST['empID'];
	// $delete = mysqli_query($con,"DELETE FROM events where employee_id='$empid'");
	// if($delete)
	// 	echo json_encode(array('status'=>'event delete success'));
	// else
	// 	echo json_encode(array('status'=>'event delete failed'));
    
    
    foreach($_POST['newEvents'] as $value) {
    
	$startdate = $value['startdate'].'+'.$value['zone'];
    $enddate = $value['enddate'].'+'.$value['zone'];   
	$title = $value['title'];
    $resource_id = $value['resource_id']; 
    $pattern_id = $value['pattern_id']; 
    $employee_id = $value['employee_id'];
    $event_type = $value['event_type'];
    $allDay = $value['allDay'];
	$insert = mysqli_query($con,"INSERT INTO events(`title`, `startdate`, `enddate`, `allDay`, `resource_id`, `pattern_id`, `employee_id`, `event_type`) VALUES('$title','$startdate','$enddate','$allDay', '$resource_id', '$pattern_id', '$employee_id', '$event_type')");
    //$insert = mysqli_query($con,"INSERT INTO events( `startdate`) VALUES('$startdate')");
	$lastid = mysqli_insert_id($con);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
    }
}

if($type == 'new')
{
	$startdate = $_POST['start'].'+'.$_POST['zone'];
    $enddate = $_POST['end'].'+'.$_POST['zone'];
	$title = $_POST['title'];
    $resource_id = $_POST['resourceId'];
	$insert = mysqli_query($con,"INSERT INTO events(`title`, `startdate`, `enddate`, `allDay`, `resource_id`) VALUES('$title','$startdate','$enddate','false', '$resource_id')");
	$lastid = mysqli_insert_id($con);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
}

if($type == 'changetitle')
{
	$eventid = $_POST['eventid'];
	$title = $_POST['title'];
	$update = mysqli_query($con,"UPDATE events SET title='$title' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'resetdate')
{
	$title = $_POST['title'];
	$startdate = $_POST['start'];
	$enddate = $_POST['end'];
	$eventid = $_POST['eventid'];
	$update = mysqli_query($con,"UPDATE events SET title='$title', startdate = '$startdate', enddate = '$enddate' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'remove')
{
	$eventid = $_POST['eventid'];
	$delete = mysqli_query($con,"DELETE FROM events where id='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'fetch')
{
    $employee_id = $_POST['employeeID'];
	$events = array();
	$query = mysqli_query($con, 
        "
        SELECT 
            events.id, 
            events.title, 
            events.startdate, 
            events.enddate, 
            events.resource_id, 
            events.employee_id, 
            resources.title resourcesTitle
        FROM 
            events
        RIGHT JOIN 
            resources
        ON 
            events.resource_id = resources.id 
        WHERE 
            events.employee_id ='$employee_id'
        "
        );
	while($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC))
	{
	$e = array();
    $e['id'] = $fetch['id'];
    $e['title'] = $fetch['title'];
    $e['start'] = $fetch['startdate'];
    $e['end'] = $fetch['enddate'];
    $e['resourceId'] = $fetch['resource_id'];
    $e['resourcesTitle'] = $fetch['resourcesTitle'];
    
    $allday = ($fetch['allDay'] == "true") ? true : false;
    $e['allDay'] = $allday;

    array_push($events, $e);
	}
	echo json_encode($events);
}


?>