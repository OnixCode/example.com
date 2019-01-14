<?php
require '../core/functions.php';
require '../core/processContactForm.php';

$meta=[];
$meta['title']="Contact John";
$meta['description']='Contact John';

$content = <<<EOT
<h1>Contact Form</h1>
{$message}
<form method="post">

<div class="form-group">
    <label for="Name">Name</label>
    <input id="name" name="name" type="text" class="form-control">
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input id="email" name="email" type="text" class="form-control">
</div>

<div class="form-group">
    <label for="message">Message</label>
    <input id="message" name="message" type="textarea" style="width:200px;height:250px;" class="form-control">
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
    <a href="/inqueries/index.php" >Check Sent</a>
</div>
</form>
EOT;

include '../core/layout.php';
