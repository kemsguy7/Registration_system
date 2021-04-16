<?php  
session_unset();//($_SESSION['first_name']);
    //This is the main page for the site. 

    //Include the configuration file: 

    require ('includes/config2.inc.php');

    // Set the age title and inclde the HTML header:
    $page_title = 'Welcome to this site!';
    include ('includes/header.php');

    //Welcpme the user (by name if they are logged in): 
    echo '<h1>Welcome to Our Registration Our System</h1>';
   // if (isset($_SESSION['first_name'])) {
       // echo ", {$_SESSION['first_name']}!";
  //  }
  //  echo '</h1>';
?>
<p>Click <a href="register.php">Here</a> to register or <a href="login.php"> here</a> to login</p>

 <?php //Include the html footer file:
 //include ('includes/footer.php');
 ?>