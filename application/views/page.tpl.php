<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php $this->load->view("inc/head"); ?>
	</head>
	<body>
		<?php $this->load->view("inc/header"); ?>
		<div class="container" >
			<div class="row">
				<div class="col-md-12">
					<section class="content">
						<h3><?=$pageData['data']['page']['heading']?></h3>
						<?php $this->load->view("inc/messages"); ?>
						<p><?=html_entity_decode($pageData['data']['page']['page_content'])?></p>
					</section>
				</div>
			</div>
		</div>
		<?php $this->load->view("inc/footer"); ?>
	</body>	
</html>