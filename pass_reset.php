<?php
    session_start();
     if(isset($_POST['submit'])){
        $old_pass = $_POST['old_pass'];
        $new_pass = $_POST['new_pass'];

        $username = $_SESSION['username'];

        $db = file_get_contents('db.json');
        $db_data = json_decode($db, true);

        // check user password
        if($db_data[$username]['password']== $old_pass){
            $db_data[$username]['password'] = $new_pass;
            file_put_contents('db.json', json_encode($db_data));
            $msg ='Thank you '. $username.' Your password reset was successful!, you can now login <a href="login.php">Here</a>';
            
        }else{
            $msg = 'Wrong password!';
        }
        echo($msg);
        // header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
       <h1>Password Reset</h1>
       <?php
        if(!isset($_SESSION['username'])) {
            // session isn't started
    ?>
            <p>Please login to reset your password</p>
            <li><a href="login.php">Login</a></li>
    <?php  
        }else{
            echo ('Welcome '.$_SESSION['username'].' reset your password');
            
    ?>  
       <form action="" method="post">
        <p>Old Password</p>
        <input type="password" name="old_pass" placeholder=""><br><br>
        <p>New Password</p>
        <input type="password" name="new_pass" placeholder=""><br><br>
        <button type="submit" name="submit">Reset</button>
       </form>
       <li><a href="logout.php">Logout</a></li>
     <?php
        }
    ?> 
   </div> 

</body>
</html>