<?php

	class Database {
		private $host = "localhost";
		private $username = "root";
		private $password = "";
		private $dbname = "blog_api";
		private $conn;

		public function connect() {
			$this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

			if($this->conn) {
				return $this->conn;
			} else {
				http_response_code(403);
				echo json_encode(array("message" => "Connection failed."));
			}
		}
	}