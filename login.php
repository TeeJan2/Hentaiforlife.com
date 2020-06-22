<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=DB_HEARTFORHENTAI', 'DB_HEARTFORHENTAI', '84{R7Z(g+NDz');

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    if($user !== false && password_verify($password, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        header("Location: index.php");
    } else {
        $errorMessage = "Email oder Passwort ist ungültig!";
    }
}
?>
<!--- DB Name und Benutzer: test Passwort waJCNf3YP7f3FwbD --->
<html lang="de" dir="ltr" xmlns="http://www.w3.org/1999/html">
  <head>
      <?php include("inc/header.inc.php") ?>
      <meta charset="UTF-8">
      <link rel="shortcut icon" href="/images/icon.png">
      <link rel="stylesheet" href="style.css">
  </head>
  <body>

  <header>
            <div class="inner-width">
                <a href="/" class="logo" alt=""><img src="images/logo.png"></img></a>
                <i class="menu-toggle-btn fas fa-bars"></i>
                <nav class="navigation-menu">
                    <a href="index.php"><i class="fas fa-home home"></i> Home</a>
                    <a href="team.php"><i class="fas fa-users team"></i> Team</a>
                    <a href="contact.php"><i class="fas fa-headset contact"></i> Contact</a>
                </nav>
            </div>
        </header>

  <?php
    if(isset($errorMessage)) {
        echo $errorMessage;
    }
  ?>

  <form class="box" action="login.php?login=1" method="post">
        <h1>Login</h1>
        <input type="text" name="email" placeholder="E-Mail">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Submit">
        <p>Noch kein Account? <a href="register.php">Erstelle einen Account</a></p>

  </form>


  </body>
</html>