<?php
include 'db_connection.php'; // Include the database connection file

// Create operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $sql = "INSERT INTO articles (title, content) VALUES ('Article Title', 'Article Content')";

	
    
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
// Assuming you've established a database connection as $conn

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");

    // Bind the parameters
    $stmt->bind_param("ss", $title, $content);  // "ss" indicates two strings

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Redirect or show success message
        header("Location: index.php");
    } else {
        // Handle the error
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
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
