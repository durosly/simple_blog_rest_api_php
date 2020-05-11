<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT");
	header("Content-Type: application/json");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With, Content-Type");

	include_once '../../config/database.php';
	include_once '../../module/post.php';

	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);

	$data = json_decode(file_get_contents("php://input"));

	if(empty($data->id) || empty($data->title) || empty($data->body) || empty($data->author) || empty($data->category_id)) {
		http_response_code(403);
		echo json_encode(array("message" => "Enter all fields"));
	} else {
		$post->id = $data->id;
		$post->title = $data->title;
		$post->body = $data->body;
		$post->author = $data->author;
		$post->category_id = $data->category_id;

		$status = $post->update();

		if($status) {
			http_response_code(200);
			echo json_encode(array("message" => "Post updated successfully."));
		} else {
			http_response_code(400);
			echo json_encode(array("message" => "Unable to update post."));

		}
	}