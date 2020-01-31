<html><?/*این جا در اصل حکم تمپلیت ماست و در واقع همه مواردی که ما برای ساخت یک صفحه html همواره می نوشتیم را در اینجا جمع کرده ایم*/?>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="<?=baseUrl()?>/css/base.css">
  <link rel="stylesheet" href="<?=baseUrl()?>/css/style.css">
  <script type="text/javascript" src="<?=baseUrl()?>/js/jquery-1.11.3.min.js"></script>
</head>
<body>
<div id="header-wrapper">
  <div id="header"></div>
</div>
<div id="content"><?=$content?></div><?/*مقادیر داخل متغیر contetn که در داخل ob_get_clean ذخیره شده بود را به ما تحویل می دهد*/?>
</body>
</html>
