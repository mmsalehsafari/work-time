<?php
class NoteModel {/*در اینجا تمام کارهای دیتابیسی مربوط به یادداشت را انجام می دهد*/
  public static function insert($dates, $title, $entertime, $exittime, $worktime, $description, $userId){/*اطلاعات یادداشت و عنوان را برای ما در دیتابیس ثبت می کند*/
    $db = Db::getInstance();
    $db->insert("INSERT INTO x_note (dates ,title, enterTime, exitTime, workTime, description, user_id, isDone) VALUES ('$dates', '$title', '$entertime', '$exittime', '$worktime', '$description', '$userId', false )");
  }
  public static function remove($noteId, $userId){/*باتوجه به دو متغیر نوت آیدی و یوزر آیدی که دریافت می کند اقدام به حذف یادداشت مربوط به آنها می کند*/
    $db = Db::getInstance();
    $db->modify("DELETE FROM x_note WHERE note_id=$noteId AND user_id=$userId");
  }

  public static function toggle($noteId, $userId){/*براساس متغیرهای نوت آیدی و یوزرآیدی که دریافت می کند اقدام به تغییر وضعیت یادداشت بین دو حالت انجام و غیر انجام می کند*/
    $db = Db::getInstance();
    $db->modify("UPDATE x_note SET isDone=NOT isDone WHERE note_id=$noteId AND user_id=$userId");/*متود مدیفای برای تغییر حالت از انجام به غیر انجام و بالعکس استفاده می شود*/
  }

  public static function catalog($userId){/*براساس یوزرآیدی کاربر ، لیست یادداشت های او را به از دیتابیس بیرون می کشد و تحویل ما می دهد*/
    $db = Db::getInstance();
    $records = $db->query("SELECT * FROM x_note WHERE user_id=$userId");
    return $records;
  }

  public static function catalogByPage($userId, $startIndex, $count){/*این تابع براساس یوزرآیدی کاربر می گوید که مثلا از رکورد 45 ام شروع کن(startIndex) و 20 تا رکورد بعدی رو بده(count)*/
    $db = Db::getInstance();
    $records = $db->query("SELECT * FROM x_note WHERE user_id=$userId LIMIT $startIndex, $count");/*کلمه LIMIT باعث می شود که از شماره رکورد مربوط به startIndex به اندازه count گزارش(Query) گرفته شود*/
    return $records;
  }

  public static function countNotes($userId){/*این تابع تعداد کل یادداشت ها (رکوردها) را به ما می دهد*/
    $db = Db::getInstance();
    $records = $db->query("SELECT COUNT(*) AS total FROM x_note WHERE user_id=$userId");
    return $records[0]['total'];
  }
}