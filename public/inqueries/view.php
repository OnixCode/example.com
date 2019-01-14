<?php
require '../../config/keys.php';
require '../../core/db_connect.php';

$input=filter_input_array(INPUT_GET);
$record = $input['email'];

$stmt = $pdo->prepare("SELECT * FROM inqueries WHERE email = :email");
$stmt->execute(['email'=>$record]);
$row = $stmt->fetch();

$meta=[];
$meta['title']= "Sender's Mailbox";

$content=<<<EOT
<h1>{$row['name']}</h1>
{$row['email']}<br>
{$row['message']}

<hr>
<div>
  <a href="inqueries/delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';
