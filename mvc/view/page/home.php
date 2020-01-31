<? /*این صفحه همان صفحه ای است که ما در آن لیست یادداشت هایی که کاربر ثبت کرده است را به او نشان می دهیم*/?>
<div id="header-wrapper">
  <div id="header-top-right">
    <? if ($isGuest) { ?>
      <img class="profile-image" src="<?=baseUrl()?>/image/empty-profile-24.png">
      <span style="margin-right: 5px"><?=_header_guest?> <?=_header_welcome?></span>
      <a style="margin-right: 5px" class="btn-blue" href="<?=fullBaseUrl()?>/user/login"><?=_btn_login?></a>
    <? } else { ?>
      <img class="profile-image" src="<?=baseUrl()?>/image/empty-profile-24.png">
      <span style="margin-right: 5px"><?=$_SESSION['email']?> <?=_header_welcome?></span>
      <a style="margin-right: 5px" class="btn-blue" href="<?=fullBaseUrl()?>/user/logout"><?=_btn_logout?></a>
    <? } ?><?/*در داخل href باید ما آدرس کامل url مان را بنویسیم یعنی باید چیزای قبل از بیس روتمان هم نوشته شوند که این کار با تابع fullBaseUrl انجام می شود*/  ?>
  </div>
</div>

<div id="content">
  <? if ($isGuest) { ?>
    <div class="tac lf important-color m15tb">
      <span>برای استفاده کامل از سیستم، نیازمند ثبت نام در سایت می باشید</span>
    </div>
  <? } else { ?>
    <ul class="todo-entry">
      <li>انجام</li>
      <li>حذف</li>
      <li>عنوان</li>
      <li>توضیحات</li>
      <li>زمان وقوع</li>
    </ul>

    <? if ($records == null){ $records = array(); } ?>
    <? foreach ($records as $record){/*می آید رکوردهای ما در دیتا بیس را بررسی می کند*/
      if ($record['isDone']){/*به عبارت داخل ستون isDone در داخل دیتابیس ما نگاه می کند که دو حالت دارد که یا done است و یا pending*/
        $doneClass = "done";
      } else {
        $doneClass = "pending";
      }
      ?>
      <ul class="todo-entry <?=$doneClass?>"><?/*متناسب با اینکه که ستون isDone ، انجام شده(done) و یا pending باشد کلاس مربوطه را با رنگ آمیزی برای آن سطر لحاظ می کند*/?>
        <li><span onclick="noteToggle(this, <?=$record['note_id']?>)" class="btn">*</span></li><?/*وقتی که روی دکمه انجام کلیک کنیم ، دستورات تابع noteToggle را اجرا می کند*/?>
        <li><span onclick="noteRemove(this, <?=$record['note_id']?>)" class="btn">-</span></li><?/*وقتی که روی دکمه remove کلیک میکنیم به عنوان متغیر اول می گوید که ریمو بوده که کلیک کرده و برای متغیر دوم نوت آیدی یادداشت را می فرستد برای تابع پایین*/?>
        <li><?=$record['title']?></li>
        <li><?=$record['description']?></li>
        <li><?=jdate($record['eventTime'], 'd M Y')?></li><?/*تاریخ و زمان ثبت یادداشت را با استفاده از تابع jdate به دیتا بیس ما منتقل می کندو ما در قسمت دوم می توانیم فرمت نمایش را تعیین کنیم*/?>
      </ul>
    <? } ?>
  <br>
  <br>
  <br>
      <a href="/notes-v2/note/submit" class="btn-blue">درج یادآور</a><?/*با زدن دکمه «درج یادآور» ما به دایرکتوری کنترلر ، note.php منتقل می شویم و تابع submit اجر میشود*/?>
    </div>
  <? } ?>
</div>

<script>
  function noteToggle(sender, noteId){/*وقتی که روی دکمه انجام کلیک میکنیم بعنوان پارامتر دوم نوت آیدی را دریافت می کند و پارامتر اول برای این است که نشان دهد چه کسی درخواست noteToggle را ارسال کرده است*/
    sender = $(sender);
    var parent = sender.parentsUntil('.todo-entry').parent();/*همین طور میاد در پدرش عقب یعنی میاد اول سراغ li ، بعدش سراغ doneClass و تو دو اینتری ولی ul را در نظر نمی گیرد لذا باید یک پرنت دیگر بنویسیم تا آنرا هم حساب کند*/

    $.ajax('/notes-v2/note/toggle/' + noteId, {
      type: 'post',
      dataType: 'json',
      success: function(data) {
        if (parent.hasClass('done')){/*میگه که اگه اون سطر گزارش ما در کلاس todo_entry اش کلاس done را داشت*/
          parent.removeClass('done');/*کلاس done را حذف کن*/
          parent.addClass('pending');/*به جای کلاس done ، کلاس pending را اضافه کن*/
        } else {
          parent.removeClass('pending');
          parent.addClass('done');
        }
      }
    });
  }

  function noteRemove(sender, noteId){
    sender = $(sender);
    var parent = sender.parentsUntil('.todo-entry').parent();

    $.ajax('/notes-v2/note/remove/' + noteId, {
      type: 'post',
      dataType: 'json',
      success: function(data) {
        parent.remove();
      }
    });
  }
</script>
