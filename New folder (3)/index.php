<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CKEditor CRUD</title>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
</head>
<body>

<h2>Create Article</h2>
<form action="crud_operations.php" method="post">
    <label>Title:</label><br>
    <input type="text" name="title"><br><br>
    
    <label>Content:</label><br>
    <textarea name="content" id="editor"></textarea><br><br>
    
    <script>
        CKEDITOR.replace('editor');
    </script>
    
    <input type="submit" name="create" value="Create">
</form>

<h2>Articles List</h2>
<table border="1">
    <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'crud_operations.php'; // Include CRUD operations
        $articles = getArticles();
        while($row = $articles->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['content'] . "</td>";
            echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='crud_operations.php?delete=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
