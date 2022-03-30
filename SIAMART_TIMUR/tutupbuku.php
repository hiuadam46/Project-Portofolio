<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_timur_data',$links);
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
    <title>Tutup Buku</title>
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

		$Pcs2("#btnproses").click(function(){
			amm=confirm("Yakin Tutup Buku Bulan ini ?")
			if (amm)
			{
			$Pcs2("#framelap").attr("src","prosestutupbuku.php")
			}
			else
			{
			window.close()
			}
		})
		

		
    });
	
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
	$nnn=execute("select date_format(tgl,'%M %Y') tgl from periode ");
	$mperiode=$nnn[tgl];
?>	
	<form name='fform' id='fform'>
	<font face='Arial' color='white' >
	<div>
	<table width='100%' id="tabelhead">
	<tr>
	<td align=center><font size=10>Periode  <?php echo $mperiode; ?></font> Yakin anda akan melakukan proses tutup buku sekarang ?
	<br><font size=10><input type=button id='btnproses' value='Proses...' style='fontSize:10'>
	</td>
	</tr>
	</table>
	</form>
	<iframe id='framelap' width='100%' height='500px' src="isilaporan.php"></iframe>

</body>
</html>