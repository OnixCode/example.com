<?php
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';


$message = null;

$args = [
    'title'=>FILTER_SANITIZE_STRING, //strips HTML to prevent cross site injection attacks
    'meta_description'=>FILTER_SANITIZE_STRING, //same
    'meta_keywords'=>FILTER_SANITIZE_STRING, //same
    'body'=>FILTER_UNSAFE_RAW //null filter to take data and process it allowing all HTML
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){
  //strip white spa$input['b$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);$input['body'] = strip_tags($input['body'],$allowed);ody'] = strip_tags($input['body'],$allowed);ce from beginning and end
    $input = array_map('trim', $input);
  //Identifying only allowed HTML
    $input['body'] =cleanHTML($input['body']);
  //creating the slug
    $slug = slug($input['title']);

    //sanitized insert
    $sql = 'INSERT INTO posts SET id=uuid(), title=?, slug=?, body=?';
    if($pdo->prepare($sql)->execute([
        $input['title'],
        $slug,
        $input['body']
    ])){ //if the above execute statement runs correctly you go back to following line as a redirection, else Something bad happened
       header('LOCATION:/posts');
    }else{
        $message = 'Something bad happened';
    }
}

$content = <<<EOT
<h1>Add a New Post</h1>
{$message}
<form method="post">

<div class="form-group">
    <label for="title">Title</label>
    <input id="title" name="title" type="text" class="form-control">
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea id="body" name="body" rows="8" class="form-control"></textarea>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="meta_description">Description</label>
        <textarea id="meta_description" name="meta_description" rows="2" class="form-control"></textarea>
    </div>

    <div class="form-group col-md-6">
        <label for="meta_keywords">Keywords</label>
        <textarea id="meta_keywords" name="meta_keywords" rows="2" class="form-control"></textarea>
    </div>
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
EOT;

include '../../core/layout.php';
