<?php
require '../config/keys.php';
require 'db_connect.php';
require 'John/src/Validation/Validate.php';

use John\Validation;

$message = null;

$valid = new John\Validation\Validate();

$args = [
    'name'=>FILTER_SANITIZE_STRING, //strips HTML to prevent cross site injection attacks
    'email'=>FILTER_SANITIZE_EMAIL, //same
    'message'=>FILTER_SANITIZE_STRING, //same
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){
  //strip white spa$input['b$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);ody'] = strip_tags($input['body'],$allowed);ce from beginning and end
    $input = array_map('trim', $input);

    //sanitized insert
    $sql = 'INSERT INTO
      inqueries
    SET
      id=uuid(),
      name=?,
      email=?,
      message=?';
  var_dump($input);
    if($pdo->prepare($sql)->execute([
        $input['name'],
        $input['email'],
        $input['message']
    ])){
       header('LOCATION: thanks.php');
    }else{
        $message = 'Something bad happened';
    }

}
