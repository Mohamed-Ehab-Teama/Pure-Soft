<?php 

require_once './connection.php';


if (!$connection)
{
    $_SESSION['error'] = "Connection Went Wrong ";
    header('location:login.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    // Making Variables
    foreach ( $_POST as $key => $value )
    {
        $$key = $value;
    }
    // echo $email . "<br>" . $password ;




    // Check if empty:
    if ( empty($email) or empty($password) )
    {
        $_SESSION['error'] = "Fields cannot be Empty";
        header('location:login.php');
        die;
    }

    // Encrypt Password
    $password = md5($password);


    // Check if email and password are correct:
    $sql = 'SELECT * FROM users' ;

    $result = mysqli_query( $connection, $sql );

    $emails = [];
    $passes = [];

    if ( mysqli_num_rows($result) > 0 )
    {
        
        while ($row = mysqli_fetch_assoc($result))
        {
            $emails[] = $row['email'];
            $passes[] = $row['password'];
        }

        // echo $emails[0] . "<br>" . $email . "<br>" . $passes[0] . "<br>" . $password . "<br>" . count($emails) . "<br>" . count($passes);
        // die;



        for ($i = 0 ; $i <= count($emails) - 1 ; $i++ )
        {
            for ($j = 0 ; $j <= count($passes) - 1 ; $j++ )
            {
                if ( $emails[$i] == $email and $passes[$j] == $password )
                {
                    $_SESSION['login'] = 'true';
                    header('location:index.php');
                    die;
                }else{
                    continue;
                }
            }
        }

        $_SESSION['error'] = " Incorrect Inputs ";
        header('location:login.php');
        die;

        
        
    }






}else{
    echo$_SESSION['error'] = " Method Problem ";
    header('location:login.php');
    die;
}