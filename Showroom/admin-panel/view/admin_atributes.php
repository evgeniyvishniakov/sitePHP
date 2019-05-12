<?php 
include_once './class/class_admin_brands.php';
include_once './class/class_admin_colors.php';
include_once './class/class_admin_sizes.php';



$admim_brands = new Admin_Brands;
$admim_sizes = new Admin_Sizes;
$admim_colors = new Admin_Colors;
$name = $_POST['name'];
$foto = $_POST['foto'];

if (!empty($_POST["atribute"]) AND empty($_POST["ok_atribute"])) {
  
  switch ($_POST["atribute"]) {

    case 'brand':
      $admim_brands->brands_add($name, $foto);
        break;
    case 'size':
      $admim_sizes = new Admin_Sizes;
        break;
    case 'color':
      $admim_colors = new Admin_Colors;
        break;

  }
}else {
  $error_add = 'Выберите атрибут';
}
echo '<pre>';
var_dump($_POST);
echo '</pre>';
?>



<div class="table_input">
        <h3>Добавить Бренд</h3>
        <p><?php echo $error_add; ?></p>
        <form action="#" method="POST">
        <p>Выберите атрибут:</p><select  name="atribute">
        <option selected disabled>Выбрать</option>
        <option value="brand">Бренд</option>
        <option value="size">Размер</option>
        <option value="color">Цвет</option>
        </select>

          <p>Название:</p><input type="text" name="name">
          <p>Логотип:</p><input type="file" name ="foto">
          <input type="submit" name="ok_atribute" value="Сохранить">
        </form>
      </div>
      <div class="table_list">

      <div class="table_atribute table_brands">
        <h3>Бренды</h3>
          <table>
              <tr>
              <th>Логотип</th>
              <th>Название</th>
            </tr>
            <?php foreach ($admim_brands->brands_list() as $key => $value) {?>
            <tr>
              <td><?php echo $value['foto'];?></td>
              <td><?php echo $value['name'];?></td>
              <td><a class="edit" href="?get=products&edit=<?php echo $value['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
              <td><a class="del" href="?get=atribute&brand_del=<?php echo $value['id'];?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php  } ?>
          </table>
        </div>

        <div class="table_atribute table_colors">
        <h3>Цвет</h3>
          <table>
            <tr>
              <th>id</th>
              <th>Название</th>
            </tr>
            <?php foreach ($admim_colors->colors_list() as $key => $value) {?>
            <tr>
              <td><?php echo $value['id'];?></td>
              <td><?php echo $value['name'];?></td>
              <td><a class="edit" href="?get=products&edit=<?php echo $value['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
              <td><a class="del" href="?get=atribute&color_del=<?php echo $value['id'];?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php  } ?>
          </table>
        </div>

        <div class="table_atribute table_sizes">
        <h3>Размер</h3>
          <table>
            <tr>
              <th>id</th>
              <th>Название</th>
            </tr>
            <?php foreach ($admim_sizes->sizes_list() as $key => $value) {?>
            <tr>
              <td><?php echo $value['id'];?></td>
              <td><?php echo $value['name'];?></td>
              <td><a class="edit" href="?get=products&edit=<?php echo $value['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
              <td><a class="del" href="?get=atribute&size_del=<?php echo $value['id'];?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php  } ?>
          </table>
        </div>
      </div> 
	 </div>	
  