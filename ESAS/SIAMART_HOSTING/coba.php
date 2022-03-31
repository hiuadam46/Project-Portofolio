<?php
require("utama.php");

$x = new barcode128;
$inp = “test”;
echo "$inp<br/>";
$x->debug_barcode($inp);

?>