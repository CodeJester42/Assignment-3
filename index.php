<?php

/*******w******** 
    
    Name: Neal Fernandez
    Date: February 22, 2024
    Description: Assignment 3 - Blog

 ****************/

require('connect.php');
require('authenticate.php');

$stmt = $db->query('SELECT * FROM posts ORDER BY timestamp DESC');
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>My Blog - Home Page</title>
</head>

<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <div id="container">
        <div id="container1">
            <div id="container1-1">
                <a href="index.php">
                    <h1>My Amazing Blog</h1>
                </a>
                <h3>Recently Posted Blog Entries</h3>
            </div>
            <a href="post.php">
                <p id="new-blog">New Blog</p>
            </a>
            <a href="index.php"><button id="post" type="button">Home</button></a>
            <a href="post.php"><button id="home" type="button">New Post</button></a>
            <div id="container2">
                <?php
                foreach ($posts as $post) {
                    echo "<div>";
                    echo "<h2><a href='full_post.php?id={$post['id']}'>{$post['title']}</a></h2>";
                    echo "<p>" . formatDate($post['timestamp']) . " - <a href='edit.php?id={$post['id']}'>edit</a></p>";
                    if (strlen($post['content']) > 200) {
                        // Truncate content to 200 characters
                        $truncated_content = substr($post['content'], 0, 200);
                        echo "<p>$truncated_content... <a href='full_post.php?id={$post['id']}'>Read Full Post</a></p>";
                    } else {
                        // Display full content
                        echo "<p>{$post['content']}</p>";
                    }

                    echo "</div>";
                }
                ?>
            </div>
            <p id="copyright">Copywrong 2024 - No Rights Reserved</p>
        </div>
    </div>
</body>

</html>