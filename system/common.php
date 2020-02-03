<?php
function hr($return = false){
  if ($return){
    return "<hr>\n";
  } else {
    echo "<hr>\n";
  }
}

function br($return = false){
  if ($return){
    return "<br>\n";
  } else {
    echo "<br>\n";
  }

}

function dump($var, $return = false){
  if (is_array($var)){
    $out = print_r($var, true);
  } else if (is_object($var)) {
    $out = var_export($var, true);
  } else {
    $out = $var;
  }

  if ($return){
    return "\n<pre style='direction: ltr'>$out</pre>\n";
  } else {
    echo "\n<pre style='direction: ltr'>$out</pre>\n";
  }
}

function getCurrentDateTime(){
  return date("Y-m-d H:i:s");
}

function encryptPassword($password){
  global $config;
  return md5($password . $config['salt']);
}

function getFullUrl(){
  $fullurl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  return $fullurl;
}

function getRequestUri(){
  return $_SERVER['REQUEST_URI'];
}

function baseUrl(){/*با این تابع می توانیم عبارت /notes-v-2/ را به ابتدای دایرکتوری هایمان اضافه کنیم*/
  global $config;/*با این کد ما متغیر config را در همه جا می توانیم صدا بزنیم*/
  return $config['base'];/*برای مقداری دهی کردن به متغیر config ما در فایل config.php این کار را انجام می دهیم و سپس با دستورreturn این مقدار را دریافت می کنیم*/
}

function fullBaseUrl(){/*این تابع عبارت قبل از بیس روت هم به ما url ما اضافه می کند یعنی همه چیزهای قبل از notes-v2*/
  global $config;
  return 'http://' . $_SERVER['HTTP_HOST'] . $config['base'];
}

function strhas($string, $search, $caseSensitive = false){
  if ($caseSensitive){
    return strpos($string, $search) !== false;
  } else {
    return strpos(strtolower($string), strtolower($search)) !== false;
  }
}

function message($type, $message, $mustExit = false) {/*این تابع براساس اینکه کار ما success یا fail باشد یک پیغام را به دایرکتوری مربوطه ارسال می کند*/
  $data['message'] = $message;/*پیامی که در داخل message نوشتیم را در داخل یک ایندکس به همین نام می گذاریم*/
  View::render("/message/$type.php", $data);
  if ($mustExit){/*بعد از انجام دستور مربوطه ، از تابع خارج می شویم و دستور exit می دهیم*/
    exit;
  }
}

function twoDigitNumber($number){/*کار این تابع این است که برای روزهای زیر 10 ، آنها را با صفر(06 مثلا)نمایش می دهد*/
  return ($number < 10) ? $number = "0" . $number : $number;/*داره میگه که اگه متغیر number ما کوچکتر از 10 بود یه صفر بچسبون به اولش در غیر این صورت خودشو خروجی بده*/
}

//1970-01-01 00:00:00 = 1348-10-11 00:00:00
function jdate($date, $format="Y-m-d"){/*این تابع برای تبدیل تازیخ میلادی به شمسی استفاده می شود*/
  $timestamp = strtotime($date);/*تعداد ثانیه های گذشته از مبدا زمانی ما تا به امروز را حساب می کند*/
  $secondsInOneDay = 24*60*60;/*تعداد ثانیه های موجود در یک روز را حساب می کند*/
  $daysPassed = floor($timestamp / $secondsInOneDay) + 1;/*تعداد روزهای گذشته از مبدا زمانی ما را نشان میدهد*/
  /*تابع flor عدد های داخل خودش را رو به پایین گرد می کند و به خاطر اینکه یه روز اختلاف دارد ما یه به علاوه یک اضافه می کنیم*/
  $days = $daysPassed;/*تعداد روزهای گذشته از مبداء زمانی که در بالا محاسبه شد را ما در داخل متغیر days می ریزیم*/
  $month = 11;/*ما ماه را از 11 شروع می کنیم چون باتوجه به مقداری که days در پایین داده ایم رسما برج 10 را به اتمام رسانده ایم وباید از 11 شروع کنیم*/
  $year = 1348;/*سالی که معادل است با آن سال تایم استمپ ما را نشان می دهد*/

  $days -= 19;/*این تعداد روز باید از تعداد روزهای گذشته این ماه که تا الان 11 روز بود بگذرد و به اصطلاح کم شود تا به ماه بعدی منتقل شویم*/

  $daysInMonths = array( 31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29 );/*در اینجا ما تعداد روزهای موجود در ماه های مختلف سال را داخل یک آرایه قرار می دهیم*/

  $monthNames = array(/*اسم ماه ها را در داخل یک آرایه قرار می دهیم*/
    'فروردین',
    'اردیبهشت',
    'خرداد',
    'تیر',
    'مرداد',
    'شهریور',
    'مهر',
    'آبان',
    'آذر',
    'دی',
    'بهمن',
    'اسفند',
  );


  while (true){
    if ($days > $daysInMonths[$month-1]){/*داره میگه که اگه تعداد روزهای ما از تعداد روزهای موجود در یک ماه بیشتر بود(علت اینکه منهای یک می کنیم این است که خانه های ایندکس ما از صفر شروع می شوند)*/
      $days -= $daysInMonths[$month-1];/*تعداد روزهای یک ماه رو از تعداد کل روزها کم کن*/
      $month++;/*و بعد به تعداد ماه ها یک واحد اضافه کن*/
      if ($month == 13){/*اگر شماره ماه برابر 13 شد*/
        $year++;/*به تعداد سالها یک واحد اضافه کن*/
        if (($year - 1347) % 4 == 0){/*برای محاسبه سال کبیسه سالی که درش هستیم را از اخرین سال کبیسه که 1347 هست کم می کنیم و بر 4 تقسیم می کنیم و اگر باقی مانده صفر شد کبیسه است*/
          $days--;/*چون سال کبیسه یه روز از سال معمولی بیشتر دارد باید از تعداد روزها یک روز دیگر کم کنیم*/
        }
        $month = 1;/*و در پایان تعداد ماه ها را دوباره از نو شرو به محاسبه می کنیم*/
      }
    } else {
      break;
    }
  }

  $month = twoDigitNumber($month);/*تابع نارنجی رنگ در صورتی یه رقمی بودن شماره ماه(6)یک صفر به قبل از آن اضافه می کند(06)*/
  $days =  twoDigitNumber($days);

  $monthName = $monthNames[$month-1];/*از روی شماره ماه، نام ماه را به ما می دهد*/

  $output = $format;/*این یک فرمت است که در داخل قواعد نوشتاری php وجود دارد ، منظور از فرمت همین استفاده از متغیر های Y و.. است*/
  $output = str_replace("Y", $year, $output);
  $output = str_replace("m", $month, $output);
  $output = str_replace("d", $days, $output);
  $output = str_replace("M", $monthName, $output);

  return $output;

}



