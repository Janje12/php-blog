<?php
include('components/header.php');
include('components/navbar.php');
require_once('models/user.php');
require_once('models/post.php');

$usersPosts = Post::findPosts("userID !", $_SESSION['userID']);
$pageNo = 1;
$shownPosts = $usersPosts;
if (isset($_GET['pageNo'])) {
    $pageNo = $_GET['pageNo'];
}
$shownPosts = array_splice($shownPosts, ($pageNo - 1) * 3, 3);
$message = '';
if (isset($_POST['postID']) && isset($_POST['rating']) && isset($_POST['currentRating'])) {
    $postID = $_POST['postID'];
    $rating = $_POST['rating'];
    $currentRating = $_POST['currentRating'];
    if (Post::ratePost($postID, $currentRating + $rating)) {
        $message = 'Uspešno ste ocenili objavu!';
        header("Location: " . "all-posts.php?pageNo={$pageNo}");
    } else {
        $message = 'Greška pri ocenivanju objave! Pokušajte ponovo kasnije!';
    }
}
?>
<div class="container">
    <div class="row no-gutters mt-4 d-flex justify-content-center">
        <div class="col-8">
            <h2 class="my-4">Sve objave:</h2>
            <p class="text-muted"><?php echo $message; ?></p>
            <?php
            foreach ($shownPosts as $post) {
                echo Post::getlHtml($post, true, false, true);
            }
            echo "<form class=\"d-flex justify-content-center\">";
            for ($i = 1; $i <= ceil(count($usersPosts ) + 2) / 3; $i++) {
                $selected = $i == $pageNo ? "btn-dark" : "btn-light";
                echo "<button name=\"pageNo\" value=\"{$i}\" class=\"btn btn-lg {$selected} mx-1\">{$i}</button>";
            }
            echo "</form>";
            ?>
        </div>
    </div>
</div>