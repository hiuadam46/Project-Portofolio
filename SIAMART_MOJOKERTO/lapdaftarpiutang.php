<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_mojokerto_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Daftar Piutang</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script src="js/jquery.corner.js"></script>			
    <script type="text/javascript">
	  var $Pcs2 = jQuery.noConflict();
	  var dialogisopen=false;
		$Pcs2(document).ready(function(){
		$Pcs2("#mtgl1").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		$Pcs2("#mtgl2").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		buatlaporan();
		$Pcs2("#headertrans").html("<b>Daftar Piutang")
		$Pcs2("#mtgl1").datepicker({dateFormat: 'dd-mm-yy'});
		$Pcs2("#mtgl2").datepicker({dateFormat: 'dd-mm-yy'});
		
        $Pcs2("#kotakdialog2").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 800,	
		  });

		$Pcs2("#mlsup").click(function(){
			bukasuplier()
		})
		
		// $Pcs2("#mtgl1").change(function(){
		// 	buatlaporan()
		// })

		// $Pcs2("#mtgl2").change(function(){
		// 	buatlaporan()
		// })

		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
		})
		$Pcs2("#goprintexcel").click(function()
		{
			buatlaporan(true, true);
		})
		$Pcs2("#mllgn").click(function(){
			bukapelanggan()
		})
		$Pcs2("#mlsales").click(function() 
		{
			mcomm="Select rpad(karid,12,' ') Kode,left(karnama,50) Nama  from setkaryawan where true"
			mordd="Kode"
			mffff=" concat(karid,karnama) "

			$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msalesid')
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();	
		})

		//Periode <input type=text id=mperiode size=8>
		$Pcs2("#mperiode").blur(function() 
		{
			mperiode=$Pcs2("#mperiode").val()
			buatlaporan()
		})

		$Pcs2("#mlookperiode").click(function() 
		{
			//mcomm=" (select '> 7' as periode union "
			mcomm="select periode  kode from ( select 'Semua periode' as periode union "
			mcomm= mcomm + " select '> 07' as periode union "			
			mcomm= mcomm + " select '> 14' as periode union "
			mcomm= mcomm + " select '> 21' as periode union "
			mcomm= mcomm + " select '> 30' as periode union "
			mcomm= mcomm + " select '> 60' as periode) a where true "
			mordd="kode"
			mffff=" concat(periode) "

			$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mperiode')
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Periode');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();	
		})

		$Pcs2("#msalesid").blur(function() 
		{
			msalesid=$Pcs2("#msalesid").val()
			dasales=taptabel("setkaryawan","karid,karnama","karid = '"+msalesid+"'")
			$Pcs2("#msalesid").val("")
			$Pcs2("#msalesnama").val("")
			if (dasales.karid!=undefined)
			{
				$Pcs2("#msalesid").val(dasales.karid)
				$Pcs2("#msalesnama").val(dasales.karnama)
			}
			else
			{
				$Pcs2("#msalesid").val("")
				$Pcs2("#msalesnama").val("")
			}
			buatlaporan()
		})

		$Pcs2("#mlgnid").blur(function() 
			{
			mlgnid=$Pcs2("#mlgnid").val()
			//datas=taptabel("setlgn","lgnid,lgnnama","lgnid='"+this.value+"'")
			datas=taptabel("setlgn","lgnid,lgnnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","lgnid='"+mlgnid+"'")

			$Pcs2("#mlgnid").val("")
			$Pcs2("#mlgnnama").val("")
			if (datas.lgnid!=undefined)
			{
				$Pcs2("#mlgnid").val(datas.lgnid)
				$Pcs2("#mlgnnama").val(datas.lgnnama)
			}
			else
			{
				$Pcs2("#mlgnid").val("")
				$Pcs2("#mlgnnama").val("")				
			}
			buatlaporan()

		})
    });
	function buatlaporan(ngeprint,excel)
	{
			//mtgl1=$Pcs2("#mtgl1").val()
			//mtgl2=$Pcs2("#mtgl2").val()
			msalesid=$Pcs2("#msalesid").val()
			mlgnid=$Pcs2("#mlgnid").val()
			if(!excel)
			{
				if (!ngeprint)
				{
					//$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mdfp&mtg1="+mtgl1+"&mtg2="+mtgl2+"&msalesid="+msalesid+"&mlgnid="+mlgnid)
					$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mdfp&msalesid="+msalesid+"&mlgnid="+mlgnid)
				}
				else
				{
					//window.open("isilaporan.php?mLapo=mdfp&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&msalesid="+msalesid+"&mlgnid="+mlgnid)
					window.open("isilaporan.php?mLapo=mdfp&isprint=YY"+"&msalesid="+msalesid+"&mlgnid="+mlgnid)
				}
			}
			else
			{
				//window.open("isilaporan.php?mLapo=mdfp&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&msalesid="+msalesid+"&mlgnid="+mlgnid)
				window.open("isilaporan.php?mLapo=mdfp&excel=true&isprint=YY"+"&msalesid="+msalesid+"&mlgnid="+mlgnid)
			}
	}
    </script>
    <script type="text/javascript">

	function bukasuplier()
	{
		//if ($Pcs2("#mnid").val()==''){$Pcs2("#mnid").focus();return;break;}
		$Pcs2("#framehrg").attr('src','looksup.php?mobj=lookdfhutang')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	}
	function bukapelanggan()
	{
		mcomm="Select rpad(lgnid,12,' ') Kode,left(lgnnama,50) Nama from setlgn where true"
		mordd="Kode"
		mffff=" concat(lgnid,lgnnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelanggan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	}
</script>
</head>

<body background='images/num.jpg'>
<?php 
	require("menu.php");
?>	
	<form name='fform' id='fform'>
	<font face='Arial' color='white' >
	<div style="position:absolute;top:10px; left:10px; width:1250px;text-align:left;background-color:sBlue">
	<table width='100%'>
	<tr>
	<!--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly> S.d. -->
	<!--<td>Tgl. </td>
	<td><input type=text id=mtgl1 size=10 readonly> S.d. 
	<input type=text id=mtgl2 size=10 readonly></td> 
	<td align=right>
		<a href="" id='goprint' >
		<img src="images/icon_print.png"></a>
		<a id="goprintexcel" href="">
		<img alt="" height="32" src="images/excel.png"></a>
	</td>
	-->
	</tr>
	<tr>

		<td>Sales </td> <td><input type=text id=msalesid size=8>
		<input type='button' id=mlsales value='F5'>
		<input type=text id=msalesnama readonly>

		pelanggan 
		<input type=text id=mlgnid size=8>
		<input type='button' id=mllgn value='F5'>
		<input type=text id=mlgnnama readonly> 
		 
		<!--	Periode <input type=text id=mperiode size=12 readonly>
		<input type='button' id=mlookperiode value='F5'>	-->
		</td>
		<td align=right>
			<a href="" id='goprint' >
			<img src="images/icon_print.png"></a>
			<a id="goprintexcel" href="">
			<img alt="" height="32" src="images/excel.png"></a>
		</td>
	</tr>
	</table>
	</form>
	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<iframe id='framehrg' width='700' height='400'></iframe>
		</center>
	</div>
	<iframe id='framelap' width='100%' height='1200px' src="isilaporan.php"></iframe>

</body>
</html>