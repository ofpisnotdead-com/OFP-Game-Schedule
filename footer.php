<?php
if (isset($section_title))
	$form->title = "$section_title &nbsp;";

$form->title = $form->title . "<B>{$form->hidden["display_name"]}</B>";

if (!empty($form->data["uniqueid"]))
	$form->title .= '<span style="float:right;font-size:12px;">'.$form->data["uniqueid"].'</span>';

$form->hidden["action"] = NULL;
echo $form->display();
?>

	</DIV> <!-- /.container -->
</DIV> <!-- /.wrapper -->


<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
	