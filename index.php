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
	  <p class="title">Sometimes, you simply need to share some things and 140 characters is not enough! Why not share it as an image?</p>
	</div>
	<div class="row">
	  <div class="six columns">
		Have you ever wanted to share a more-than-140-character-excerpt from an article you were reading? Using the <em>Cliptext</em> chrome extension, you can easily highlight text in your browser and share the selected text on Twitter as an image.
		<img id="ext_pic" src="images/chrome_ext.png" alt="Cliptext chrome extension" width="100%"/>
		<button class="button-primary" onclick="chrome.webstore.install()" id="install-button">Download Cliptext for Chrome</button>
	  </div>
	  <div class="six columns">
        <form action="clipr.php" method="POST" data-parsley-validate>
          <p>Simply type or paste what you want to share. <em>Cliptext</em> will generate an image that you can share on Twitter.</p>
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