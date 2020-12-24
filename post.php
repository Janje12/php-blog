<?php
include('components/header.php');
include('components/navbar.php');
require_once('models/post.php');

$message = '';
$canDelete = false;
if (isset($_GET['postID'])) {
	$postID = $_GET['postID'];
	if (Post::findPosts('postID', $postID)) {
		$foundPost = Post::findPosts("postID", $postID);
		$canDelete = $_SESSION['userID'] == $foundPost[0]['userID'] ? true : false;
	} else {
		$message = 'Greška! Ta objava ne postoji više!';
	}
}

?>
<style>
	.link-light {
		color:black;
		text-decoration: none;
	}
</style>
<div class="container">
	<div class="row mt-4 d-flex justify-content-end">
		<div class="col-6">
			<a class="link-light" href="index.php"><button class="btn btn-outline-dark">&nbsp;<i class="fa fa-arrow-left"></i>&nbsp;</a>
			</button>
		</div>
		<div class="col-4">
			<form method="POST" action="new-post.php">
				<button class="btn btn-outline-success" type="submit">Dodaj novu objavu! <i class="fa fa-edit"></i> </button>
			</form>
		</div>
	</div>
	<div class="row no-gutters d-flex justify-content-center">
		<div class="col-8">
			<h2 class="mb-4"><?php echo $foundPost[0]['title']; ?></h2>
			<p class="text-muted"><?php echo $message; ?></p>
			<?php
			foreach ($foundPost as $post) {
				echo Post::getlHtml($post, false, $canDelete, false);
			}
			?>
		</div>
	</div>
</div>