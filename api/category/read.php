<?php 

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Method: GET");
	header("Access-Control-Allow-Header: Access-Control-Allow-Header, Access-Control-Allow-Method, Access-Control-Allow-Origin, X-Requested-With");

	require_once "../../config/database.php";
	require_once "../../module/category.php";

	$database = new Database();
	$db = $database->connect();

	$category = new Category($db);

	$data = $category->read();

	$resultCheck = $data->num_rows;
	if($resultCheck > 0) {
		$categories_arr = array("data" => array());

		while($row = $data->fetch_assoc()) {
			extract($row);

			$category_item = array(
				"id" => $id,
				"name" => $name,
				"created_at" => $created_at
			);

			array_push($categories_arr['data'], $category_item);
		}

		http_response_code(200);
		echo json_encode($categories_arr);
	} else {
		http_response_code(404);
		echo json_encode(array("message" => "No post found."));
	}

	

