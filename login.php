<?php
    // Mysqli Extension (procedural)
    include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method='post'>
        username: <br>
        <input type="text" name="username"><br>
        password: <br>
        <input type="text" name="password"> <br>
        <input type="submit" name="submit">
    </form>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST" and !empty($_POST['submit'])){
        $username=filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS);
        $password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($username)){
            echo "please enter the username!";
        }else if(empty($password)){
            echo "please enter the password";
        }else{
            $sql="SELECT  username, password FROM users WHERE username='$username' and password='$password'";
            try{
                $row=mysqli_query($conn,$sql);
                if(mysqli_fetch_assoc($row)>0){
                    echo "you are now succesfully logged in";
                }else{
                    echo "please check your password and username";
                }
            }catch(mysqli_sql_exception){
                echo "Couldn't login right now";
            }
        }
        
    }
?>
<?php
    mysqli_close($conn); // close the connect at the end
?>