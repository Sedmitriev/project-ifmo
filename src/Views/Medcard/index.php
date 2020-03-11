</header>
<div class="mainblock">
  <div class = "medcard">
      <table class = "table_blur">
        <tr>
          <th>Номер карты</th>
          <th>Фамилия</th>
          <th>Имя</th>
          <th>Отчество</th>
          <th>Дата рождения</th>
          <th> </th>
          </tr>
          <?php foreach ($medcardsOnPage as $medcard):
            $url = '/medcard/show';
            echo "<tr><form action='" . $url . "' method='post'><td><input name='medcard_id' type='hidden' value="
            . $medcard['medcard_id'] . " />" . $medcard['medcard_id'] . "</td><td>" . $medcard['patients_surname']
              . "</td><td>" . $medcard['patients_name'] . "</td><td>" . $medcard['patients_patronymic'] . "</td><td>"
              . $medcard['patients_dob'] . "</td><td><input type='submit' name='selcard' value='Выбрать' /></td></form></tr>";
          endforeach;?>
      </table>
      <?php echo $pagination->get(); ?>
      </div>
    </div>
    <div class = "Vmenu">
      <form action="/medcard/search" method="post" class="search">
        <input type="search" name="id" placeholder="поиск" class="input" />
        <input type="submit" name="searchCard" value="" class="submit" />
      </form>
      <ul>
      <li><a href='/medcard/new' class="btn btn-primary">Новая карта</a></li>
      <li><a href="#dialog" class="btn btn-primary">Выбрать карту</a></li>
      <li><a href="#dialogdel" class="btn btn-primary">Удалить карту</a></li>
      <li><a href='/visit/calendar' class="btn btn-primary">Журнал</a></li>
      <li><a href='/kassa/index' class="btn btn-primary">Касса</a></li>
      </ul>
  </div>
</div>

<!--   <script type="text/javascript">
function get_action() { // inside script tags
  return form_action;
}
</script> -->
<div id = dialog>
  <div id = select>
    <p class="dialog_label">Введите номер медкарты</p>
      <form action="/medcard/show" method='post'>
      <!-- <form name="dialog" method="post" action="" onsubmit = "this.action=get_action();"></form> -->
        <input name="medcard_id" type="text" placeholder="Номер карты"/>
        <input type="submit" name="selcard" value="Выбрать карту"><br/>
      </form>
    <a href="#" class="close">Закрыть окно</a>
  </div>
</div>


<div id = dialogdel>
  <div id = delete>
    <p class="dialog_label">Введите номер медкарты</p>
    <form action="/medcard/delete" method="post">
    <input name="medcard_id" type="text" placeholder="Номер карты"/>
    <input type="submit" name="selcard" value="Удалить карту"><br/>
    </form>
    <a href="#" class="close">Закрыть окно</a>
  </div>
</div>

