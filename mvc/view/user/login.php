<?
if (isset($_SESSION['email'])){
  $message = _already_logged_in . ' ' . $_SESSION['email'];
}
?>
<div class="tac">
  <img src="<?=baseUrl()?>/image/notes.png"><br><br><?/*تابع baseurl در اصل دارد اسم framework را به ابتدای مسیردهی ما اضافه میکند*/?>

  <form action="<?=baseUrl()?>/user/login" method="post">
    <input type="text" class="ltr" placeholder="<?=_ph_email?>" name="email"><br>
    <br>
    <input type="password" class="ltr" placeholder="<?=_ph_password?>" name="password"><br>
    <br>
    <br>
    <button type="submit" class="btn-blue"><?=_btn_login?></button>
  </form>

  <br>
  <br>
  <br>
  <a href="<?=baseUrl()?>/user/register" class="link-gray"><?=_btn_signup?></a>
</div>
