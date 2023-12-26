<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article with Autosave</title>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM articles WHERE id='$id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No article found with the given ID.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "UPDATE articles SET title='$title', content='$content' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<h2>Edit Article with Autosave</h2>
<form id="editForm" action="edit.php?id=<?php echo $id; ?>" method="post">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo $row['title']; ?>"><br><br>
    
    <label>Content:</label><br>
    <textarea name="content" id="editor"><?php echo $row['content']; ?></textarea><br><br>
    
    <script>
        CKEDITOR.replace('editor');

        // Autosave content every 10 seconds
        setInterval(function() {
            var content = CKEDITOR.instances.editor.getData();
            var title = $("input[name='title']").val();
            
            $.ajax({
                url: "autosave.php", // Create a new PHP file called autosave.php
                method: "POST",
                data: { id: <?php echo $id; ?>, title: title, content: content },
                success: function(response) {
                    console.log('Autosaved:', response);
                }
            });
        }, 10000); // 10 seconds
    </script>
    
    <input type="submit" name="update" value="Update">
</form>

</body>
</html>
