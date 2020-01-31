<?/*این تابع کارش لود کردن فایل های داخل کنترلر و مدل است و تمام آنها را صدا می زند*/
function __autoload($classname) {
  if (strhas($classname, "Model")) {/*?داره میگه اگه کلاس ما تو اسمش مدل داشت ، دستورای زیر رو اجرا کن*/
    $filename = str_replace("Model", "", $classname);/*کلمه مدل رو از نام کلاس حذف کن*/
    $filename = strtolower($filename);/*تمام حروف نام کلاس ما را به کوچک تبدیل کن*/
    require_once(getcwd() . "/mvc/model/$filename.php");/*تمام فایل های داخل دایرکتوریی که درون پرانتز نوشته شده است را برای ما صدا می زند یا همان require می کند*/
    return;
  }

  if (strhas($classname, "Controller")) {/*تمام کارهایی که در بالا برای مدل انجام دادیم برای کنترلر انجام میدهد*/
    $filename = str_replace("Controller", "", $classname);
    $filename = strtolower($filename);
    require_once(getcwd() . "/mvc/controller/$filename.php");
    return;
  }
}
?>