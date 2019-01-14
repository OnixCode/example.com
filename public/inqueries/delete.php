<?php
require '../../config/keys.php';
require '../../core/db_connect.php';

$args =[
  'id'=>FILTER_UNSAFE_RAW,
  'confirm'=>FILTER_VALIDATE_INT
];

$input=filter_input_array(INPUT_GET, $args);
$id=$input['id'];

$stmt = $pdo->prepare("SELECT * FROM inqueries WHERE id= :id");
$stmt->execute(['id'=>$id]);
$row = $stmt->fetch();


if(!empty($input['confirm'])){
  $stmt = $pdo->prepare("DELETE FROM inqueries WHERE id= :id");
  if($stmt->execute(['id'=>$id])){
    header('Location: /inqueries/');
  }
}

$meta=[];
$meta['title']="DELETE: {$row['id']}";


$content=<<<EOT
<h1 style="text-align-center;"><b style="color:red;">DELETE:</b> {$row['email']}</h1>
<h2 style="text-align-center";><b style="color:red";>Are you sure you want to delete</b> {$row['email']}</h2>

<hr>
<div>
  <a href="inqueries/">Cancel</a>
  <a href="inqueries/delete.php?id={$row['id']}&confirm=1">Delete</a>
</div>
EOT;

require '../../core/layout.php';
