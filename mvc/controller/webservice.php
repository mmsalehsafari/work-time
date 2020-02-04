<?
class webserviceController {

  public function test() {
    $json = array(
      'message' => 'success',
      'code' => 100,
    );
    echo json_encode($json);
  }

  public function list_of_email() {
    $email = post('email');
    $db = Db::getInstance();
    $result = $db->query("SELECT email FROM x_user WHERE email = '$email'");

  }

  public function register() {
    $data = curl_request("http://www.arma-x.local/time/wstester/test2");/*این کد اطلاعات encode شده از url زردرنگ را می گیرد و داخل متغیر data ذخیره می کند*/
    $emails = json_decode($data, true);
    $email = $emails['email'];
    $username = $emails['username'];
    $password = $emails['password'];
    $mobilenumber = $emails['mobilenumber'];

    echo "[";

    $db = Db::getInstance();/*بررسی اینکه ایمیل قبلا ثبت شده است یا نه*/
    $result = $db->query("SELECT email FROM x_user WHERE email = '$email'");
    if ($result == null) {
      $message = array(
        'repeat' => "fail",
      );
      echo json_encode($message);
    } else {
      $message = array(
        'repeat' => "success",
      );
      echo json_encode($message);
    }

    echo ",";

    $db = Db::getInstance();/*اضافه کردن اطلاعات کاربر*/
    $result = $db->insert("INSERT INTO x_user (email , username , password , mobilenumber) VALUES ('$email','$username','$password','$mobilenumber')");
    $message = array(
      "situation" => "success",
    );
    echo json_encode($message);
    echo "]";
  }

  public function login() {/*مربوط به قسمت لاگین*/
    $data = curl_request("http://www.arma-x.local/time/wstester/test2");/*این کد اطلاعات encode شده از url زردرنگ را می گیرد و داخل متغیر data ذخیره می کند*/
    $emails = json_decode($data, true);
    $password = $emails['password'];
    $email = $emails['email'];

    echo "[";

    $db = Db::getInstance();
    $result = $db->query("SELECT email FROM x_user WHERE email = '$email'");
    if ($result == null){/*اگر ایمیلی ثبت نشده بود*/
      $message = array(
        "repeat" => "fail",
      );
      echo json_encode($message);
    } else {
      $message = array(
        "repeat" => "success",
      );
      echo json_encode($message);
    }

    echo ",";

    $db = Db::getInstance();/*مربوط به پسورد*/
    $result = $db->query("SELECT password FROM x_user WHERE password = '$password'");
    if ($result == null){
      $message = array(
        "situation" => "fail",
      );
      echo json_encode($message);
    }else {
      $message = array(
        "situation" => "success",
      );
      echo json_encode($message);
    }
    echo "]";
  }
  public function test3(){
    $data = curl_request("http://www.arma-x.local/time/wstester/test3");/*این کد اطلاعات encode شده از url زردرنگ را می گیرد و داخل متغیر data ذخیره می کند*/
    $info = json_decode($data , true);
    $day = $info['day'];
    $description = $info['description'];
    $entertime = $info['entertime'];
    $exittime = $info['exittime'];
    $worktime = $info['worktime'];
    $dates = $info['dates'];

    $db = Db::getInstance();
    $result = $db->insert("INSERT INTO x_note (title , description, enterTime, exitTime, worktime, dates) VALUES ('$day', '$description', '$entertime', '$exittime', '$worktime', '$dates')");
    $message = array(
      "situation" => "success",
    );
    echo json_encode($message);
  }
}