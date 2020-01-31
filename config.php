<?
if (!defined('test')) { echo "Forbidden Request"; exit; }

global $config;
$config['db']['host'] = 'localhost';
$config['db']['user'] = 'armaxir';
$config['db']['pass'] = '1234';
$config['db']['name'] = 'armaxir_notes';

$config['lang'] = 'fa';

$config['salt'] = 'suya9s8ydaiu987vqo28bv9q87B87VPq7E98QVB';
$config['base'] = '/time';/*با نوشتن این کد ما همه جا می توانیم با نوشتن base کلمه /notes-v2/ را به ابتدای مسیر دایرکتوری هایمان اضافه کنیم*/

$config['route'] = array(/*این کانفیگ برای ایجاد alias استفاده می شود*/
  '/login' => '/user/login',/*میگه که اگه ما در url نوشتیم login تو در اصل برای ما همون user/login/ را اجرا کن که قبلا اجرا می کردی*/
  '/profile' => '/user/profile',
  '/ورود' => '/user/login',
);