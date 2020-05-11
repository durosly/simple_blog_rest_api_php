<?php 

	class Post {
		private $table = "posts";
		private $conn;

		public $id;
		public $title;
		public $body;
		public $author;
		public $category_name;
		public $category_id;
		public $created_at;

		public function __construct($db) {
			$this->conn = $db;
		}

		public function read() {
			$sql = "SELECT p.id, p.title, p.body, p.author,p.created_at, c.name as category_name FROM ". $this->table ." AS p LEFT JOIN categories AS c ON c.id = p.category_id ORDER BY p.created_at DESC;";

			$result = $this->conn->query($sql);
			return $result;

		}

		public function read_single() {
			$sql = "SELECT p.id, p.title, p.body, p.author,p.created_at, c.name as category_name FROM ". $this->table ." AS p LEFT JOIN categories AS c ON c.id = p.category_id WHERE p.id = ? LIMIT 0,1";
			$this->id = htmlspecialchars(strip_tags(trim($this->id)));
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("i", $this->id);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0) {
				$data = $result->fetch_assoc();
				extract($data);
				$this->title = $title;
				$this->body = htmlspecialchars_decode($body);
				$this->author = $author;
				$this->category_name = $category_name;
				$this->created_at = $created_at;
				return true;
			} else {
				return false;
			}
		}

		public function create() {
			$sql = "INSERT INTO " . $this->table . "(title, body, author, category_id) VALUES (?,?,?,?);";
			//santize data
			$this->title = html_entity_decode(strip_tags($this->conn->real_escape_string($this->title)));
			$this->body = html_entity_decode(strip_tags($this->conn->real_escape_string($this->body)));
			$this->author = html_entity_decode(strip_tags($this->conn->real_escape_string($this->author)));
			$this->category_id = html_entity_decode(strip_tags($this->conn->real_escape_string($this->category_id)));

			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssi", $this->title, $this->body, $this->author, $this->category_id);
			$stmt->execute();

			if($this->conn->affected_rows > 0) {
				return true;
			} else {
				return false;
			}


		}

		public function update() {
			$sql = "UPDATE " . $this->table . " SET title=?, body=?, author=?, category_id=? WHERE id=?;";
			//sanitize data
			$this->id = html_entity_decode(strip_tags($this->conn->real_escape_string($this->id)));
			$this->title = html_entity_decode(strip_tags($this->conn->real_escape_string($this->title)));
			$this->body = html_entity_decode(strip_tags($this->conn->real_escape_string($this->body)));
			$this->author = html_entity_decode(strip_tags($this->conn->real_escape_string($this->author)));
			$this->category_id = html_entity_decode(strip_tags($this->conn->real_escape_string($this->category_id)));

			//bind and execute query
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssii", $this->title, $this->body, $this->author, $this->category_id, $this->id);
			$stmt->execute();

			//check status
			if($this->conn->affected_rows > 0) {
				return true;
			} else {
				return false;
			}
		}

		public function delete() {
			$sql = "DELETE FROM " . $this->table . " WHERE id=?;";
			//sanitize data
			$this->id = html_entity_decode(strip_tags($this->conn->real_escape_string($this->id)));


			$stmt = $this->conn->prepare($sql);
			if($stmt) {
				$stmt->bind_param("i", $this->id);
				$stmt->execute();
				//check status
				if($this->conn->affected_rows > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				http_response_code(403);
				echo json_encode(array("message" => "SQL failed."));
				exit();
			}
		}
	}