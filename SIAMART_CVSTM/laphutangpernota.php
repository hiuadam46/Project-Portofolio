<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Nota Hutang</title>
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
		$Pcs2("#setper").html("<font size=3><i>Nota Hutang</font></i>")
		$Pcs2("#mtgl1").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		$Pcs2("#mtgl2").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		buatlaporan();
		$Pcs2("#headertrans").html("<b>Daftar Hutang")
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
		
		$Pcs2("#mtgl1").change(function(){
			buatlaporan()
		})

		$Pcs2("#mtgl2").change(function(){
			buatlaporan()
		})

		$Pcs2("#goprint").click(function(){
			buatlaporan(true)
		})

		$Pcs2(document).click(function(){
			buatlaporan()
		})

		
		var mws=screen.width

		$Pcs2("#setperxx").css({		'width': mws-665+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
		});
		
    });
	function buatlaporan(ngeprint)
	{
			mser="isilaporan.php?mLapo=mdfhnota&mt1="+baliktanggal($Pcs2("#mtgl1").val());
			mser=mser+"&mt2="+baliktanggal($Pcs2("#mtgl2").val());
			mser=mser+"&ml="+$Pcs2("#msupid").val();
			mser=mser+"&ms="+$Pcs2("#msupid").val();
			mser=mser+"&mk="+$Pcs2("#mstatus").val();
			mser=mser+"&me="+$Pcs2("#mkarid").val();
			mser=mser+"&mt="+$Pcs2("#mistgl").val();
			
			if (!ngeprint)
			{
			$Pcs2("#framelap").attr("src",mser)
			}
			else
			{
			window.open(mser+"&isprint=YY")
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
	<font face='Arial' color='white' ><b>
	<table width='100%'>
	<tr>
	<td>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly title='Tgl.'> S.d. <input type=text id=mtgl2 size=10 readonly title='s.d.'>
	= <select id='mistgl'><option value='A' title=' = '> Berdasar Tgl. Nota</option><option value='B'>Tgl. Jatuh Tempo</option></select>
	Status <select id='mstatus' title='Status'><option value='B'>Belum Lunas</option><option value='L'>Lunas</option><option value='S'>Semua</option></select>
	<hr>
	<?php 
	echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Suplier ";combobox2("select '' misi,'Semua' mtampil union select supid misi,supnama mtampil from setsup order by misi","id='msupid' title='Pelanggan'");
	?>
	</td>
	<td align=right><a href="" id='goprint' ><img src="images/icon_print.png"></a></td>
	</tr>
	</table>
	</form>
	<iframe id='framelap' width='100%' height='500px' src="isilaporan.php"></iframe>

</body>
</html>