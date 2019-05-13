<?php 
include_once './class/class_admin_brands.php';
include_once './class/class_admin_colors.php';
include_once './class/class_admin_sizes.php';


$admim_brands = new Admin_Brands;
$admim_colors = new Admin_Colors;
$admim_sizes = new Admin_Sizes;


?>



<div class="table_input">
        <h3>Добавить Бренд</h3>

        
        <form action="#" method="POST">
        <p>Выберите атрибут:</p><select  name="atribute">
        <option selected disabled>Выбрать</option>
        <option value="1">Бренд</option>
        <option value="2">Размер</option>
        <option value="3">Цвет</option>
        </select>

          <p>Название:</p><input type="text" name="name_brend">
          <p>Логотип:</p><input type="file">
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
              <td><a class="del" href="?get=atribute&size_del=<?php echo $value['id'];?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php  } ?>
          </table>
        </div>
      </div> 
	 </div>	
  