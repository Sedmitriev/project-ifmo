</header>
<div class="mainblock">
  <div class = "medcard">
    <table class = "table_blur">
      <tr>
        <th>Дата</th>
        <th>Врач</th>
        <th>Код услуги</th>
        <th>Название</th>
        <th>Цена</th>
        <th> </th>
      </tr>
      <?php foreach ($servicesById as $serv):
          echo "<tr><td>" . $serv['visits_date'] . "</td><td>" . $serv['doctors_name'] . "</td><td>" . $serv['services_code']
             . "</td><td>" . $serv['services_name'] . "</td><td>" . $serv['services_price'] . "</td></tr>";
        endforeach;?>
    </table>
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
    <li><a href='#addVisit' class="btn btn-primary addVisit">Добавить услугу</a></li>
    <li><a href='/medcard/template/title' class="btn btn-primary">Титульный лист</a></li>
    <li><a href='/medcard/template/contract' class="btn btn-primary">Договор</a></li>
    <li><a href='/medcard/template/med_consent' class="btn btn-primary">Согласие на мед вмешательство</a></li>
    <li><a href='/medcard/template/pers_consent' class="btn btn-primary">Согласие на обаботку персональных данных</a></li>
    <li><a href='/medcard/template/poll' class="btn btn-primary">Карта опроса</a></li>
    <li><a href='/medcard/template/act' class="btn btn-primary">Акт приема-сдачи мед услуг</a></li>
    <li><a href='/medcard/template/notification' class="btn btn-primary">Уведомление</a></li>
    <li><a href='/medcard/template/paid_services' class="btn btn-primary">Предоставление платных мед услуг</a></li>
    <li><a href='/medcard/template/treatment_plan' class="btn btn-primary">Предварительный план лечения</a></li>
    </ul>
  </div>
</div>


  <div id = "addVisit" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Заголовок модального окна -->
        <div class="modal-header">
          <h4 class="modal-title">Запись на прием</h4>
        </div>
        <!-- Основное содержимое модального окна -->
        <div class="modal-body">
          <form action="/visit/addFromServices" method="post">
            <div class="form-group">
              <label for="time">Время приема</label>
              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" name="date" data-target="#datetimepicker1"/>
                  <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
            </div>
            <div class="form-group">
              <label for="doctor">Врач</label>
              <select class="form-control" name="doctor" placeholder="Врач">
                <?php foreach ($doctors as $doc):
                  echo "<option value = " . $doc['doctors_id'] . " > " . $doc['doctors_name'] . " </option>";
                endforeach;?>
              </select>
            </div>
            <div class="form-group">
              <label for="medcard_nmb">Номер медкарты</label>
              <?php $valueMedcard = $medcard['medcard_id'];?>
              <input type="text" class="form-control" name="medcard" placeholder="Номер карты" value="<?php echo $valueMedcard ?>">
            </div>
            <div class="form-group" id="serv">
              <label for="services_code">Код услуги</label>
              <button type="button" class="btn btn-primary">
                <i class="fas fa-plus-square"></i> Добавить
              </button>
              <select class="form-control" name="service[]" placeholder="Код услуги">
                <?php foreach ($services as $srv):
                  echo "<option value = " . $srv['services_id'] . " > " . $srv['services_code'] . " - " . $srv['services_name'] . " </option>";
                endforeach;?>
              </select>
            </div>
        <!-- Футер модального окна -->
        <div class="modal-footer">
          <!-- <button type="button" id="newCard2" class="btn btn-primary">Новая карта</button> -->
          <button type="submit" class="btn btn-primary">Добавить запись</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        </div>
      </form>
      </div>
    </div>
  </div>
 </div>
</body>
</html>
