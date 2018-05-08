<?php

if (!isset($_POST['mauticform']) ||
	!isset($_POST['mauticform']['formId']) ||
	!isset($_POST['mauticform']['formName']) ||
	!isset($_POST['mauticform']['amail']) ||
	!isset($_POST['mauticform']['email'])) {

	die('Required fields not set');
}

$fields = $_POST['mauticform'];

$formId = $fields['formId'];
$formName = $fields['formName'];
$realEmail = $fields['amail'];
$honeyEmail = $fields['email'];

$formUrl = "https://mautic.targetteal.com/form/submit?formId=$formId";

if ($honeyEmail != '') {
	// Bot caught in the honeypot filter
    die('Caught!');
}
?>

<form id="honeyform" action="<?php echo $formUrl; ?>" method="post">
<?php
    foreach ($fields as $name => $value) {
        echo '<input type="hidden" name="mauticform[' . htmlentities($name) . ']" value="'.htmlentities($value).'"/>';
    }
?>
</form>
<script type="text/javascript">
    document.getElementById('honeyform').submit();
</script>
