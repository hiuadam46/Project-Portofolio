<?php
	include("utama.php");
	include("bar128.php");
	$nee=executerow("select * from setstok where pb<>0 order by stoid");

	echo "
	<center>
	<table border=0 cellpadding=0 cellspacing=9 style='position:absolute;top:-13;left:4'>
	";
	echo "<tr>";
	echo "<td valign=top>";

	$mono=1;
	while ($bbe=mysql_fetch_object($nee))
	{

	$mjmml=$bbe->pb;
	for ($mge=0;$mge<$mjmml;$mge++)
	{
	echo "
	<table border=0 cellpadding=0 cellspacing=0>
	";
	$mhrgjual3='Rp '.number_format($bbe->hrgjual3,0,',','.');
	"$html<tr><td  colspan=".strlen($w)." align=center><font family=arial size=1><b>$text &nbsp;&nbsp;&nbsp; ADA SENTOSA</table>";
	echo "<tr height=5>";
	echo "<td rowspan=5 width=35 valign=top></td>";
	echo "<td align=center valign=top width=80></tr>";

	echo "<tr><td width=80 align=left valign=top><b><font size=1 face=verdana>".substr($bbe->stonama,0,14)."</td></tr>";
	echo "<tr><td  align=left valign=top>";
	echo bar128(stripslashes($bbe->barcode));
	//echo "</div><b><font size=1 face=verdana>$bbe->barcode </font><font size=1 face=verdana><br>&nbsp;&nbsp;";
	echo "<b><font size=1 face=verdana><b>$mhrgjual3 </font><font size=1 face=verdana> </td></tr>";
	echo "</td>";
	echo "</tr>";

	echo "
	</table>
	";
	
	if ($mono==3)
	{
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td valign=top>";
	$mono=1;
	}
	else
	{
	echo "</td>";
	echo "<td valign=top>";
	$mono++;
	}

	}
	
	}
	echo "</tr>";

	echo "
	</table>
	";
	
?>