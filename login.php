<?php
  require("connection.php");
 
  if(isset($_POST["submit"])){
 
    $username = $_POST["username"];
    $password = $_POST["password"];
 
    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $userExists = $stmt->fetchAll();
    var_dump($userExists);
 
    $passwordHashed = $userExists[0]["password"];
    $checkPassword = password_verify($password, $passwordHashed);
 
    if($checkPassword === false){
      echo "Login fehlgeschlagen, Passwort stimmt nicht überein";
    }
    if($checkPassword === true){
 
      session_start();
      $_SESSION["username"] = $userExists[0]["username"];
 
      header("Location: Schüler.php");
    }
  }
 ?>
 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
 
    <div class="login-box">
 
         <form action="login.php" method="POST">
        <h2>Login Schüler</h2>
        <div class="inputs_container">
            <div class="user-box">
            <input type="text" placeholder="Benutzername" name="username" autocomplete="off"></div>
            <div class="user-box">
            <input type="password" placeholder="Passwort" name="password" autocomplete="off"></div>
        </div>
        <button name="submit" class="login">Login</button>
    </form>    
       
 
   
 <a href="loginlehrer.html">Login als Lehrer</a>
        </form>
  </div>    
   
</body>
</html>