/*متغیرها: url= آدرس(url) است که در بالای صفحه نمایش داده می شود.showCount= تعداد صفحاتی است که از قبل وبعد باید نمایش داده شود. */
/*متغیرها: activeClass= اسم کلاسی است که برای دکمه های قابل کلیک به کار می بریم.deactiveClass= اسم کلاس هایی است که برای دکمه های غیر فعال استفاده می شود*/
/*متغیرها: currentPageIndex= صفحه فعلی که درش هستیم را نشان می دهد.pageCount= تعداد کل صفحات را نشان می دهد*/
/*متغیرها: jsFunction= نام تابع javascript مربوط به عملیات pagination را میگیرد*/
function pagination($url, $showCount, $activeClass, $deactiveClass, $currentPageIndex, $pageCount, $jsFunction = null){
  ob_start();/*وقتیکه ما کدهای زیر را در داخل ob_start قرار می دهیم دیگر قابل نمایش دادن نیستند و برای نمایش باید متغیری که این کدها داخلش ریخته می شوند صدا زد*/
  /*وقتی که در داخل ob_start قرار می دهیم کدها را دیگر خود کدها به طور اتوماتیک چاپ نمی شوند بلکه ما می توانیم هرجا که بخواهیم دستور چاپ صادر کنیم*/
  if ($jsFunction){/*أاره میگه که اگر متغیر jsFunction تعریف شده بود*/
    $tags = "span"; /*این کد جنس دمه های مارو تعیین می کند که از جنس span باشد*/
    $action = 'onclick="' . $jsFunction . '(#)"';/*وقتیکه روی دکمه کلیک می کنیم تابع javascript مربوطه را صدا میزند*/
  } else {
    $tags = "a";
    $action = 'href="' . $url . '/#"';
  }
  ?>

  <? $rAction = str_replace("#", "1", $action); ?>  <?/*کار این تابع این است که برای # در متغیر action یک مقدار تخصیص می دهد*/?>
  <<?=$tags?> <?=$rAction?> class="<?=$activeClass?>">1</<?=$tags?>> <?/*این کد دکمه شماره یک را به طور ثابت در ابتدای pagination ما قرار می دهد*/?>
  <span>..</span>   <?/*این کد بین دکمه شماره یک و دکمه های بعدش .. قرار می دهد*/?>
  <? for ($i=$currentPageIndex-$showCount; $i<=$currentPageIndex+$showCount; $i++){ ?>
    <? if ($i <= 1) { continue; } ?>    <?/*با این کد ما دکمه هایی که شماره زیر یک دارن را از نمایششان جلوگیری می کنیم*/?>
    <? if ($i >= $pageCount) { continue; } ?>  <?/*این کد از نمایش دکمه های بیشتر از تعداد pagination ما جلوگیری می کند*/?>
    <? if ($i == $currentPageIndex) { ?>   <?/*این کد از نمایش اضافی دکمه اخر جلوگیری می کند چون ما یکبار آن را در پایان ذکر کرده ایم در زیر*/?>
      <span class="<?=$deactiveClass?>"><?=$i?></span>     <?/*برای دکمه هایی که فعال نیستن کلاس deactiveClass را تعیین می کندکه همان تم آبی رنگ است*/?>
    <? } else { ?>
      <? $rAction = str_replace("#", $i, $action); ?>
      <<?=$tags?> <?=$rAction?> class="<?=$activeClass?>"><?=$i?></<?=$tags?>>   <?/*برای دکمه هایی که فعال هستند کلاس activeClass را اختصاص میدهد که همان تم سفید رنگ است*/?>
    <? } ?>
  <? } ?>
  <span>..</span>
  <? $rAction = str_replace("#", $pageCount, $action); ?>
  <<?=$tags?> <?=$rAction?> class="<?=$activeClass?>"><?=$pageCount?></<?=$tags?>>    <?/*این کد دکمه آخرین pagination را در انتهای کار فیکس نمایش می دهد*/?>

  <?
  $output = ob_get_clean();
  return $output;
}

