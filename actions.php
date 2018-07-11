<?php
include "database.php";
if($_POST){
	$returnData = array();
	if($_POST['type'] == 'getTypes'){
		$type_id = $_POST['type_id'];
		$getTabels = mysqli_fetch_array(mysqli_query($con, "select * from type_list where id='$type_id'"));
		$table = $getTabels['type_tables'];
		$selectQuery = mysqli_query($con, "select * from $table");
		while($fetQuery = mysqli_fetch_array($selectQuery)){
			$returnData[] = $fetQuery;
		}
		echo json_encode($returnData);
	}


	if($_POST['type'] == 'getTaskList'){
		$type = $_POST['task_types'];
		$opr = $_POST['opr'];
		switch ($opr) {
			case 1:
				$opp = '=';
				break;
			case 2:
				$opp = '!=';
				break;
			default:
				$opp = '=';
				break;
		}
		$type_lists = $_POST['type_lists'];
		$getTabels = mysqli_fetch_array(mysqli_query($con, "select * from type_list where id='$type'"));
		$table = $getTabels['type_tables'];

         $query = "SELECT employee.`name` AS emp_name,food.`name` AS food_name, department.name AS dep_name, project.name AS project_name, task.name AS task_name, task.task_status AS task_status FROM task INNER JOIN employee ON employee.id = task.emp_id INNER JOIN department ON department.id = task.dep_id  INNER JOIN food ON food.id = task.f_id INNER JOIN project ON project.id = task.pro_id WHERE $table.id $opp '$type_lists'";

		$selectTask = mysqli_query($con,$query);

         while($fetTask = mysqli_fetch_array($selectTask)){
			$returnData[] = $fetTask;
		}
		echo json_encode($returnData);
	}
}
if($_GET){

}


?>
