<?php 
 
require 'adminAuth.php';
 // Checking whether 'id' exists on the URL AND if it's a number↓↓↓
 if(isset($_GET['id']) && ctype_digit($_GET['id'])){

    $id = $_GET['id'];
// what to do if we do not get an ID ↓↓↓
} else {
    header('Location: select.php');
}
?>
<!DOCTYPE>
    <<!DOCTYPE html>
    <html>
    <head>
        <title>PHP</title>
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
    <body>

        <?php 
            //$db = mysqli_connect('localhost', 'root', '', 'nekomatsuri');
            $db = mysqli_connect('localhost', 'root', "_Al0h0m0ra420_",'nekomatsuri');

            $sql = "DELETE FROM users WHERE id=$id";
            //This one is sanitazed already cause↑ of being checked to be a number above
            
            mysqli_query($db, $sql);
            echo '<p>User Deleted</p>';
            mysqli_close($db);
            
            header('Location: select.php');
        ?>
        
    </body>
    </html>