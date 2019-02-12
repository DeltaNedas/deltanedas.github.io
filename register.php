<!DOCTYPE html>

<html>
  <head>
    <title>Register</title>
    <link rel = "stylesheet",
      href = "/style.css">
    <link rel = "shortcut icon",
      href = "/res/img/favicon.png" type="image/x-icon"/>
  </head>
  <body>
    <menu-bar>
      <menu-tab>
        <a href = "/">Home</a>
      </menu-tab>
    </menu-bar><br /><br />
    <form action = "register.php",
      method = "post">
      <input type = "text",
        name = "username",
        placeholder = "Username",
        style = "margin-right: 7px;" />
      <input type = "text",
        name = "email",
        placeholder = "Email"/><br /><br />
      <input type = "password",
        name = "password",
        placeholder = "Password",
        style = "margin-right: 7px;" />
      <input type = "password",
        name = "passwordverify",
        placeholder = "Password, Again"/><br /><br />
      <input type = "submit",
        name = "Register!",
        style = "width: 100%" />
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $Username = $_POST["username"];
      $Email = $_POST["email"];
      $Password = $_POST["password"];
      $PasswordVerify = $_POST["passwordverify"];
      if (!(strlen($Username) < 17 && 3 < strlen($Username))) {
        echo "Username must be between 4 and 16 characters long.";
      } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "Email is not valid.";
      } elseif (!(strlen($Password) > 7 && strlen($Password) < 129)) {
        echo "Password must be between 8 and 128 characters long.";
      } elseif ($Password != $PasswordVerify) {
        echo "Passwords must match.";
      } else {
        $Username = htmlspecialchars($Username);
        $ID = escapeshellcmd("/var/www/html/data/$Email");
        if (!file_exists($ID)) {
          $PasswordVerify  = "";
          $Password = password_hash($Password, PASSWORD_BCRYPT);
          echo "Welcome, $Username.";
          file_put_contents("$ID/password", $Password, LOCK_EX);
          file_put_contents("$ID/username", $Username, LOCK_EX);
          file_put_contents("$ID/balance", 0, LOCK_EX);
          $AccessToken = bin2hex(random_bytes(128)); //Creates 128 character long random Access Token
          
        } else {
          echo "Email already taken.";
        }
      }
    }
    ?>
  </body>
</html>
