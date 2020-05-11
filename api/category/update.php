<?php 

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Method: PUT");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Header: Access-Control-Allow-Header, Access-Control-Allow-Method, Access-Control-Allow-Origin, X-Requested-With, Authorization");

	require_once "../../config/database.php";
	require_once "../../module/category.php";

	$data = json_decode(file_get_contents("php://input"));
	if(!isset($data->name) || empty($data->name) || !isset($data->id) || empty($data->id)) die("No entries");

	$database = new Database();
	$db = $database->connect();

	$category = new Category($db);
	$category->id = $data->id;
	$category->name = $data->name;
	$status = $category->update();

	if($status) {
		http_response_code(200);
		echo json_encode(array("message" => "Category updated successfully."));
	} else {
		http_response_code(403);
		echo json_encode(array("message" => "Category update unsuccessful."));
	}