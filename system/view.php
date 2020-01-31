<?php
class View {/*این صفحه برای نشان دادن فایل های html , css کاربرد دارد و ما را به دایرکتوری فایل های مربوطه هدایت می کند و در آخر در داخل یک تمپلیت قرار می دهد*/
  public static function render($filePath, $data = array()){
  
    extract($data);/*از ایندکس داخل متغیر دیتا یک متغیر تهیه می کند و در واقع ایندکس را به متغیر تبدیل می کند*/

    ob_start();/*تمام مطالبی که در داخل ob_start() و ob_get_clean() نوشته می شوند در داخل صفحه نمایش داده نمی شوند بلکه در داخل متغیر کانتنت ذخیره می گردند*/
    require_once(getcwd() . "/mvc/view" . $filePath);
    $content = ob_get_clean();

    require_once(getcwd() . "/theme/default.php");/*با این دستور ما را به دایرکتوری مربوط به تمپلیت مان هدایت می کندکه همان default.php می باشد*/
  }

  public static function renderPartial($filePath, $data = array()){/*این تابع همانند تابع render می باشد با این تفاوت که که دیگر ما را به تمپلیت که فایل default.php بود هدایت نمی کند*/
    extract($data);

    require_once(getcwd() . "/mvc/view" . $filePath);
  }
}