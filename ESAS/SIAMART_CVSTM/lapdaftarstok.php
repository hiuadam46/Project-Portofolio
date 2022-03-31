<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_cvstm_data',$links);
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
		buatlaporan();
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
			buatlaporan()
		})

		$Pcs2("#mtgl1").change(function(){
			buatlaporan()
		})

		$Pcs2("#mtgl2").change(function(){
			buatlaporan()
		})

		$Pcs2("#msupid").change(function(){
			buatlaporan()
		})

		$Pcs2("#mgrpid").change(function(){
			buatlaporan()
		})
		
		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
		})
		$Pcs2("#goprintexcel").click(function()
		{
			buatlaporan(true, true);
		})
		$Pcs2("#mlokid").click(function(){
			buatlaporan()
		})
		
    });
	function buatlaporan(ngeprint,excel)
	{
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()
			msupid=$Pcs2("#msupid").val()
			mgrpid=$Pcs2("#mgrpid").val()
			mlokid=$Pcs2("#mlokid").val()
			msaldo=$Pcs2("#mqty").val()
			if(!excel)
			{
				if (!ngeprint)
				{
				$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mdfs&mtg1="+mtgl1+"&mtg2="+mtgl2+"&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo)
				}
				else
				{
				window.open("isilaporan.php?mLapo=mdfs&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo)
				}
			}
			else
			{
				window.open("isilaporan.php?mLapo=mdfs&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY&msupid="+msupid+"&mgrpid="+mgrpid+"&mlokid="+mlokid+"&msaldo="+msaldo)
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
	<div>
	<table width='100%' id="tabelhead">
	<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly> S.d. <input type=text id=mtgl2 size=10 readonly>
	&nbsp;&nbsp;Suplier
	<?php
	
	 combobox("select a misi, a mtampil from temporer union select supid misi,supnama mtampil from setsup order by misi","msupid");
	 echo "&nbsp;&nbsp;Brand";
	 combobox("select a misi, a mtampil from temporer union select grpid misi,grpnama mtampil from setgrp order by misi","mgrpid");
	 echo "&nbsp;&nbsp;Lokasi";
	 combobox("select a misi, a mtampil from temporer union select lokid misi,loknama mtampil from setlok order by misi","mlokid");
	 ?>
	 Saldo QTY <select id='mqty'>
	 <option value='Semua'>Semua Stok</option>
	 <option value='Minimal'>Minimal</option>
	 <option value='Saldo'>Yang ada saldonya</option>
	 </select>
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
	<iframe id='framelap' width='100%' height='500px' src="isilaporan.php"></iframe>

</body>
</html>