<?php 
    // This is the login page page for the site. 

  
    $page_title = 'Login';
    include ('includes/header.php');

    if(isset($_POST['submitted'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = file_get_contents('db.json');
        $db_data = json_decode($db, true);

        // check if user exists
        if(array_key_exists($username, $db_data)){
            // check user password
            if($db_data[$username]['password']=== $password){
                $_SESSION['username'] = $db_data[$username]['username'];
                $_SESSION['email'] = $db_data[$username]['email'];
                $response = '';
            }else{
                $response = 'Incorrect password';
            }
        }else{
            $response = 'User does not exist';
        }
        echo($response);
    } 
?>


    <h1>Login </h1>
 </p>
       <?php
        if(!isset($_SESSION['username'])) {
            // session isn't started
    ?>
    <form action="" method="post">
        <fieldset> 
                <p><b>Username: </b><input type="text" name="username" size="20" maxlength="40" /></p>

                <p><b>Password:</b> <input type="password" name="password" size="20" maxlength="20" /></p>
                <div align="center"><input type="submit" name="submit" value="Login" /></div>
                <input type="hidden" name="submitted" value="TRUE" />
                  <p>Not Registered? | <a href="index.php">Register</a></p>
        <a href="pass_reset.php">Reset Password</a>
       </form>
        </fieldset>
    </form>
     <?php  
        }else{
            echo ('Welcome '.$_SESSION['username']);
    ?>
            <p>You are logged in.. </p>
            <li><a href="pass_reset.php">Reset Password</a></li>
            <li><a href="logout.php">Logout</a></li>
    <?php
        }
    ?>
    