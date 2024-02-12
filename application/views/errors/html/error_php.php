<?php defined('BASEPATH') OR exit('No direct script access allowed');

	$this->config =& get_config();
	$base_url = $this->config['base_url'];

	if(ENVIRONMENT=='development'){
	if (!defined('SHOW_DEBUG_BACKTRACE')){
		define('SHOW_DEBUG_BACKTRACE', true);
	}
?>

	<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

	<?php if(isset($pageData) && $pageData!=''){
		echo $pageData;
	}else{ ?>
		<h4>A PHP Error was encountered</h4>
		<p>Severity: <?= isset($severity) ? $severity : ''; ?></p>
		<p>Message:  <?= isset($message) ? $message : ''; ?></p>
		<p>Filename: <?= isset($filepath) ? $filepath : ''; ?></p>
		<p>Line Number: <?= isset($line) ? $line : ''; ?></p>
	<?php } ?>

	<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

		<p>Backtrace:</p>
		<?php foreach (debug_backtrace() as $error): ?>

			<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

				<p style="margin-left:10px">
				File: <?php echo $error['file'] ?><br />
				Line: <?php echo $error['line'] ?><br />
				Function: <?php echo $error['function'] ?>
				</p>

			<?php endif ?>

		<?php endforeach ?>

	<?php endif ?>

	</div>
<?php }else{ ?>
	<!DOCTYPE html>
	<html lang="en">

		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

			<title><?= SITE_NAME ?></title>
			<style>
				* {
					-webkit-box-sizing: border-box;
					box-sizing: border-box;
				}

				body {
					padding: 0;
					margin: 0;
				}

				#notfound {
					position: relative;
					height: 100vh;
				}

				#notfound .notfound {
					position: absolute;
					left: 50%;
					top: 50%;
					-webkit-transform: translate(-50%, -50%);
						-ms-transform: translate(-50%, -50%);
							transform: translate(-50%, -50%);
				}

				.notfound {
					max-width: 560px;
					width: 100%;
					padding-left: 160px;
					line-height: 1.1;
				}

				.notfound .notfound-404 {
					position: absolute;
					left: 0;
					top: 0;
					display: inline-block;
					width: 140px;
					height: 140px;
					/*background-image: url('assets/errors/emoji.png');*/
					background-size: cover;
				}

				.notfound .notfound-404:before {
					content: '';
					position: absolute;
					width: 100%;
					height: 100%;
					-webkit-transform: scale(2.4);
						-ms-transform: scale(2.4);
							transform: scale(2.4);
					border-radius: 50%;
					background-color: #f2f5f8;
					z-index: -1;
				}

				.notfound h1 {
					font-family: 'Nunito', sans-serif;
					font-size: 65px;
					font-weight: 700;
					margin-top: 0px;
					margin-bottom: 10px;
					color: #151723;
					text-transform: uppercase;
				}

				.notfound h2 {
					font-family: 'Nunito', sans-serif;
					font-size: 21px;
					font-weight: 400;
					margin: 0;
					text-transform: uppercase;
					color: #151723;
				}

				.notfound p {
					font-family: 'Nunito', sans-serif;
					color: #999fa5;
					font-weight: 400;
				}

				.notfound a {
					font-family: 'Nunito', sans-serif;
					display: inline-block;
					font-weight: 700;
					border-radius: 40px;
					text-decoration: none;
					color: #388dbc;
				}

				@media only screen and (max-width: 767px) {
					.notfound .notfound-404 {
						width: 110px;
						height: 110px;
					}
					.notfound {
						padding-left: 15px;
						padding-right: 15px;
						padding-top: 110px;
					}
				}
			</style>
		</head>
		<body>
			<div id="notfound">
				<div class="notfound">
					<div class="notfound-404" style="background-image: url('<?=$base_url.'/assets/errors/emoji.png'?>');"></div>
					<h1>500</h1>
					<h2>Internal Server Error</h2>
					<p>Try to refresh this page or feel free to contact us if the problem persists.</p>
					<!--<a href="#">Back to homepage</a>-->
				</div>
			</div>
		</body>
	</html>
<?php } ?>