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

$stmt = $db->query('SELECT * FROM posts ORDER BY timestamp DESC');
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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


    <div id="container">
        <div id="container1">
            <h1>Stung Eye - Index</h1>
            <a href="index.php"><button id="home" type="button">Home</button></a>
            <a href="post.php"><button id="post" type="button">New Post</button></a>
            <div id="container2">
                <?php
                foreach ($posts as $post) {
                    echo "<div>";
                    echo "<h2>{$post['title']}</h2>";
                    echo "<p>{$post['content']}</p>";
                    echo "<a href='edit.php?id={$post['id']}'>Edit</a>";
                    echo "</div>";
                }
                ?>
            </div>
            <p>Copywrong 2024 - No Rights Reserved</p>
        </div>
    </div>
</body>

</html>