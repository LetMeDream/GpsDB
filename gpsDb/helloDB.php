<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP data base</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        
    <script src="main.js"></script>
    <style>
        html body div.container form div.form-group.col-lg-6 input{
            margin-left: 23px;
           
        }
    </style>
</head>
<body>
   
    <?php 
    
    readfile('nav-tmpl.html');
        
    ?>
    
    
    <?php 
       
        $name = '';
        $email = '';
        $pass = '';
        $gender = '';
        $tc = '';
        $color = '';
        $password='';

        //Unused yet
        $languages = array();

       

        if (isset($_POST['submit'])) {
            $ok = true;
 //Form's inputs validators
 
            if (!isset($_POST['name']) || ($_POST['name'] === '')){
                $ok = false;
                echo 'Insert a name!<br><br>';
            } else {
                $name = $_POST['name'];
            }
            if (!isset($_POST['password']) || ($_POST['password'] === '')){
                $ok = false;
            } else {
                $password = $_POST['password'];
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
                echo 'You need to accept the <a href="">Terms & Conditions</a> in order to advance';
            } else {
                $tc = $_POST['tc'];
            }
       


        
        if ($ok){
            // Database code; INSERTING LOGIC
            $db = mysqli_connect("localhost","root", "_Al0h0m0ra420_", "nekomatsuri");
            
            // Creating a HASH for passwords since we won't be storing them at the data base.
            // Using PASSWORD HASHING API
            $hash = password_hash($password, PASSWORD_DEFAULT);



            $sql = sprintf("INSERT INTO users (Name, password, Gender, Color) VALUES ('%s', '%s', '%s','%s') 
            ",  mysqli_real_escape_string($db, $name),
            // Down here ↓ we use the created HASH for the password ↓
                mysqli_real_escape_string($db, $hash),
                mysqli_real_escape_string($db, $gender),
                mysqli_real_escape_string($db, $color));
            
            mysqli_query($db, $sql);
            mysqli_close($db);

            echo '<p>User added.</p>';
            $name = '';
            $gender = '';
            $color = '';
            $tc = '';
            $password = '';
            echo '<br><a href="select.php">See users</a>';
        } 
    }
        
    ?>
     <!--Formulario contacto -->
         
     <div class="container">
              

                <h4 class="modal-title">User Creation</h4>

                         <form action="" method="post">
                            <div class="form-group col-lg-6">
                                Name: <input type="text"   name="name" placeholder='Name' value="<?php 
                                echo htmlspecialchars($name);
                                ?>" autocomplete='off'>
                            </div>

                            <div class="form-group col-lg-5">
                                Password: <input type="password"   name="password" placeholder=''>
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
                                <button type="submit" name="submit">Add user</button>
                            </div>

                            
                        </form>
                        <br>
                        <br>
               
                        </div>
                        <!--Formulario contacto -->

   


</body>
</html>