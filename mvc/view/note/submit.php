<div>
  <div class="tac">
    <br>
    <br>
    <br>
    <form action="<?=baseUrl()?>/note/submit" method="post">
      <input type="text" class="tac" placeholder="تاریخ (1398/11/06)" name="dates" style="width: 300px"><br>
      <br>
      <input type="text" class="tac" placeholder="روز (یکشنبه)" name="title" style="width: 300px"><br>
      <br>
      <input type="text" class="tac m31lr" placeholder="زمان ورود (13:45)" name="entertime" style="width: 120px"><input type="text" class="tac m31lr"  placeholder="زمان خروج (18:45)" name="exittime" style="width: 120px"><br>
      <br>
      <br>
      <textarea type="text" placeholder="کار" name="description" style="width: 300px; height: 200px; resize: none"></textarea><br>
      <br>
      <br>
      <button type="submit" class="btn-blue">درج</button>
    </form>

    <br>
  </div>
</div>
