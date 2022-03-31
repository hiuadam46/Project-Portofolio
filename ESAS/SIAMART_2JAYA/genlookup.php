<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Lookup</title>
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script type="text/javascript">

var $Pcs2 = jQuery.noConflict();
var dialogisopen=false;
var mvv=15;
var mws=screen.width
var mobj='<?php echo $mobj; ?>'
var mad="asc"
var mcomm=parent.mcomm
var mordd=parent.mordd
var mffff=parent.mffff
var mha = parent.mha
var msatuan = parent.msatuan
var mgolongan = parent.mgolongan
var maww=0

$Pcs2(document).ready(function()
{
	$Pcs2("#setper").html("<font size=3><i>Pembelian</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	baru();
	
	$Pcs2("#kotakdialog2").dialog(
	{
		autoOpen: false,
		modal: true,
		show: false,
		hide: false,
		dragable: true,
		width : 800,
	});
	
	$Pcs2("#setper").css(
	{
		'width': mws-665+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
	});
	
	//$Pcs2(document).keydown(function()
	$Pcs2(document).keyup(function()
	{
		if (event.keyCode==27)
		{
			parent.$Pcs2("#kotakdialog2").dialog('close');
			parent.$Pcs2("#"+mobj).focus();
		}
	})
	
	$Pcs2(document).keypress(function()
	{
		mmv=event.keyCode
		if (mmv==115&&(mordd=='stoid'||mordd=='stonama'))
		{
			window.parent.arahsatuan(1)
			arahsatuan(1);
		}
		
		if (mmv==114&&(mordd=='stoid'||mordd=='stonama'))
		{
			window.parent.arahsatuan(2)
			arahsatuan(2)
		}
	});
	
	//$Pcs2("#fform").keydown(function()
	$Pcs2("#fform").keyup(function()
		{
		mmf2=event.element(event);
		mmid=mmf2.id
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
			//tabOnEnter (mmf2, event);
		}
	})
	
	$Pcs2("#tcari").keyup(function()
	{
		if(event.keyCode==40 || event.keyCode==13)
		{
			$Pcs2("#11_1").focus()
		}
		else
		{
			maww=0;
			refreshgrid2(true)
		}
	})
	
	$Pcs2("#tcari").keypress(function()
	{
		if(event.keyCode==40)
		{
			refreshgrid2(false)
		}
	})
	
	$Pcs2("#mlsup").click(function()
	{
		bukasuplier();
	})
});

///awal functions
function arahharga(theid,golikut)
{
	if (theid==2)
	{
		if(mgolongan=='' && golikut==undefined)
		{
			mharga=1
		}
		if(mgolongan=='B' && golikut==undefined)
		{
			mharga=4
		}
		if(mgolongan=='A' && golikut==undefined)
		{
			mharga=1
		}
	}
	
	if (theid==3 || theid=='')
	{
		if(mgolongan=='' && golikut==undefined)
		{
			mharga=3
		}
		if(mgolongan=='B' && golikut==undefined)
		{
			mharga=5
		}
		if(mgolongan=='A' && golikut==undefined)
		{
			mharga=2
		}
	}
	
	if (mharga==1)
	{
		mharga=''
	}
	
	query1="select left(a.stoid,10) K, left(a.barcode,15) Barc, left(a.stonama,30) Nama, left(format(a.hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0),12) rightHarga, 'L001' QSALDO, stoid from setstok a "
	query2=" where true "
	mcomm=query1+query2
	
	refreshgrid()
}

function arahsatuan(theid)
{
	//$Pcs2("#btnpartai").css("color","black")
	//$Pcs2("#btnecer").css("color","black")
	msatuan=theid
	//alert(msatuan);
	if (theid==1)
	{
		arahharga(2)
		//$Pcs2("#btnpartai").css("color","red")
	}
	
	if (theid==2)
	{
		arahharga(3)
		//$Pcs2("#btnecer").css("color","red")
	}
}

