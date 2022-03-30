<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_angel_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Laporan Pelunasan Piutang</title>
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

		$Pcs2("#mlgnid").change(function(){
			buatlaporan()
		})
		
		$Pcs2("#mtgl1").change(function(){
			buatlaporan()
		})

		$Pcs2("#mtgl2").change(function(){
			buatlaporan()
		})

		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
		})
		$Pcs2("#goprintexcel").click(function()
		{
			buatlaporan(true, true)
		})

		$Pcs2("#mkasirid").blur(function()
	{
		mkasir = $Pcs2("#mkasirid").val()
		datas=taptabel("user","id,nama","id='"+mkasir+"'")

		// $Pcs2("#mkasir").val("")
		// $Pcs2("#mkasirnama").val("")
		if (datas.id!=undefined)
		{
			$Pcs2("#mkasirid").val(datas.id)
			$Pcs2("#mkasirnama").val(datas.nama)
		}
		// else
		// {			
		// 	$Pcs2("#mkasir").val("")
		// 	$Pcs2("#mkasirnama").val("")
		// }
		buatlaporan()
	})

		$Pcs2("#lookmkasirid").click(function()
		{
			mcomm="Select a.kasir User from ( select kasir from transkasir1 group by kasir) a where true "
			mordd=" kasir "
			mffff=" kasir "

			$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mkasirid')
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup kasir');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();
		})

		$Pcs2("#lookmlgnid").click(function()
		{
			mcomm="Select rpad(lgnid,12,' ') Kode,left(lgnnama,30) Nama,left(alamat,35) Alamat,rpad(golongan,12,' ') rightGol from setlgn where true"
			mordd="Kode"
			mffff=" concat(lgnid,lgnnama,alamat,'gol:',golongan) "
			
			$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			$Pcs2("#framehrg").contentWindow.focus();
		})
		$Pcs2("#mjnsbayar").change(function(){
			buatlaporan()
		})
		$Pcs2("#mlgnid").blur(function()
		{
			datas=taptabel("setlgn","golongan,lgnid,plafon,lgnnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","lgnid='"+this.value+"'")
			
			$Pcs2("#mlgnid").val("")
			$Pcs2("#mlgnnama").val("")
			if (datas.lgnid!=undefined)
			{
				$Pcs2("#mlgnid").val(datas.lgnid)
				$Pcs2("#mlgnnama").val(datas.lgnnama)
				buatlaporan()
			}
		})
		
    });
	function buatlaporan(ngeprint, excel)
	{
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()
			mrute=$Pcs2("#mlgnid").val()
			mjnsbayar=$Pcs2("#mjnsbayar").val()
			mkasirid =$Pcs2("#mkasirid").val();
			if(!excel)
			{
				if (!ngeprint)
				{
				$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mlaplunaspiutang&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mrute="+mrute+"&mjnsbayar="+mjnsbayar+"&mksir="+mkasirid);
				}
				else
				{
				window.open("isilaporan.php?mLapo=mlaplunaspiutang&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mrute="+mrute+"&mjnsbayar="+mjnsbayar+"&isprint=YY"+"&mksir="+mkasirid);
				}
			}
			else
			{
				window.open("isilaporan.php?mLapo=mlaplunaspiutang&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mrute="+mrute+"&mjnsbayar="+mjnsbayar+"&isprint=YY"+"&mksir="+mkasirid);
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
	
</script>
</head>

<body background='images/num.jpg'>
<?php 
	require("menu.php");
?>	
	<form name='fform' id='fform'>
	<font face='Arial' color='white' >
	<div style="text-align:left;background-color:sBlue">
	<table width='100%'>
	<tr>
		<td>Tgl. 
			&nbsp;&emsp;&emsp;&emsp;&nbsp;<input type=text id=mtgl1 size=10 readonly> S.d. 
			<input type=text id=mtgl2 size=10 readonly>
		</td>
		<td align=right><a href="" id='goprint' >
			<img src="images/icon_print.png"></a>
			<a id="goprintexcel" href="">
			<img alt="" height="32" src="images/excel.png"></a>
		</td>
	</tr>
	<tr>
		<td>Pelanggan 
			: <input id="mlgnid" size="5" type="text">
			<input id="lookmlgnid" type="button" value="F5">
			<input id="mlgnnama" disabled size="45" type="text">
			
			Kasir
			: <input id="mkasirid" size="5" type="text">
			<input id="lookmkasirid" type="button" value="F5">
			<input id="mkasirnama" disabled size="45" type="text">
			
			Cara Bayar :
			<select id="mjnsbayar"> 
				<option value=''>--All--</option> 
				<option value='Tunai'>Tunai</option> 
				<option value='Transfer'>Transfer</option> 
				<option value='Giro'>Giro</option>
			</select>
		</td>
	</tr>
	</table>
	</form>
	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<iframe id='framehrg' width='700' height='400'></iframe>
		</center>
	</div>
	<iframe id='framelap' width='100%' height='500px' src="isilaporan.php"></iframe>

</body>
</html>