<?php
require '../../core/functions.php';
require '../../core/session.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

$input=filter_input_array(INPUT_GET);

$id=!(empty($input['id']))?$input['id']:null; //$id variable is equal to the 'id' table value
$email=!(empty($input['email']))?$input['email']:null; /*does this variable exist,
otherwise set the value null for both lines 7 and 8*/

if(!empty($email)){
  $lookup = $email;
  $where = 'email = :lookup'; //column in database equals value we want it to be
}else{
  $lookup = $id;
  $where = 'id = :lookup';
}

$stmt=$pdo->prepare("SELECT * FROM users WHERE {$where}");//at this point $where is still equal to 'email=:lookup'
$stmt->execute(['lookup'=>$lookup]); // setting 'lookup' key to $lookup value by overwriting the line above
$row=$stmt->fetch();

$meta=[];
$meta['title']="{$row['first_name']} {$row['last_name']}";

$content=<<<EOT
<h1>{$row['first_name']} {$row['last_name']}</h1>
{$row['email']}

<hr>
<div>
  <a href="users/edit.php?id={$row['id']}">Edit</a>
  <a href="users/delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';
