<?php
require("../utama.php");

$query="select 
a.stoid,
FORMAT(a.qty,0) qty,FORMAT(a.unit,0) unit,
FORMAT(a.extra,0) extra,FORMAT(a.extraunit,0) extraunit,
FORMAT(hrgsat,0) hrgsat,FORMAT(diskonp,2) diskon,FORMAT(jmlhrg,0) jmlhrg
from transbeli2 a 
where a.nid='$mnid' 
order by nomor";

/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;
while ($rows=mysql_fetch_object($rrw))
	{
		echo "<script> alert(".rows->stoid.") </script>";
		$mnom++;
	}


?>