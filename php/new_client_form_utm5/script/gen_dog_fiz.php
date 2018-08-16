<?php
require_once 'vendor/autoload.php';
//Разбираем название тарифного плана
	$tarif_arrey = array();
	$tarif_arrey = explode(' ',$_POST['tarif']);
	$speed = $tarif_arrey[1];
	$pay_abon = $tarif_arrey[3];
//Сопоставление тарифов и id в биллинге
	if ($_POST['tarif']== 'Квартира 10 за 350'){$tarif_id = 26;}
	if ($_POST['tarif']== 'Квартира 25 за 490'){$tarif_id = 27;}
	if ($_POST['tarif']== 'Квартира 50 за 690'){$tarif_id = 28;}
	if ($_POST['tarif']== 'Квартира 100 за 980'){$tarif_id = 29;}

	if ($_POST['tarif']== 'Коттедж 15 за 570'){$tarif_id = 30;}
	if ($_POST['tarif']== 'Коттедж 30 за 790'){$tarif_id = 31;}
	if ($_POST['tarif']== 'Коттедж 55 за 960'){$tarif_id = 32;}
	if ($_POST['tarif']== 'Коттедж 100 за 1490'){$tarif_id = 33;}
//Заполняем файл шаблона
	$document = new \PhpOffice\PhpWord\TemplateProcessor('doc/dogovor_fizik.docx');
		$document->setValue('d_num', $_POST['d_num']);
		$document->setValue('d_date', $_POST['d_date']);
		$document->setValue('fio', $_POST['fio']);
		$document->setValue('series_pas', $_POST['series_pas']);
		$document->setValue('num_pas', $_POST['num_pas']);
		$document->setValue('kem_pas', $_POST['kem_pas']);
		$document->setValue('d_pas', $_POST['d_pas']);
		$document->setValue('street', $_POST['street']);
		$document->setValue('dom', $_POST['dom']);
		$document->setValue('apart', $_POST['apart']);
		$document->setValue('id', $_POST['id']);
		$document->setValue('login', $_POST['id']);
		$document->setValue('tel_num', $_POST['tel_num']);
		$document->setValue('pay_connect', $_POST['pay_connect']);
		$document->setValue('pay_abon', $pay_abon);
		$document->setValue('tarif', $_POST['tarif']);
		$document->setValue('speed', $speed);
		$document->setValue('pass', $_POST['pass']);
// Сохраняем файл на шару
$fio = $_POST['fio'];
$conv_d_num = ($_POST['d_num']);
$file = ("Договор № $conv_d_num-2018 (Интернет $fio).docx");
$path = ("doc/share/doc/");
$conv_file = ($path.$file);
$document->saveAs($conv_file);
//Увеличиваем счетчик договоров
$file = fopen("doc/number_doc", "w");
$d_num = $_POST['d_num'] + 1;
fwrite($file, $d_num); 
fclose($file);

$series_pas = $_POST['series_pas'];
$num_pas = $_POST['num_pas'];
$kem_pas = $_POST['kem_pas'];
$d_pas = $_POST['d_pas'];
$street = $_POST['street'];
$dom = $_POST['dom'];
$apart = $_POST['apart'];

$passport = "паспорт $series_pas $num_pas выдан $kem_pas дата выдачи $d_pas г.";
$addres = "$street $dom $apart";

if  ($_POST['add_user']=='on'){
    include_once 'vendor/k-shym/urfa-client/init.php';
//Соединение с UTM
$urfa = URFAClient::init(array(
    'login'    => 'portal',
    'password' => 'portal',
    'address'  => '172.16.1.52',
    'protocol' => 'tls',
	));
//Добавляем пользователя
$result = $urfa->rpcf_add_user_new(array(
    'login'=> $_POST['id'],
    'password'=> $_POST['pass'],
    'full_name'=> $_POST['fio'],
    'mob_tel'=> $_POST['tel_num'],
    'passport'=> $passport,
	'comments'=> $addres,
	'credit' => 50,
	'is_blocked' => 1
	));
$user_id = $result['user_id'];
//Добавляем группы
$urfa->rpcf_add_group_to_user(array(
	'user_id' => $user_id,
	'group_id' => 110
	));
if ($tarif_id == 26 || $tarif_id == 27 || $tarif_id == 28 || $tarif_id == 29){
$urfa->rpcf_add_group_to_user(array(
	'user_id' => $user_id,
	'group_id' => 400
	));
}
if ($tarif_id == 30 || $tarif_id == 31 || $tarif_id == 32 || $tarif_id == 33){
	$urfa->rpcf_add_group_to_user(array(
		'user_id' => $user_id,
		'group_id' => 300
	));
	}
//Добавляем тариф
$urfa->rpcf_link_user_tariff(array(
	'user_id' => $user_id,
    'tariff_current' => $tarif_id,
    //Расчетный период надо менять (+2) каждый месяц первого числа.
	'discount_period_id' => 44,
	'change_now' => 1
	));
}

?>
<form class="form_dogovor" action="<?php echo($conv_file);?>">
    <p class="bottom"><input class="form_bottom" type='submit' value='Скачать договор'></p>
</form>