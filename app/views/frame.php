<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>diktkassa</title>
		<?php if (isset($_ENV['meta_description'])) { ?>
			<meta name="description" content="<?php echo $_ENV['meta_description']; ?>">
		<?php } ?>

		<link rel="shortcut icon" href="favicon.ico">

		<meta property="og:image" content="<?php echo URL::asset('images/diktkassa.png'); ?>">

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/vendor/normalize.css/normalize.css">
		<link rel="stylesheet" href="/css/app.css">
	</head>
	<body>
		<header class="main row">
			<div class="columns">
				<a href="/">
					<i
						class="site-icon fa fa-archive"
						data-icon-text="<?php print $poemCount; ?> dikt"
					></i>
					<h1 class="site-name">diktkassa</h1>
				</a>
			</div>
		</header>

		<div class="content-main row">
			<?php echo $content; ?>
		</div>

		<footer class="main row">
			<div class="columns small-12 small-centered medium-7 medium-centered large-5 large-centered">
				<a class="info-button" href="#">
					Informasjon
				</a>
				<br>
				<br>
				<div class="info-text">
					Her kan du anonymt legge inn dine egenskrevne dikt.<br>
					Du kan også lese andre sine dikt. <br>
					Et utvalg av diktene skal til slutt bli til boken «Norges anonyme diktere».
					<br><br>
					Ved å legge inn et dikt bekrefter du at du har rettighetene til dette diktet,<br>
					at det ikke er publisert før, <br>
					og at vi har lov til å publisere diktet på denne nettsiden og i vår kommende diktbok.
					<br><br>
					<a class="social-icon" href="https://www.facebook.com/diktkassa"><i class="fa fa-facebook-square"></i> Facebook</a>
					<a class="social-icon" href="https://github.com/jjmmkk/diktkassa"><i class="fa fa-github-square"></i> Github</a>
					<br>
				</div>
			</div>
		</footer>

		<script src="/js/app.js"></script>

		<?php if (isset($_ENV['ga_tracking_id'])) { ?>
			<script>
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', '<?php echo $_ENV['ga_tracking_id']; ?>', 'auto');
				ga('send', 'pageview');
			</script>
		<?php } ?>

	</body>
</html>
