<?php
class UserModel {/*کار این کنترلر امور دیتابیسی مربوط به یوزر است که اطلاعات یوزر و ... را می گیرد و به کنترلر می فرستد*/
  public static function insert($email, $name, $nickname, $password, $time1, $time){
    $db = Db::getInstance();
    $db->insert("INSERT INTO x_user
      (  email,  fullname,  nickname,    password, registerTime, lastVisitTime) VALUES
      ('$email', '$name', '$nickname', '$password',  '$time1',     '$time')"
    );
  }/*این یک قرارداد است که ما همیشه تابع های مدل را استاتیک و تابع های کنترلر را نان استاتیک در می نویسیم باز به آموزش مراجعه شود*/

  public static function fetch_by_email($email){/*این تابع ایمیل کاربر را می گیرد و تمام اطلاعات مربوط به او را به ما گزارش می دهد*/
    $db = Db::getInstance();
    $record = $db->first("SELECT * FROM x_user WHERE email='$email'");
    return $record;
  }
}