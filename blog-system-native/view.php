<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}

$id = $_GET['id'];

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> Post <?php echo $row['post_id']; ?> </title>
</head>

<body>

    <?php
    $sql = " SELECT * FROM posts INNER JOIN users on users.id = posts.post_created_by WHERE post_id = $id ";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    // echo "<pre>";
    // echo $id;
    // var_dump($result);
    // var_dump($row);
    // echo "</pre>";
    // die;
    ?>

    <div class="container mt-5">

        <!--                          Error or Success Messages    -->
        <!-- Success -->
        <?php
        if (isset($_SESSION['success'])):
        ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Error -->
        <?php
        if (isset($_SESSION['error'])):
        ?>
            <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>


        <!--                         Post Details    -->
        <h1 class="mt-3 mb-3 text-center"> Post <?php echo $row['post_id'] ?> </h1>

        <div class="card">
            <div class="card-header">
                Post <?php echo $row['post_id']; ?> <br>
                Owner : <?php echo $row['name']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    Title : <?php echo $row['title']; ?>
                </h5>
                <p class="card-text">
                    <b>Description</b> : <?php echo $row['description']; ?>
                </p>
            </div>
        </div>


        <!--                    Make comment Section -->
        <form class="mt-5" action="./comment.php?id=<?php echo $id; ?>" method="post">
            <div class="form-floating mt-3">
                <textarea class="form-control" id="floatingTextarea" name="comment"></textarea>
                <label for="floatingTextarea">Comment:...</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3"> Comment </button>
        </form>


        <!--                All Comments     -->
        <?php
        $sql = 'SELECT * FROM comments';
        $result = mysqli_query($connection, $sql);
        ?>


        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col"> Comment </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                        <tr>
                            <td>
                                <?php echo $row['comment']; ?>
                            </td>
                        </tr>
                <?php
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>



    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>