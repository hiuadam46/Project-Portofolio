<html>

<head>
<title>Print Kasir</title>
<!-- <link rel="stylesheet" href="main.css" type="text/css"> -->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();

$Pcs2(document).ready(function()
{
	printer()
})
</script>
<script type="text/javascript">
function printer()
{
	self.print();
	self.close();
	opener.focus();
	opener.$Pcs2("#12_"+gg).focus()
}
</script>
</head>

<body onload="loadform()" style="background-color: #FFFFFF">

<?php
$mtjpoin=$_GET['mtjpoin'];

require("utama.php");
$abc=execute("select a.*,b.lgnnama from transkasir1 a left join setlgn b on a.lgnid=b.lgnid where nid='$mnid'");

echo '
<div style="width:125mm">
<table border=0 width=80%>
';

echo '
	<tr height=0>
		<td colspan=6>'.'=============================='.'</td>
	</tr>
';
echo '
	<tr height=0>
		<td colspan=6 align=center>'.'METRO BIKE SHOP'.'</td>
	</tr>
';
echo '
	<tr height=0>
		<td colspan=6 align=center>'.'Jl Bromo No 10 Wlingi Blitar'.'</td>
	</tr>
';
echo '
	<tr height=0>
		<td colspan=6 align=center>'.'Telp 0342-694469'.'</td>
	</tr>
';


echo '
	<tr height=0>
		<td colspan=6>'.'=============================='.'</td>
	</tr>
';

echo '
	<tr height=0>
		<td colspan=6>No.'.$abc[nid].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. '.$abc[tgl].'</td>
	</tr>
';

echo '
	<tr height=0>
		<td colspan=6>Pel.&nbsp;:&nbsp; '.$abc[lgnnama].' &nbsp;&nbsp; Jam &nbsp;'.$abc[jam].'</td>
	</tr>
';
echo '
	<tr height=0>
		<td colspan=6>------------------------------------------------</td>
	</tr>
';

$def=executerow("select a.*,b.stonama from transkasir2 a left join setstok b on a.stoid=b.stoid where nid='$mnid' order by a.num");

while ($hij=mysql_fetch_object($def))
{
	$mstoid=$hij->stoid;
	$mqty=number_format($hij->qty,0,'.',',');

	$mjmlhrg=number_format($hij->jmlhrg,0,'.',',');
	$mhrgsat=number_format($hij->hrgsat,0,'.',',');

	$mstonama=$hij->stonama;
	$msatuan=$hij->satuan;

	echo '
	<tr height=0>
		<td colspan=6>'.$mstonama.'</td>
	</tr>
	';
	echo '
	<tr height=0>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$mqty.'</td>
		<td>'.$msatuan.'</td>
		<td>X</td>
		<td>'.$mhrgsat.'</td>
		<td>=</td>
		<td align=right>'.$mjmlhrg.'</td>
	</tr>
	';
}
echo '
	<tr height=0>
		<td colspan=6>------------------------------------------------</td>
	</tr>
	';
echo '
	<tr height=0>
		<td colspan=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'TOTAL </td>
		<td align=right>'.number_format($abc[total],0,'.',',').'</td>
	</tr>
';

echo '
	<tr height=0>
		<td colspan=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'BAYAR </td>
		<td align=right>'.number_format($abc[bayar],0,'.',',').'</td>
	</tr>
';

echo '
	<tr height=0>
		<td colspan=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'KEMBALI</td>
		<td align=right>'.number_format($abc[kembali],0,'.',',').'</td>
	</tr>
';

echo '
	<tr height=0>
		<td colspan=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'SALDO POIN</td>
		<td align=right>'.number_format($mtjpoin,0,'.',',').'</td>
	</tr>
';

$mkett=execute("select * from setpromo");

if ($mkett[promo1]!='' && $mkett[promo1]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6>'.'-------------------------------------------------'.'</td>
	</tr>
	';
	echo '
	<tr height=0>
		<td colspan=6 align=center>'.'Promo Hari Ini:</td>
	</tr>
	';
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo1].'</td>
	</tr>
	';
}
if ($mkett[promo2]!='' && $mkett[promo2]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo2].'</td>
	</tr>
	';
}
if ($mkett[promo3]!='' && $mkett[promo3]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo3].'</td>
	</tr>
	';
}
if ($mkett[promo4]!='' && $mkett[promo4]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo4].'</td>
	</tr>
	';
}
if ($mkett[promo5]!='' && $mkett[promo5]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo5].'</td>
	</tr>
	';
}
if ($mkett[promo6]!='' && $mkett[promo6]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo6].'</td>
	</tr>
	';
}
if ($mkett[promo7]!='' && $mkett[promo7]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo7].'</td>
	</tr>
	';
}
if ($mkett[promo8]!='' && $mkett[promo8]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo8].'</td>
	</tr>
	';
}
if ($mkett[promo9]!='' && $mkett[promo9]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo9].'</td>
	</tr>
	';
}
if ($mkett[promo10]!='' && $mkett[promo10]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo10].'</td>
	</tr>
	';
}
if ($mkett[promo11]!='' && $mkett[promo11]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo11].'</td>
	</tr>
	';
}
if ($mkett[promo12]!='' && $mkett[promo12]!=undefined)
{
	echo '
	<tr height=0>
		<td colspan=6 align=left>-'.$mkett[promo12].'</td>
	</tr>
	';
}

echo '
	<tr height=0>
		<td colspan=6>'.'------------------------------------------------'.'</td>
	</tr>
';
echo '
	<tr height=0>
		<td colspan=6 align=center>'.'Terima Kasih'.'</td>
	</tr>
';
echo '
	<tr height=0>
		<td colspan=6 align=center>'.'Kami Tunggu Kedatangan Anda '.'</td>
	</tr>
';

echo '
	<tr height=0>
		<td colspan=6 align=center>'.'Kembali'.'</td>
	</tr>
';


echo '
	<tr height=0>
		<td colspan=6>'.'------------------------------------------------'.'</td>
	</tr>
';
echo '
	<tr height=0>
		<td colspan=6>'.'&nbsp;</td>
	</tr>
';

echo '
</table>
</div>
';
?>

</body>

</html>
