<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Print</title>
<link href="themes/sunny/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
$Pcs2(document).ready(function()
{
})
</script>
</head>

<body onload="loadform()" style="font-family: Draft 5cpi; background-color: #FFFFFF">

<?php
require("utama.php");

$paw=1;
$pak=500;
$mstop=false;
$mtootal=0;
$query41=executerow("
select a.*, b.lgnnama, b.alamat, c.karnama
from transjual1 a
left join setlgn b on a.lgnid=b.lgnid
left join setkaryawan c on a.sales=c.karid
where nid='$mnid'
");
$jual1=mysql_fetch_assoc ($query41);

$maw=0;

//echo("select a.*,b.lgnnama,b.alamat from transjual1 a left join setlgn b on a.lgnid=b.lgnid where nid='$mnid'");

for ($att=1;$att<5;$att++)
{
	$jl2=executerow("select 
	a.*,b.stonama,b.satuan1,b.satuan2 
	from transjual2 a 
	left join setstok b on a.stoid=b.stoid 
	where a.nid='$mnid' order by nomor limit $maw,$pak ");

	$merrr=mysql_num_rows($jl2);

	if ($merrr==0)
	{
		$mstop=true;
	}

	$maw=$maw+$pak;
	$jl3=executerow("select 
	a.*,b.stonama,b.satuan1,b.satuan2 
	from transjual2 a 
	left join setstok b on a.stoid=b.stoid 
	where a.nid='$mnid' order by nomor limit $maw,$pak ");
	$merrr2=mysql_num_rows($jl3);

	if ($merrr2==0)
	{
		$pak=11;
	}

	if ( ! $mstop )
	{
		echo '
		<table border=0 cellspacing=0 width=96%>
		';
		if($att==1)
		{
			echo '
			<tr>
				<td><font size=5></font></td>
				<td align=right><font size=5>FAKTUR PENJUALAN</font></td>
			</tr>
			';
			echo '
			<tr>
				<td><font size=3></font></td>
				<td align=right><font size=3>Tanggal : '.$jual1[tgl].' &nbsp; </font></td>
			</tr>
			';
			echo '
			<tr>
				<td>&nbsp;</td>
				<td align=right>&nbsp;</td>
			</tr>
			';
			echo '
			<tr>
				<td><b><font size=4>Kepada : '.$jual1[lgnnama].' </font></td>
				<td align=right> Faktur No.: '.$jual1[nid].' &nbsp; </td>
			</tr>
			';
			echo '
			<tr>
				<td><b><font size=3>'.$jual1[alamat].'</font></td>
				<td align=right> Sales : '.$jual1[sales].' '.$jual1[karnama].' &nbsp; </td>
			</tr>
			';
		}

		echo '
		</table>
		';
		echo "
		<table border=1 cellspacing=0 width=96% >
		";
		echo '
			<tr>
				<th width=5%>NO.</th>
				<th>COLLY</th>
				<th>ISI</th>
				<th align=left>&nbsp;&nbsp;NAMA BARANG</th>
				<th align=right>HARGA SATUAN&nbsp;</th>
				<th align=right>SUB TOTAL&nbsp;</th>
			</tr>
		';

		$mnom=1;$ongkos=0;$tunai=0;
		$ongkos = $jual1[ongkos];
		$tunai = $jual1[tunai];

		while ($jual2=mysql_fetch_assoc($jl2))
		{
			if ( $jual2[qty]>0 )
			{
				$mq1=number_format( $jual2[qty] ,0,".",",") ;
				$ms1=$jual2[satuan1];
			}
			else
			{
				$mq1='';
				$ms1='';
			}

			if ( $jual2[unit]>0 )
			{
				$mq2=number_format( $jual2[unit] ,0,".",",") ;
				$ms2=$jual2[satuan2];
			}
			else
			{
				$mq2='';
				$ms2='';
			}

			$mstonama=$jual2[stonama];
			$mhrgsat = number_format( $jual2[hrgsat] - $jual2[diskonrp] ,0,".",",") ;
			$mjmlhrg = number_format( $jual2[jmlhrg] ,0,".",",") ;

			echo "
			<tr>
				<td align=right width=5%>$mnom.</td>
				<td> 
					<table width=96% border=0 cellspacing=0>
						<tr>
							<td align=right width=30%>".$mq1.'</td>
							<td>&nbsp;'.$ms1."</td>
							<td align=right width=30%>&nbsp;&nbsp;".$mq2.'</td>
							<td>&nbsp;'.$ms2."</td>
						</tr>
					</table> 
				</td>
				<td>&nbsp;&nbsp;@".$ms1." ".$jual2[isi]."".$ms2."</td>
				<td>&nbsp;&nbsp;".$mstonama."</td>
				<td align=right>".$mhrgsat."&nbsp;</td>
				<td align=right>".$mjmlhrg."&nbsp;</td>
			</tr>
			";

			$mtootal=$mtootal+$jual2[jmlhrg];
			$mnom++;
		}

		echo '
		</table>
		';

		echo "
		<table border=0 cellspacing=2 width=96%>
		";
		for ($axx=$mnom;$axx<$pak;$axx++)
		{
			echo '
			<tr>
				<td> &nbsp;</td>
			</tr>
			';
		}
		echo '
		</table>
		';
	}
	else
	{
		$query209=executerow("select * from setpromo");
		$abb=mysql_fetch_assoc ($query209);
		
		echo '
		<table border=0 cellspacing=0 width=96%>
		';
		if( $mstop )
		{
			$mtootalx=number_format($mtootal,0,".",",");
			echo "
			<tr>
				<td> </td>
				
			</tr>
			";
			echo "
			<tr>
				<td> </td>
				<td colspan=3 align=right><b><font><b> Tunai </td>
				<td align=right><font ><b>".number_format($tunai,0,".",",")."&nbsp;</td>
			</tr>
			";
			echo "
			<tr>
				<td><font size=3><b>Jatuh Tempo : ".$jual1[tgljt]." </td>
				<td colspan=3 align=right><b><font size=5><b> Total Piutang </td>
				<td align=right><font size=5><b>".number_format(($mtootal+$ongkos-$tunai),0,".",",")."&nbsp;</td>
			</tr>
			";
			echo "
			<tr>
				<td colspan=6><i>TERBILANG : ".strtoupper(currencytoWord(($mtootal+$ongkos-$tunai)))."</i><hr></td>
			</tr>
			";
			echo '
		</table>
			';
			echo '
		<table border=0 cellspacing=0 width=100%>
			';
			echo "
			<tr>
				<td valign=top align=center>Tanda Terima <br><br><br>_______________</td>
				<td valign=top align=center>Mengetahui <br><br><br>_______________</td>
				<td valign=top align=center>Sopir <br><br><br>_______________</td>
				<td valign=top align=center>Hormat Kami<br><br><br>_______________</td>
			</tr>
			";
		}
		echo '
		</table>
		';
		break;
	}

	//Note:<br> - "+abb.promo13+" <br> - "+abb.promo14+" <br> - "+abb.promo15+" <br> - "+abb.promo16+" <br> - "+abb.promo17+"//
	////
	$paw=$axx;
	$pak=$axx+18;
}
echo "
<br /><font size=2><i><b></b>
";
?>
<script type="text/javascript">
function loadform()
{
	window.print();
	window.close();
	opener.focus();
}
</script>
<span id="spanisi" style="width: 96%"></span>

</body>

</html>
