<?php
	include_once('../../database/db_connection.php');

	session_start();
	error_reporting(0);



if($_POST['action'] == 'all_users'){

	$output_user_all='';	
	$sql_user_all = "SELECT regnumber,fname,email,username,typeID  FROM  tbluser  WHERE regnumber !=:reg_number order by regnumber asc";
	$query_user_all= $dbh -> prepare($sql_user_all);
	$query_user_all-> bindParam(':reg_number', $_SESSION['regnumber'], PDO::PARAM_STR);
	$query_user_all-> execute();
	$results_user_all=$query_user_all->fetchAll(PDO::FETCH_OBJ);

	if($query_user_all->rowCount() > 0){
		foreach ($results_user_all as $result_user_all) {
            
			$output_user_all .= '
				<tr>
					<td>'.$result_user_all->regnumber.'</td>
					<td>'.$result_user_all->fname.'</td>
					<td>'.$result_user_all->email.'</td>
					<td><i class="glyphicon glyphicon-edit text-info" title="Edit"></i>&nbsp;&nbsp;'.activate_deactivate($dbh,$result_user_all->regnumber).'&nbsp;&nbsp;<i class="glyphicon glyphicon-trash text-danger" title="Delete"></i></td>
				</tr>';
		}

	}

echo $output_user_all;

}

if($_POST['action'] == 'activate'){

	$sql="UPDATE tbluser SET parmision_status = parmision_status+1 WHERE regnumber ='".$_POST['to_user_id']."'";
    $query = $dbh->prepare($sql);
    $query->execute();
}

if($_POST['action'] == 'deactivate'){

	$sql="UPDATE tbluser SET parmision_status = parmision_status-1 WHERE regnumber ='".$_POST['to_user_id']."'";
    $query = $dbh->prepare($sql);
    $query->execute();
}




/*ALL FUNCTION IN THIS FILES */


function activate_deactivate($dbh,$regnumber){
	$query = "SELECT regnumber,parmision_status FROM tbluser WHERE regnumber = '".$regnumber."' AND parmision_status = '0'";
	$startment = $dbh->prepare($query);
	$startment->execute();
	$total_row = $startment->rowCount();
	$output = '';

	if($total_row > 0){

		$output = '<span class="action_button" data-touserid="'.$regnumber.'" data-action="activate"><i class="glyphicon glyphicon-ok text-success" title="activate"></i></span>';
		
	}else{

		$output = '<span class="action_button" data-touserid="'.$regnumber.'" data-action="deactivate"><i class="glyphicon glyphicon-remove text-danger" title="deactivate"></i></span>';

	}

	return $output;
}

?>

