<?php
require '../../core/functions.php';
require '../../core/session.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

// Get the post
$get=filter_input_array(INPUT_GET);
$id = $get['id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute(['id'=>$id]);

$row = $stmt->fetch(); //load into row variable for use later

if(empty($row)){
  http_response_code(404);
  die('Page Not Found <a href="/">Home</a>');
}

$meta=[];
$meta['title']=$row['title'];

//Update the post
$message = null;

$args = [
  //strips HTML to prevent cross site injection attacks
  'id'=>FILTER_SANITIZE_STRING,
  'title'=>FILTER_SANITIZE_STRING, //same
  'meta_description'=>FILTER_SANITIZE_STRING, //same
  'meta_keywords'=>FILTER_SANITIZE_STRING, //same
  'body'=>FILTER_UNSAFE_RAW
  //null filter to take data and process it allowing all HTML
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){
  //strip white space from beginning and end
    $input = array_map('trim', $input);

  //Identifying only allowed HTML
    $input['body'] =cleanHTML($input['body']);

  //creating the slug
    $slug = slug($input['title']);

  //sanitized insert
  $sql = 'UPDATE
    posts
  SET
    title=:title,
    slug=:slug,
    body=:body,
    meta_keywords=:meta_keywords,
    meta_description=:meta_description
  WHERE
    id=:id';

  if($pdo->prepare($sql)->execute([
    'title'=>$input['title'],
    'slug'=>$slug,
    'body'=>$input['body'],
    'meta_keywords'=>$input['meta_keywords'],
    'meta_description'=>$input['meta_description'],
    'id'=>$input['id']
  ])){ /*if the above execute statement runs correctly you go back to
    following line as a redirection, else Something bad happened*/
      header('LOCATION:/posts/view.php?slug=' . $row['slug']);
  }else{
      $message = 'Something bad happened';
  }
}

$content = <<<EOT
<h1>Edit a Post</h1>
{$message}
<form method="post">
<input name="id" value="{$row['id']}" type="text">

<div class="form-group">
    <label for="title">Title</label>
    <input id="title" value="{$row['title']}" name="title" type="text" class="form-control">
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea id="body" name="body" rows="8" class="form-control"
    >{$row['body']}
    </textarea>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="meta_description">Description</label>
        <textarea id="meta_description" name="meta_description" rows="2" class="form-control"
        >{$row['meta_description']}
        </textarea>
    </div>

    <div class="form-group col-md-6">
        <label for="meta_keywords">Keywords</label>
        <textarea id="meta_keywords" name="meta_keywords" rows="2" class="form-control"
        >{$row['meta_description']}
        </textarea>
    </div>
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
EOT;

include '../../core/layout.php';
