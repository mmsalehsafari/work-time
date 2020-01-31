<?/*این صفحه قسمت html مربوط به pagination را برای javascript تامین می کند*/?>
<?= pagination('/notes-v2/note/catalog', 2, 'btn btn-blue', 'btn', $pageIndex, $pageCount); ?>
<hr>
<br>
<br>
<?= pagination('/notes-v2/note/catalog', 2, 'btn btn-blue', 'btn', $pageIndex, $pageCount, 'getPage'); ?> <?/*این کد مربوط به مقدار دهی کردن تابع pagination مربوط به javascript است*/?>
<hr>
<br>
<br>

<div id="notes">
  <ul class="todo-entry">
    <li>انجام</li>
    <li>حذف</li>
    <li>عنوان</li>
    <li>توضیحات</li>
    <li>زمان وقوع</li>
  </ul>

  <? if ($records == null){ $records = array(); } ?>
  <? foreach ($records as $record){
    if ($record['isDone']){
      $doneClass = "done";
    } else {
      $doneClass = "pending";
    }
    ?>
    <ul class="todo-entry <?=$doneClass?>">
      <li><span onclick="noteToggle(this, <?=$record['note_id']?>)" class="btn">*</span></li>
      <li><span onclick="noteRemove(this, <?=$record['note_id']?>)" class="btn">-</span></li>
      <li><?=$record['title']?></li>
      <li><?=$record['description']?></li>
      <li><?=jdate($record['eventTime'], 'd M Y')?></li>
    </ul>
  <? } ?>

  <br>
  <br>
  <div class="tal">
    <a href="/notes-v2/note/submit" class="btn-blue">درج یادآور</a>
  </div>
</div>

<?= pagination('/notes-v2/note/catalog', 2, 'btn btn-blue', 'btn', $pageIndex, $pageCount, 'getPage'); ?>
<hr>
<br>
<br>