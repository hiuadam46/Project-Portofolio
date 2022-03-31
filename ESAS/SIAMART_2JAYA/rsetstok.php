<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Stok</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>  
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script src="js/jquery.corner.js"></script>			
    <script type="text/javascript">

	var $Pcs2 = jQuery.noConflict();
	var dialogisopen=false;
	var mvv=15;
	var mws=screen.width
	var mtable1foc='12_1'

  $Pcs2(document).ready(function(){

	$Pcs2("#setper").html("<font size=3><i>Stok</font></i>")

	refreshgrid()
		
    $Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	show: false,
	hide: false,
	dragable: true,
	width : 800,	
	});
	
	
//	$Pcs2("#setper").css({
//	'width': mws-410+'px',
//	'height': '19px',
//	'line-height':'19px',
//	'font-size':'12',
//	});


	$Pcs2("#fform").keydown(function() {
	
		mmf2=event.element(event);
		mmid=mmf2.id
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
		tabOnEnter (mmf2, event);
		}
	})

	
	$Pcs2("#fsetstok").keydown(function() {	
		mmf2=event.element(event);
		tabOnEnter (mmf2, event);
	})

	$Pcs2("#mcari").keyup(function() {	
	refreshgrid()
	})
	
	$Pcs2("#tcetakb").click(function() {
		window.open("printbarcode.php")
	})

	$Pcs2("#tcetak").click(function() {
	window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setkaryawan&detitle=Master Karyawan/Sales<br>")
	})
	
	$Pcs2("#btnkeluar").click(function() {
		$Pcs2("#kotakdialog2").dialog('close');
	})
	
	})
	
///awal functions
	function ambilprint(theid)
	{
		maa=theid.id.substr(2,10)
		mbb='12'+maa
		mid=$Pcs2("#"+mbb).val()
		if (theid.checked)
		{ execajaxa("update setkaryawan set print=1 where karid='"+mid+"'") }
		else
		{ execajaxa("update setkaryawan set print=0 where karid='"+mid+"'") }
	}

	function chkalls(theid)
	{

	if (theid.checked)
		{ 
		$Pcs2(".chkhk").prop('checked','true')
		execajaxa("update setkaryawan set print=1") 
		}
		else
		{ 
		$Pcs2(".chkhk").prop('checked','')
		execajaxa("update setkaryawan set print=0") 
		}
	}
	
	function arah(theid)
	{

			mname=theid.id;
			mtable1foc=mname
			mlg=mname.indexOf("_")
			msatu=mname.substr(mlg+1,1000)
			mdua=mname.substr(0,mlg)
			$Pcs2(".thebodiv").css("background-color","transparent")
			$Pcs2(".rcell").css("background-color","transparent")


				mggg=theid
				if (mggg.type!='button' && mggg.type!='checkbox')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			if (event.keyCode==13)
			{
				$Pcs2("#buka").click()
			}
			if (event.keyCode==39)
			{

				mggg=getNextElement(theid)
				if (mggg.type!='button')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				mggg.focus()
				mggg.select()
				mtable1foc=mggg.id
			}
			
			if (event.keyCode==37)
			{

				mjjj=getPrevElement(theid)
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				mjjj.focus()
				mjjj.select()
				mtable1foc=mjjj.id
				
			}
			
			if (event.keyCode==38)
			{

				mbawah=parseInt(msatu)-1
				mjjj=document.getElementById(mdua+'_'+mbawah)
				mjjj.focus()
				mjjj.select()
				mtable1foc=mjjj.id

				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
			}
			if (event.keyCode==40)
			{
				mjjjd=$Pcs2("#tabjumlah").val()
				mbawah=parseInt(msatu)+1
				document.getElementById(mdua+'_'+mbawah).focus()
				document.getElementById(mdua+'_'+mbawah).select()
				mtable1foc=mdua+'_'+mbawah
				mjjj=document.getElementById(mdua+'_'+mbawah)
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				$Pcs2("#bodiv_"+mbawah).css("background-color","yellow")
			}
			
	}
		
	function refreshgrid()
	{

		mser="&mfilt="+$Pcs2("#mcari").val();
		$Pcs2.ajax({
		type:"POST",
		url:"grids/gridsetstok.php",
		data : "mTform=setkaryawan"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
			//$Pcs2("#"+mtable1foc).focus()
		}});

	}
	
/////akhir function	
</script>
</head>

<body background='images/num.jpg' style='font-size:90%;font-family:arial'>
<?php 
	require("menu.php");
?>
	<form name='fform' id='fform'>
	
	<font face='arial' color='white'><b>
	<table width=100%>
	
	<tr>
	<td>Cari </td><td>:<input type='text' id='mcari' size=50></td>
	</tr>

	</table>
	</font>
	<span id='spantabel'>
	</span>	
		
	<div id='tombols' style="position:Relative;left:5px">
	<hr>
	<input type='button' id="bCari" value="F1 = Cari" >&nbsp;&nbsp;
	<input type='button' id="buka" value="F2/Enter = Edit" >&nbsp;&nbsp;
	<input type='button' id="tambah" value="F3 = Baru" >&nbsp;&nbsp;
	<input type='button' id="tcetak" value="F7 = Print" >&nbsp;&nbsp;
	<input type='button' id="tcetakb" value="Print Barcode" >&nbsp;&nbsp;	
	<input type='button' id="tkeluar" value="Tutup" >
	</div>
	</form>

</body>
</html>