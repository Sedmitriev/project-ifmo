</header>
<div class="mainblock">
<div class = medcard>
    <div class = 'form'>
      <form action="/medcard/update/<?php echo $medcard['medcard_id']; ?>" method="post">
        <p>
        <input name="medcard_id" type="text" value="<?php echo $medcard['medcard_id']; ?>" placeholder="Номер карты" class="medcard_input"/>
        <input name="medcard_date" type="date" value="<?php echo $medcard['medcard_date']; ?>" placeholder="Месяц, год" class="medcard_input"/>
        </p>
        <p>
          <input name="patients_surname" type="text" value="<?php echo $medcard['patients_surname']; ?>" placeholder="Фамилия" class="medcard_input"/>
          <input name="patients_name" type="text" value="<?php echo $medcard['patients_name']; ?>" placeholder="Имя" class="medcard_input"/>
          <input name="patients_patronymic" type="text" value="<?php echo $medcard['patients_patronymic']; ?>" placeholder="Отчество" class="medcard_input"/>
        </p>
        <p>
          <input name="patients_dob" type="date" value="<?php echo $medcard['patients_dob']; ?>" placeholder="Дата рождения" class="medcard_input"/>
          <select name="patients_sex">
            <?php $selects = array('муж' => 'мужской', 'жен' => 'женский');?>
            <option selected value="<?=$medcard['patients_sex']?>"><?=$selects[$medcard['patients_sex']]?></option>
            <?php
            if ($medcard['patients_sex'] == 'жен') {
              echo '<option value="жен">женский</option>';
            } else {echo '<option value="муж">мужской</option>';}
            ?>
          </select>
        </p>
        <p>
          <input name="patients_addr" type="text" value="<?php echo $medcard['patients_addr']; ?>" placeholder="Адрес" class="medcard_input"/>
          <input name="patients_tel" type="tel" value="<?php echo $medcard['patients_tel']; ?>" placeholder="Телефон" class="medcard_input"/>
        </p>
        <p>
          <input name="patients_passp_series" type="text" value="<?php echo $medcard['patients_passp_series']; ?>" placeholder="Серия паспорта" class="medcard_input"/>
          <input name="patients_passp_number" type="text" value="<?php echo $medcard['patients_passp_number']; ?>" placeholder="Номер паспорта" class="medcard_input"/>
          <input name="patients_passp_issued_by" type="text" value="<?php echo $medcard['patients_passp_issued_by']; ?>" placeholder="Кем выдан"/ class="medcard_input">
          <input name="patients_passp_date" type="date" value="<?php echo $medcard['patients_passp_date']; ?>" placeholder="Когда выдан" class="medcard_input"/>
          <input name="patients_passp_code" type="text" value="<?php echo $medcard['patients_passp_code']; ?>" placeholder="Код подразделения" class="medcard_input"/>
        </p>
        <p>
          <input name="patients_insur" type="text" value="<?php echo $medcard['patients_insur']; ?>" placeholder="Страховой полис" class="medcard_input"/>
        </p>
        <p>
          <input name="patients_job" type="text" value="<?php echo $medcard['patients_job']; ?>" placeholder="Место работы" class="medcard_input"/>
        </p>
        <p>
          <input name="patients_drugIntolerance" type="text" value="<?php echo $medcard['patients_drugIntolerance']; ?>" placeholder="Лекарственная непереносимость"class="medcard_input"/>
        </p>
        <div class="add_button">
          <input type="submit" name="addcard" value="Редактировать карту"><br/>
        </div>
      </form>
    </div>
  </div>
  <div class = Vmenu>
    <ul>
    <li><a href='/medcard/index' class="btn btn-primary">Вернуться на главную</a></li>
    <li><a href="/services/<?php echo $medcard['medcard_id']; ?>" class="btn btn-primary">Услуги</a></li>
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
</div>
</div> 

