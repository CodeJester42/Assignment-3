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


// Fetch post details from the database
$stmt = $db->prepare('SELECT * FROM posts WHERE id = :id');
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if post exists
if (!$post) {
    echo "Post not found";
    exit;
}

// Handle form submission for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

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
    <h1>Edit Post</h1>
    <form action="" method="post">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?= $post['title'] ?>"><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content"><?= $post['content'] ?></textarea><br>
        <button type="submit">Save Changes</button>
    </form>
</body>

</html>