<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Prepare an SQL statement
    $stmt = $conn->prepare("UPDATE articles SET title=?, content=? WHERE id=?");
    
    // Bind parameters
    $stmt->bind_param("ssi", $title, $content, $id);  // "ssi" indicates string, string, integer
    
    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Autosaved successfully.";
    } else {
        echo "Error autosaving: " . $stmt->error;
    }
    
    // Close the prepared statement
    $stmt->close();
}
?>
