<?php
session_start();
require_once('connection.php');
?>

<!DOCTYPE html>
<html>
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
<div id ="the_wall">
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
  //$query_count_msg = "SELECT count(*) FROM messages";
  //$count_msg = fetch_record($query_count_msg);

  // if($count_msg > 0) {
    $query_get_msg = "SELECT first_name, last_name, users.created_at, message, messages.id FROM users LEFT JOIN messages ON users.id = messages.users_id";
    $messages = fetch_all($query_get_msg);

    $query_get_comments = "SELECT comment, comments.created_at, comments.users_id FROM messages LEFT JOIN comments ON messages.id = comments.messages_id";
    $comments = fetch_all($query_get_comments);

    //var_dump($comments);

    for($i=0; $i<count($messages); $i++){

        if($messages[$i]['message'] !== null) {
            echo '<div class="message">' . $messages[$i]['first_name'] . " " . $messages[$i]['last_name'] . " - " . $messages[$i]['created_at'] ;
            echo '<p>' . $messages[$i]['message'] . '</p>';

            for($j=0; $j<count($comments); $j++){
              if(true) {
              echo '<div class="comment">' . $comments[$j]['created_at'] . " " . $comments[$j]['users_id'];
              echo '<p>' . $comments[$j]['comment'] . '</p></div>';
            }
          } //end of comments loop
        ?>
      <!--*************** input comment ************************* -->
         <div id="the_wall">
           <form class="pure-form" action="process.php" method="post">
               <input type='hidden' name="action" value="comment">
               <fieldset class="pure-group">
                 <legend><strong>Post a comment</strong></legend>
                   <textarea class="pure-input-1-2" placeholder="Leave a comment" name="comment"></textarea>
     <!--*************** store message id ************************* -->
                   <input type='hidden' name='post_id' value=" <?php echo $comments[$j]['id']; ?> ">
               </fieldset>
               <button type="submit" class="pure-button pure-input-1-2 button-secondary">Leave a comment</button>
           </form>
        </div>
    <!-- ************end of input comment ************************* -->
      <?php

        } //end of if not null messages
    } //end of messages loop
//  } //end of if count mesages
?>


</div> <!-- end of message input-->

</body>
</html>
