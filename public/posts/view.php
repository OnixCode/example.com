<?php
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

$input=filter_input_array(INPUT_GET);
$slug=preg_replace("/[^a-z0-9-]+/","",$input['slug']);

$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = :slug"); //calls the data and holds
$stmt->execute(['slug'=>$slug]); //prepares the data
$row = $stmt->fetch(); //pulls to our site

$meta=[];
$meta['title']=$row['title'];
$meta['description']=$row['meta_description'];
$meta['keywords']=$row['meta_keywords'];

$content=<<<EOT
<h1>{$row['title']}</h1>
{$row['body']}

<hr>
<div>
  <a href="posts/edit.php?id={$row['id']}">Edit</a>
  <a href="posts/delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';
