<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->config =& get_config();
$base_url = $this->config['base_url'];
if(ENVIRONMENT=='development'){
?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<meta charset="utf-8">
			<title>Error</title>
			<style type="text/css">

				::selection { background-color: #E13300; color: white; }
				::-moz-selection { background-color: #E13300; color: white; }

				body {
					background-color: #fff;
					margin: 40px;
					font: 13px/20px normal Helvetica, Arial, sans-serif;
					color: #4F5155;
				}

				a {
					color: #003399;
					background-color: transparent;
					font-weight: normal;
				}

				h1 {
					color: #444;
					background-color: transparent;
					border-bottom: 1px solid #D0D0D0;
					font-size: 19px;
					font-weight: normal;
					margin: 0 0 14px 0;
					padding: 14px 15px 10px 15px;
				}

				code {
					font-family: Consolas, Monaco, Courier New, Courier, monospace;
					font-size: 12px;
					background-color: #f9f9f9;
					border: 1px solid #D0D0D0;
					color: #002166;
					display: block;
					margin: 14px 0 14px 0;
					padding: 12px 10px 12px 10px;
				}

				#container {
					margin: 10px;
					border: 1px solid #D0D0D0;
					box-shadow: 0 0 8px #D0D0D0;
				}

				p {
					margin: 12px 15px 12px 15px;
				}
			</style>
		</head>
		<body>
			<div id="container">
				<h1><?php echo $heading; ?></h1>
				<?php echo $message; ?>
			</div>
		</body>
	</html>
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
					<h1>400</h1>
					<h2>Bad Request</h2>
					<p>This page isn't working right now.</p>
				</div>
			</div>
		</body>
	</html>
<?php } ?>