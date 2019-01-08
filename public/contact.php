<?php
require '../core/processContactForm.php';

$meta=[];
$meta['title']='Contact John';
$meta['description']='Contact John';

$content = <<<EOT
  {$message}
<form action="contact.php" method="POST" novalidate>
  <h1>Contact Form</h1>

  <div class="form-group">
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{$valid->userInput('name')}">
    <div class="text-danger">{$valid->error('name')}</div>
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input id="email" type="email" name="email" value="{$valid->userInput('email')}">
    <div class="text-danger">{$valid->error('email')}</div>
  </div>

  <div class="form-group">
    <label for="message">Messsage</label>
    <textarea id="message" name="message" value="{$valid->userInput('message')}"></textarea>
    <div class="text-danger">{$valid->error('message')}</div>
  </div>

  <div>
    <input type="hidden" name="_subject" value="New submission!">
  </div>

  <div>
    <input type="submit" value="Send">
  </div>
</form>
EOT;

require '../core/layout.php';
