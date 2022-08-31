<form action="<?php echo $_SERVER['PHP_SELF'] ;?>" method="POST">
<input type="text" name="Name" placeholder="name">
<input type="password" name="password1" placeholder="password">
<input type="submit" value="sign up" name="signup">
<input type="submit" value="login" name="login">
</form>
<?php
session_start();
$dsn='mysql:host=localhost;dbname=user';
$user= 'root';
$pass= '';
try {
   //$name1=$_POST['Name'];
   //$name2=$_POST['password1'];
    $db= new PDO($dsn, $user, $pass) ; // Start A New Connection With PD0
    
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   if(isset($_POST["login"]))
   {
     if(empty($_POST["Name"]) || empty($_POST["password1"]))
     {
        $message = "all field is requied";
        echo $message;
     }
     else{
        $query = " SELECT * FROM identity WHERE Name1 = :username AND password1 = :pass"; 
        $stmt = $db->prepare($query);
        $stmt->execute(
            array(
                'username'  => $_POST["Name"],
                'pass'  => $_POST["password1"]
            )
            );
            $count = $stmt->rowCount();
            if($count > 0)
            {
                $_SESSION["username"] = $_POST["Name"];
                header("location:login_SUCSSES.php");
                
            }
            
            
        }
   }

elseif (isset($_POST["signup"]))
 {
    $fname=$_POST['Name'];
    $pass=$_POST['password1'];
    $q = "INSERT INTO identity (Name1,password1) VALUES ('$fname', '$pass')";
    $db->exec($q);
 }


}
    catch(PDOException $e) {
    echo 'Failed ' . $e->getMessage();
    }



    ?>