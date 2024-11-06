<?php
require_once './connection.php';


if (!$_SESSION['login']) {
    header('location:login.php');
    die;
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> Posts </title>
</head>

<body>

    <?php
    $sql = " SELECT * FROM posts INNER JOIN users on users.id = posts.post_created_by";
    $result = mysqli_query($connection, $sql);
    ?>

    <div class="container mt-5">

        <h1 class="mt-3 mb-3 text-center"> All Posts </h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col"> ID </th>
                    <th scope="col"> Title </th>
                    <th scope="col"> Description </th>
                    <th scope="col"> Created By </th>
                    <th scope="col"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0):
                    while ($row = mysqli_fetch_assoc($result)):
                ?>
                        <tr>
                            <th scope="row">
                                <?php echo $row['post_id']; ?>
                            </th>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>
                            <td>
                                <?php echo $row['description']; ?>
                            </td>
                            <td>
                                <?php echo $row['name']; ?>
                            </td>
                            <td>
                                <a href="./view.php?id=<?php echo $row['post_id']; ?>" type="button" class="btn btn-primary"> View </a>
                                <a href="#" type="button" class="btn btn-success"> Update </a>
                                <a href="#" type="button" class="btn btn-danger"> Delete </a>
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