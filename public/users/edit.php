<?php
require '../../core/functions.php';
require '../../core/session.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

// Get the post
$get=filter_input_array(INPUT_GET);
$id = $get['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id'=>$id]);

$row = $stmt->fetch(); //load into row variable for use later

if(empty($row)){
  http_response_code(404);
  die('Page Not Found <a href="/">Home</a>');
}

$meta=[];
$meta['title']="{$row['first_name']} {$row['last_name']}";

//Update the post
$message = null;

$args = [
  //strips HTML to prevent cross site injection attacks
  'id'=>FILTER_SANITIZE_STRING,
  'first_name'=>FILTER_UNSAFE_RAW, //same
  'last_name'=>FILTER_UNSAFE_RAW, //same
  'email'=>FILTER_SANITIZE_EMAIL, //same
  'password'=>FILTER_UNSAFE_RAW
  //null filter to take data and process it allowing all HTML
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){
  //strip white space from beginning and end
  $input = array_map('trim', $input);

  $hashSQL=false;

  if(!empty($input['password'])){

    $hash = password_hash(
      $input['password'],
      PASSWORD_BCRYPT,
      ['cost'=>14]
    );
    $hashSQL=",password='{$hash}'";
  }

  //sanitized insert
  $sql = "UPDATE
    users
  SET
    first_name=:first_name,
    last_name=:last_name,
    email=:email
    {$hashSQL}
  WHERE
    id=:id";

  if($pdo->prepare($sql)->execute([
    'first_name'=>$input['first_name'],
    'last_name'=>$input['last_name'],
    'email'=>$input['email'],
    'id'=>$input['id']
  ])){ /*if the above execute statement runs correctly you go back to
    following line as a redirection, else Something bad happened*/
      header('LOCATION:/users/index.php?id=' . $row['id']);
  }else{
      $message = 'Something bad happened';
  }
}

$content = <<<EOT
<h1>Edit Current User</h1>
{$message}
<form method="post">
<input value="{$row['id']}" name="id">
<div class="form-group">
    <label for="fName">First Name</label>
    <input id="fName"  value="{$row['first_name']}" name="first_name" type="text" class="form-control">
</div>

<div class="form-group">
    <label for="lName">Last Name</label>
    <input id="lName" value="{$row['last_name']}" name="last_name" class="form-control">
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input id="email" value="{$row['email']}" name="email" class="form-control">
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" class="form-control">
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>

EOT;

include '../../core/layout.php';
