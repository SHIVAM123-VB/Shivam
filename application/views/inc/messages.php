<?php
	$errMessages=$this->ideate_model->get_messages("err","admin");
	if(count($errMessages)) { ?>
	<div class="col-sm-12">
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
			<?php
				/*foreach($errMessages as $errMessage)
				{
					echo $errMessage."<br>";
				}*/
				echo implode("</br>",$errMessages);
			?>
		</div>
	</div>
<?php }
	$succMessages=$this->ideate_model->get_messages("succ","admin");
	if(count($succMessages)) { ?>
	<div class="col-sm-12">
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">&times;</button>
			<?php
				/*foreach($succMessages as $succMessage)
				{
					echo $succMessage."<br>";
				}*/
				echo implode("</br>",$succMessages);
			?>
		</div>
	</div>
<?php } ?>