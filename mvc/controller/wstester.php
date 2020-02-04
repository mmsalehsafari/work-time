<?php
class WsTesterController {/*کار این کنترلر گرفتن اطلاعات encode شده از سایت ها و یا برنامه های دیگر است*/

  public function test(){
    $post = array(
      "email" => "saleh@gmail.com",
    );

    $data = curl_request("http://www.arma-x.local/time/webservice/test");/*این کد اطلاعات encode شده از url زردرنگ را می گیرد و داخل متغیر data ذخیره می کند*/
    echo $data;
  }
  public function test2(){
    $post = array(
      "email" => "saleh@gmail.com",
      "username" => "saleh",
      "password" => 1234,
      "mobilenumber" => "09127375003",
    );
    $data = curl_request("http://www.arma-x.local/time/webservice/test");/*این کد اطلاعات encode شده از url زردرنگ را می گیرد و داخل متغیر data ذخیره می کند*/

    echo json_encode($post);
  }
  public function test3(){
    $post = array(
      "day" => "سه شنبه",
      "description" => "زدن کدهای json",
      "entertime" => "18:35",
      "exittime" => "20:35",
      "worktime" => "2:00:00",
      "dates" => "1398/11/12",
    );
    echo json_encode($post);
  }
}