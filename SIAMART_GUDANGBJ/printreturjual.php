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
	window.print();
	window.close();
	opener.focus();
})
</script>
<script type="text/javascript">
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
$pak=100;
$mstop=false;
$mtootal=0;

$result=executerow("
select a.*, b.lgnnama, b.alamat, b.telp
from transreturjual1 a
left join setlgn b on a.lgnid=b.lgnid
where nid='$mnid'
");
$jual1=mysql_fetch_assoc($result);

$maw=0;
$mnom=1;

for ($att=1;$att<5;$att++)
{
	$jl2=executerow("
	select a.*, b.stonama, b.satuan1, b.satuan2
	from transreturjual2 a
	left join setstok b on a.stoid=b.stoid
	where a.nid='$mnid'
	order by nomor
	limit $maw, $pak
	");

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
		//$pak=41;
	}

	if ( ! $mstop )
	{
		echo '
		<table border=0 cellspacing=0 width=45%>
		';
		if($att>0)
		{
			echo '
			<tr>
				<td><font size=5 style="display:none">GUDANG BALI JAYA </font></td>
				<td><font style="font-size:12pt">FAKTUR RETUR PENJUALAN</font></td>
				<td width=5%>Dari</td>
				<td>:&nbsp;</td>
				<td width=39% style="font-size:12pt">'.$jual1[lgnnama].'</td>
			</tr>';

			echo '
			<tr>
				<td><font size=4 style="display:none">Blitar</font></td>
				<td>&nbsp;</td>
				<td>Alamat</td>
				<td>:&nbsp;</td>
				<td> '.$jual1[alamat].'</td>
			</tr>';

			echo '
			<tr>
				<td><font size=4 style="display:none">Telp 0813.5741.8787</font></td>
				<td>&nbsp;</td>
				<td>Telp. </td>
				<td>:&nbsp;</td>
				<td>'.$jual1[telp].'</td>
			</tr>';

			echo '
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align=right>&nbsp;</td>
			</tr>
			';
			echo '
			<tr>
				<td><b>Faktur No.: '.$jual1[nid].' </td>
				<td><b>Tanggal : '.date('d-m-Y',strtotime($jual1[tgl])).' </td>
				<td colspan=3><b>Kasir :&nbsp;'.$mkasir.'</td>
			</tr>
			';
		}

		echo '
		</table>
		';
		echo "
		<table border=0 cellspacing=0 width=45% >
		";
		echo '
			<tr>
				<th style="'.borders(1,0,1,1,1).'" width=3% >NO.</th>
				<th align=left style="'.borders(1,0,1,1,1).'" width=27% colspan="2">NAMA BARANG</th>
				<th style="'.borders(1,0,1,1,1).'" width=10%>QTY RETUR</th>
				<th style="'.borders(1,0,1,1,1).'" width=3%>V</th>
				<th style="'.borders(1,0,1,1,1).';;text-align:center" width=5%>HARGA</th>
				<th style="'.borders(1,0,1,1,1).'" width=5% >POT.</th>
				<th align=right style="'.borders(1,1,1,1,1).'" width=10% >SUB TOTAL</th>
			</tr>
		';

		$mtootal=0;
		$mnom2=1;
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
			
			if ( $jual2[extra]>0 )
			{
				$mq1e=number_format( $jual2[extra] ,0,".",",") ;
				$ms1e=$jual2[satuan1];
			}
			else
			{
				$mq1e='';
				$ms1e='';
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
			
			if ( $jual2[extraunit]>0 )
			{
				$mq2e=number_format( $jual2[extraunit] ,0,".",",") ;
				$ms2e=$jual2[satuan2];
			}
			else
			{
				$mq2e='';
				$ms2e='';
			}

			$mstonama=$jual2[stonama];
			$mstonama=str_replace(" ","&nbsp;&nbsp;",$mstonama);
			$mhrgsat = number_format($jual2[hrgsat], 0, ".", ", ");
			$mjmlhrg = number_format( $jual2[jmlhrg] ,0,".",",") ;
			$mdisk = number_format($jual2[diskonrp], 0, ".", ", ");

			echo '
			<tr>
				<td align=right style="'.borders(1,0,0,0,1).'" width=5% >'.$mnom.'.&nbsp;</td>
				<td style="'.borders(1,0,0,0,1).'" colspan="2">&nbsp;&nbsp;'.$mstonama.'</td>
				<td style="'.borders(1,0,0,0,1).'" align=right>
					<table width=80% border=0 cellspacing=0>
						<tr>
							<td align=right width=30%>'.$mq1.'</td>
							<td>&nbsp;'.$ms1.'</td>
							<td align=right width=30%>&nbsp;&nbsp;'.$mq2.'</td>
							<td>&nbsp;'.$ms2.'</td>
						</tr>
					</table>
				</td>
				
				<td align=right style="'.borders(1,0,0,0,1).'" >&nbsp;</td>
				<td align=right style="'.borders(1,0,0,0,1).'" >'.$mhrgsat.'&nbsp;</td>
				<td align=right style="'.borders(1,0,0,0,1).'" >'.$mdisk.'&nbsp;</td>
				<td align=right style="'.borders(1,1,0,0,1).'" >'.$mjmlhrg.'&nbsp;</td>
			</tr>
			';

			$mtootal=$mtootal+$jual2[jmlhrg];
			$mnom++;
			$mnom2++;
		}

		$mtootalx=number_format($mtootal,0,".",",");
		echo '
			<tr>
				<td colspan=3 style="'.borders(0,0,1,0,1).'" >Terbilang&nbsp;:</td>
				<td colspan=3 align=right style="'.borders(1,0,1,1,1).'" ><b><font size=4><b> Total :</td>
				<td align=right style="'.borders(0,1,1,1,1).'" colspan=2><font size=4><b>'.$mtootalx.'&nbsp;</td>
			</tr>
		';
		echo "
			<tr>
				<td colspan=3><font size=4 >===".terbilang($jual1[total])."&nbsp;rupiah===</font></td>
				<td colspan=3 align=right style='".borders(0,0,0,0,1)."' ><b><font size=4><b>&nbsp;</td>
				<td align=right style='".borders(0,0,0,0,1)."' colspan=2><font size=4><b>&nbsp;</td>
			</tr>
		";
		echo "
			<tr>
				<td colspan=3 align=left>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penerima, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin,</td>
				<td colspan=3 align=right style='".borders(0,0,0,0,1)."' ><b><font size=4><b>&nbsp;</td>
				<td align=right style='".borders(0,0,0,0,1)."' colspan=2><font size=4><b>&nbsp;</td>
			</tr>
		";
		echo "
			<tr>
				<td colspan=3> </td>
				<td colspan=3 align=right style='".borders(0,0,0,0,1)."' ><b><font size=4><b>&nbsp;</td>
				<td align=right style='".borders(0,0,0,0,1)."' colspan=2><font size=4><b>&nbsp;</td>
			</tr>
		";
		echo "
			<tr>
				<td align=center colspan=3>&nbsp;</td>
				<td colspan=5><b>&nbsp;</td>
			</tr>
		";
		echo "
			<tr>
				<td align=center colspan=3>&nbsp;</td>
				<td colspan=5><b>&nbsp;</td>
			</tr>
		";
		echo "
			<tr>
				<td colspan=3 align=left> ------------ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ------------- </td>
				<td colspan=5 align=left>&nbsp;</td>
			</tr>
		";
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
