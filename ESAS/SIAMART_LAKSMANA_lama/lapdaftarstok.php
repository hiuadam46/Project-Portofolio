<?php 

ob_start("ob_gzhandler");
session_start();

$linksa=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_laksmana_data',$linksa);
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
    <title>Daftar Stok</title>
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
		//buatlaporan();
		$Pcs2("#headertrans").html("<b>Daftar Stok")
		$Pcs2("#mtgl1").datepicker({dateFormat: 'dd-mm-yy'});
		$Pcs2("#mtgl2").datepicker({dateFormat: 'dd-mm-yy'});

		var mws=screen.width
  
		$Pcs2("#framelap").css({
		'width': mws-25+'px',
		});

		$Pcs2("#tabelhead").css({
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

		$Pcs2("#mlsup").click(function(){
			bukasuplier()
		})
		
		$Pcs2("#mqty").change(function(){
			//buatlaporan()
		})

		$Pcs2("#mtgl1").change(function(){
			//buatlaporan()
		})

		$Pcs2("#mtgl2").change(function(){
			//buatlaporan()
		})

		$Pcs2("#msupid").change(function(){
			//buatlaporan()
		})

		$Pcs2("#mgrpid").change(function(){
			//buatlaporan()
		})
		
		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
		})

		$Pcs2("#btnref").click(function(){
			buatlaporan()
		})

	$Pcs2("#msupid").blur(function() {
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setsup","*","supid='"+this.value+"'")
		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		if (datas.supid!=undefined)
		{
		$Pcs2("#msupid").val(datas.supid)
		$Pcs2("#msupnama").val(datas.supnama)

		}
	})
		
	$Pcs2("#mgrpid").blur(function() {
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setgrp","*","grpid='"+this.value+"'")
		$Pcs2("#mgrpid").val("")
		$Pcs2("#mgrpnama").val("")
		if (datas.grpid!=undefined)
		{
		$Pcs2("#mgrpid").val(datas.grpid)
		$Pcs2("#mgrpnama").val(datas.grpnama)

		}
	})

	
    });
	function buatlaporan(ngeprint)
	{
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()
			msupid=$Pcs2("#msupid").val()
			mgrpid=$Pcs2("#mgrpid").val()
			mlokid=$Pcs2("#mlokid").val()
			msaldo=$Pcs2("#mqty").val()
			if (!ngeprint)
			{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mdfs&mtg1="+mtgl1+"&mtg2="+mtgl2+"&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo)
			}
			else
			{
			window.open("isilaporan.php?mLapo=mdfs&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo)
			}
	}
    </script>
    <script type="text/javascript">

	function bukasuplier()
	{
		mcomm="Select rpad(supid,12,' ') Kode,left(supnama,50) Nama from setsup where true"
		mordd="Kode"
		mffff=" concat(supid,supnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msupid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	}

	function bukagrup()
	{
		mcomm="Select rpad(grpid,12,' ') Kode,left(grpnama,50) Nama from setgrp where true"
		mordd="Kode"
		mffff=" concat(grpid,grpnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mgrpid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
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
	<div>
	<table width='100%' id="tabelhead">
	<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly> S.d. <input type=text id=mtgl2 size=10 readonly>
	&nbsp;&nbsp;Suplier
	<input type=text  size=5 id='msupid'><input type=button id=lookmsupid value='F5' onclick='bukasuplier()' ><input type=text id=msupnama size=25 disabled>
	&nbsp;&nbsp;Grup
	<input type=text  size=5 id='mgrpid'><input type=button id=lookgrpid value='F5' onclick='bukagrup()' ><input type=text id=mgrpnama size=25 disabled>
	<?php
	
	 echo "&nbsp;&nbsp;Lokasi";
	 combobox("select a misi, a mtampil from temporer union select lokid misi,loknama mtampil from setlok order by misi","mlokid");
	 ?>
	 Saldo QTY <select id='mqty'>
	 <option value='Semua'>Semua Stok</option>
	 <option value='Minimal'>Minimal</option>
	 <option value='Saldo'>Yang ada saldonya</option>
	 </select>
	</td>
	<td align=right><a href="" id='goprint' >	 
	<img src="images/icon_print.png"></a>
	</td>
	</tr>
	<tr>
	<td colspan=2 align=center bgcolor=yellow>
	<input type=button value='REFRESH DATA' id='btnref'>
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