function arah(theid)
{
	mdda=theid.id.substr(0,2)
	mmdb=theid.id.replace(mdda,'12')
	miis=$Pcs2("#"+mmdb).val()
	$Pcs2("#mkunci").val(miis)
	
	mname=theid.id;
	mlg=mname.indexOf("_")
	msatu=mname.substr(mlg+1,1000)
	mdua=mname.substr(0,mlg)
	$Pcs2(".thebodiv").css("background-color","white")
	$Pcs2(".rcell").css("background-color","white")
	
	mggg=theid
	if (mggg.type!='button')
	{
		$Pcs2("#"+mggg.id).css("background-color","lightblue")
	}
	mlg=mggg.id.indexOf("_")
	msatu=mggg.id.substr(mlg+1,1000)
	$Pcs2("#bodiv_"+msatu).css("background-color","red")
	
	if (event.keyCode==13)
	{
		parent.$Pcs2("#kotakdialog2").dialog("close");
		mhhh=theid.id.substr(0,2)
		mffa=theid.id.replace(mhhh,'12')
		mff=$Pcs2("#mkunci").val()
		parent.$Pcs2("#"+mobj).val(mff)
		parent.$Pcs2("#"+mobj).select()
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
		$Pcs2("#bodiv_"+msatu).css("background-color","red")
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
		//mlg=mjjj.id.indexOf("_")
		msatu=mjjj.id.substr(mlg+1,1000)
		$Pcs2("#bodiv_"+msatu).css("background-color","red")
		mjjj.focus()
		mjjj.select()
	}
	
	if (event.keyCode==38)
	{
		mjjjd=$Pcs2("#tabjumlah").val()
		mbawah=parseInt(msatu)-1
		if (mbawah<1)
		{
			mgggg="#11_1"
			maww=$Pcs2(mgggg).val()
			maww=maww.replace('.','')
			maww=toval(maww)-51
			if (maww<0)
			{return;}
			refreshgridx()
			return;
		}
		
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
		$Pcs2("#bodiv_"+msatu).css("background-color","red")
	}
	if (event.keyCode==40)
	{
		mjjjd=$Pcs2("#tabjumlah").val()
		mbawah=parseInt(msatu)+1
		if (mbawah>50)
		{
			mgggg="#11_"+theid.id.substr(3,100)
			maww=$Pcs2(mgggg).val()
			maww=maww.replace('.','')
			refreshgrid()
			return;
		}
		
		document.getElementById(mdua+'_'+mbawah).focus()
		document.getElementById(mdua+'_'+mbawah).select()
		mjjj=document.getElementById(mdua+'_'+mbawah)
		if (mjjj.type!='button')
		{
			$Pcs2("#"+mjjj.id).css("background-color","lightblue")
		}
		$Pcs2("#bodiv_"+mbawah).css("background-color","red")
	}
}

function refreshgrid(mnot)
{
	mggg=" like '!!"+$Pcs2("#tcari").val()+"!!'"
	
	mcomm2=mcomm+" and ( "+mffff+mggg+") "
	
	if (mordd=='stoid' && $Pcs2("#tcari").val()!='')
	{
		mordd='stonama'
	}
	
	$Pcs2.ajax(
	{
		//type:"POST",
		cache : true,
		context: document.body,
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		//type : 'GET',
		url:"grids/gridgenlookup.php",
		data : "msqq="+mcomm2+"&morder="+mordd+"&mad="+mad+"&tcar="+$Pcs2("#tcari").val()+"&maww="+maww,
		async: true,
		success : function(data)
		{
			$Pcs2("#spantabel").html(data)
			if (mnot==undefined)
			{
				$Pcs2("#11_1").focus()
			}
		}
	});
}

function refreshgrid2(mnot)
{
	mcomm2=mcomm+" and "+mffff+" like '!!"+$Pcs2("#tcari").val()+"!!'"
	
	if (mordd=='stoid' && $Pcs2("#tcari").val()!='')
	{
		mordd='stonama'
	}
	
	$Pcs2.ajax(
	{
		type:"POST",
		cache : true,
		context: document.body,
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridgenlookup.php",
		data : "msqq="+mcomm2+"&morder="+mordd+"&mad="+mad+"&tcar="+$Pcs2("#tcari").val()+"&maww="+maww,
		async: true,
		success : function(data)
		{
			$Pcs2("#spantabel").html(data)
			if (mnot==true)
			{
				$Pcs2("#tcari").focus()
			}
			if (mnot==false)
			{
				$Pcs2("#11_1").focus()
			}
		}
	});
}

function refreshgridx()
{
	mcomm2=mcomm+" and "+mffff+" like '!!"+$Pcs2("#tcari").val()+"!!'"
	
	if (mordd=='stoid' && $Pcs2("#tcari").val()!='')
	{
		mordd='stonama'
	}
	
	$Pcs2.ajax(
	{
		type:"POST",
		cache : true,
		context: document.body,
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridgenlookup.php",
		data : "msqq="+mcomm2+"&morder="+mordd+"&mad="+mad+"&tcar="+$Pcs2("#tcari").val()+"&maww="+maww,
		async: true,
		success : function(data)
		{
			$Pcs2("#spantabel").html(data)
			mddd=(maww+50)
			if (mddd>50)
			{
				mddd=50
			}
			$Pcs2("#11_"+mddd).focus()
		}
	});
}

function focuskan()
{
	$Pcs2("#11_1").focus()
}

function baru(mgdn)
{
	refreshgrid(true);
	$Pcs2("#tcari").focus();
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

function urutkan(theid)
{
	mmid=theid.id
	mval=theid.value
	if (mval=='-')
	{
		mordd=mmid
		mad="asc"
	}
	if (mval=='^')
	{
		mordd=mmid
		mad="asc"
	}
	if (mval=='v')
	{
		mordd=mmid
		mad="desc"
	}
	refreshgrid()
}
/////akhir function
</script>
</head>

<body style="font-size: 90%; font-family: arial; background-image: url('images/num.jpg')">

<?php 
require("utama.php");
?>
<form id="fform" name="fform">
	<table width="100%">
		<tr>
			<td colspan="3"><label style="color: white">Cari : </label>
			<input id="tcari" size="40" type="text"></td>
		</tr>
		<tr>
			<td colspan="1"><b style="color: black; font-family: Arial">
			<span id="spantabel"></span></b></td>
		</tr>
	</table>
	<input id="mkunci" readonly size="1" type="text">
</form>

</body>

</html>
