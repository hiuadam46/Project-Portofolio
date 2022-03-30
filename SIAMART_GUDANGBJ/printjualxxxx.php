<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<title>
</title>
</head>
<body bgcolor=#FFFFFF style='font-size:98%;font-family:arial' onload=loadform()>

<?php
require("utama.php");
require("terbilang.php");
    
$paw=1;
$pak=44;
$mstop=false;
$mtootal=0;
$jual1=execute("
select a.*,b.lgnnama,b.alamat,b.telp,c.karnama from 
transjual1 a 
left join setlgn b on a.lgnid=b.lgnid 
left join setkaryawan c on a.sales=c.karid 
where nid='$mnid'
");

$maw=0;
$mnom=1;

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
//$pak=41;
}

if ( ! $mstop )
{
     echo '<table border=0 cellspacing=0 width=100%>';
     if($att>0)
	 {
	 echo '
	 <tr>
	 <td><font size=5>GUDANG BALI JAYA </font></td>
	 <td align=center><font size=5>FAKTUR PENJUALAN&nbsp;</font></td> 
	 <td width=5%>Kepada</td> 
	 <td width=25% style="font-size:15pt">: '.$jual1[lgnnama].'</td> 
	 </tr>';

     echo '
	 <tr>
	 <td><font size=2>Blitar</font></td>
	 <td></td>
	 <td>Alamat</td>
	 <td>: '.$jual1[alamat].'</td>
	 </tr>';

     echo '
	 <tr>
	 <td>Telp 0342-801048</td>
	 <td></td>
	 <td>Telp. </td>
	 <td>: '.$jual1[telp].'</td>
	 </tr>';
	 
     echo '<tr><td></td><td align=right>  &nbsp; </td></tr>';
     echo '<tr>
	 <td><b>Faktur No.: '.$jual1[nid].' </td>
	 <td><b>Tanggal : '.date('d-m-Y',strtotime($jual1[tgl])).'  </td>
	 <td colspan=2><b>Sales : '.$jual1[sales].' '.$jual1[karnama].'  </td></tr>';
	 
     }
	 
	 echo '</table>';
     echo "<table border=0 cellspacing=0 width=100% >";
     echo "
	 <tr>
	 <th style='".borders(1,0,1,1,2)."'   width=3%  >NO.</th>  
	 <th  align=left  style='".borders(1,0,1,1,2)."'  width=40%>NAMA BARANG</th> 
	 <th  style='".borders(1,0,1,1,2)."'  width=10%>SATUAN</th> 
	 <th  style='".borders(1,0,1,1,2)."'  width=3%>V</th> 
	 <th align=right  style='".borders(1,0,1,1,2)."'    width=5% >HARGA</th> 
	 <th  style='".borders(1,0,1,1,2)."'    width=5% >DISK</th> <th  align=right  style='".borders(1,1,1,1,2)."'    width=10% >SUB TOTAL</th>
	 </tr>";

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
	$mhrgsat = number_format( $jual2[hrgsat] - $jual2[diskonrp]  ,0,".",",") ;
	$mjmlhrg = number_format( $jual2[jmlhrg] ,0,".",",") ;
	$mdisk = number_format( $jual2[diskonp] ,0,".",",") ;
	
	echo "
	<tr>
	<td align=right style='".borders(1,0,0,1,2)."'   width=5%   >$mnom.</td>
	<td style='".borders(1,0,0,1,2)."' >&nbsp;&nbsp;".$mstonama."</td>
	<td style='".borders(1,0,0,1,2)."' align=right> 
	<table width=80% border=0 cellspacing=0><tr><td align=right width=30%>".$mq1.'</td><td>&nbsp;'.$ms1."</td><td align=right width=30%>&nbsp;&nbsp;".$mq2.'</td><td>&nbsp;'.$ms2."</td></tr></table> 
	</td>
	<td align=right style='".borders(1,0,0,1,2)."' >&nbsp;</td>
	<td align=right style='".borders(1,0,0,1,2)."' >".$mhrgsat."&nbsp;</td>
	<td align=right style='".borders(1,0,0,1,2)."' >".$mdisk."&nbsp;</td>
	<td align=right style='".borders(1,1,0,1,2)."' >".$mjmlhrg."&nbsp;</td>
	</tr>";

	$mtootal=$mtootal+$jual2[jmlhrg];
	$mnom++;
	$mnom2++;
	}

    
     

		  $mtootalx=number_format($mtootal,0,".",",");
		  echo "<tr><td colspan=2 style='".borders(0,0,1,0,2)."' > Jatuh Tempo : ".date('d-m-Y',strtotime($jual1[tgljt]))." </td><td colspan=3 align=right style='".borders(1,0,1,0,2)."'  ><b><font size=4><b> Total  :</td><td align=right style='".borders(0,1,1,0,2)."'  colspan=2><font size=4><b>".$mtootalx."&nbsp;</td></tr>";
		  echo "<tr><td colspan=2> <font size=4 >".terbilang($jual1[jumlah])." </font></td><td colspan=3 align=right style='".borders(1,0,0,0,2)."' ><b><font size=4><b> Grand Total  :</td><td align=right  style='".borders(0,1,0,0,2)."' colspan=2><font size=4><b>".number_format($jual1[total],0,".",",")."&nbsp;</td></tr>";
 		  echo "<tr><td colspan=2 align=left> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang menerima, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang menyerahkan,</td><td colspan=3 align=right style='".borders(1,0,0,0,2)."' ><b><font size=4><b> Tunai  :</td><td align=right  style='".borders(0,1,0,0,2)."'   colspan=2><font size=4><b>".number_format($jual1[tunai],0,".",",")."&nbsp;</td></tr>";
		  echo "<tr><td  colspan=2> </td><td colspan=3 align=right style='".borders(1,0,0,1,2)."' ><b><font size=4><b> Sisa  :</td><td align=right style='".borders(0,1,0,1,2)."'  colspan=2><font size=4><b>".number_format($jual1[jumlah],0,".",",")."&nbsp;</td></tr>";
 		  echo "<tr><td align=center>&nbsp;</td><td align=right><b>Barang yang&nbsp;</td><td colspan=5><b> sudah &nbsp;dibeli &nbsp;tidak &nbsp;dapat &nbsp;ditukar&nbsp;/&nbsp;dikembalikan</td></tr>";
 		  echo "<tr><td align=center>&nbsp;</td><td align=right><b>Pembayaran&nbsp;</td><td colspan=5><b> Cek/BG &nbsp;dianggap &nbsp;LUNAS &nbsp;apabila &nbsp;telah &nbsp;dicairkan</td></tr>";
 		  echo "<tr><td colspan=2 align=left> --------------------------------- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --------------------------------- </td></tr>";
		  echo '</table>';
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

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Print</title>
    <link rel="stylesheet" type="text/css" href="themes/sunny/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>  
    <script type="text/javascript" src="js/prototype.js"></script>
    <script src="js/jquery.corner.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script src="js/jquery.corner.js"></script>			
    <script type="text/javascript">
    var $Pcs2 = jQuery.noConflict();
     $Pcs2(document).ready(function(){

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

</html>


