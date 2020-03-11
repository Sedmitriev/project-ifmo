</header>
<div class="mainblock">
  <div class = "medcard">
    <div id = "calendar">
    </div>
  </div>
  <div class = "Vmenu">
    <form action="/medcard/search" method="post" class="search">
      <input type="search" name="id" placeholder="поиск" class="input" />
      <input type="submit" name="searchCard" value="" class="submit" />
    </form>
    <ul>
    <li><a href='/medcard/index' class="btn btn-primary">На главную</a></li>
    <li><a href='#newCard' class="btn btn-primary" id="newCard1" data-toggle="modal" data-target="#newCard">Новая карта</a></li>
    </ul>
  </div>
</div>

  <div id = "addVisit" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Заголовок модального окна -->
        <div class="modal-header">
          <h4 class="modal-title">Запись на прием</h4>
        </div>
        <!-- Основное содержимое модального окна -->
        <div class="modal-body">
          <form action="/visit/add" method="post" name="addVisit">
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
              <select class="form-control" name="medcard" placeholder="Номер карты">
                <?php foreach ($medcards as $card):
                  echo "<option value = " . $card['medcard_id'] . " > " . $card['medcard_id'] . " - " . $card['patients_surname'] . " " . $card['patients_name'] . " " . $card['patients_patronymic'] . " </option>";
                endforeach;?>
              </select>
            </div>
            <div id="serv">
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="services_code">Код услуги</label>
                  <select class="form-control selectService" name="service[]" placeholder="Код услуги">
                    <?php foreach ($services as $srv):
                      echo "<option value = " . $srv['services_id'] . " > " . $srv['services_name'] . " - " . $srv['services_code'] . " </option>";
                    endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="services_count">Кол-во</label>
                  <input type="number" min="1" max="99" step="1" class="form-control services_count" name="services_count[]" value = "1">
                </div>
                <div class="form-group col-md-2">
                  <label for="services_sum">Сумма</label>
                  <input type="text" class="form-control services_sum" name="services_sum[]" value="500">
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-primary" id="addServ">
              <i class="fas fa-plus-square"></i> Добавить
            </button>
            <div class="form-group">
             <label for="sum">Итого</label>
             <input type="text" class="form-control" name="sum">
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

 <div id = "newCard" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content">
       <!-- Заголовок модального окна -->
       <div class="modal-header">
         <h4 class="modal-title">Запись на прием</h4>
       </div>
       <!-- Основное содержимое модального окна -->
       <div class="modal-body">
         <form action="/visit/addNewCard" method="post" name="addNewCard">
           <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
               <input type="text" class="form-control datetimepicker-input" name="date" data-target="#datetimepicker2"/>
               <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                   <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
             <input type="text" class="form-control" id='medcard' name="medcard" value="<?php echo $nextId; ?>" placeholder="Номер карты">
           </div>
           <div class="form-group">
             <label for="patients_surname">Фамилия пациента</label>
             <input type="text" class="form-control" id='patients_surname' name="patients_surname" placeholder="Фамилия пациента">
           </div>
           <div class="form-group">
             <label for="patients_name">Имя пациента</label>
             <input type="text" class="form-control" id='patients_name' name="patients_name" placeholder="Имя пациента">
           </div>
           <div class="form-group">
             <label for="patients_patronymic">Отчество пациента</label>
             <input type="text" class="form-control" id='patients_patronymic' name="patients_patronymic" placeholder="Отчество пациента">
           </div>
           <div class="form-group">
             <label for="patients_tel">Телефон</label>
             <input type="text" class="form-control" id='patients_tel' name="patients_tel" placeholder="Телефон пациента">
           </div>
           <div id="serv">
              <div class="form-row">
                <div class="form-group col-md-8">
                  <label for="services_code">Код услуги</label>
                  <select class="form-control selectService" name="service[]" placeholder="Код услуги">
                    <?php foreach ($services as $srv):
                      echo "<option value = " . $srv['services_id'] . " > " . $srv['services_name'] . " - " . $srv['services_code'] . " </option>";
                    endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="services_count">Кол-во</label>
                  <input type="number" min="1" max="99" step="1" class="form-control services_count" name="services_count[]" value = "1">
                </div>
                <div class="form-group col-md-2">
                  <label for="services_sum">Сумма</label>
                  <input type="text" class="form-control services_sum" name="services_sum[]" value="500">
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-primary" id="addNewServ">
              <i class="fas fa-plus-square"></i> Добавить
            </button>
            <div class="form-group">
             <label for="sum">Итого</label>
             <input type="text" class="form-control" name="sum">
           </div>
       <!-- Футер модального окна -->
       <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Добавить запись</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
       </div>
     </form>
     </div>
   </div>
 </div>
 </div>

 <div id = "editVisit" class="modal fade">
   <div class="modal-dialog">
     <div class="modal-content">
       <!-- Заголовок модального окна -->
       <div class="modal-header">
         <h4 class="modal-title">Запись на прием</h4>
       </div>
       <!-- Основное содержимое модального окна -->
       <div class="modal-body">
         <form method="post" name="editVisit">
           <div class="form-group">
             <input type="hidden" class="form-control" id='id' name="visits_id"
           </div>
           <div class="form-group">
             <label for="time">Время приема</label>
             <input type="text" class="form-control" id='date' name="date" placeholder="Время">
           </div>
           <div class="form-group">
             <label for="doctor">Врач</label>
             <input type="text" class="form-control" id='doctor' name="doctor" placeholder="Врач">
           </div>
           <div class="form-group">
             <label for="medcardId">Номер медкарты</label>
             <input type="text" class="form-control" id='medcardId' name="medcardId" placeholder="Номер карты">
           </div>
           <div class="form-group">
             <label for="patient">ФИО пациента</label>
             <input type="text" class="form-control" id='patient' name="patient" placeholder="Фамилия, имя, отчество">
           </div>
           <div id="editServ">
            <div class="form-row">
              <div class="form-group col-md-8">
              <label for="services_code" id='labelService'>Код услуги</label>
                <select class="form-control editServSelect selectService" name="service[]" placeholder="Код услуги">
                    <?php foreach ($services as $srv):
                      echo "<option value = " . $srv['services_id'] . " > " . $srv['services_name'] . " - " . $srv['services_code'] . " </option>";
                    endforeach;?>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="services_count">Кол-во</label>
                <input type="number" min="1" max="99" step="1" class="form-control services_count" name="services_count[]" value="1">
              </div>
              <div class="form-group col-md-2">
                <label for="services_sum">Сумма</label>
                <input type="text" class="form-control services_sum" name="services_sum[]" value="500">
              </div>
            </div>
           </div>
              <button type="button" class="btn btn-primary" id="addEditServ"
                <i class="fas fa-plus-square"></i> Добавить
              </button>
            <div class="form-group">
             <label for="sum">Итого</label>
             <input type="text" class="form-control" name="sum">
           </div>
       <!-- Футер модального окна -->
       <div class="modal-footer">
         <button type="submit"  formaction="/visit/delete" class="btn btn-primary">Удалить запись</button>
         <button type="submit"  formaction="/visit/update" class="btn btn-primary">Редактировать запись</button>
         <button type="button" class="btn btn-default" data-dismiss="modal" onclick='window.location.reload(true)'>Закрыть</button>
       </div>
     </form>
     </div>
   </div>
 </div>
