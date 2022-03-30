<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_laksmana_data',$links);
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
    <title>Kartu Stok</title>
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
		$Pcs2("#headertrans").html("<b>Kartu Stok")
		$Pcs2("#mtgl1").datepicker({dateFormat: 'dd-mm-yy'});
		$Pcs2("#mtgl2").datepicker({dateFormat: 'dd-mm-yy'});
		$Pcs2("#mstoid").focus()
		
        $Pcs2("#kotakdialog2").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 800,	
		  });

		$Pcs2("#mlookstok").click(function(){
			bukastok()
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
		
		$Pcs2("#mstoid").blur(function(){
			buatlaporan()
		})

		$Pcs2("#mlokid").change(function(){
			buatlaporan()
		})

		$Pcs2(document).keyup(function() {
			alert(Event.element(event))
			tabOnEnter (mmf2, event);
		})
		
	});
	function buatlaporan(ngeprint)
	{
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()
			mstoid=$Pcs2("#mstoid").val()
			mlokid=$Pcs2("#mlokid").val()
			
			if (!ngeprint)
			{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mkrtstok&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mstoid="+mstoid+"&mlokid="+mlokid)
			}
			else
			{
			window.open("isilaporan.php?mLapo=mkrtstok&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&mstoid="+mstoid+"&lokid="+mlokid)
			}
	}
    </script>
    <script type="text/javascript">

	function bukastok()
	{
		query1="select left(a.stoid,12) stoid,a.stonama Nama from setstok a "
		query2=" where true "

		mcomm=query1+query2

		mordd="stoid "
		mffff=" stonama "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mstoid')
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
	<font face='Arial' color='black' >
	<div>
	<table width='100%'>
	<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly>-<input type=text id=mtgl2 size=10 readonly>
	Stok : <input type=text id=mstoid size=8><input type='button' id=mlookstok value='F5'><input type=text id=mstonama readonly>
	Lokasi : 
	<?php
		combobox("select a misi,a mtampil from temporer union select lokid misi,concat(lokid,' - ',loknama) mtampil from setlok order by misi","mlokid")
	?>
	</td>
	
	<td align=right><a href="" id='goprint' > <img src="images/icon_print.png"></a> </td>
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