<?php 
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Админ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/admin/style_admin.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>

<section class="admin">
    <div class="top_admin">
        <div class="logo">
            <p>Admin</p>
        </div>
        <div class="logout">
            <p class="name">Имя пользователя</p>
            <a href="http://showroom/">Вернуться на сайт</a>
            <a href="">Выход</a>
        </div>
    </div>
    <div class="main_admin">
        <div class="left_admin">
            <ul>
            <a href="#">Главная</a>
            <a href="?get=products">Товары</a>
            <a href="#">Категории</a>
            <a href="#">Пользователи</a>
            <a href="?get=atribute">Атрибуты</a>
            
            </ul>
        </div>
        <div class="right_admin">
            <?php 
                $admin_page = [
                    "atribute" ,
                    "products" ,
                ];

                foreach ($admin_page as $page ) {
                   if ($page == $_GET['get']) {
                        require_once "view/admin_". $page .".php";
                   }
                }
            
            ?>
        </div>
    </div>
</section>   
<script>
    
function handleFileSelect(evt) {
    var files = evt.target.files;

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = 
          [
            '<img style="height: 75px; border: 1px solid #000; margin: 5px" src="', 
            e.target.result,
            '" title="', escape(theFile.name), 
            '"/>'
          ].join('');
          
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);


</script>
</body>
</html>

