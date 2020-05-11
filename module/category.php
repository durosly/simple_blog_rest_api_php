<?php

	class Category {
		private $table = "Categories";
		private $conn;

		public $id;
		public $name;
		public $created_at;

		public function __construct($db) {
			$this->conn = $db;
		}

		public function read() {
			$sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC;";
			$stmt = $this->conn->prepare($sql);

			if($stmt) {
				$stmt->execute();

				$result = $stmt->get_result();
				return $result;
			} else {
				http_response_code(400);
				echo json_encode(array("message" => "SQL error!"));
				die();
			}
		}

		public function read_single() {
			$sql = "SELECT * FROM " . $this->table . " WHERE id=" . $this->id . ";";

			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt = $this->conn->prepare($sql);

			if($stmt) {
				$stmt->execute();

				$result = $stmt->get_result();
				if($result->num_rows > 0) {
					$row = $result->fetch_assoc();
					extract($row);
					$this->id = $id;
					$this->name = $name;
					$this->created_at = $created_at;
					return true;
				} else {
					http_response_code(404);
					echo json_encode(array("message" => "NO categories found."));
				}
			} else {
				http_response_code(400);
				echo json_encode(array("message" => "SQL error!"));
				die();
			}

		}

		public function create() {
			$sql = "INSERT INTO " . $this->table . "(name) VALUES (?);";

			$this->name = htmlspecialchars(strip_tags($this->conn->real_escape_string($this->name)));

			$stmt = $this->conn->prepare($sql);
			if($stmt) {
				$stmt->bind_param("s", $this->name);
				$stmt->execute();
				if($this->conn->affected_rows > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				http_response_code(400);
				echo json_encode(array("message" => "SQL Failed."));
			}
		}

		public function update() {
			$sql = "UPDATE " . $this->table ." SET name=? WHERE id=?;";

			$this->id = htmlspecialchars(strip_tags($this->id));
			$this->name = htmlspecialchars(strip_tags($this->conn->real_escape_string($this->name)));

			$stmt = $this->conn->prepare($sql);
			if($stmt) {
				$stmt->bind_param("si", $this->name, $this->id);
				$stmt->execute();

				if($this->conn->affected_rows > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				http_response_code(403);
				echo json_encode(array("message" => "SQL Error."));
				die();
			}
		}

		public function delete() {
			$sql = "DELETE FROM " . $this->table . " WHERE id=?;";
			$this->id = htmlspecialchars(strip_tags($this->id));

			$stmt = $this->conn->prepare($sql);
			if($stmt) {
				$stmt->bind_param("i", $this->id);
				$stmt->execute();

				if($this->conn->affected_rows > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				http_response_code(403);
				echo json_encode(array("message" => "SQL Error."));
				die();
			}
		}
	}