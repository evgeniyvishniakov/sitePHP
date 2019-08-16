<?php 

include 'include/header.php';

//$this->DelProducts();

// Добавление товаров

//$categories_id = $_POST['categories'];

//if ($categories_id == 2) {
//  $categories_name = 'Мужское';
//}else {
//  $categories_name = 'Женское';
//}



//if (!empty($_GET['edit'])) {
//  $id_edit = $_GET['edit'];
//
//  foreach ($admim_products->products($id_edit) as $key => $value) {
//    $name = $value['name'];
//    $price = $value['price'];
//    $sale = $value['sale'];
//    $size = $value['size'];
//    $color = $value['color'];
//    $child_cat_name = $value['child_cat_name'];
//    $brand = $value['brand'];
//    $quantity = $value['quantity'];
//    $categories_id = $value['categories_id'];
//
//    if ($categories_id == 2) {
//      $categories_name = 'Мужское';
//    }else {
//      $categories_name = 'Женское';
//    }
//  }
//
//  if (!empty($_POST['save_edit'])) {
//   $admim_products->products_edit($id_edit);
//    header('Location: http://showroom/admin-panel/?get=products');
//    ob_end_flush();
//    exit;
//  }
//}


?>

<div class="admin_products_main">
	<div class="table_input">

	<?php// if (!empty($_GET['edit'])) { // если нажата кнопка редактировать то меняется заголовок ?>
	  <h3>Редактировать Товар</h3>
	<?php// } else { ?>
	  <h3>Добавить Товар</h3>
	<?php// } ?>
	  <form action="#" method="POST">

	  <p>Выберите категорию:</p><select  name="categories_name">
		  <option selected disabled>Выбрать</option>
		  <?php// foreach ($admim_cat_prod->CategoriesParents() as $key => $value) {?>
		  <option <?php// if ($categories_id == $value['id']){echo 'selected';} ?>  value="<?php// echo $value['id']; ?>"><?php// echo $value['name']; ?></option>
		  <?php//  } ?>
		  </select>
	  <p>Подкатегория:</p><select name="child_cat_name">
		  <option value="Не выбрано" selected>Выбрать</option>
		  <?php// foreach ($admim_cat_prod->CategoriesChilds() as $key => $value) {?>
		  <option <?php// if ($child_cat_name === $value['name']){echo 'selected';} ?> value="<?php// echo $value['id'].'|'.$value['name'] ?>"><?php// echo $value['name'];?></option>
		  <?php//  } ?>
		  </select> 

		  <?php // if (!empty($_GET['edit'] OR !empty($categories_id))) { // Если нажато редактировать, то убирается кнопка Выбрать категорию
		   // echo '';
		   //} else {?>
			<input type="submit" value="Выбрать" name="cat_ok"> 
		  <?php// } ?>
		

	  <div class="pointer_events <?php// if (!empty($categories_id)){echo 'pointer-events_auto';}else{echo 'pointer-events_none';} ?>">
	  
		<p>Название:</p><input type="text" name="name" value="<?php// echo $name; ?>">
		<form id="form" action="">
		<input type="file" id="files" multiple name="foto" value="<?php// echo $foto; ?>">
		<output id="list"></output>
		</form>
		<p>Цена:</p><input type="number" name="price" value="<?php// echo $price; ?>">
		<p>Скидка:</p><input type="number"  name="sale" value="<?php// echo $sale; ?>">

			  <p>Размер:</p><select name="size">
				  <option value="Не выбрано" selected>Выбрать</option>
			  <?php// foreach ($admim_sizes_prod->sizes_list() as $key => $value) {?>
				  <option <?php// if ($size == $value['name']){echo 'selected';} ?> value="<?php// echo $value['name'];?>"><?php// echo $value['name'];?></option>
			  <?php // } ?>
				  </select>

			  <p>Цвет:</p><select name="color">
			  <option value="Не выбрано" selected>Выбрать</option>
			  <?php// foreach ($admim_colors_prod->colors_list() as $key => $value) {?>
				  <option <?php// if ($color == $value['name']){echo 'selected';} ?> value="<?php// echo $value['name'];?>"><?php //echo $value['name'];?></option>
			  <?php//  } ?>
				  </select>

			  

			  <p>Бренд:</p><select name="brand">
				  <option value="Не выбрано" selected>Выбрать</option>
			  <?php// foreach ($admim_brands_prod->brands_list() as $key => $value) {?>
				  <option <?php// if ($brand == $value['name']){echo 'selected';} ?> value="<?php// echo $value['name'];?>"><?php// echo $value['name'];?></option>
			  <?php//  } ?>     
				 </select>

			  <p>Количество:</p><input type="number" name="quantity" value="<?php echo $quantity;?>"></p>

			  <?php if (!empty($_GET['edit'])) {  // Если нажато редактировать, то меняется кнопка?>

				  <input type="submit" value="Редактировать" name="save_edit">
			  
				<?php } else {?>

				  <input type="submit" value="Сохранить" name="save_prod">
				<?php
				  if ($_POST['save_prod']) $this->AddProducts(); 
				} ?>  
			
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
				<?php foreach ($this->ShowProducts() as $key => $value) {?>
				<tr>
				  <td><img class="image_admin" src="../app/admin/views/img/<?php echo $value['foto']; ?>" alt="<?php echo $value['foto']; ?>"></td>
				  <td><?php echo $value['name']; ?></td>
				  <td><?php echo $value['price'] . ' грн'; ?></td>
				  <td><?php echo $value['sale'] . ' грн'; ?></td>
				  <td><?php echo $value['size']; ?></td>
				  <td><?php echo $value['color']; ?></td>
				  <td>
					<p><?php echo $value['categories_name']; ?></p>
					<p><?php echo $value['child_cat_name']; ?></p>
				  </td>
				  <td><?php echo $value['brand']; ?></td>
				  <td><?php echo $value['quantity'] . ' шт'; ?></td>
				  <td><a class="edit" href="?get=products&edit=<?php echo $value['id']; ?>"><i class="fa fa-pencil-square-o"></i></a></td>
				  <td><a class="del" href="?del=<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
				<?php  } ?> 
			  </table>
			</div>
		  </div>
</div>
<?php

include 'include/footer.php';
?> 











