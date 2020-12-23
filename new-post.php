<?php
include('components/header.php');
include('components/navbar.php');
require_once('models/post.php');

if (!isset($_POST['title']) && !isset($_POST['content'])) {
    $message = 'Naslov i sadržaj ne smeju biti prazni!';
} else {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars( $_POST['content']);
    $userID =  htmlspecialchars($_SESSION['userID']);
    $post = new Post($title, $content, $userID);
    if (Post::addPost($post)) {
        $message = 'Uspešno ste napravili novu objavu!';
        header('Location: ' . 'index.php');
    } else {
        $message = 'Već postoji objava sa tim naslovom!';
    }
}
?>
<div class="container">
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-6">
            <form method="POST">
                <div class="input-group input-group-lg mb-3">
                    <label class="col-12 text-muted">Naslov:</label>
                    <input type="text" name="title" class="form-control" placeholder="Naslov">
                </div>
                <div class="input-group input-group-lg mb-3">
                    <label class="col-12 text-muted">Sadržaj:</label>
                    <textarea class="form-control" name="content" rows="8" placeholder="Sadržaj..."></textarea>
                </div>
                <label class="text-center">
                    <?php echo $message; ?>
                </label>
                <div class="input-group input-group-lg d-flex justify-content-end">
                    <button type="submit" class="btn btn-outline-success">Objavi!</button>
                </div>
            </form>
        </div>
    </div>
</div>