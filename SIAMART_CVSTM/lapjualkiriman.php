<?php 

ob_start("ob_gzhandler");
session_start();

$linksa=mysql_pconnect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_cvstm_data',$linksa);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$linksa) or die ("");
$rrwx=mysql_fetch_object ($resultx);
if ($rrwx->id=='')
{
echo "<script> window.location='index.php' </script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Penjualan</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
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
		$Pcs2("#headertrans").html("<b>Penjualan")
		$Pcs2("#mtgl1").datepicker({dateFormat: 'dd-mm-yy'});
		$Pcs2("#mtgl2").datepicker({dateFormat: 'dd-mm-yy'});

	$Pcs2("#framelap").css({
	'width': mws-25+'px',
	});
		
        $Pcs2("#kotakdialog2").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 800,	
		  });

		$Pcs2("#mllgn").click(function(){
			bukapelanggan()
		})

	$Pcs2("#mlgnid").blur(function() {
		datas=taptabel("setlgn","golongan,lgnid,plafon,lgnnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","lgnid='"+this.value+"'")
		$Pcs2("#mlgnid").val("")
		$Pcs2("#mlgnnama").val("")
		if (datas.lgnid!=undefined)
		{
		$Pcs2("#mlgnid").val(datas.lgnid)
		$Pcs2("#mlgnnama").val(datas.lgnnama)
		}
		buatlaporan()
	})
	
	$Pcs2("#msalesid").blur(function() {
		msalesid=$Pcs2("#msalesid").val()
		dasales=taptabel("setkaryawan","karid,karnama","karid = '"+msalesid+"'")
		$Pcs2("#msalesid").val("")
		$Pcs2("#msalesnama").val("")
		if (dasales.karid!=undefined)
		{
			$Pcs2("#msalesid").val(dasales.karid)
			$Pcs2("#msalesnama").val(dasales.karnama)
		}
		buatlaporan()
	})

	$Pcs2("#mlsales").click(function() {
		mcomm="Select rpad(karid,12,' ') Kode,left(karnama,50) Nama  from setkaryawan where true"
		mordd="Kode"
		mffff=" concat(karid,karnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msalesid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
		$Pcs2("#chkall").click(function(){
			mpilih=$Pcs2("#chkall").attr('checked')
			alert(mpilih)
		})
		
		$Pcs2("#mtgl1").change(function(){
			buatlaporan()
		})

		$Pcs2("#mtgl2").change(function(){
			buatlaporan()
		})

		$Pcs2("#misppn").change(function(){
			buatlaporan()
		})

		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
		})
		$Pcs2("#goprintexcel").click(function()
		{
			buatlaporan(true, true);
		})
		$Pcs2(".rows").click(function(){
			arah(this.id)
		})

	});

	function alls()
	{
			mpilih=$Pcs2("#chkall").attr('checked')

			for (qt=1;qt<100;qt++)
			{
			asd2=$Pcs2("#42_"+qt).val()
			if(asd2==undefined)
			{break;}
			$Pcs2("#44_"+qt).attr('checked',mpilih)			
			}
			buatlaporan(false)
	}
	
	function buatlaporan(ngeprint,excel)
	{
			asd=$Pcs2("#mlgnid").val()			
			//mkasir=$Pcs2("#mkasir").val()
			msalesid=$Pcs2("#msalesid").val()
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()
			misppn=$Pcs2("#misppn").val()
			if (!excel)
			{
				if (!ngeprint)
				{
					$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mlapjualkiriman&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mlgnid="+asd+"&msalesid="+msalesid+"&misppn="+misppn)
				}
				else
				{
					window.open("isilaporan.php?mLapo=mlapjualkiriman&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mlgnid="+asd+"&msalesid="+msalesid+"&misppn="+misppn)
				}
			}
			else
			{
				window.open("isilaporan.php?mLapo=mlapjualkiriman&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mlgnid="+asd+"&msalesid="+msalesid+"&misppn="+misppn)
			}

	}
    </script>
    <script type="text/javascript">

	function arah(theid)
	{
		$Pcs2("#row"+theid.id).css("background-color","yellow")
		buatlaporan(false)
	}

	function bukapelanggan()
	{
		mcomm="Select rpad(lgnid,12,' ') Kode,left(lgnnama,50) Nama,rpad(golongan,12,' ') rightGol from setlgn where true"
		mordd="Kode"
		//mffff=" concat(lgnid,lgnnama,'gol:',golongan) "
		mffff=" concat(lgnid,lgnnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	}

	function bukastok()
	{
		//if ($Pcs2("#mnid").val()==''){$Pcs2("#mnid").focus();return;break;}
		$Pcs2("#framehrg").attr('src','lookstok.php?mobj=lookkrtstok')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
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
	<div style="position:relative; width:1000px;text-align:left;background-color:sBlue">
	<table width='100%'>
	<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly> S.d. <input type=text id=mtgl2 size=10 readonly></td>
	<td align=right>
		<a href="" id='goprint' > 
		<img src="images/icon_print.png"></a> 
		<a id="goprintexcel" href="">
		<img alt="" height="32" src="images/excel.png"></a>
	</td>
	</tr>

	<tr>
	<!--<td>Kasir : <input type=text id=mkasir size=8><input type='button' id=mlkasir value='F5'><input type=text id=mkasirnama readonly> -->
	<td>Sales : <input type=text id=msalesid size=8><input type='button' id=mlsales value='F5'><input type=text id=msalesnama readonly>
	Pelanggan : <input type=text id=mlgnid size=8><input type='button' id=mllgn value='F5'><input type=text id=mlgnnama readonly>
	PPN	: <select id=misppn> 
			<option value=''>Semua</option>
			<option value='PPN'>PPN</option>
			<option value='Non PPN'>Non PPN</option>
		</select>
	</td>
	</tr>	
	
	</table>

	
	</form>
	<iframe id='framelap' width='100%' height='450px' src="isilaporan.php"></iframe>

	<div id="kotakdialog2" title="Lookup pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></td></tr>
		</center>
	</div>	
	
</body>
</html>