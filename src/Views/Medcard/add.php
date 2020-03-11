</header>
<div class="mainblock">
  <div class = medcard>
      <div class = 'form'>
        <form action="/medcard/new" method="post">
          <p>
          <input name="medcard_id" type="text" placeholder="Номер карты" class="medcard_input"/>
          <input name="medcard_date" type="date" placeholder="Дата" class="medcard_input"/>
          </p>
          <p>
            <input name="patients_surname" type="text" placeholder="Фамилия" class="medcard_input"/>
            <input name="patients_name" type="text" placeholder="Имя" class="medcard_input"/>
            <input name="patients_patronymic" type="text" placeholder="Отчество" class="medcard_input"/>
          </p>
          <p>
            <input name="patients_dob" type="date" placeholder="Дата рождения" class="medcard_input"/>
            <select name="patients_sex">
              <option selected value="муж">мужской</option>
              <option value="жен">женский</option>
            </select>
          </p>
          <p>
            <input name="patients_addr" type="text" placeholder="Адрес" class="medcard_input"/>
            <input name="patients_tel" type="tel" placeholder="Телефон" class="medcard_input"/>
          </p>
          <p>
            <input name="patients_passp_series" type="text" placeholder="Серия паспорта" class="medcard_input"/>
            <input name="patients_passp_number" type="text" placeholder="Номер паспорта" class="medcard_input"/>
            <input name="patients_passp_issued_by" type="text" placeholder="Кем выдан" class="medcard_input"/>
            <input name="patients_passp_date" type="date" placeholder="Когда выдан" class="medcard_input"/>
            <input name="patients_passp_code" type="text" placeholder="Код подразделения" class="medcard_input"/>
          </p>
          <p>
            <input name="patients_insur" type="text" placeholder="Страховой полис" class="medcard_input"/>
          </p>
          <p>
            <input name="patients_job" type="text" placeholder="Место работы" class="medcard_input"/>
          </p>
          <p>
            <input name="patients_drugIntolerance" type="text" placeholder="Лекарственная непереносимость" class="medcard_input"/>
          </p>
          <div class="add_button">
            <input type="submit" name="addcard" value="Добавить карту"><br/>
          </div>
        </form>
    </div>
  </div>
  <div class = "Vmenu">
    <form action="searchCard.php" method="post" class="search">
      <input type="search" name="id" placeholder="поиск по номеру карты" class="input" />
      <input type="submit" name="searchCard" value="" class="submit" />
    </form>
    <ul>
    <li><a href='/medcard/index' class="btn btn-primary">Вернуться на главную</a></li>
    <li><a href='/medcard/add' class="btn btn-primary">Новая карта</a></li>
    <li><a href="#dialog" class="btn btn-primary">Выбрать карту</a></li>
    <li><a href="#dialogdel" class="btn btn-primary">Удалить карту</a></li>
    </ul>
  </div>
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
    <form action="script/delmedcard.php" method="post">
    <input name="medcard_id" type="text" placeholder="Номер карты"/>
    <input type="submit" name="selcard" value="Удалить карту"><br/>
    </form>
    <a href="#" class="close">Закрыть окно</a>
  </div>
</div>

