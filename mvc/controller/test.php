<?php
class TestController {/*این کنترلر بیشتر برای کارهای تستی ما ایجاد شده است*/

  public function test1(){/*می آید و برای کاربر ما 400 تا گزارش تهیه می کند*/
    $db = Db::getInstance();
    for ($i=0; $i<400; $i++) {
      $title = "Some Title " . $i;/*نام عنوانش را some Title میگذارد*/
      $description = "Some Description " . $i;/*در قسمت توضیحات هم some Description می نویسد*/
      $isDone = false;/*ستون مربوط به انجام یا غیر انجام شده بودن یادداشت را به طور پیش فرض در حالت انجام نشده قرار می دهد*/
      $db->insert("INSERT INTO x_note (user_id, title, description, isDone) VALUES (1, '$title', '$description', '$isDone')");
    }
  }
  /*ریجکس در اصل یک processor متن می باشد*/
  public function regex(){/*مار این تابع ارائه یک ساختاری است برای درج نظر کاربر با این امکانات که اگه لینکی کاربر نوشت می توانیم باکلیک بر روی آن به آن آدرس هدایت شویم*/
    echo '<meta charset="utf-8"><style>body { font-family: tahoma }</style>';/*یک ساختار html کوچک برایش می سازیم برای اینکه یکم خوشگل تر باشد*/
    $source = "<div>this is sample url: ftp://google.com/something/test and another url = http://microsoft.com/answers/?topic=140 and nothing else ftptest hello ftp end https://google.com and http://uncox.com/question/1222/یک-سئوال-عجیب  and ftps://test.com/test and another http://microsoft/test </div>";
    echo $source;/*متغیر source را بعنوان یک string ای در نظر می گیریم که در داخل نظر یک کاربر در سایت وجود دارد*/

    hr();
    $changedSource = preg_replace("/((?:ht|f)tp(?:|s):\/\/[a-zA-Z0-9]+\.[a-zA-Z0-9]+.*?)\s/", '<a href="$1">Link</a> ', $source);
    echo $changedSource;/*دستور preg_replace برای اجرای دستورات regex است و ما در این جا از آن برای اینکه وقتی روی لینک های نوشته یمان کلیک می کنیم به صفحه مربوط هدایت شویم استفاده می کنیم*/
  }


/*سطر زیر به تایم استمپ اشاره می کند که به معنای زمان گذشته از یک مبدا زمانی خاص است و تایم استمپ مورد استفاده یونیکس می باشد*/
  //1970-01-01 00:00:00 = 1348-10-11 00:00:00
  public function convertDate($date, $format = "d M Y"){/*کار این تابع تبدیل تاریخ میلادی به تاریخ شمسی است*/
    header('Content-Type: text/html; charset=utf-8');/*با این دستور مشکل عدم نمایش فارسی اسم ماه ها حل می شود*/
    echo jdate($date, $format);/*با این کد ما متود jdate در فایل common.php را صدا می زنیم و آنرا اجرا میکنیم*/
  }
}