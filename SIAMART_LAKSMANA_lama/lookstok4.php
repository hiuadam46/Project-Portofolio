<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Produksi</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frogz/ui.all.css">
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
	var mobj='<?php echo $mobj; ?>'

  $Pcs2(document).ready(function(){
	$Pcs2("#setper").html("<font size=3><i>Pembelian</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	baru()
	
        $Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	show: false,
	hide: false,
	dragable: true,
	width : 800,	
	});

	$Pcs2("#setper").css({
	'width': mws-665+'px',
	'height': '19px',
	'line-height':'19px',
	'font-size':'12',
	});

	$Pcs2(document).keydown(function() {
	if (event.keyCode==27)
	{
	parent.$Pcs2("#kotakdialog2").dialog('close');
	parent.$Pcs2("#"+mobj).focus();
	}
	
	})
	
	$Pcs2("#fform").keydown(function() {
	
		mmf2=event.element(event);
		mmid=mmf2.id
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
		tabOnEnter (mmf2, event);
		}
	})

	$Pcs2("#tcari").keyup(function() {
		refreshgrid()
	})
	
	$Pcs2("#mlsup").click(function() {
		bukasuplier();
	})
	
	});

///awal functions
	
	function arah(theid)
	{
			mname=theid.id;
			mlg=mname.indexOf("_")
			msatu=mname.substr(mlg+1,1000)
			mdua=mname.substr(0,mlg)
			$Pcs2(".thebodiv").css("background-color","transparent")
			$Pcs2(".rcell").css("background-color","transparent")


				mggg=theid
				if (mggg.type!='button')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")

			if (event.keyCode==13)
			{
				parent.$Pcs2("#kotakdialog2").dialog("close");
				mff=theid.value
				parent.$Pcs2("#"+mobj).val(mff)	
				parent.$Pcs2("#"+mobj).focus()
				parent.$Pcs2("#"+mobj).blur()
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
				
			}
			
			if (event.keyCode==38)
			{

				mbawah=parseInt(msatu)-1
				mjjj=document.getElementById(mdua+'_'+mbawah)
				mjjj.focus()
				mjjj.select()
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
				mjjj=document.getElementById(mdua+'_'+mbawah)
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				$Pcs2("#bodiv_"+mbawah).css("background-color","yellow")
			}
			
	}
		

	function bukasuplier()
	{
		$Pcs2("#framehrg").attr('src','looksup.php?mobj=lookdfhutang')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	}

	function refreshgrid()
	{

		mser="&mcari="+$Pcs2("#tcari").val();
		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridlookstok.php",
		data : "mTform=lookstok"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
		}});

	}

	function refreshgrid2()
	{

		mser="&mnid="+$Pcs2("#mnid").val();
		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridproduksi2.php",
		data : "mTform=transbeli"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
		}});

	}
	
	function baru(mgdn)
	{

	refreshgrid()
	$Pcs2("#tcari").focus()
				
	}

	function ambilstok(theid)
	{
		mmid=theid.id
		rownama=mmid.replace('12','13')
		rowsat1=mmid.replace('12','16')

		$Pcs2("#"+rownama).val("")
		misi=theid.value
		mstok=taptabel("setstok","stonama,satuan1,satuan2,satuan3","stoid='"+misi+"'")

		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)

	}

	function rumus1(theid)
	{
		mmid=theid.id
		rownama=mmid.replace('12','13')
		rowsat1=mmid.replace('12','16')

		$Pcs2("#"+rownama).val("")
		misi=theid.value
		mstok=taptabel("setstok","stonama,satuan1,satuan2,satuan3","stoid='"+misi+"'")

		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)

	}

/////akhir function	
</script>
</head>

<body background='images/num.jpg' style='font-size:90%;font-family:arial'>
<?php 
	require("utama.php");
?>
	<form name='fform' id='fform'>
	
	<table width=100%>		
	<tr>
	<td  colspan=3>Cari :<input type=text id=tcari size=30></td>
	<tr>
	<tr>
	<td colspan=1><font face='arial' color='black'><b><span id='spantabel'></span></td>
	</tr>
	</table>
	
	</form>
	
</body>
</html>