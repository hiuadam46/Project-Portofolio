<?php 

ob_start("ob_gzhandler");
session_start();

$linksa=mysql_connect('localhost','esae1797_admin','+FeBJfl6&G]u') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('esae1797_pancurmas',$linksa);
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
    <title>Retur Pembelian</title>
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
		$Pcs2("#headertrans").html("<b>Penbelian")
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

		$Pcs2("#mlsup").click(function(){
			bukaSuplier()
		})

	$Pcs2("#msupid").blur(function() {
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setsup","supid,supnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","supid='"+this.value+"'")

		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		if (datas.supid!=undefined)
		{
		$Pcs2("#msupid").val(datas.supid)
		$Pcs2("#msupnama").val(datas.supnama)
		}
		buatlaporan()

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

		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
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
	
	function buatlaporan(ngeprint)
	{
			asd=$Pcs2("#msupid").val()			
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()

			if (!ngeprint)
			{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mlapreturbeli&mtg1="+mtgl1+"&mtg2="+mtgl2+"&msupid="+asd)
			}
			else
			{
			window.open("isilaporan.php?mLapo=mlapreturbeli&mtg1="+mtgl1+"&mtg2="+mtgl2+"&isprint=YY"+"&msupid="+asd)
			}

	}
    </script>
    <script type="text/javascript">

	function arah(theid)
	{
		$Pcs2("#row"+theid.id).css("background-color","yellow")
		buatlaporan(false)
	}

	
	function bukaSuplier()
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
	<td align=right><a href="" id='goprint' > <img src="images/icon_print.png"></a> </td>
	</tr>

	<tr>
	<td>Suplier : <input type=text id=msupid size=8><input type='button' id=mlsup value='F5'><input type=text id=msupnama readonly>

</td>
	</tr>	
	
	</table>

	
	</form>
	<iframe id='framelap' width='100%' height='450px' src="isilaporan.php"></iframe>

	<div id="kotakdialog2" title="Lookup Suplier">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></td></tr>
		</center>
	</div>	
	
</body>
</html>