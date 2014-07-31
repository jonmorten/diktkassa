<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Diktkassa</title>
		<meta name="description" content="(•.•)">

		<link rel="shortcut icon" href="favicon.ico">

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="vendor/normalize.css/normalize.css">
		<link rel="stylesheet" href="css/app.css">
	</head>
	<body>
		<span class="project-status">Alpha</span>
		<header class="main row">
			<div class="columns small-12">
				<i class="fa fa-archive"></i>
				<a href="/">
					<h1>diktkassa</h1>
				</a>
			</div>
		</header>

		<div class="content-main row">
			<?php echo $content; ?>
		</div>

		<script src="js/app.js"></script>

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
