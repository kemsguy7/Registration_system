<?php 

?>
<!--End of Content -->
</div>

<div id="Menu"> 

<a href="index.php" title="Home Page">Home </a>
<?php 
// This page completed the home page

//Display the links based upon the login status: 
if (isset($_SESSION['user_id'])) {
    // if the user is logged in, show logout and change password links
    echo '<a href="logout.php" title="Logout">Logout </a>';
 
   
} else {
    // Show the links for the non-logged in users
    //Not logged in. 
    echo '<a href="register.php" title="Register for the site>Register </a><br/>
    <a href="login.php" title="Login">Login </a><br/.
    <a href="forgot_password.php" title="Password Retrieval> Retrieve Password </a>
    ';
}
?>
<a href="#">Some Page </a><br/>
<a href="#">Another Page </a>
</div>
</body>
</html>
<?php //FLush the buffered output.
ob_end_flush();
?>