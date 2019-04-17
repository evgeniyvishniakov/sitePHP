<div class="table_input">
  <h3>Добавить Товар</h3>
  <form action="#" method="POST">
  <p>Название:</p><input type="text">
  <p>Фото:</p><input type="file">
  <p>Цена:</p><input type="number">
  <p>Скидка:</p><input type="number">
  <p>Размер:</p><select name="Size[]">
  <option selected disabled value="all">Выбрать</option>
              <option value="xxs">XXS</option>
              <option value="xs">XS</option>
              <option value="s">S</option>
              <option value="m">M</option>
              <option value="l">L</option>
              <option value="xl">XL</option>
              <option value="xxl">XXL</option>
             </select>
          <p>Цвет:</p><select name="Color[]">
              <option selected disabled value="all">Выбрать</option>
              <option value="red">Красный</option>
              <option value="yellow">Желтый</option>
              <option value="green">Зеленый</option>
              <option value="blue">Синий</option>
              <option value="orange">Оранжевый</option>
              <option value="black">Черный</option>
             </select>
          <p>Категория:</p><select name="categories[]">
              <option selected disabled value="all">Выбрать</option>
              <option value="red">Мужское</option>
              <option value="yellow">Женской</option>
             </select>
          <p>Подкатегория:</p><select name="child-cat[]">
              <option selected disabled value="all">Выбрать</option>
              <option value="red">Штаны</option>
              <option value="yellow">Футболки</option>
             </select>
          <p>Бренд:</p><select name="Color[]">
              <option selected disabled value="all">Выбрать</option>
              <option value="red">Puma</option>
              <option value="yellow">Adidas</option>      
             </select>
          <p>Количество:</p><input type="number"></p>
          <input type="submit" value="Сохранить">
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
 
