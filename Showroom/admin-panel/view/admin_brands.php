<div class="table_input">
        <h3>Добавить Бренд</h3>
        <form action="#" method="POST">
          <p>Название:</p><input type="text" name="name_brend">
          <p>Логотип:</p><input type="file">
          <input type="submit" name="ok_brand" value="Сохранить">
        </form>
      </div>
      <div class="table_brand">
        <h3>Список товаров</h3>
        <div class="search">
          <input type="text" name="search">
          <input type="submit" value="Поиск">
        </div>
        <div class="teble">
          <table>
            <tr>
              <th>Логотип</th>
              <th>Название</th>
            </tr>
            <tr>
              <td>Фото</td>
              <td>Levis</td>
              <td><a class="edit" href="?get=products/?edit=2"><i class="fa fa-pencil-square-o"></i></a></td>
              <td><a class="del" href=""><i class="fa fa-trash"></i></a></td>
            </tr>
          </table>
        </div>
	 </div>	
  