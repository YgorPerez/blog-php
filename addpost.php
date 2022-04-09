<?php
require 'config/config.php';
require 'config/db.php';

// check for submit
if (isset($_POST['submit'])) {
    // get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);

    $query = "INSERT INTO posts (title, body, author) VALUES ('$title', '$body', '$author')";

    if (mysqli_query($conn, $query)) {
        // success
        header('Location: ' . ROOT_URL . '');
    } else {
        // error
        echo 'ERROR: ' . mysqli_error($conn);
    }
}
?>

<?php include 'inc/header.php';?>
    <div class="container">
        <h1>Add Post</h1>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>
<?php include 'inc/footer.php';?>