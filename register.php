<?php 

// This is the registration page for the site. 


$page_title  = 'Register';
include ('includes/header.php');

if (isset($_POST['submitted'])) {
    //Handle the form. 

  
        $username = $_POST['username']; //pout post values in an array
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user_details = [
                'username'=> $username,
                'email' => $email,
                'password' => $password
        ];
        
        // save to the database file
        $db = file_get_contents('db.json');
        $db_data = json_decode($db, true);
        $db_data[$username] = $user_details;
        file_put_contents('db.json', json_encode($db_data));
        
     header('Location: login.php');
      


            
} else {
 //   echo 'Registraion Failed, please try again';
}     
           
            
        // End  of the main submit conditional. 
    
?>

        <h1>Register</h1>
        <form action="register.php" method="post">
        <fieldset>

        <p><b>Username:</b> <input type="text"name="username" size="20" maxlength="20" 
        value="<?php if (isset($trimmed
        ['first_name'])) echo $trimmed
        ['first_name']; ?>" /></p>


        <p><b>Email Address:</b> <input type="text" name="email" size="30" maxlength="80"
        value="<?php if
        (isset($trimmed['email'])) echo
        $trimmed['email']; ?>" /> </p>

    
        <p><b>Password:</b> <input type="password" name="password" size="20" maxlength="20" /></p>
        </fieldset>

        <div align="center"><input type="submit" name="submit" value="Register" /></div>
        <input type="hidden" name="submitted"
        value="TRUE" />

        </form>

 