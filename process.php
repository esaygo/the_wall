<?php

session_start();

require_once('connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'register') {
    register_user($_POST);
}
elseif(isset($_POST['action']) && $_POST['action'] == 'login') {
  login_user($_POST);

}
elseif(isset($_POST['action']) && $_POST['action'] == 'message') {
  post_message($_POST);
  //var_dump("this is the message" . $_POST);
  //die();
}
else{ //malicious nav to process.php or someone trying to log off
  session_destroy();
  header('Location: index.php');
  die();
}



function register_user($post) {
  $_SESSION['errors'] = array();
  if(empty($post['first_name'])) {
    $_SESSION['errors'][]="First name can't be blank!";
  }
  if(empty($post['last_name'])) {
    $_SESSION['errors'][]="Last name can't be blank!";
  }
  if(empty($post['password'])) {
    $_SESSION['errors'][]="Password is required!";
  }
  if($post['password'] !== $post['confirm_password']) {
    $_SESSION['errors'][] = "The password doesn't match!";
  }
  if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors'][] = "Invalid email!";
  }
//***********end of validation checks***********
  if(count($_SESSION['errors']) > 0) {
    header('Location:index.php');
    die();

  } else { //insert into db
    $query = "INSERT INTO users(first_name,last_name,email,password,created_at,updated_at) VALUES ('".$post['first_name']."','".$post['last_name']."', '".$post['email']."', '".$post['password']."',NOW(),NOW())";

    run_mysql_query($query);
    $_SESSION['success_message'] = "User succesfully added!";

    header('Location:index.php');
    die();
  }
}

function login_user($post) {

  $query = "SELECT * FROM users WHERE users.email = '".$post['email']."' AND users.password = '".$post['password']."' ";

  $user = fetch_record($query);

  if(count($user) > 0) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['login_message'] = "success";
    header('Location:the_wall.php');
  } else {
    $_SESSION['errors'] = "Can't find a user with these credentials";
    header('Location:index.php');
  }
}

function post_message($post) {
  $query = "INSERT INTO messages(message,created_at,updated_at, users_id) VALUES ('".$post['message']."',NOW(),NOW(), '".$_SESSION['user_id']."')";
  var_dump($post);
  echo "this is the message" . $query;
  run_mysql_query($query);
  header('Location:the_wall.php');
  die();
}

 ?>
