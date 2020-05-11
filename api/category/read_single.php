<?php 

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Method: GET");
	header("Access-Control-Allow-Header: Access-Control-Allow-Header, Access-Control-Allow-Method, Access-Control-Allow-Origin, X-Requested-With");

	if(!isset($_GET['id']) || empty($_GET['id']))die("No entry");
	require_once "../../config/database.php";
	require_once "../../module/category.php";

	$database = new Database();
	$db = $database->connect();

	$category = new Category($db);
	$category->id = $_GET['id'];

	$status = $category->read_single();

	if($status) {
		http_response_code(200);
		echo json_encode(array(
			"id" => $category->id,
			"name" => $category->name,
			"created_at" => $category->created_at
		));
	}