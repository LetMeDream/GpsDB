
<?php 
       require 'adminAuth.php';
     
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reading Database</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    
    <style>
        p{
            font-family: 'Bitter', serif;
        }
        
        html body ul a.btn.btn-default:hover{
            background-color:#aab5b4;
            transition: 1.2s;
        }
    </style>
</head>
<body>
    <?php 
       readfile('nav-tmpl.html');
        
        
    ?>

    <h2>List of users </h2>
    <p>Only for admins</p>

    <ul>
        <?php 

        
        
        $db = mysqli_connect('localhost', 'root',  "_Al0h0m0ra420_", 'nekomatsuri');

        $sql = "SELECT * FROM users";
        $result = mysqli_query($db, $sql);
        // Result is an array of arrays
        // Row is the current array
        foreach ($result as $row) {
            printf('<li><span style="color: %s">%s (%s)</span><a href="update.php?id=%s">edit</a><br></br><a href="delete.php?id=%s">Delete</a></li><br>',
            htmlspecialchars($row['Color']),
            htmlspecialchars($row['Name']),
            htmlspecialchars($row['Gender']),
            htmlspecialchars($row['id']),
            htmlspecialchars($row['id'])
        );
        }
        //fuckgoback
        
        echo '<br><a class="btn btn-default" role="button" href="log out.php">Log out</a>';
        
        mysqli_close($db);
        
        ?>


    </ul>   
</body>
</html>