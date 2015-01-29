<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cliptext</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="favicon.ico">
  <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/loemldldacgegipolkcnnojkaehcigno" />
  <link rel="stylesheet" type="text/css" href="bower_components/skeleton/css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="bower_components/skeleton/css/skeleton.css" />
  <link rel="stylesheet" href="css/app.css" />
  <link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
</head>
<body>
  <div class="container main">
	<h1 class="title">Cliptext</h1>
	<div class="row titlerow">
	  <p class="title">Have you ever wanted to share a more-than-140-character text excerpt from an article you were reading? Sometimes, 140 characters is simply not enough! Why not share it as an image?</p>
	</div>
	<div class="row" style="border-bottom:1px solid #cccccc;padding-bottom:10px;margin-bottom:10px">
	  <div class="six columns">
		Most people use Twitter on their mobile phones. You can simply select text in your browser (or other app) and <em>Cliptext</em> will help you share it as an image on Twitter.
		<br/><br/>
		<iframe width="420" height="315" src="//www.youtube.com/embed/qekyQzCk2PM" frameborder="0" allowfullscreen></iframe>
		<br/><br/>
		<a href="https://play.google.com/store/apps/details?id=com.davidadamojr.android.cliptext" target="_blank" class="button button-primary">Download Cliptext for Android</a>
	  </div>
	  <div class="six columns">
		 Using the <em>Cliptext</em> chrome extension, you can easily highlight text in your browser and share the selected text on Twitter as an image.
		<img id="ext_pic" src="images/chrome_ext.png" alt="Cliptext chrome extension" width="100%"/>
		<button class="button-primary" onclick="chrome.webstore.install()" id="install-button">Download Cliptext for Chrome</button>
	  </div>
	</div>
	<div>
	  <div class="u-full-width">
        <form action="clipr.php" method="POST" data-parsley-validate>
          <p>Wanna give <em>Cliptext</em> a quick try? Simply type or paste the text you want to share. <em>Cliptext</em> will generate an image that you can share on Twitter.</p>
		  <input type="hidden" name="url" value="home" />
          <textarea name="text" class="u-full-width" placeholder="Cliptext is awesome..." id="text" required></textarea>
	      <input class="button-primary" type="submit" value="Generate Image" />
		</form>
	  </div>
    </div>
	<?php include('footer.php'); ?>
  </div>
  <script src="bower_components/jquery/jquery.min.js"></script> 
  <script src="http://parsleyjs.org/dist/parsley.remote.min.js"></script>
  <?php include('analytics.php'); ?>
</body>
</html>