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
        if ($type === 'username') {
            $user = $db->findUser('username', $value);
            $type = 'userID';
            $value = $user['userID'];
        }
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

    public static function ratePost($postID, $rating)
    {
        $db = new Database();
        $post = $db->updatePost($postID, 'rating', $rating);
        return $post;
    }

    public static function getlHtml($post, $canRate)
    {
        $db = new Database();
        $postID = $post['postID'];
        $title = $post['title'];
        $content = $post['content'];
        $rating = $post['rating'];
        $user = $db->findUser('userID', $post['userID']);
        $username = $user['username'];
        $dateCreated = substr($post['datePosted'], 0, 10);
        $rateHtml = "<div class=\"col-5\">{$rating} <i style=\"color: gold;\" class=\"fa fa-star\"></i></div>";
        if ($canRate) {
            $rateHtml = 
            "<div class=\"col-1\">{$rating} <i style=\"color: gold;\" class=\"fa fa-star\"></i></div>
            <div class=\"col-4 mb-0\">
            <form method=\"POST\" class=\"mb-0\">
            <input type=\"hidden\" name=\"postID\" value=\"{$postID}\">
            <input type=\"hidden\" name=\"currentRating\" value=\"{$rating}\">
            <button type=\"submit\" name=\"rating\" value=\"1\" class=\"btn btn-success\"><i class=\"fa fa-arrow-up\"></i></button>
            <button type=\"submit\" name=\"rating\" value=\"-1\" class=\"btn btn-danger\"><i class=\"fa fa-arrow-down\"></i></button>
            </form>
            </div>";
        }
        $html =
            "<div class=\"card mb-3\">
            <div class=\"card-header\">
                <h5>{$title}</h5>
                <p class=\"text-muted\">Objavio: <a class=\"link-secondary\" href=\"search-posts.php?filter=username&value={$username}\">${username}</a></p>
            </div>
            <div class=\"card-body\">
                <p class=\"card-text\">{$content}</p>
            </div>
            <div class=\"card-footer\">
            <div class=\"row\">
                {$rateHtml}
                <div class=\"col-7 d-flex justify-content-end\">
                    <a href=\"search-posts.php?filter=datePosted&value={$dateCreated}\" class=\"text-muted mb-0\">{$dateCreated}</a>
                </div>
            </div>
            </div>
        </div>";
        return $html;
    }

}
