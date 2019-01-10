<?php


$meta=[];
$meta['title']="John's Resume";
$meta['description']='John Falzone a full stack developer';

$content = <<<EOT

    <h1>Hello, I am John Falzone</h1>
    <p>
      <img class="avatar" src="https://www.gravatar.com/avatar/4678a33bf44c38e54a58745033b4d5c6?d=mm&s=64" alt="John Falzone">
      In life, sometimes you have an opportunity to fulfill your purpose. I am achieving that through this page.</p>

EOT;

require '../core/layout.php';
