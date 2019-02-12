<!DOCTYPE html>

<html>
<head>
  <title>Error 404: File Not Found</title>
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
  <?php
    function out($Text) {
      echo "$Text <br />";
    }
    $File = $_SERVER["REQUEST_URI"];
    out("^^^ Click :D");
    out("Request file <strong>$File</strong> was not found.");
  ?>
</body>
</html>
