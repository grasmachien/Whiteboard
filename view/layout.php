<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Whiteboard</title>
  <link href="css/src/screen.css" rel="stylesheet" type="text/css" />
<body>
<div class="container">
  <div class="main">
    <?php echo $content; ?>
  </div>
</div>

  <script src="js/vendor/fallback/fallback.min.js"></script>
  <script src="js/vendor/handlebars.min.js"></script>
  <script type="text/javascript">
  if (typeof jQuery == 'undefined') {
  	document.write(unescape("%3Cscript src='js/vendor/jquery/dist/jquery.min.js' type='text/javascript' %3E%3C/script%3E"));
  }
  </script>
  <script src="js/vendor/handlebars.min.js"></script>
  <script src="js/src/init.js"></script>
  
  

</body>
</html>
