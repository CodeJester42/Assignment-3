<?php

/*******w******** 
    
    Name:
    Date:
    Description:

 ****************/

require('connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

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
            <h1>My Amazing Blog</h1>
            <a href="index.php"><button id="home" type="button">Home</button></a>
            <a href="post.php"><button id="post" type="button">New Post</button></a>
            <div id="container2">
                <fieldset>
                    <legend>New Blog Post</legend>
                    <form action="" method="post">
                        <label for="title">Title:</label><br>
                        <input type="text" id="title" name="title"><br>
                        <label for="content">Content:</label><br>
                        <textarea id="content" name="content" style="resize:none"></textarea><br>
                        <button type="submit">Create</button>
                    </form>
                </fieldset>
            </div>
            <p>Copywrong 2024 - No Rights Reserved</p>
        </div>
    </div>
</body>

</html>