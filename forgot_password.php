<?php 
//This Page allows a user to reset their password, if forgotten. 


require ('includes/config2.inc.php');
$page_title = 'Forgot Your password';

include ('includes/header.php');

if (isset($_POST['submitted'])) {
    require (MYSQL);

    // Assume Nothing: 
    $uid = FALSE; 

    //Validate the email address...
    if (!empty($_POST['email'])) {

        // Check for the existence of that email address...
        $q = 'SELECT id FROM users WHERE email="'. mysqli_real_escape_string($db, $_POST['email']). ' "';

        $r = mysqli_query ($db, $q) or trigger_error("Query: $q\n<br/> MySQL Error: ". mysqli_error($db));

        if (mysqli_num_rows($r) == 1) {
            // Retrieve the user ID: 
            list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM);
        } else {
            //No database match
            echo '<p class="error">The submitted email address does not match those on file! </p>';
        }
    } else {
        //No email
        echo '<p class="error">You forgot to enter your email address! </p>';
    } //End of empty ($_POST['email']) IF.

    if ($uid) {
        //If everything's OK.

        //Create a new Random password
        // uniqid is fed 2 values, rand() and true which make the returnes string more random
        // The password is now determined by pulling out ten characters starting with the 3rd on
        $p = substr (md5(uniqid(rand(), true)), 3, 10);

        //Update the database: 
        $q = "UPDATE users SET pass=SHA1('$p')
        WHERE id =$uid LIMIT 1";

        $r = mysqli_query ($db, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ".mysqli_error($db));

        if (mysqli_affected_rows($dbc) == 1) {
            //If it ran OK.

            //Send an email: 
            $body = "Your password to log into
            djls.com.ng has been temporarily
            changed to '$p'. Please log in using
            this password and this email address.
            Then you may change your password to
            something more familiar.";

            mail ($_POST['email'], 'Your temporary password.', $body, 'From:admin@djls.com.ng');

            //Print a message and wrap up
            echo '<h3>Your password has been
            changed. You will receive the new,
            temporary password at the email
            address with which you registered.
            Once you have logged in with this
            password, you may change it by
            clicking on the "Change Password"
            link.</h3>';

            mysqli_close($db);
            include ('include/footer.php');
            $exit(); //Stop the script
        } else {
            //If it did not run OK.
            echo '<p class="error">Your password could not be changed due to a system error. We apologize for the inconvenience. </p>';
        }

    } else {
        // Failed the validation test
        echo '<p class="error">Please try again. </p>';
    }

    mysqli_close($db);
} //End of the main Submit conditional. 
?>

<h1>Reset Your Password</h1>
 <p>Enter your email address below and your password will be reset.</p>
 <form action="forgot_password.php" method="post">
 <fieldset>
    <p><b>Email Address:</b> <input type="text" name="email" size="20" maxlength="40" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
 </fieldset>
 <div align="center"><input type="submit" name="submit" value="Reset My Password"/></div>
 <input type="hidden" name="submitted" value="TRUE" />
 </form>

 <?php  
 include ('includes/footer.html');
 ?>