<div class="mainblock">
  <div class = "medcard">
    <h3><? $checkConnect ?></h3>
    <h3><? $checkKKT ?></h3>
    <form action="/kassa/print" method="post">
        <p>
        <input name="service" type="text" placeholder="Услуга"/>
        <input name="price" type="text" placeholder="Цена"/>
        </p>
        <div class="add_button">
          <input type="submit" name="printcheck" value="Распечатать чек"><br/>
        </div>
    </form>
  </div>
    <div class = "Vmenu">
      <form action="/medcard/search" method="post" class="search">
        <input type="search" name="id" placeholder="поиск" class="input" />
        <input type="submit" name="searchCard" value="" class="submit" />
      </form>
      <ul>
      <li><a href="#dialog">Открыть смену</a></li>
      <li><a href="#dialogdel">Закрыть смену</a></li>
      </ul>
    </div>
  <div id = dialog>
    <div id = select>
      <p>Введите номер медкарты</p>
      <?php $url = '/medcard/' . $medcard['medcard_nmb'];
        echo "<form action='" . $url . "' method='post'>"; ?>
      <input name="medcard_nmb" type="text" placeholder="Номер карты"/>
      <input type="submit" name="selcard" value="Выбрать карту"><br/>
      </form>
      <a href="#" class="close">Закрыть окно</a>
    </div>
  </div>
  <div id = dialogdel>
    <div id = delete>
      <p>Введите номер медкарты</p>
      <form action="/medcard/delete" method="post">
      <input name="medcard_nmb" type="text" placeholder="Номер карты"/>
      <input type="submit" name="selcard" value="Удалить карту"><br/>
      </form>
      <a href="#" class="close">Закрыть окно</a>
    </div>
  </div>
</div> 
