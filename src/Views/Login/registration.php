</header>
<div class="mainblock">
<div class = "enter_reg">
    <? if(isset($result)) : ?>
    <p><? echo $result; ?></p>
    <? endif; ?>
    <div class = 'label_login'>
        <h3>Регистр
            
        ация</h3>
    </div>
    <div class = "img">
        <img src="static/images/man.jpg">
    </div>
    <div class = 'form_reg'>
        <form action="/registration" method="post">
        <div class="ent-input">
            <input name="users_login" type="text" placeholder="Введите логин" class="login_input">
        </div>
        <div class="ent-input">
            <input name="users_password" type="password" placeholder="Введите пароль" class="login_input">
        </div>
        <div class="ent-input">
            <input name="users_fio" type="text" placeholder="Введите фамилию" class="login_input">
        </div>
        <div class="ent-input">
            <input name="users_position" type="text" placeholder="Введите должность" class="login_input">
        </div>
        <div class="ent-submit_reg">
            <input type="submit" name="submit" value="Зарегистрироваться"><br/>
        </div>
        </form>
    </div>
    <!-- <div class="ent-button">
        <input value="Зарегистрироваться" type="button" onclick="location.href='/registration'" />
    </div> -->
</div>
</div>