<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Laporan Absensi</title>
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
		$Pcs2("#setper").html("<font size=3><i>Laporan Absensi</font></i>")
		$Pcs2("#mtgl1").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		$Pcs2("#mtgl2").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		buatlaporan();
		$Pcs2("#headertrans").html("<b>Laporan Absensi")
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
		
		$Pcs2("#mkarid").change(function(){
			buatlaporan()
		})


		$Pcs2("#setper").css({
		'width': mws-410+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
		});

		$Pcs2(document).keyup(function() {
			alert(Event.element(event))
			tabOnEnter (mmf2, event);
		})
		
	});
	function buatlaporan(ngeprint)
	{
			mtgl1=$Pcs2("#mtgl1").val()
			mtgl2=$Pcs2("#mtgl2").val()
			mkarid=$Pcs2("#mkarid").val()
			
			if (!ngeprint)
			{
			$Pcs2("#framelap").attr("src","isilaporan.php?mLapo=mlapabsensi&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mkarid="+mkarid)
			}
			else
			{
			window.open("isilaporan.php?mLapo=mlapabsensi&mtg1="+mtgl1+"&mtg2="+mtgl2+"&mkarid="+mkarid+"&isprint=YY")
			}
	}
    </script>
    <script type="text/javascript">

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
	<table width='100%'>
	<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. <input type=text id=mtgl1 size=10 readonly>-<input type=text id=mtgl2 size=10 readonly>
	Grup : 
	<?php
		combobox("select '' misi,'' mtampil union select grup misi,grup mtampil from setkaryawan group by misi order by misi","mkarid")
	?>
	Bagian : 
	<?php
		combobox("select '' misi,'' mtampil union select bagian misi,bagian mtampil from setkaryawan group by misi order by misi","mbagian")
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