<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_wps_data',$links);
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
    <title>Laporan Giro</title>
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
			buatlaporan()
		})
		
		$Pcs2("#chkall").click(function(){
			mpilih=$Pcs2("#chkall").attr('checked')
		})
		
		$Pcs2("#mtgl1").change(function(){
			buatlaporan()
		})

		$Pcs2("#mtgl2").change(function(){
			buatlaporan()
		})

		$Pcs2("#mrekid").change(function(){
			buatlaporan()
		})

		$Pcs2("#mbankid").change(function(){
			buatlaporan()
		})

		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
		})
		$Pcs2("#goprintexcel").click(function()
		{
			buatlaporan(true, true)
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
			asd=$Pcs2("#mrekid").val()			
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()
			mbankid=$Pcs2("#mbankid").val()
			if (!excel)
			{
				if (!ngeprint)
				{
					$Pcs2("#framelap").attr("src","isilapgiro.php?mLapo=mlapgiro&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mrekid="+asd+"&mbankid="+mbankid+"&mstoid="+$Pcs2("#mstoid").val())
				}
				else
				{
					window.open("isilapgiro.php?mLapo=mlapgiro&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mrekid="+asd+"&mbankid="+mbankid+"&mstoid="+$Pcs2("#mstoid").val())
				}
			}
			else
			{
				window.open("isilapgiro.php?mLapo=mlapgiro&excel=true&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mrekid="+asd+"&mbankid="+mbankid+"&mstoid="+$Pcs2("#mstoid").val())
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
		mcomm="Select lgnid,lgnnama from setlgn where true "
		mordd="  lgnid "
		mffff=" lgnnama "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelanggan');
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
	<table width='100%' cellspacing=0 cellpadding=0>
	<tr>
	<td>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly> S.d. <input type=text id=mtgl2 size=10 readonly>
	Jenis Giro : <?php combobox("select rekid misi,reknama mtampil from setrek where reknama like '%giro%' ","mrekid"); ?>
	<?php
		$sql = "select rekid,reknama from setrek where nrcid='101'";
		$query = mysql_query($sql);
		echo '<select id="mbankid">';
		echo '<option value="">-pilih bank-</option>';
		while ($row = mysql_fetch_array($query)) 
			{ 
				echo '<option value="' . $row['rekid'] . '">' . $row['reknama'] . '</option>';
			}
		echo '</select>';
	?>

	</td>
	<td align=right>
		<a href="" id='goprint' > 
		<img src="images/icon_print.png"></a> 
		<a id="goprintexcel" href="">
		<img alt="Excel" height="32" src="images/excel.png"></a>
	</td>
	</tr>
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