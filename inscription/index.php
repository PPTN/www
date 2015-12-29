<?php
    $HTTP_RAW_POST_DATA = file_get_contents("php://input");

    $ch = curl_init("https://lists.riseup.net/www");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $HTTP_RAW_POST_DATA);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);

    if ($result === FALSE) die("Err proxy_forward() - ". curl_error($ch));
    curl_close($ch);
	return $result;
