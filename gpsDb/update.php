<?php 
require 'auth.php';

 // Checking whether 'id' exists on the URL AND if it's a number↓↓↓
 if(isset($_GET['id']) && ctype_digit($_GET['id'])){

    $id = $_GET['id'];
// what to do if we do not get an ID ↓↓↓
} else {
    header('Location: select.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP data base</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
   
    <?php
         readfile('nav-tmpl.html');
    ?>
   
    
    <?php

     
   
    
        $name = '';
        $gender = '';
        $tc = '';
        $color = '';
      

       

        if (isset($_POST['submit'])) {
            $ok = true;
 //Form's inputs validators
 
            if (!isset($_POST['name']) || ($_POST['name'] === '')){
                $ok = false;
            } else {
                $name = $_POST['name'];
            }
           
            
            if (!isset($_POST['gender']) || ($_POST['gender'] === '')){
                $ok = false;
            } else {
                $gender = $_POST['gender'];
            }
            if (!isset($_POST['colors']) || ($_POST['colors'] === '')){
                $ok = false;
            }   else {
                $color = $_POST['colors'];
            }
            
            if (!isset($_POST['tc']) || ($_POST['tc'] === '')){
                $ok = false;
            } else {
                $tc = $_POST['tc'];
            }
       


        
        if ($ok){
            // Database code, UPDATING LOGIC.
           $db = mysqli_connect('localhost', 'root', "_Al0h0m0ra420_", 'nekomatsuri');
           $sql = sprintf ('UPDATE users SET name="%s", gender="%s", color="%s" WHERE id=%s', 
                mysqli_real_escape_string($db, $name),
                mysqli_real_escape_string($db, $gender),
                mysqli_real_escape_string($db, $color),
                $id
            );
            mysqli_query($db, $sql);
            echo '<p>User updated</p>';
            
            mysqli_close($db);
            
            header('Location: select.php');
        }


    } else {
        // Prefilling selected user info.
            $db = mysqli_connect('localhost', 'root', "_Al0h0m0ra420_", 'nekomatsuri');
            $sql = sprintf("SELECT * FROM users WHERE id=%s", $id);
            // We sent above order to the database ↓↓
            $result = mysqli_query($db, $sql);
            
            foreach($result as $row){
                $name = $row['Name'];
                $gender = $row['Gender'];
                $color = $row['Color']; 
            }

            mysqli_close($db);
        
    }
        
    ?>
     <!--Formulario contacto -->
         
     <div class="container">
              

                <h4 class="modal-title">Form</h4>

                         <form action="" method="post">
                            <div class="form-group col-lg-6">
                                <input type="text"   name="name" placeholder='Name' value="<?php 
                                echo htmlspecialchars($name);
                                ?>">
                            </div>
                            
                            
                            <div class='gender'>
                                Gender: Hombre<input type='radio' name='gender' value='m'<?php 
                                if ($gender === 'm'){
                                    echo ' checked';
                                }
                                ?>>  
                                Mujer<input type='radio' name='gender' value='f'<?php 
                                if ($gender === 'f'){
                                    echo ' checked';
                                }
                                ?>>
                               
                            </div>
                            <br>
                            Favorite Color:
                            <select name='colors'>
                                <option value=''>Please, pick a color.</option>
                                <option value='#f00'<?php 
                                if ($color === '#f00'){
                                    echo ' selected';
                                }
                                ?>>Red</option> 
                                <option value='#0f0'<?php 
                                if ($color === '#0f0'){
                                    echo ' selected';
                                }
                                ?>>Green</option>
                                <option value='#00f'<?php 
                                if ($color === '#00f'){
                                    echo ' selected';
                                }
                                ?>>Blue</option>
                            </select>
                            <br>
                            
                            <br>
                            Sí, <b>Acepto</b> los términos y condiciones<input name='tc' type="checkbox" value="ok"<?php 
                            if ($tc === 'ok'){
                                echo ' checked';
                            }
                            ?>> 
                            
                            <div class="form-group col-lg-12"> 
                                <button type="submit" name="submit">Update info.</button>
                            </div>

                        </form>
                        <br>
                        <br>
                        
               
                        </div>
                        <!--Formulario contacto -->

   


</body>
</html>