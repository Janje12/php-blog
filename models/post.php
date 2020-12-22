<?php
require_once("db/dbconnect.php");

class Post
{

    private $postID;
    private $title, $content, $rating, $userID;
    private $dateCreated;

    function __construct($title, $content, $userID)
    {
        $this->title = $title;
        $this->content = $content;
        $this->userID = $userID;
        $this->rating = 0.0;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getRating()
    {
        return $this->rating;
    }

    public static function addPost($post)
    {
        $db = new Database();
        $post = $db->insertPost($post);
        return $post;
    }

    public static function findPosts($type, $value)
    {
        $db = new Database();
        $post = $db->findPost($type, $value);
        return $post;
    }

    public static function searchPosts($type, $value)
    {
        $db = new Database();
        $post = $db->searchPosts($type, $value);
        return $post;
    }

    public static function findBestPosts()
    {
        $db = new Database();
        $post = $db->findBestPosts();
        return $post;
    }

    public static function updatePost($post)
    {
    }

    public static function deletePost($postID)
    {
        $db = new Database();
        $post = $db->deletePost($postID);
        return $post;
    }

    public static function ratePost($postID, $rating) {
        $db = new Database();
        $post = $db->updatePost($postID, 'rating', $rating);
        return $post;
    }

    public static function getlHtml($post)
    {
        $postID = $post['postID'];
        $title = $post['title'];
        $content = $post['content'];
        $rating = $post['rating'];
        $html =
        "<div class=\"card mb-3\">
            <div class=\"card-header\">
                {$title}
            </div>
            <div class=\"card-body\">
                <p class=\"card-text\">{$content}</p>
                <div class=\"d-flex justify-content-end mb-0\">
                <form method=\"POST\" class=\"mb-0\">
                <input type=\"hidden\" name=\"postID\" value=\"{$postID}\">
                <input type=\"hidden\" name=\"currentRating\" value=\"{$rating}\">
                <button type=\"submit\" name=\"rating\" value=\"1\" class=\"btn btn-success\"><i class=\"fa fa-arrow-up\"></i></button>
                <button type=\"submit\" name=\"rating\" value=\"-1\" class=\"btn btn-danger\"><i class=\"fa fa-arrow-down\"></i></button>
                </form>
                </div>
            </div>
            <div class=\"card-footer\">
                {$rating} <i style=\"color: gold;\" class=\"fa fa-star\"></i>
            </div>
        </div>";
        return $html;
    }

    public static function getPersonalHtml($post)
    {
        $postID = $post['postID'];
        $title = $post['title'];
        $content = $post['content'];
        $rating = $post['rating'];
        $html =
        "<div class=\"card mb-3\">
            <div class=\"card-header\">
                {$title}
            </div>
            <div class=\"card-body\">
                <p class=\"card-text\">{$content}</p>
                <div class=\"d-flex justify-content-end mb-0\">
                <form method=\"POST\" class=\"mb-0\">
                <input type=\"hidden\" name=\"postID\" value=\"{$postID}\">
                <button type=\"submit\" class=\"btn btn-danger\">Obriši objavu</button>
                </form>
                </div>
            </div>
            <div class=\"card-footer\">
                {$rating} / 5 <i style=\"color: gold;\" class=\"fa fa-star\"></i>
            </div>
        </div>";
        return $html;
    }
}