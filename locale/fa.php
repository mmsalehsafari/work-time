<?
define('_email_not_registered', "ورود ناموفق است. لطفاً صحت ایمیل خود را بررسی نمایید");
define('_invalid_password', "رمز عبور شما اشتباه است");
define('_login_welcome', 'ورود شما را تبریک می گوییم <a href="' . baseUrl() . '/page/home">ورود به صفحه اصلی</a>');/*دیگر لازم نیست که کنترلر و MVC را بنویسیم چون آنها را قبلا در core.php خود به خود لود کرده ایم*/
define('_already_registered', "شما پیشتر ثبت نام کرده اید، کافیست وارد سایت شوید");
define('_already_logged_in', 'شما هم اکنون وارد شده اید <a href="' . baseUrl() . '/page/home">ورود به صفحه اصلی</a> یا <a href="' . baseUrl() . '/user/logout">خروج از حساب</a><br><br>ایمیل شما: ');
define('_weak_password', "پسورد به اندازه کافی قوی نمی باشد");
define('_password_not_match', "پسورد ها با هم مطابقت ندارند");
define('_user_name_not_get', "شما username خود را وارد نکرده اید");
define('_successfully_registered', 'شما با موفقیت ثبت نام شدید،<a href="' . baseUrl() . '/user/login">ورود به سایت</a>');/*در این می رود به دایرکتوری فریم ورک بعد به MVC و بعد از آنجا فایل user.php را می خواند و بعدش تابع login را اجرا می کند*/
define('_header_welcome', "خوش آمدید");
define('_header_guest', "کاربر مهمان");

define('_btn_register', "ثبت نام");
define('_btn_login', "ورود");
define('_btn_logout', "خروج");
define('_btn_signup', "ساخت حساب جدید");

define('_ph_email', "ایمیل");
define('_ph_password', "رمز عبور");
define('_ph_confirm_password', "تکرار رمز عبور");
define('_ph_user_name', "نام کاربری");
define('_ph_mobile_number', "شماره موبایل");
?>