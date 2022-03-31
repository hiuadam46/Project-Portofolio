<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Penjualan</title>
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
	var mvv=15;
  
	$Pcs2(document).ready(function(){
		refreshgrid()
		$Pcs2("#setper").html("<font size=3><i>Penjualan</font></i>")
		$Pcs2("#mtgl1").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		$Pcs2("#mtgl2").val('<?php $mdat=date('d-m-Y'); echo $mdat; ?>')
		buatlaporan();
		$Pcs2("#headertrans").html("<b>Daftar Piutang")
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

		$Pcs2(".par").click(function(){
			refreshgrid()
		})
		$Pcs2(".par").change(function(){
			refreshgrid()
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
			mser="isilaporan.php?mLapo=lapbukujual&mt1="+baliktanggal($Pcs2("#mtgl1").val());
			mser=mser+"&mt2="+baliktanggal($Pcs2("#mtgl2").val());
			mser=mser+"&ml="+$Pcs2("#mlgnid").val();
			mser=mser+"&ms="+$Pcs2("#msupid").val();
			mser=mser+"&mk="+$Pcs2("#mstatus").val();
			mser=mser+"&me="+$Pcs2("#mkarid").val();
			mser=mser+"&mt="+$Pcs2("#mistgl").val();
			mser=mser+"&mg="+$Pcs2("#mgrpid").val();
			mser=mser+"&mm="+$Pcs2("#mmerkid").val();
			
			if (!ngeprint)
			{
			$Pcs2("#framelap").attr("src",mser)
			}
			else
			{
			window.open(mser+"&isprint=YY")
			}
	}
	
	function arah(theid)
	{
			mname=theid.id;
			mlg=mname.indexOf("_")
			msatu=mname.substr(mlg+1,1000)
			mdua=mname.substr(0,mlg)
			$Pcs2(".thebodiv").css("background-color","transparent")
			$Pcs2(".rcell").css("background-color","transparent")


				mggg=theid
				mggg.focus()
				mggg.select()
				if (mggg.type!='button')
				{
				$Pcs2("#"+mggg.id).css("background-color","orange")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			
			if (event.keyCode==13 || event.keyCode==39)
			{

				mggg=getNextElement(theid)
				mggg.focus()
				mggg.select()
				if (mggg.type!='button')
				{
				$Pcs2("#"+mggg.id).css("background-color","orange")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			}
			
			if (event.keyCode==37)
			{

				mjjj=getPrevElement(theid)
				mjjj.focus()
				mjjj.select()
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","orange")					
				}
				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			}
			
			if (event.keyCode==38)
			{

				mbawah=parseInt(msatu)-1
				mjjj=document.getElementById(mdua+'_'+mbawah)
				mjjj.focus()
				mjjj.select()
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","orange")					
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
				mjjj=document.getElementById(mdua+'_'+mbawah)
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","orange")					
				}
				$Pcs2("#bodiv_"+mbawah).css("background-color","yellow")
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

	function refreshgrid()
	{

		mser="&mt1="+baliktanggal($Pcs2("#mtgl1").val());
		mser=mser+"&mt2="+baliktanggal($Pcs2("#mtgl2").val());
		mser=mser+"&ml="+$Pcs2("#mlgnid").val();
		mser=mser+"&ms="+$Pcs2("#msupid").val();
		mser=mser+"&mk="+$Pcs2("#mstatus").val();
		mser=mser+"&me="+$Pcs2("#mkarid").val();
		mser=mser+"&mjog="+mvv;
		
		$Pcs2.ajax({
		type:"POST",
		url:"3grid.php",
		data : "mTform=mlapjual"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
		}});

	}

	function trans(mkode)
	{
		wwx=window.open("transjual.php?mnnid="+mkode)
		wwx.focus();
	}	

	function faktur(mkode)
	{
		xxw=window.open('printjual.php?mnid='+mkode,'aa',('alwaysraised=yes,scrollbars=no,resizable=no,height=550,left=200,top=10'));
		self.blur()
		xxw.focus();
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
	Tgl. <input type=text id=mtgl1  class='par' size=10 readonly title='Tgl.'> S.d. <input type=text id=mtgl2  class='par' size=10 readonly title='s.d.'>
	<?php 
	echo "<hr>";
	echo " Pelanggan ";combobox2("select '' misi,'Semua' mtampil union select lgnid misi,lgnnama mtampil from setlgn order by misi","id='mlgnid' title='Pelanggan' class='par'");
	echo " Suplier ";combobox2("select '' misi,'Semua' mtampil union select supid misi,supnama mtampil from setsup order by misi","id='msupid' title='Suplier' class='par'");
	echo " Sales ";combobox2("select '' misi,'Semua' mtampil union select karid misi,karnama mtampil from setkaryawan order by misi","id='mkarid' title='Sales' class='par'");
	?>
	 Status <select id='mstatus'  class='par'><option value='3'>Semua</option><option value='1'>Kredit</option><option value='2'>Tunai</option></select>
	</td>
	<td align=right><a href="" id='goprint' ><img src="images/icon_print.png"></a></td>
	</tr>
	</table>

	<span id='spantabel'>
	</span>
	</form>


</body>
</html>