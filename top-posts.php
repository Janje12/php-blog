<?php
include('components/header.php');
include('components/navbar.php');
require_once('models/user.php');
require_once('models/post.php');

$usersPosts = Post::findBestPosts();
$message = '';
if (isset($_POST['postID']) && isset($_POST['rating']) && isset($_POST['currentRating'])) {
    $postID = $_POST['postID'];
    $rating = $_POST['rating'];
    $currentRating = $_POST['currentRating'];
    if (Post::ratePost($postID, $currentRating + $rating)) {
        $message = 'Uspešno ste ocenili objavu!';
        header('Location: ' . 'top-posts.php');
    } else {
        $message = 'Greška pri ocenivanju objave! Pokušajte ponovo kasnije!';
    }
}
?>
<div class="container">
    <div class="row no-gutters mt-4 d-flex justify-content-center">
        <div class="col-8">
            <h2 class="my-4">Najbolje objave:</h2>
            <p class="text-muted"><?php echo $message; ?></p>
            <?php
            foreach ($usersPosts as $post) {
                echo Post::getlHtml($post, false, false, true);
            }
            ?>
        </div>
    </div>
</div>