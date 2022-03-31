<?php
require("utama.php");

$handle = fopen("resource.txt",'a+');
//$condensed = Chr(27) . Chr(33) . Chr(4);
//$bold1 = Chr(27) . Chr(69);
//$bold0 = Chr(27) . Chr(70);
//$initialized = chr(27).chr(64);
//$condensed1 = chr(15);
//$condensed0 = chr(18);
//$Data  = $initialized;
//$Data .= $condensed1;

if ($mdata=='DOCET')
{
fclose($handle);
copy("resource.txt", "//localhost/epsontm1");# Lakukan cetak
unlink("resource.txt");
}
else
{
$Data .= $mdata."\n";
fwrite($handle, $Data);
fclose($handle);
}

?>