<?php
include('components/header.php');
include('components/navbar.php');
require_once('models/user.php');
require_once('models/post.php');

$usersPosts = Post::findPosts("userID", $_SESSION['userID']);
$pageNo = 1;
$shownPosts = $usersPosts;
if (isset($_GET['pageNo'])) {
	$pageNo = $_GET['pageNo'];
}
$shownPosts = array_splice($shownPosts, ($pageNo - 1) * 3, 3);

$message = '';
if (isset($_POST['postID'])) {
	$postID = $_POST['postID'];
	if (Post::deletePost($postID)) {
		$message = 'Uspešno ste obrisali objavu!';
		header('Location: ' . 'index.php?pageNo=' . $pageNo);
	} else {
		$message = 'Greška pri brisanju objave! Pokušajte ponovo kasnije!';
	}
}

?>
<div class="container">
	<div class="row mt-4 d-flex justify-content-end">
		<?php echo $message; ?>
		<div class="col-4">
			<form method="POST" action="new-post.php">
				<button class="btn btn-outline-success" type="submit">Dodaj novu objavu! <i class="fa fa-edit"></i> </button>
			</form>
		</div>
	</div>
	<div class="row no-gutters d-flex justify-content-center">
		<div class="col-8">
			<h2 class="mb-4">Vaše objave:</h2>
			<p class="text-muted"><?php echo $message; ?></p>
			<?php
			foreach ($shownPosts as $post) {
				echo Post::getlHtml($post, false, true, true);
			}
			echo "<form class=\"d-flex justify-content-center\">";
			for ($i = 1; $i <= ceil(count($usersPosts) / 3); $i++) {
				$selected = $i == $pageNo ? "btn-dark" : "btn-light";
				echo "<button name=\"pageNo\" value=\"{$i}\" class=\"btn btn-lg {$selected} mx-1\">{$i}</button>";
			}
			echo "</form>";
			?>
		</div>
	</div>
</div>