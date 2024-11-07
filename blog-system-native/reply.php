<?php
require_once './connection.php';

if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}


// Get Post and Comment ID
$post_id = $_GET['post_id'];
$comment_id = $_GET['comment_id'];


// ID of the current user
$user_id = $_SESSION['user_id'];

// Get The Reply
$reply = $_POST['reply'];


// If the reply is empty
if ( empty($reply) )
{
    $_SESSION['error'] = "Reply Cannot be Empty";
    header('location:view.php?id='.$post_id);
    die;
}



// Insert the Reply:
$sql = " INSERT INTO replies (user_id, post_id, comment_id, reply) 
            VALUES ('$user_id', '$post_id', '$comment_id', '$reply') ";
$result = mysqli_query($connection, $sql);

if ( $result )
{
    $_SESSION['success'] = " Reply made successfully ";
    header('location:view.php?id='.$post_id);
    die;
}else{
    $_SESSION['error'] = " Something Went wrong ";
    header('location:view.php?id='.$post_id);
    die;
}