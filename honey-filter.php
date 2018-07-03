<?php
define('SECURITY_HASH', '8f3937426a12d221d56ea15901b5870d');

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

$blockedEmailPatterns = array(
	'/\A(\d*)\@(.*)\z/',
	'/\A(.*)\@(\d*)\.(.*)\z/'
);

foreach ($blockedEmailPatterns as $pattern) {
	if (preg_match($pattern, $realEmail)) {
		// Bot caught in the blocked patterns
		die('Caught');
	}
}

$fields['email'] = $realEmail;
$fields['hash'] = SECURITY_HASH;

unset($fields['amail']);

?>
<p>Filtering Spam content... </p>
<form id="form" action="<?php echo $formUrl; ?>" method="post">
<?php
  foreach ($fields as $name => $value) {
		echo '<input type="hidden" name="mauticform[' . htmlentities($name) . ']" value="'.htmlentities($value).'"/>';
  }
?>
</form>
<script type="text/javascript">
  document.getElementById('form').submit();
</script>
