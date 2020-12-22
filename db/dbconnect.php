<?php
require_once("models/user.php");
require_once("models/post.php");

class Database
{
	private $conn;

	public function __construct()
	{
		try {
			$this->conn = mysqli_connect("localhost", "root", "", "blog");
			mysqli_set_charset($this->conn, "utf8");
			return true;
		} catch (PDOException $e) {
			$this->conn = null;
		}
		return false;
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
			$sql = "INSERT INTO users(username, firstName, lastName, password, email) 
			VALUES('".$username."','".$firstName."','".$lastName."','".$password."','".$email."')";
			return mysqli_query($this->conn, $sql);
		} catch (Exception $e) {
			return $e;
		}
		return false;
	}

	public function findUser($type, $value) {
		if (!$this->conn) return false;
		try {
			$sql = "SELECT * FROM users WHERE " . $type . " = '" . $value . "'";
			$result = mysqli_query($this->conn, $sql);
			return mysqli_fetch_assoc($result);
		} catch (Exception $e) {
			return $e;
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
			$sql = "INSERT INTO posts(title, content, userID) 
			VALUES('".$title."','".$content."','".$userID."')";
			return mysqli_query($this->conn, $sql);
		} catch (Exception $e) {
			return $e;
		}
		return false;
	}

	public function findPost($type, $value) {
		if (!$this->conn) return false;
		try {
			$sql = "SELECT * FROM posts ";
			if ($type !== "" && $value !== "")
				$sql .= "WHERE " . $type . "= '" . $value . "'";
			$result = mysqli_query($this->conn, $sql);
			$result_arr = [];
			while($row = mysqli_fetch_assoc($result)){
  				$result_arr[] = $row;
			}
			return $result_arr;
		} catch (Exception $e) {
			return $e;
		}
		return false;
	}

	public function searchPosts($type, $value) {
		if (!$this->conn) return false;
		try {
			$sql = "";
			if ($type === 'rating-lower')
				$sql = "SELECT * FROM posts WHERE rating < " . $value;
			else if ($type === 'rating-higher')
				$sql = "SELECT * FROM posts WHERE rating > " . $value;
			else
				$sql = "SELECT * FROM posts WHERE " . $type . " LIKE '%" . $value . "%'";
			$result = mysqli_query($this->conn, $sql);
			$result_arr = [];
			while($row = mysqli_fetch_assoc($result)){
  				$result_arr[] = $row;
			}
			return $result_arr;
		} catch (Exception $e) {
			return $e;
		}
		return false;
	}

	public function findBestPosts() {
		if (!$this->conn) return false;
		try {
			$sql = "SELECT * FROM posts ORDER BY rating DESC LIMIT 3 ";
			$result = mysqli_query($this->conn, $sql);
			$result_arr = [];
			while($row = mysqli_fetch_assoc($result)){
  				$result_arr[] = $row;
			}
			return $result_arr;
		} catch (Exception $e) {
			return $e;
		}
		return false;
	}

	public function updatePost($postID, $type, $value) {
		if (!$this->conn) return false;
		try {
			$sql = "UPDATE posts SET " . $type . " = " . $value . " WHERE postID LIKE '" . $postID . "'";
			return mysqli_query($this->conn, $sql);
		} catch (Exception $e) {
			return $e;
		}
		return false;
	}

	public function deletePost($postID) {
		if (!$this->conn) return false;
		try {
			$sql = "DELETE FROM posts WHERE postID LIKE '" . $postID . "'";
			return mysqli_query($this->conn, $sql);
		} catch (Exception $e) {
			return $e;
		}
		return false;
	}
}
