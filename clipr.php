<?php
$no_image = true;
if (isset($_POST['text']) && isset($_POST['url'])){
	require_once('lib/TextConverter.php');
	$text = $_POST['text'];
	$url = trim($_POST['url']);
	$image_src = convert_to_image($text);
	$no_image = false;
	$image_hash = explode('/', explode('.', $image_src)[0])[1];
	
	if (isset($_POST['mobile'])){
		session_start();
		$_SESSION['mobile'] = "true";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Clipr - Text Sharing</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="favicon.ico">
  <link rel="stylesheet" type="text/css" href="bower_components/skeleton/css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="bower_components/skeleton/css/skeleton.css" />
  <link rel="stylesheet" href="css/app.css" />
  <link href='//fonts.googleapis.com/css?family=Raleway:400,300,600' rel='stylesheet' type='text/css'>
  <style>
    .footer {
		text-align: left;
	}
  </style>
</head>
<body>
  <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
  <div class="container main">
	 <h1><a href="index.php" alt="Cliptext">Cliptext</a></h1><br/>
	 <?php
	 if ($no_image): ?>
		<p>No image</p>
	<?php else: ?>
		<img class="shareimg" src="<?php echo $image_src; ?>" />
		<form method="POST" action="auth.php" id="tweet_form">
			<div class="row">
				<div class="seven columns">
					<label for="tweet_text">Say something about this image</label>
					<textarea class="u-full-width" id="tweet_text" name="tweet_text" placeholder="I find this quite interesting..."><?php if ($url != 'home') echo $url; ?></textarea>
					<span id="counter"></span>
					<input type="hidden" name="image_hash" id="image_hash" value="<?php echo $image_hash; ?>" />
				</div>
			</div>
			<div class="row">
				<br/>
				<input class="button-primary" type="submit" value="Share on Twitter" />
			</div>
		</form>
	<?php endif; ?>
	<?php include('footer.php'); ?>
  </div>

  <script src="bower_components/jquery/jquery.min.js"></script>
  <script src="js/jquery.simplyCountable.js"></script>
  <script type="text/javascript">
	$('#tweet_text').simplyCountable();
  </script>
  <?php include('analytics.php'); ?>
</body>
</html>