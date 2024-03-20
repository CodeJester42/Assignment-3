<?php
// full_post.php

/*******w******** 
    
    Name: Neal Fernandez
    Date: February 22, 2024
    Description: Assignment 3 - Blog

 ****************/

require('connect.php');
require('authenticate.php');

// Fetch post details from the database based on the provided post ID
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $postId = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $stmt->bindParam(':id', $postId);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if post exists
    if (!$post) {
        echo "Post not found";
        exit;
    }
} else {
    echo "Invalid post ID";
    exit;
}

function formatDate($timestamp)
{
    // Convert the timestamp to a formatted date
    return date("F j, Y, g:i a", strtotime($timestamp));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
</head>

<body>
    <div id="container">
        <div id="container1">
            <div id="container1-1">
                <a href="index.php">
                    <h1>My Amazing Blog</h1>
                </a>
            </div>
            <a href="index.php"><button id="home" type="button">Home</button></a>
            <a href="post.php"><button id="home" type="button">New Post</button></a>
            <div id="container2">
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><?php echo formatDate($post['timestamp']); ?></p>

                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            </div>

            <p id="copyright">Copywrong 2024 - No Rights Reserved</p>
        </div>
    </div>
</body>

</html>