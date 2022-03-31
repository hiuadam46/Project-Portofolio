<html>
<head>
<title>Print Kasir</title>
<link rel="stylesheet" href="main.css" type="text/css" />
<script src="js/jquery-1.3.2.min.js"></script>
<script src="js/jquery.corner.js"></script>
<script src="js/myfunc.js"></script>
<script>
    var $Pcs2 = jQuery.noConflict();

$Pcs2(document).ready(function(){
   printer()
})
   
</script>
<script type="text/javascript">
function printer()
{
	self.print();
	self.close();
	opener.$Pcs2("#12_1").focus();
}
</script>

</script>
<title>
</title>
</head>
<body bgcolor=#FFFFFF onload='loadform()'>

<?php
require("utama.php");
$abc=execute("select nid,tgl,lokid1,lokid2 from transmutasigudang where nid='$mnid' limit 0,1");
$abc2=execute("select * from setlok where lokid='$abc[lokid1]' limit 0,1");
$abc3=execute("select * from setlok where lokid='$abc[lokid2]' limit 0,1");

	echo "<table border=0 width=100%>";
	echo '<tr height=0><td colspan=2> -- MUTASI GUDANG --</td></tr>';
	echo '<tr height=0><td colspan=2>No.'.$abc[nid].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. '.date("d-m-Y",strtotime($abc[tgl])).'</td></tr>';
	echo '<tr height=0><td colspan=1>Lokasi Asal </td><td>'.$abc[lokid1].' '.$abc2[loknama].'</td></tr>';
	echo '<tr height=0><td colspan=1>Ke Lokasi </td><td>'.$abc[lokid2].' '.$abc3[loknama].'</td></tr>';
	echo '<tr height=0><td colspan=2>'.'---------------------------------------';

$def=executerow("delete from transmutasigudang where nid=''");
$def=executerow("select a.*,b.stonama,b.satuan1,b.satuan2 from transmutasigudang a left join setstok b on a.stoid=b.stoid where nid='$mnid'");
	
			while  ($hij=mysql_fetch_object($def))
			{
			
			$mstoid=$hij->stoid;
			$mqty=number_format($hij->qty,0,'.',',');
			$munit=number_format($hij->unit,0,'.',',');			
			$msatuan1=$hij->satuan1;
			$msatuan2=$hij->satuan2;
			$mstonama=$hij->stonama;		
				echo '<tr height=0><td colspan=2>'.$mstonama.'</td></tr>';
				echo '<tr height=0>
				<td colspan=2 align=right><table width=60% border=0 cellspacing=0> <tr> <td>'.$mqty.'</td> <td>'.$msatuan1.'</td><td>'.$munit.'</td> <td>'.$msatuan2.'</td></table></td></tr>';
			}
			echo '</table>';
			echo '<tr height=0><td colspan=2>'.'---------------------------------------</td>';
?>

</body>
</html>
