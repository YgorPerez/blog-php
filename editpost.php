<?php
require 'config/config.php';
require 'config/db.php';

// check for submit
if (isset($_POST['submit'])) {
    // get form data
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);

    $query = "UPDATE posts SET
                title = '$title',
                body = '$body',
                author = '$author'
            WHERE id = $update_id";

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
    <div class="container">
        <h1>Edit Post</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control" ><?php echo $post['body']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
        </form>
    </div>