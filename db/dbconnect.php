<?php
require_once("models/user.php");
require_once("models/post.php");

class Database
{
	private $conn;

	public function __construct($configFile = "config.ini")
	{
		if (!$config = parse_ini_file($configFile))
			return false;
		try {
			$host = $config['host'];
			$user = $config['user'];
			$pass = $config['password'];
			$database = $config['database'];
			$this->conn = mysqli_connect($host, $user, $pass, $database);
			mysqli_set_charset($this->conn, "utf8");
			return true;
		} catch (Exception $e) {
			$this->conn = null;
			echo $e->getMessage();
		}
		return false;
	}

	public function __destruct()
	{
		$this->conn = null;
	}

	public function insertUser(User $user)
	{
		if (!$this->conn) return false;
		if ($this->findUser('username', $user->getUsername())) return false;
		if ($this->findUser('email', $user->getEmail())) return false;
		try {
			$username = $user->getUsername();
			$firstName = $user->getFirstName();
			$lastName = $user->getLastName();
			$password = $user->getPassword();
			$email = $user->getEmail();
			$sql = "INSERT INTO users(username, firstName, lastName, password, email) VALUES (?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($this->conn, $sql);
			$stmt->bind_param("sssss", $username, $firstName, $lastName, $password, $email);
			return $stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public function findUser($type, $value)
	{
		if (!$this->conn) return false;
		try {
			$sql = "SELECT * FROM users ";
			if ($type !== "" && $value !== "") {
				$sql .= "WHERE " . $type . "= ?"; // Poziva se iz metode u koje ne moze da se prosledi nista drugo osim vec zadato
				$stmt = mysqli_prepare($this->conn, $sql);
				$stmt->bind_param("s", $value);
				$stmt->execute();
				$result = $stmt->get_result()->fetch_assoc();
			} else {
				$result = mysqli_query($this->conn, $sql);
			}
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public function insertPost(Post $post)
	{
		if (!$this->conn) return false;
		if ($this->findPost('title', $post->getTitle())) return false;
		try {
			$title = $post->getTitle();
			$content = $post->getContent();
			$userID = $post->getUserID();
			$sql = "INSERT INTO posts(title, content, userID) VALUES(?, ?, ?)";
			$stmt = mysqli_prepare($this->conn, $sql);
			$stmt->bind_param("ssi", $title, $content, $userID);
			return $stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public function findPost($type, $value)
	{
		if (!$this->conn) return false;
		try {
			$sql = "SELECT * FROM posts ";
			if ($type !== "" && $value !== "") {
				$sql .= "WHERE " . $type . "= ?";
				$stmt = mysqli_prepare($this->conn, $sql);
				$stmt->bind_param("s", $value);
				$stmt->execute();
				$result = $stmt->get_result();
			} else {
				$result = mysqli_query($this->conn, $sql);
			}
			$result_arr = [];
			while ($row = mysqli_fetch_assoc($result)) {
				$result_arr[] = $row;
			}
			return $result_arr;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public function searchPosts($type, $value)
	{
		if (!$this->conn) return false;
		try {
			$value = '%'.$value.'%';
			$sql = "";
			if ($type === 'rating-lower')
				$sql = "SELECT * FROM posts WHERE rating < ?";
			else if ($type === 'rating-higher')
				$sql = "SELECT * FROM posts WHERE rating > ?";
			else
				$sql = "SELECT * FROM posts WHERE " . $type . " LIKE ?";
			$stmt = mysqli_prepare($this->conn, $sql);
			$stmt->bind_param("s", $value);
			$stmt->execute();
			$result = $stmt->get_result();
			$result_arr = [];
			while ($row = mysqli_fetch_assoc($result)) {
				$result_arr[] = $row;
			}
			return $result_arr;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public function findBestPosts()
	{
		if (!$this->conn) return false;
		try {
			$sql = "SELECT * FROM posts ORDER BY rating DESC LIMIT 3 ";
			$result = mysqli_query($this->conn, $sql);
			$result_arr = [];
			while ($row = mysqli_fetch_assoc($result)) {
				$result_arr[] = $row;
			}
			return $result_arr;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public function updatePost($postID, $type, $value)
	{
		if (!$this->conn) return false;
		try {
			$sql = "UPDATE posts SET " . $type . " = ? WHERE postID LIKE ?";
			$stmt = mysqli_prepare($this->conn, $sql);
			$stmt->bind_param("si", $value, $postID);
			return $stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}

	public function deletePost($postID)
	{
		if (!$this->conn) return false;
		try {
			$sql = "DELETE FROM posts WHERE postID LIKE ?";
			$stmt = mysqli_prepare($this->conn, $sql);
			$stmt->bind_param("i", $postID);
			return $stmt->execute();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return false;
	}
}
