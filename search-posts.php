<?php
include('components/header.php');
include('components/navbar.php');
require_once('models/user.php');
require_once('models/post.php');

$message = '';
$foundPosts = [];
if (isset($_GET['filter']) && isset($_GET['value'])) {
    $message = 'Nađene objave:';
    $filter = $_GET['filter'];
    $value = $_GET['value'];
    $foundPosts = Post::searchPosts($filter, $value);
    if (count($foundPosts) == 0)
        $message = 'Ne postoje objave sa tim filterom!';
}
?>
<div class="container">
    <form>
        <div class="row no-gutters mt-4 d-flex justify-content-center">
            <div class="col-3">
                <label class="text-muted">Filter:</label>
                <select class="form-control" name='filter'>
                    <?php
                    $selected = $filter === "title" ? "selected" : "";
                    echo "<option {$selected} value=\"title\">Naslov</option>";
                    $selected = $filter === "content" ? "selected" : "";
                    echo "<option {$selected} value=\"content\">Sadržaj</option>";
                    $selected = $filter === "datePosted" ? "selected" : "";
                    echo "<option {$selected} value=\"datePosted\">Datum objave</option>";
                    $selected = $filter === "rating-higher" ? "selected" : "";
                    echo "<option {$selected} value=\"rating-higher\">Ocena veća od</option>";
                    $selected = $filter === "rating-lower" ? "selected" : "";
                    echo "<option {$selected} value=\"rating-lower\">Ocena manja od</option>";
                    ?>
                </select>
            </div>
            <div class="col-3">
                <label class="text-muted">Vrednost:</label>
                <input class="form-control" type="text" name="value">
            </div>
            <div class="col-3">
                <br>
                <button type="submit" class="form-control btn btn-primary">Pretraži</button>
            </div>
        </div>
    </form>
    <div class="row no-gutters mt-4 d-flex justify-content-center">
        <div class="col-8">
            <h2 class="my-4"><?php echo $message; ?></h2>
            <p class="text-muted"></p>
            <?php
            foreach ($foundPosts as $post) {
                echo Post::getlHtml($post);
            }
            ?>
        </div>
    </div>
</div>