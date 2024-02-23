<?php

/*******w******** 
    
    Name: Neal Fernandez
    Date: February 22, 2024
    Description: Assignment 3 - Blog

 ****************/

require('connect.php');
require('authenticate.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Delete the post
        $stmt = $db->prepare('DELETE FROM posts WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();

        // Redirect to index.php after deletion
        header('Location: index.php');
        exit;
    } else {
        // Handle form submission for editing
        $title = $_POST['title'];
        $content = $_POST['content'];

        if (strlen($title) < 1 || strlen($content) < 1) {
            // Redirect back to the form with an error message if title or content is empty
            header("Location: edit.php?id={$_GET['id']}&error=empty");
            exit;
        }

        // Update the post in the database
        $stmt = $db->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();

        // Redirect to index.php after editing
        header('Location: index.php');
        exit;
    }
} else {
    $stmt = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        echo "Post not found";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Post!</title>
</head>

<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="container">
        <div id="container1">
            <div id="container1-1">
                <h1>Stung Eye - Edit Blog Post</h1>
            </div>
            <a href="index.php"><button id="home" type="button">Home</button></a>
            <a href="post.php"><button id="post" type="button">New Post</button></a>
            <div id="container2">
                <fieldset>
                    <legend>Edit Blog Post</legend>
                    <form action="" method="post">
                        <div id="form-title">
                            <label for="title">Title:</label><br>
                            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>"><br>
                        </div>
                        <div id="form-content">
                            <label for="content">Content:</label><br>
                            <textarea id="content" name="content" style="resize:none"><?php echo htmlspecialchars($post['content']); ?></textarea><br>
                        </div>
                        <div id="form-button">
                            <button type="submit" redirect="index.php">Update</button>
                            <button type="submit" name="delete" value="delete" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <p id='copyright'>Copywrong 2024 - No Rights Reserved</p>
        </div>
    </div>
</body>

</html>