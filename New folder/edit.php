<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article</title>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>

<?php
include 'db_connection.php'; // Include the database connection file

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch the article based on the ID
    $sql = "SELECT * FROM articles WHERE id='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No article found with the given ID.";
        exit;
    }
}

// Update operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "UPDATE articles SET title='$title', content='$content' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to homepage or list page
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<h2>Edit Article</h2>
<form action="edit.php?id=<?php echo $id; ?>" method="post">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo $row['title']; ?>"><br><br>
    
    <label>Content:</label><br>
    <textarea name="content" id="editor"><?php echo $row['content']; ?></textarea><br><br>
    
    <script>
        CKEDITOR.replace('editor');
    </script>
    
    <input type="submit" name="update" value="Update">
</form>

</body>
</html>
