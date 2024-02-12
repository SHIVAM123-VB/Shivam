<title><?=(isset($pageData['browserTitle'])) ? $pageData['browserTitle'] : SITE_NAME ?></title>

<meta name="keywords" content="<?=(isset($pageData['metaKey'])) ?  $pageData['metaKey'] : " " ?>">

<meta name="description" content="<?=(isset($pageData['metaDescription']))? $pageData['metaDescription'] : " " ?>">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/front/css/theme/settings.css'?>" media="screen">
<link rel="stylesheet" href="<?=base_url().'assets/front/css/theme/ionicons.min.css'?>">
<link rel="stylesheet" href="<?=base_url().'assets/front/css/theme/bootstrap.min.css'?>">
<link rel="stylesheet" href="<?=base_url().'assets/front/css/theme/font-awesome.min.css'?>">
<link rel="stylesheet" href="<?=base_url().'assets/front/css/theme/main.css'?>">
<link rel="stylesheet" href="<?=base_url().'assets/front/css/theme/style.css'?>">
<link rel="stylesheet" href="<?=base_url().'assets/front/css/theme/responsive.css'?>">
<link href="<?=base_url().'assets/front/css/theme/font.css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i'?>"
	rel="stylesheet">
<link rel="stylesheet" href="<?=base_url().'assets/front/css/style.css'?>">

<!-- JavaScripts -->
<script>
	var SITE_URL = '<?=base_url();?>';
</script>
<script src="<?=base_url().'assets/front/js/theme/modernizr.js'?>"></script>
<script src="<?=base_url().'assets/front/js/theme/jquery-3.3.1.min.js';?>" type="text/javascript"></script>

<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
if(isset($pageData['arrCSS']))
{		
	if(is_array($pageData['arrCSS']))
	{	
		foreach($pageData['arrCSS'] as $pageCSS)
		{
			$pageCSS=trim($pageCSS);
			if(trim($pageCSS)<>""){	?>
<link href="<?=$pageCSS?>" rel="stylesheet" type="text/css">
<?php		
			}
		}
	}
}
				?>

<?php
// if(isset($pageData['customStyle'])){

// 	if($pageData['customStyle']<>"")
// 	{
// 		echo $pageData['customStyle'];
// 	}
// }


if(isset($pageData['arrJS'])) {
	if(is_array($pageData['arrJS'])) {
		foreach($pageData['arrJS'] as $pageJS) {
			$pageJS=trim($pageJS);
			if(trim($pageJS)<>"") { ?>
<script src="<?=$pageJS?>" type="text/javascript"></script>
<?php
			}
		}
	}
}

// if(isset($pageData['customScript']))
// {
// 	if($pageData['customScript']<>""){

// 		echo $pageData['customScript'];
// 	}
// }
?>