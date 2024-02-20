<?php

/*******w******** 
    
    Name:
    Date:
    Description:

 ****************/

require('connect.php');
require('authenticate.php');

if (
    !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
    || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)
    || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)
) {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Our Blog"');
    exit("Access Denied: Username and password required.");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Welcome to my Blog!</title>
</head>

<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <h1>Blog</h1>
    <?php
    // Include database connection
    require_once('connect.php');

    // Fetch posts from the database
    $stmt = $db->query('SELECT * FROM posts ORDER BY timestamp DESC');
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display posts
    foreach ($posts as $post) {
        echo "<div>";
        echo "<h2>{$post['title']}</h2>";
        echo "<p>{$post['content']}</p>";
        echo "<a href='edit.php?id={$post['id']}'>Edit</a>";
        echo "</div>";
    }
    ?>
    <a href="post.php">Create New Post</a>
</body>

</html>