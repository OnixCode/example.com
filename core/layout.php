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
        <li><a href="index.php
        ">Home</a></li>
        <li><a href="resume.php
        ">Résumé</a></li>
        <li><a href="contact.php
        ">Contact</a></li>
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
