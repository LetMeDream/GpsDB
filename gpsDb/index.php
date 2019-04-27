
<?php   
// not going if already logged in 
require 'alreadyLog.php';

//Before this point we could be able to know whether the user&password combination was correct. But were NOT able to use it.
//Here we change that by using php integrated SESSIONS (For state management;knowing wether we are in and which user islogged in )
//starting the session down below ↓


    $logMessage = '';
    $logMessageA='';
    $name ='';
        
    if (isset($_POST['name'])&&isset($_POST['password'])){
        $db = mysqli_connect('localhost', 'root', "_Al0h0m0ra420_",'nekomatsuri');


        $sql = sprintf("SELECT * FROM users WHERE name ='%s'",
        mysqli_real_escape_string($db, $_POST['name']));
        

        
        $result = mysqli_query($db, $sql);
// We could iterate over the $result but, instead, we are going to use the fetch function
// Fetching an associative array, which represents our user.
        $row = mysqli_fetch_assoc($result);
 // then, if the user exists
        if ($row){
//Remember Row is just an array holding users info.
            $hash = $row['password'];
//Variable to determine whether or not he's an admin.
            $isAdmin = $row['isAdmin'];
// Then, we use the 'password verify' Function to compare if the password and our HASHED version of the 
// password match
            if(password_verify($_POST['password'], $hash)){
                $logMessage = 'Login successful';
                if ($isAdmin){
                    $logMessageA = '<br>And is admin!';
                } 
             
//Here we will create session variables so the current session can tell at any point who the user is and wether its an admin.
                $_SESSION['user']=$row['Name']; // This variable over here
                $_SESSION['isAdmin']=$isAdmin;  // will be stored at the server.  

                header('Location: select.php'); 



            } else {
                $logMessage = 'Invalid password';
                $name = $_POST['name'];
            }
        } else {
            $logMessage = "User doesn't exist";
            $name = $_POST['name'];
        }
        mysqli_close($db);
    } 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Section</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <style>
        html body form input#move{
            margin-left:5px;
        }
        html body form{
            margin-top:25px;
        }
       
       
        
    </style>
</head>
<body>
    <?php 
        readfile('nav-tmpl.html'); // just the Navigation Bar
        echo "$logMessage";
        if ($logMessageA){
            echo "<p>$logMessageA</p>";
        }
        
    ?>

    <form method='post' action=''>
        Username: <input type='text' name='name' autocomplete='off' value='<?php echo htmlspecialchars($name)?>'><br>
        Password: <input id='move' type='password' name='password'><br>
        <input type='submit' value='Login'><br>
    </form>
 
</body>
</html>