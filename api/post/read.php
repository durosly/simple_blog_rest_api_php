<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers");

	include_once '../../config/database.php';
	include_once '../../module/post.php';

	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);

	$data = $post->read();
	
	$resultCheck = $data->num_rows;
	if($resultCheck > 0) {
		$post_arr = array("data" => array());

		while($row = $data->fetch_assoc()) {
			extract($row);
			$post_item = array(
				"id" => $id,
				"title" => $title,
				"body" => html_entity_decode($body),
				"author" => $author,
				"category_name" => $category_name,
				"created_at" => $created_at
			);

			array_push($post_arr['data'], $post_item);
		}

		http_response_code(200);
		echo json_encode($post_arr);
	} else {
		http_response_code(402);
		echo json_encode(array("message" => "NO post found."));
	}