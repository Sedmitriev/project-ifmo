</header>
<div class="mainblock">
 <div class = "medcard">
    <? if ($delMedcard): ?>
    <h2>Карта №<? echo $medcardId; ?> удалена</h2>
    <? endif ?>
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
