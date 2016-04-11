<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>The Wall</title>
  </head>
  <body>

<section id="welcome">
<h1>Coding Dojo Wall</h1>
<?php
  if(isset($_SESSION['login_message']) && $_SESSION['login_message'] == "success") {
      echo "<h2 class='succes'>Welcome, " . $_SESSION['first_name'] . "!</h2>";
      echo "<span><a href='process.php'>Log off</a></span>";
  }
  ?>
  </section>
<div class="hline"></div>

<div id="the_wall">
  <form class="pure-form">
    <fieldset class="pure-group">
      <legend><strong>Post a message</strong></legend>
        <textarea class="pure-input-1-2" placeholder="Type in your message"></textarea>
    </fieldset>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Post a message</button>
</form>
</div>


</body>
</html>
