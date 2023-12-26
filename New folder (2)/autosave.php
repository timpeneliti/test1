<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "UPDATE articles SET title='$title', content='$content' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Autosaved successfully.";
    } else {
        echo "Error autosaving: " . $conn->error;
    }
}
?>
