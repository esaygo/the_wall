<?php
session_start();
require_once('connection.php');
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
  <form class="pure-form" action="process.php" method="post">
    <input type='hidden' name="action" value="message">
    <fieldset class="pure-group">
      <legend><strong>Post a message</strong></legend>
        <textarea class="pure-input-1-2" placeholder="Type in your message" name="message"></textarea>
    </fieldset>
    <button type="submit" class="pure-button pure-input-1-2 pure-button-primary">Post a message</button>
</form>
</div>
<div id="display_messages">
  <?php
  $query_count_msg = "SELECT count(*) FROM messages";
  $count_msg = fetch_record($query_count_msg);

  if($count_msg > 0) {
    $query_get_msg = "SELECT first_name, last_name, users.created_at, message FROM users LEFT JOIN messages ON users.id = messages.users_id
";
    $messages = fetch_all($query_get_msg);
    //var_dump($messages);
    for($i=0; $i<count($messages); $i++){

        echo '<div class="message"><li>' . $messages[$i]['first_name'] . " " . $messages[$i]['last_name'] . " - " . $messages[$i]['created_at'] ;
        echo '<p>' . $messages[$i]['message'] . '</p></div><div class="hline"></div>  ';
    }

  }

  ?>

</div>

</body>
</html>
