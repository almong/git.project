<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="../style/main.css" />

<h1 class="h1">Создание договора физ. лица</h1>
<form class="form_dogovor" method="POST" action=./load_dogovor.php>
    <table>
        <tr><td>
    <p><label for="d_num">Номер договора:</label><input type="text" value="<?php echo file_get_contents("./doc/number_doc");?>" name="d_num"></p>
	<p><label for="d_date">Дата договора:</label><input type="text" value="<?php echo date("d.m.Y"); ?>" name="d_date"></p>
        </td></tr>
    </table>
    <table>
        <tr><td>
        <p><label for="fio">ФИО:</label><input type="text" name="fio" placeholder="Иванов Василий Петрович"></p>
		<p><label for="tel_num">Номер телефона:</label><input type="text" name="tel_num" placeholder="89887625865"></p>
		<p><label for="series_pas">Серия паспорта:</label><input type="text" name="series_pas" placeholder="1234"></p>
		<p><label for="num_pas">Номер паспорта:</label><input type="text" name="num_pas" placeholder="123456"></p>
		<p><label for="kem_pas">Кем выдан:</label><input type="text" name="kem_pas" placeholder="ОВД Мосторазводного района г. Ленинград"></p>
		<p><label for="d_pas">Дата выдачи:</label><input type="text" name="d_pas"></p>
        </td>
        <td>
        <p><label for="street">Адрес подключения (улица):</label><input type="text" name="street" placeholder="ул. Пролетарская"></p>
		<p><label for="dom">Номер дома:</label><input type="text" name="dom" placeholder="20"></p>
		<p><label for="apart">Номер квартиры:</label><input type="text" name="apart" placeholder="3"></p>
		<p><label for="id">Лицевой счет:</label><input type="text" value="<?php include('script/new_id.php');?>" name="id"></p>
		<p><label for="pass">Пароль от ЛК: </label><input type="text" value="<?php include('script/gen_pass.php');?>" name="pass"></p>
        <p><label for="pay_connect">Стоимость подключения:</label><input type="text" name="pay_connect" placeholder="0"></p>
        <p><label for="tarif">Тариф:</label><select class="select-class" name="tarif" size="1">
						<option selected="selected" value="Квартира 10 за 350">Квартира 10 за 350</option>
						<option value="Квартира 25 за 490">Квартира 25 за 490</option>
						<option value="Квартира 50 за 690">Квартира 50 за 690</option>
						<option value="Квартира 100 за 980">Квартира 100 за 980</option>
						<option value="Коттедж 15 за 570">Коттедж 15 за 570</option>
						<option value="Коттедж 30 за 790">Коттедж 30 за 790</option>
						<option value="Коттедж 55 за 960">Коттедж 55 за 960</option>
						<option value="Коттедж 100 за 1490">Коттедж 100 за 1490</option>
				</select></p>
        </td></tr>
        </table>
    <p><label class="label_checkbox">Добавлять абонента в биллинг</label><input class="checkbox" type="checkbox" name="add_user" checked></p></br>
	<p class="bottom"><input class="form_bottom" value="Создать договор" type="submit"></p>
</form>