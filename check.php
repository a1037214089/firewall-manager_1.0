<?php
    session_start();
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);

    $conn = mysqli_connect('127.0.0.1','root','123456','firewalld');
    $sql = "select * from admin where username = '$username'";

    $result = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);
    if($count===1)
    {
        $row = mysqli_fetch_assoc($result);
        if(md5($password)===$row['password'])
        {
            echo "login-success";
            $_SESSION['isLogin'] = 'true';
            $_SESSION['username'] = $username;
        }
        else
        {
            $pp = md5($password);
            echo "login-failed";
        }
    }
    else
    {
        echo "login-failed";
    }
    mysqli_close($conn);

?>