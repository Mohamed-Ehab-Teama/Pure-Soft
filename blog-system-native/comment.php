<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}

// ID of the current user
$user_id = $_SESSION['user_id'];

// Id of the post
$post_id = $_GET['id'];

// The Comment we made
$comment = $_POST['comment'];


// If the comment is empty
if ( empty($comment) )
{
    $_SESSION['error'] = "Comment Cannot be Empty";
    header('location:view.php?id='.$post_id);
    die;
}

// Insert the comment
$sql = " INSERT INTO comments (post_id, comment, comment_created_by) VALUES ('$post_id', '$comment', '$user_id') ";
$result = mysqli_query($connection, $sql);


if ( $result )
{
    $_SESSION['success'] = " Comment made successfully ";
    header('location:view.php?id='.$post_id);
    die;
}else{
    $_SESSION['error'] = " Something Went wrong ";
    header('location:view.php?id='.$post_id);
    die;
}

