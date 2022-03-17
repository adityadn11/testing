<?php 
require_once "koneksi.php";

if(function_exists($_GET['function'])){
	$_GET['function']();
}

function get_band()
{
	global $connect;
	$query = $connect->query("SELECT * FROM band");
	while($row=mysqli_fetch_object($query))
	{
		$data[] = $row;
	}

	$response=array('status' => 1,
		'message' =>'Success',
		'data'=> $data);

	header('Content-Type : application/json');
	echo json_encode($response);
}

function get_band_id()
{
	global $connect;
	if (!empty($_GET["band_id"])){
		$id = $_GET["band_id"];
	}

	$query ="SELECT * FROM band WHERE band_id = $id";
	$result = $connet ->query($query);
	while($row = mysqli_fetch_object($result))
	{
		$data[] = $row;
	}
	if($data)
	{
		$response = array('status' => 1,
			'message' =>'Success',
			'data' => $data);
	}else {
		$response=array('status' => 0,
			'message' => 'No Data Found');
	}
	header('Content-Type : application/json');
	echo json_encode($response);
}

function get_personnel()
{
	global $connect;
	$query = $connect->query("SELECT * FROM personnel");
	while($row=mysqli_fetch_object($query))
	{
		$data[] = $row;
	}

	$response=array('status' => 1,
		'message' =>'Success',
		'data'=> $data);

	header('Content-Type : application/json');
	echo json_encode($response);
}
function get_personnel_id()
{
	global $connect;
	if (!empty($_GET["personnel_id"])){
		$id = $_GET["personnel_id"];
	}

	$query ="SELECT * FROM personnel WHERE personnel_id = $id";
	$result = $connet ->query($query);
	while($row = mysqli_fetch_object($result))
	{
		$data[] = $row;
	}
	if($data)
	{
		$response = array('status' => 1,
			'message' =>'Success',
			'data' => $data);
	}else {
		$response=array('status' => 0,
			'message' => 'No Data Found');
	}
	header('Content-Type : application/json');
	echo json_encode($response);
}

function get_detailband()
{
	global $connect;
	$query = $connect->query("SELECT band_name, name, position FROM personnel INNER JOIN band ON personnel.band_id=band.band_id");
	while($row=mysqli_fetch_object($query))
	{
		$data[] = $row;
	}

	$response=array('status' => 1,
		'message' =>'Success',
		'data'=> $data);

	header('Content-Type : application/json');
	echo json_encode($response);

}

function insert_band()
{
	global $connect;   
	$check = array('id' => '', 'name' => '', 'max_personnel' => '');
	$check_match = count(array_intersect_key($_POST, $check));
	if($check_match == count($check)){

		$result = mysqli_query($connect, "INSERT INTO band SET
			band_id = '$_POST[id]',
			band_namename = '$_POST[name]',
			max_personnel = '$_POST[personnel]'");

		if($result)
		{
			$response=array(
				'status' => 1,
				'message' =>'Insert Success'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Insert Failed.'
			);
		}
	}else{
		$response=array(
			'status' => 0,
			'message' =>'Wrong Parameter'
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}


function insert_personnel()
{
	global $connect;   
	$check = array('id' => '','band_id' => '', 'name' => '', 'position' => '');
	$check_match = count(array_intersect_key($_POST, $check));
	if($check_match == count($check)){

		$result = mysqli_query($connect, "INSERT INTO personnel SET
			personnel_id = '$_POST[id]'
			band_id = '$_POST[band_id]',
			name = '$_POST[name]',
			position = '$_POST[position]'");

		if($result)
		{
			$response=array(
				'status' => 1,
				'message' =>'Insert Success'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Insert Failed.'
			);
		}
	}else{
		$response=array(
			'status' => 0,
			'message' =>'Wrong Parameter'
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}

function update_band()
{
	global $connect;
	if (!empty($_GET["id"])) {
		$id = $_GET["id"];
	}   
	global $connect;   
	$check = array('id' => '', 'name' => '', 'max_personnel' => '');
	$check_match = count(array_intersect_key($_POST, $check));
	if($check_match == count($check)){

		$result = mysqli_query($connect, "UPDATE band SET               
			band_id = '$_POST[id]',
			band_namename = '$_POST[name]',
			max_personnel = '$_POST[personnel]'");

		if($result)
		{
			$response=array(
				'status' => 1,
				'message' =>'Update Success'                  
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Update Failed'                  
			);
		}
	}else{
		$response=array(
			'status' => 0,
			'message' =>'Wrong Parameter',
			'data'=> $id
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}

function update_personnel()
{
	global $connect;
	if (!empty($_GET["id"])) {
		$id = $_GET["id"];
	}   
	global $connect;   
	$check = array('id' => '','band_id' => '', 'name' => '', 'position' => '');
	$check_match = count(array_intersect_key($_POST, $check));
	if($check_match == count($check)){

		$result = mysqli_query($connect, "UPDATE personnel SET               
			personnel_id = '$_POST[id]'
			band_id = '$_POST[band_id]',
			name = '$_POST[name]',
			position = '$_POST[position]'");

		if($result)
		{
			$response=array(
				'status' => 1,
				'message' =>'Update Success'                  
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Update Failed'                  
			);
		}
	}
	else
	{
		$response=array(
			'status' => 0,
			'message' =>'Wrong Parameter',
			'data'=> $id
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}
?>