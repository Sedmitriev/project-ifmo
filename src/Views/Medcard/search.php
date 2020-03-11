</header>
<div class="mainblock">
<div class = "medcard">
    <? if (!empty($searchMedcard)) : ?>
    <table class = "table_blur">
      <tr>
        <th>Номер карты</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата рождения</th>
        <th> </th>
        </tr>
        <? foreach ($searchMedcard as $medcard):
                  $url = '/medcard/show';
                  echo "<tr><form action='" . $url . "' method='post'><td><input name='medcard_id' type='hidden' value="
                  . $medcard['medcard_id'] . " />" . $medcard['medcard_id'] . "</td><td>" . $medcard['patients_surname']
                    . "</td><td>" . $medcard['patients_name'] . "</td><td>" . $medcard['patients_patronymic'] . "</td><td>"
                    . $medcard['patients_dob'] . "</td><td><input type='submit' name='selcard' value='Выбрать' /></td></form></tr>";
            endforeach;?>
        </table>
        <? else : ?>
          <h2>Карта не найдена</h2>
        <? endif ?>
    <?php //echo $pagination->get(); ?>
    </div>
</div>
  <div class = "medcard">
    <? if (!empty($searchMedcard)) : ?>
    <table class = "table_blur">
      <tr>
        <th>Номер карты</th>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата рождения</th>
        <th> </th>
        </tr>
        <? foreach ($searchMedcard as $medcard):
                  $url = '/medcard/show';
                  echo "<tr><form action='" . $url . "' method='post'><td><input name='medcard_id' type='hidden' value="
                  . $medcard['medcard_id'] . " />" . $medcard['medcard_id'] . "</td><td>" . $medcard['patients_surname']
                    . "</td><td>" . $medcard['patients_name'] . "</td><td>" . $medcard['patients_patronymic'] . "</td><td>"
                    . $medcard['patients_dob'] . "</td><td><input type='submit' name='selcard' value='Выбрать' /></td></form></tr>";
            endforeach;?>
        </table>
        <? else : ?>
          <h2>Карта не найдена</h2>
        <? endif ?>
    <?php //echo $pagination->get(); ?>
    </div>
  </div>
  <div class = "Vmenu">
    <form action="/medcard/search" method="post" class="search">
      <input type="search" name="id" placeholder="поиск" class="input" />
      <input type="submit" name="searchCard" value="" class="submit" />
    </form>
    <ul>
    <li><a href='/medcard/index' class="btn btn-primary">Вернуться на главную</a></li>
    <li><a href='/medcard/add' class="btn btn-primary">Новая карта</a></li>
    <li><a href="#dialog" class="btn btn-primary">Выбрать карту</a></li>
    <li><a href="#dialogdel" class="btn btn-primary">Удалить карту</a></li>
    </ul>
  </div>
<div id = dialog>
  <div id = select>
    <p>Введите номер медкарты</p>
    <?php $url = '/medcard/' . $medcard['medcard_id'];
      echo "<form action='" . $url . "' method='post'>"; ?>
    <input name="medcard_id" type="text" placeholder="Номер карты"/>
    <input type="submit" name="selcard" value="Выбрать карту"><br/>
    </form>
    <a href="#" class="close">Закрыть окно</a>
  </div>
</div>
<div id = dialogdel>
  <div id = delete>
    <p>Введите номер медкарты</p>
    <form action="/medcard/delete" method="post">
    <input name="medcard_id" type="text" placeholder="Номер карты"/>
    <input type="submit" name="selcard" value="Удалить карту"><br/>
    </form>
    <a href="#" class="close">Закрыть окно</a>
  </div>
</div>
