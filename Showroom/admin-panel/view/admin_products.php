<?php 
include_once './class/class_admin_categories.php';
include_once './class/class_admin_brands.php';
include_once './class/class_admin_colors.php';
include_once './class/class_admin_sizes.php';


$admim_brands = new Admin_Brands;
$admim_colors = new Admin_Colors;
$admim_sizes = new Admin_Sizes;

$admim_cat = new Admin_Categories;


//print_r($admim_cat->CategoriesParents());

//foreach ($admim_cat->CategoriesParents() as $key => $value) {
//  echo $value['name'];
//}

print_r($_FILES['image']);

$cat_id = $_POST['categories'];

if ($cat_id == 2) {
  $cat_name = 'Мужское';
}else {
  $cat_name = 'Женское';
}

$name = htmlspecialchars($_POST['name']);
$foto = $_FILES['image'];
echo $foto;
$price = $_POST['price'];
$sale = $_POST['sale'];
$size = $_POST['size'];
$color = $_POST['color'];
$child_cat = $_POST['child-cat'];
$brand = $_POST['brand'];
$qunt = $_POST['qunt'];


?>



<div class="table_input">
  <h3>Добавить Товар</h3>

  <form action="#" method="POST">

  <p>Выберите категорию:</p><select  name="categories">
      <option selected disabled>Выбрать</option>
      <?php foreach ($admim_cat->CategoriesParents() as $key => $value) {?>
      <option <?php if ($cat_id == $value['id']){echo 'selected';} ?>  value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
      <?php  } ?>
      </select>
    <input type="submit" value="Выбрать" name="cat_ok"> 

  <div class="pointer_events <?php if (!empty($cat_id)){echo 'pointer-events_auto';}else{echo 'pointer-events_none';} ?>">
  
    <p>Название:</p><input type="text" name="name" value="<?php echo $name; ?>">
    <p>Фото:</p><input type="file" name="image" multiple accept="image/*,image/jpeg"/>
    <p>Цена:</p><input type="number" name="price" value="<?php echo $price; ?>">
    <p>Скидка:</p><input type="number"  name="sale" value="<?php echo $sale; ?>">

          <p>Размер:</p><select name="size">
              <option selected disabled>Выбрать</option>
          <?php foreach ($admim_sizes->sizes_list() as $key => $value) {?>
              <option <?php if ($size == $value['name']){echo 'selected';} ?> value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
          <?php  } ?>
              </select>

          <p>Цвет:</p><select name="color">
          <option selected disabled>Выбрать</option>
          <?php foreach ($admim_colors->colors_list() as $key => $value) {?>
              <option <?php if ($color == $value['name']){echo 'selected';} ?> value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
          <?php  } ?>
              </select>

          <p>Подкатегория:</p><select name="child-cat">
              <option selected disabled>Выбрать</option>
          <?php foreach ($admim_cat->CategoriesChilds($cat_id) as $key => $value) {?>
            <option <?php if ($child_cat == $value['name']){echo 'selected';} ?> value="<?php echo $value['name']; ?>"><?php echo $value['name'];?></option>
            
          <?php  } ?>
             </select>

          <p>Бренд:</p><select name="brand">
              <option selected disabled>Выбрать</option>
          <?php foreach ($admim_brands->brands_list() as $key => $value) {?>
              <option <?php if ($brand == $value['name']){echo 'selected';} ?> value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
          <?php  } ?>     
             </select>

          <p>Количество:</p><input type="number" name="qunt" value="<?php echo $qunt;?>"></p>

          <input type="submit" value="Сохранить" name="save_prod">
        
    </div>
  </form>        
</div>
      <div class="table_prod">
        <h3>Список товаров</h3>
        <div class="search">
          <input type="text" name="search">
          <input type="submit" value="Поиск">
        </div>
        <div class="teble">
          <table>
            <tr>
              <th>Фото</th>
              <th>Название</th>
              <th>Цена</th>
              <th>Скидка</th>
              <th>Размер</th>
              <th>Цвет</th>
              <th>Категория</th>
              <th>Бренд</th>
              <th>Количество</th>
            </tr>
            <tr>
              <td>Фото</td>
              <td>Платье</td>
              <td>2500 грн</td>
              <td>200 грн</td>
              <td>m</td>
              <td>Синий</td>
              <td>
                <p>Мужское</p>
                <p>Штаны</p>
              </td>
              <td>Levis</td>
              <td>2 шт</td>
              <td><a class="edit" href="?get=products&edit=2"><i class="fa fa-pencil-square-o"></i></a></td>
              <td><a class="del" href=""><i class="fa fa-trash"></i></a></td>
            </tr>
          </table>
        </div>
      </div>
 
