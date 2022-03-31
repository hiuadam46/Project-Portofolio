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
<style type="text/css">
.auto-style1
{
	border-top-style: solid;
	border-top-width: 1px;
}
.auto-style2
{
	border-top-style: solid;
	border-top-width: 1px;
	border-bottom-style: solid;
	border-bottom-width: 1px;
}
</style>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
$Pcs2(document).ready(function()
{
	window.print();
	window.close();
	opener.focus();
})

function loadform()
{
	return
	window.print();
	window.close();
	opener.focus();
}
</script>
</head>

<body onload="loadform()" style="font-size: 98%; font-family: arial; background-color: #FFFFFF">

<?php
require("utama.php");
require("terbilang.php");

$paw=1;
$pak=44;
$mstop=false;
$mtootal=0;
$jual1=execute("
select a.*, b.lgnnama, b.alamat, b.telp, c.karnama
from transjual1 a
left join setlgn b on a.lgnid=b.lgnid
left join setkaryawan c on a.sales=c.karid
where nid='$mnid'
");

$maw=0;
$mnom=1;

//echo("select a.*,b.lgnnama,b.alamat from transjual1 a left join setlgn b on a.lgnid=b.lgnid where nid='$mnid'");

for ($att=1;$att<5;$att++)
{
	$jl2=executerow("
	select a.*, b.stonama, b.satuan1, b.satuan2
	from transjual2 a
	left join setstok b on a.stoid=b.stoid
	where a.nid='$mnid' order by b.stonama limit $maw, $pak
	");
	
	$merrr=mysql_num_rows($jl2);
	
	if ($merrr==0)
	{
		$mstop=true;
	}
	
	$maw=$maw+$pak;
	$jl3=executerow("
	select a.*, b.stonama, b.satuan1, b.satuan2
	from transjual2 a
	left join setstok b on a.stoid=b.stoid
	where a.nid='$mnid' order by nomor limit $maw, $pak
	");
	$merrr2=mysql_num_rows($jl3);
	
	if ($merrr2==0)
	{
		//$pak=41;
	}
	
	if ( ! $mstop )
	{
		echo '
		<table border=0 cellspacing=0 width=100%>
		';
		if($att==1)
		{
			echo '
			<tr>
				<td><font size=5>"JASMINE II"</font></td>
				<td align=right><font size=4>FAKTUR PENJUALAN</font></td>
			</tr>
			';
			echo '
			<tr>
				<td><font size=2>Tulungagung</font></td>
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
				<td><b><font size=3>Kepada : '.$jual1[lgnnama].' </font></td>
				<td align=right> Faktur No.: '.$jual1[nid].' &nbsp; </td>
			</tr>
			';
			echo '
			<tr>
				<td><b><font size=2>'.$jual1[alamat].'</font></td>
				<td align=right>Sales : '.$jual1[karnama].' &nbsp; </td>
			</tr>
			';
		}
		echo '
		</table>
		';
		
		/* echo "<table border=1 cellspacing=0 width=100%>"; */
		echo "
		<table cellspacing=0 width=100%>
		";
		echo '
		<thead class="auto-style2">
			<tr>
				<th width=1% class="auto-style2">No.</th>
				<th width=5% class="auto-style2">Qty. Satuan</th>
				<th style="text-align:left" width=16% class="auto-style2">Nama Barang</th>
				<th align=right width=6% class="auto-style2">Harga&nbsp;</th>
				<th align=right width=8% class="auto-style2">Sub Total&nbsp;</th>
			</tr>
		</thead>
		';
		
		$mtootal=0;
		$mnom2=1;
		echo '
		<tbody>
		';
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
			$mstonama=str_replace(" ","&nbsp;&nbsp;",$mstonama);
			$mhrgsat = number_format( $jual2[hrgsat] - $jual2[diskonrp] ,0,".",",") ;
			$mjmlhrg = number_format( $jual2[jmlhrg] ,0,".",",") ;
			$mdisk = number_format( $jual2[diskonp] ,0,".",",") ;
			
			/* echo "
			<tr>
			<td align=right style='".borders(1,0,0,1,2)."' width=5% >$mnom.</td>
			<td style='".borders(1,0,0,1,2)."' >&nbsp;&nbsp;".$mstonama."</td>
			<td style='".borders(1,0,0,1,2)."' align=right>
			<table width=80% border=0 cellspacing=0>
			<tr>
			<td align=right width=30%>".$mq1.'</td>
			<td>&nbsp;'.$ms1."</td>
			<td align=right width=30%>&nbsp;&nbsp;".$mq2.'</td>
			<td>&nbsp;'.$ms2."</td>
			</tr>
			</table></td>
			<td align=right style='".borders(1,0,0,1,2)."' >".$mhrgsat."&nbsp;</td>
			<td align=right style='".borders(1,1,0,1,2)."' >".$mjmlhrg."&nbsp;</td>
			</tr>"; */
			
			echo "
			<tr>
				<td align=right>$mnom.</td>
				<td align=right>
					<table width=80% border=0 cellspacing=0>
						<tr>
							<td align=right width=30%>".$mq1.'</td>
							<td>&nbsp;'.$ms1."</td>
							<td align=right width=30%>&nbsp;&nbsp;".$mq2.'</td>
							<td>&nbsp;'.$ms2."</td>
						</tr>
					</table></td>
				<td>&nbsp;&nbsp;".$mstonama."</td>
				<td align=right>".$mhrgsat."&nbsp;</td>
				<td align=right>".$mjmlhrg."&nbsp;</td>
			</tr>";
			
			$mtootal=$mtootal+$jual2[jmlhrg];
			$mnom++;
			$mnom2++;
		}
		echo '
		</tbody>
		';
		echo '
		</table>
		';
		
		$mtootalx=number_format($mtootal,0,".",",");
		echo "
		<table border=0 cellspacing=0 width=100%>
		";
		echo '
			<tr>
				<td colspan=3 class="auto-style1"> Jatuh Tempo : '.date("d-m-Y",strtotime($jual1[tgljt])).' </td>
				<td style="text-align:right" colspan=3 align=left class="auto-style1"><b><font size=4><b> Total :</td>
				<td style="width:22%" align=right colspan=1 class="auto-style1"><font size=4><b>'.$mtootalx.'&nbsp;</td>
			</tr>
			';
		//echo "<tr><td colspan=2> <font size=4 >".terbilang($jual1[jumlah])." </font></td><td colspan=3 align=right style='".borders(1,0,0,0,2)."' ><b><font size=4><b> Grand Total :</td><td align=right style='".borders(0,1,0,0,2)."' colspan=2><font size=4><b>".number_format($jual1[total],0,".",",")."&nbsp;</td></tr>";
		echo '
			<tr>
				<td colspan=3 align=left> &nbsp;&nbsp;Yang menerima,</td>
				<td style="text-align:right" colspan=3 align=left><b><font size=4><b> Tunai :</td>
				<td align=right colspan=1><font size=4><b>'.number_format($jual1[tunai],0,".",",").'&nbsp;</td>
			</tr>
			';
		echo '
			<tr>
				<td colspan=3></td>
				<td style="text-align:right" colspan=3 align=left><b><font size=4><b> Sisa :</td>
				<td align=right colspan=1><font size=4><b>'.number_format($jual1[jumlah],0,".",",").'&nbsp;</td>
			</tr>
			';
		echo '
		</table>
		';
	}
	else
	{
		$abb=execute("select * from setpromo");
		
		if( $mstop )
		{
			break;
		}
	}
	//Note:<br> - "+abb.promo13+" <br> - "+abb.promo14+" <br> - "+abb.promo15+" <br> - "+abb.promo16+" <br> - "+abb.promo17+"//
	////
	$paw=$axx;
	//$pak=$axx+18;
}
?>

</body>

</html>
