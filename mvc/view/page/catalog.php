<div id="header-wrapper"><?/*این صفحه مربوط به نمایش گزارش یاداداشت های ما با استفاده ازpagination می باشد*/?>
  <div id="header-top-right">
    <img class="profile-image" src="<?=baseUrl()?>/image/empty-profile-24.png">
    <span style="margin-right: 5px"><?=$_SESSION['email']?> <?=_header_welcome?></span>
    <a style="margin-right: 5px" class="btn-blue" href="<?=fullBaseUrl()?>/user/logout"><?=_btn_logout?></a>
  </div>
</div>

<div id="paginationUpdate"></div> <?/*هدف از این div این است که باعث می شود دکمه های جاوااسکریپبت ما با زدن هر دکمه سه تای قبل و بعدش نمایش داده شود*/?>

<script>
  function getPage(pageIndex){/*کار این تابع */
    $.ajax('/notes-v2/note/ajaxCatalog/' + pageIndex, {/*این تابع ما را به دایرکتوری زردنگ و فولدر کنترلر و بعدش فایل note.php وبعدش تابع ajaxCatalog هدایت می کند و در پایان شماره صفحه را هم اضافه می کند*/
      type: 'post',
      dataType: 'json',
      success: function(data){
        $("#paginationUpdate").html(data.html);/*با این دستور ما به محتویات داخل index اِ html که در داخل کنترلرnote.php و تابع ajaxCatalog ایجاد کرده ایم دست می یابیم*/
      }
    });
  }

  function noteToggle(sender, noteId){
    sender = $(sender);
    var parent = sender.parentsUntil('.todo-entry').parent();

    $.ajax('/notes-v2/note/toggle/' + noteId, {
      type: 'post',
      dataType: 'json',
      success: function(data) {
        if (parent.hasClass('done')){
          parent.removeClass('done');
          parent.addClass('pending');
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

  $(function(){/*این تابع باعث می شود که وقتی صفحه catalog را برای بار اول لود می کنیم محتویات ایندکسی قبلا درش بودیم نشان داده شود صفحه خالی به ما تحویل ندهد*/
    getPage(<?=$pageIndex?>);/* و همین که باعث می شود که div اِ updatePageIndex هم یکبار اجرا شود که اینکار باعث می شود که روی هر دکمه ای که کلیک می کنیم سه تا قبل وبعد هم نمایش داده شوند*/
  });
</script>
