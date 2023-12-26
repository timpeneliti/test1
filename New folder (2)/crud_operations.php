<?php
include 'db_connection.php'; // Include the database connection file

// Create operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "INSERT INTO articles (title, content) VALUES ('$title', '$content')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to homepage or list page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Read operation
function getArticles() {
    global $conn;
    $sql = "SELECT * FROM articles";
    $result = $conn->query($sql);
    return $result;
}

// Update operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "UPDATE articles SET title='$title', content='$content' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to homepage or list page
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $sql = "DELETE FROM articles WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to homepage or list page
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
