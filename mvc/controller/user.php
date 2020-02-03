<?php

class UserController {/*این کنترلر کارهای مربوط به یوزر که عبارتند از لاگین و رجیستر را انجام می دهد*/
/*کلاس کنترلر بیشتر برای کارهای منطفی و محاسباتی مورد استفاده قرار می گیردو نقش ارتباط بین ویو و مدل را برعهده دارد*/
  public function __construct(){
  }

  public function logout(){
    session_destroy();
    header("Location: " . fullBaseUrl() . "/user/login");/*در داخل header Location باید آدرس کامل url ما نوشته شود به همین دلیل ما از fullBaseUrl استفاده کردیم*/
  }

  public function profile($userId){
    echo "User Profile: " . $userId;
  }

  public function login() {
    if (isset($_POST['email'])){/*داره میگه که اگه ایمیل نوشته شده بود در داخل اینپوت و پست شده بود دستور لاگین چک رو اجرا کن*/
      $this->loginCheck();/*لاگین چک یه متود است و برای اجرای متودها همواره باید از this استفاده کرد*/
    } else {
      $this->loginForm();
    }
  }

  private function loginCheck(){/*علت اینکه ما این تابع را پرایوت کردیم این است که کسی نتواند با نوشتن لاگین چک به اطلاعات کاربر دسترسی پیدا کندو در واقع لاگین چک غیر قابل صدا زدن است*/
    $email = $_POST['email'];
    $password = $_POST['password'];

    $record = UserModel::fetch_by_email($email);
    if ($record == null) {
      message('fail', _email_not_registered, true);
    } else {
      if ($password == $record['password']) {
        $_SESSION['email'] = $record['email'];
        $_SESSION['user_id'] = $record['user_id'];
        message('success', _login_welcome, true);
      } else {
        message('fail', _invalid_password, true);
      }
    }

    return;
  }

  private function loginForm(){
    $data['test'] = array();
    View::render("/user/login.php", $data);/*این کد ما رو به دایرکتوری های مربوط به فایل های html , css می برد و همین طور متغیر دیتا رو هم با خود می برد*/
  }

  public function register(){
    if (isset($_POST['email'])){
      $this->registerCheck();
    } else {
      $this->registerForm();
    }
  }

  private function registerCheck(){
    $email = $_POST['email'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $userName = $_POST['username'];
    $mobileNumber = $_POST['mobileNumber'];
    $time = getCurrentDateTime();

    $record = UserModel::fetch_by_email($email);
    if ($record != null){
      message('fail', _already_registered, true);
    }

    if (strlen($password1)<3 || strlen($password2)<3){
      message('fail', _weak_password, true);
    }

    if ($password1 != $password2){
      message('fail', _password_not_match, true);
    }


    UserModel::insert($email, $userName, $mobileNumber, $password1, $time, $time);

    message('success', _successfully_registered);
  }

  private function registerForm(){
    View::render("/user/register.php", array());
  }
}