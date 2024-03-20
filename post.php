<?php

/*******w******** 
    
    Name: Neal Fernandez
    Date: February 22, 2024
    Description: Assignment 3 - Blog

 ****************/

require('connect.php');
require('authenticate.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for creating a new post
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (strlen($title) < 1 || strlen($content) < 1) {
        // Redirect back to the form with an error message if title or content is empty
        header('Location: post.php?error=empty');
        exit;
    }

    // Insert the new post into the database
    $stmt = $db->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->execute();

    // Redirect to index.php after creating new post
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>My Blog - Post a New Blog</title>
</head>

<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="container">
        <div id="container1">
            <div id="container1-1">
                <h1>Stung Eye - New Post</h1>
            </div>
            <a href="index.php"><button id="home" type="button">Home</button></a>
            <a href="post.php"><button id="post" type="button">New Post</button></a>
            <div id="container2">
                <fieldset>
                    <legend>New Blog Post</legend>
                    <div id="form-container">
                        <form action="" method="post">
                            <div id="form-title">
                                <label for="title">Title</label><br>
                                <input type="text" id="title" name="title"><br>
                            </div>
                            <div id="form-content">
                                <label for="content">Content</label><br>
                                <textarea id="content" name="content"></textarea><br>
                            </div>
                            <div id="form-button">
                                <button type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </fieldset>
            </div>
            <p id="copyright">Copywrong 2024 - No Rights Reserved</p>
        </div>
    </div>
</body>

</html>