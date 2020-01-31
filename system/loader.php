<?/*این صفحه تمام فایل هایی که لازم است صدا شوند را برای ما صدا می کند و در واقع تمام فایل های داخل فولدر system را صدا می کند*/
session_start();
date_default_timezone_set('Asia/Tehran');

global $config;
require_once(getcwd() . '/config.php');/*تابع get_cwd() را حتما باید در ابتدای مسیردهی مان بنویسیم تا به دایرکتوری صحیح منتفل شویم*/
require_once(getcwd() . '/system/core.php');/*تایعget_cwd() به ما می گوید که شما الان فی الحال در کدام مسیر هستید و به مسیر شما عبارت زردزنگ را اضافه می کند تا مسیردهی شما کامل شود*/
require_once(getcwd() . '/system/common.php');
require_once(getcwd() . '/system/db.php');
require_once(getcwd() . '/system/view.php');
require_once(getcwd() . '/locale/' . $config['lang'] . '.php');
?>