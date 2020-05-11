<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers");

	include_once '../../config/database.php';
	include_once '../../module/post.php';

	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);

	$data = json_decode(file_get_contents("php://input"));

	if(empty($data->title) || empty($data->body) || empty($data->author) || empty($data->category_id)) {
		http_response_code(403);
		echo json_encode(array("message" => "Enter all fields"));
		exit();
	} else {
		$post->title = $data->title;
		$post->body = $data->body;
		$post->author = $data->author;
		$post->category_id = $data->category_id;
		$status = $post->create();

		if($status) {
			http_response_code(200);
			echo json_encode(array("message" => "post created."));
		} else {
			http_response_code(401);
			echo json_encode(array("message" => "post not created."));
		}
	}

