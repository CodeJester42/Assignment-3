<?php

/*******w******** 
    
    Name:
    Date:
    Description:

 ****************/

require('connect.php');

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
    <div id="container">
        <div id="container1">
            <h1>Toomblr - Edit Blog Post</h1>
            <a href="index.php"><button id="home" type="button">Home</button></a>
            <a href="post.php"><button id="post" type="button">New Post</button></a>
            <div id="container2">
                <fieldset>
                    <legend>Edit Blog Post</legend>
                    <form action="" method="post">
                        <label for="title">Title:</label><br>
                        <input type="text" id="title" name="title"><br>
                        <label for="content">Content:</label><br>
                        <textarea id="content" name="content" style="resize:none"></textarea><br>
                        <button type="submit" onclick="return confirm('Are you sure?')">Update</button>
                        <button type="submit" formaction="delete.php?id=<?php echo $post['id']; ?>">Delete</button>
                    </form>
                </fieldset>
            </div>
            <p>Copywrong 2024 - No Rights Reserved</p>
        </div>
    </div>
</body>

</html>