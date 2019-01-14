<?php
require '../../config/keys.php';
require '../../core/db_connect.php';

$meta=[];
$meta['title']="Message Mailbox";

$content="<h1>Message Mailbox</h1>";
$stmt = $pdo->query('SELECT * FROM inqueries');

while($row = $stmt->fetch()){
  $content .= "<div><a href=\"inqueries/view.php?email={$row['email']}\">{$row['name']}</a></div>";
}

require '../../core/layout.php';
