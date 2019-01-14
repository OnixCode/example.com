<?php

function active ($name){
  $current = basename($_SERVER ['PHP_SELF']);
    if($current === $name){
      return 'active';
    }
    return null;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php if(!empty($meta)): ?>
  <?php if(!empty($meta['title'])): ?>
    <title><?php echo $meta['title']; ?></title>
<?php endif; ?>

<?php if(!empty($meta['description'])): ?>
  <meta name="description" content="<?php echo $meta['description']; ?>">
<?php endif; ?>

<?php if(!empty($meta['keywords'])): ?>
  <meta name="keywords" content="<?php echo $meta['keywords']; ?>">
<?php endif; ?>

<?php endif; ?>

<base href ="/">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="./dist/css/main.min.css">
</head>

<body>
  <header>
    <span class="logo">My Website</span>
    <a id="toggleMenu">Menu</a>
    <nav>
      <ul>
        <li><a href="index.php" <?php echo active('index.php'); ?>>Home</a></li>
        <li><a href="resume.php" <?php echo active('resume.php'); ?>>Résumé</a></li>
        <li><a href="contact.php" <?php echo active('contact.php'); ?>>Contact</a></li>
        <li><a href="posts" <?php echo active('/posts'); ?>>Post</a></li>
        <li><a href="users" <?php echo active('/users'); ?>>User</a></li>

        <li>
          <?php if(!empty($_SESSION['user']['id'])): ?>
            <a href="logout.php">Logout</a>
          <?php else: ?>
            <a href="login.php" <?php echo active('/login.php'); ?> >Login</a>
          <?php endif; ?>
        </li>

      </ul>
    </nav>
  </header>

  <main class="container"><?php echo $content; ?>

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
