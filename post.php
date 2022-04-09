<?php
require 'config/config.php';
require 'config/db.php';

// check for submit
if (isset($_POST['delete'])) {
    // get form data
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM posts
            WHERE id = {$delete_id}";

    if (mysqli_query($conn, $query)) {
        // success
        header('Location: ' . ROOT_URL . '');
    } else {
        // error
        echo 'ERROR: ' . mysqli_error($conn);
    }
}

//get id
$id = mysqli_real_escape_string($conn, $_GET['id']);

// create query
$query = 'SELECT * FROM posts WHERE id = ' . $id;' ORDER BY created_at DESC';

// get result
$result = mysqli_query($conn, $query);

//fetch data
$post = mysqli_fetch_assoc($result);
// var_dump($posts);
// free result
mysqli_free_result($result);

// close connection
mysqli_close($conn);
?>

		<?php include 'inc/header.php';?>
		<div class="container space-bettween">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-default">Back</a>
			<hr>
			<div class="well">
				<h1><?php echo $post['title']; ?></h1>
				<small>Created on
					<?php echo $post['created_at']; ?> by <?php echo $post['author']; ?>
				</small>
				<p><?php echo $post['body']; ?></p>
			</div>
			<hr>
			<a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-default">Edit</a>
			<form class="pull-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn btn-danger">
			</form>
		</div>
		<?php include 'inc/footer.php';?>