</div>

<script src='/static/js/calendar.js'></script>
<script>
  let formAddVisit = document.forms.addVisit;
  let formAddNewCard = document.forms.addNewCard;
  //let formEditVisit = document.forms.editVisit;

  function sum(form) {
  let sumNode = form.sum;
  let servSum = form.querySelectorAll('.services_sum');
  for (let i = 0; i < servSum.length; i++) {
    sumNode.value = Number(sumNode.value) + Number(servSum[i].value);
    console.log(servSum[i].value);
  }
  console.log(sumNode.value);
  return sumNode.value;
}

  function changeSum(form) {
    let sumNode = form.sum;
    let serviceSum = form.querySelector('.services_sum');
    let selectService = form.querySelector('.selectService');
    let serviceCount = form.querySelector('.services_count');

    selectService.addEventListener('change', function() {
      
    let selectOption = this.getElementsByTagName('option');
    for (let i = 0; i < selectOption.length; i++) {
      if (selectOption[i].selected) {
      let id = selectOption[i].value - 1;
      serviceSum.value = servJSON[id].services_price;
      sumNode.value = 0;
      serviceCount.value = 1;
      }
    }
      sum(form);
    });

    serviceCount.addEventListener('change', function() {
    let selectOption = selectService.getElementsByTagName('option');
    for (let i = 0; i < selectOption.length; i++) {
      if (selectOption[i].selected) {
      let id = selectOption[i].value - 1;
      serviceSum.value = servJSON[id].services_price * this.value;
      sumNode.value = 0;
      }
    }
    sum(form);
  });
}

changeSum(formAddVisit);
changeSum(formEditVisit);
changeSum(formAddNewCard);
  
</script>
