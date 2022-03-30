<?php
require("../utama.php");

if ($maww=='')
{$maww=0;}

$query=$msqq." order by POSITION('$tcar' IN $morder) ,".$morder.' '.$mad.' limit '.$maww.',50';

//echo ($query);

$data = array();
$idx = 0;

$rrw=executerow($query);

while($row = mysql_fetch_array($rrw)) {
            $data[$idx++] = $row;
}
print json_encode($data);


?>