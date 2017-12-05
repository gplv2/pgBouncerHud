<?php
$password = "God";

$hash = sha1(crc32(md5($password)));

echo $hash . PHP_EOL;

// da47af4bf6394c318e21a16639f1afba7a8ec8b5

?>
