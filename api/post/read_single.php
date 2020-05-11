<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers");



	include_once '../../config/database.php';
	include_once '../../module/post.php';

	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);
	$post->id = isset($_GET['id']) ? $_GET['id']: die();

	$status = $post->read_single();

	if($status) {
		http_response_code(200);
		echo json_encode(array(
			"id" => $post->id,
			"title" => $post->title,
			"body" => $post->body,
			"author" => $post->author,
			"category_name" => $post->category_name,
			"created_at" => $post->created_at
		));
	} else {
		http_response_code(404);
		echo json_encode(array("message" => "No post found."));
	}