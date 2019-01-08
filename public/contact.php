<?php
require '../config/keys.php';
require '../core/John/src/Validation/Validate.php';
require '../vendor/autoload.php';

use Jason\Validation;
use Mailgun\Mailgun;

$message = null;
$mgClient = new Mailgun('xxxx');
$domain = "sandboxxxxx.mailgun.org";
$valid = new John\Validation\Validate();

$args = [
  'name'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){
  $valid->validation = [
    'email' => [[
       'rule' => 'email',
       'message' => 'Please enter a valid email'
      ],[
      'rule' => 'notEmpty',
      'message' => 'Please enter an email'
    ]],
    'name' => [[
      'rule' => 'notEmpty',
      'message' => 'Please enter your first name'
    ]],
    'message' => [[
      'rule' => 'notEmpty',
      'message' => 'Please add a message'
    ]]

    ];

    $valid->check($input);

    if(empty($valid ->errors)){

      # Instantiate the client.
      $mgClient = new Mailgun(MG_KEY);
      $domain = MG_DOMAIN;

      # Make the call to the client.
      $result = $mgClient->sendMessage("$domain", array(
          'from'    => "{$input['name']} <{$input['email']}>",
          'to'      => 'John Falzone <21jroc@gmail.com>',
          'subject' => $input['subject'],
          'text'    => $input['message']
          )
        );

      var_dump($result);

      $message = "<div class=\alert alert-success\">Your form had been submitted!</div>";
    }else{
      $message = "<div class=\"alert alert-danger\">Your form has errors</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hello, I am John Falzone</title>
  <link rel="stylesheet" type="text/css" href="./dist/css/main.min.css">
</head>

<body>
  <header>
    <span class="logo">My Website</span>
    <a id="toggleMenu">Menu</a>
    <nav>
      <ul>
        <li><a href="index.php
        ">Home</a></li>
        <li><a href="resume.php
        ">Résumé</a></li>
        <li><a href="contact.php
        ">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main class="container">
  <br><br><br>
  <?php echo $message; ?>
    <form action="contact.php" method="POST" novalidate>
      <h1>Contact Form</h1>

      <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="<?php echo $valid->userInput('name'); ?>">
        <div class="text-danger"><?php echo $valid->error('name'); ?></div>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?php echo $valid->userInput('email'); ?>">
        <div class="text-danger"><?php echo $valid->error('email'); ?></div>
      </div>

      <div class="form-group">
        <label for="message">Messsage</label>
        <textarea id="message" name="message" value="<?php echo $valid->userInput('message'); ?>"></textarea>
        <div class="text-danger"><?php echo $valid->error('message'); ?></div>
      </div>

      <div>
        <input type="hidden" name="_subject" value="New submission!">
      </div>

      <div>
        <input type="submit" value="Send">
      </div>
    </form>
  </main>

  <script>
    var toggleMenu = document.getElementById('toggleMenu');
    var nav = document.querySelector('nav');
    toggleMenu.addEventListener(
      'click',
      function () {
        if (nav.style.display == 'block') {
          nav.style.display = 'none';
        } else {
          nav.style.display = 'block';
        }
      });
  </script>
</body>

</html>
