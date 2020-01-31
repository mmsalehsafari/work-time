<?php

class NoteController {/*این کنترلر کارهای مربوط به ثبت یادداشت را انجام می دهد*/

  public function submit(){/*کار این تابع هدایت کردن به فرم ثبت یادداشت و یا ثبت یادداشت است*/
    if (isset($_POST['title'])){/*میگه که اگه title ای نوشته شده بود و به سمت سرور پست شده بود دستور زیر را اجرا کن*/
      $this->submitNote();/*این کد ، متود سابمیت نوت را اجرا می کند که کار آن ثبت یادداشت است*/
    } else {
      View::render("/note/submit.php");/*در صورتی که یادداشتی پست نشده بود این دستور فقط فرم یادداشت را به کاربر نشان می دهد*/
    }
  }

  private function submitNote(){/*کار این تابع ایجاد یادداشت است*/
    $title = $_POST['title'];
    $description = $_POST['description'];

    if (!isset($_SESSION['user_id'])){/*اگر یوزر آیدی کاربر ما ست نشده بود*/
      header("Location: /notes-v2/page/home");/*ما را به دایرکتوری کنترلر ، فایل page.php هدایت کرده و تابع home  را اجرا می کند*/
      exit;
    }

    $userId = $_SESSION['user_id'];/*یوزر آیدی کابر ما را در داخل متغیر userId می ریزد*/

    NoteModel::insert($title, $description, $userId);/*براساس یوزرآیدی کاربر عنوان و یادداشت او را به سمت دیتابیس می فرستد*/
    header("Location: /notes-v2/page/home");/*و در پایان ما را به دایرکتوری کنترلر ، فایل page.php و تابع home هدایت می کند*/
  }

  public function remove($noteId){/*متغیر نوت آیدی را می گیرد و براساس آن اقدام به حذف یادداشت های کاربر می کند*/
    if (!isset($_SESSION['user_id'])){/*اگر یوزرآیدی کاربر ما قبلا ست نشده بود کاری انجام نمی دهد و دستور exit می دهد*/
      exit;
    }

    $userId = $_SESSION['user_id'];

    NoteModel::remove($noteId, $userId);/*توت آیدی و یوزر آیدی یادداشتی که باید حذف شود را سمت دیتابیس می فرستد*/

    echo json_encode(array(
      'status' => true,
    ));
  }

  public function toggle($noteId){/*این تابع برای دکمه های انجام یا عدم انجام یادداشت به کار می رود یا همون سبز و قرمز شدن و نشان می دهد که یک یادداشت انجام شده یا خیر*/
    if (!isset($_SESSION['user_id'])){
      exit;
    }

    $userId = $_SESSION['user_id'];

    NoteModel::toggle($noteId, $userId);/*نوت آیدی و یوزرآیدی یادداشتی که باید حالت انجامش عوض شود را سمت دیتابیس می فرستد*/

    echo json_encode(array(/*برای اجرای کدهای javascript ای که نوشتیم باید حتما از دستور json_encode استفاده کنیم*/
      'status' => true,/*زبان قابل فهم برای ما decode است و زبان قابل فهم برای ماشین encode و به همین دلیل باید دستورات json را encode کنیم*/
    ));
  }

  public function catalog($pageIndex){/*کار این تابع ایجاد صفحه بندی یا همان pagination می باشد و متغیر pageIndex در اینجا همان شماره صفحه است*/
    if (!isset($_SESSION['user_id'])){
      exit;
    }

    $userId = $_SESSION['user_id'];

    $count = 10;/*تعداد رکورد هایی که در هرصفحه نمایش داده می شود را تعیین میکند*/
    $startIndex = ($pageIndex-1) * $count;/*برای اینکه عددی که در قسمت url می نویسیم بعنوان pageIndex به جای صفر از یک شروع شود حتما باید منهای یک بکنیم*/
    $data['records'] = NoteModel::catalogByPage($userId, $startIndex, $count);/*متغیر های userId و startIndex و count را می گیرد و به سمت دیتا بیس می فرستد*/
    $recordsCount = NoteModel::countNotes($userId);/*این کد تعداد کل یادداشت ها(رکوردها) را از دیتابیس می گیرد و به ماتحویل می دهد*/
    $data['pageCount'] = ceil($recordsCount / 10);/*این کد به ما تعداد کل صفحات را نشان می دهد و عبارت ceil این مقدار را به سمت بالا گرد میکند*/
    $data['pageIndex'] = $pageIndex;/*مقدار متغیر pageIndex را درون متغیر data با ایندکس pageIndex قرار می دهد*/

    View::render("/page/catalog.php", $data);/*با این کد مارا به فولدر view و فولدر page و فایل catalog.php هدایت می کند*/
  }

  public function ajaxCatalog($pageIndex){/*این تابع بحث pagination را با استفاده از ajax وjavascript انجام می دهد*/
    if (!isset($_SESSION['user_id'])){
      exit;
    }

    $userId = $_SESSION['user_id'];

    $count = 10;
    $startIndex = ($pageIndex-1) * $count;
    $data['records'] = NoteModel::catalogByPage($userId, $startIndex, $count);
    $recordsCount = NoteModel::countNotes($userId);
    $data['pageCount'] = ceil($recordsCount / 10);
    $data['pageIndex'] = $pageIndex;

    ob_start();
    View::renderPartial("/page/ajaxCatalog.php", $data);/*می رود به فولدر view و سپس فولدر page و سپس فایل ajaxCatalog.php را اجرا می کند*/
    $output = ob_get_clean();

    echo json_encode(array(
      'status' => true,
      'html' => $output, /*با این کد ما به مقادیر داخل ob_start دسترسی پیدا می کنیم*/
    ));
  }
}