<?php

$formId = $_POST['formId'];
$formName = $_POST['formName'];
$email = $_POST['email'];
if ($email == '') {
        trigger_error("Integration without POST data", E_USER_ERROR);
        die();
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://mautic.targetteal.com/form/submit?formId=$formId");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        "mauticform[formId]" => $formId,
        "mauticform[formName]" => $formName,
        "mauticform[email]" => $email)));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);
