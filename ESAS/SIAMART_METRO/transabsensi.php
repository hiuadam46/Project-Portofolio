<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Absensi</title>
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
	$Pcs2("#setper").html("<font size=3><i>Absensi</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#midinput").focus()
	baru()

	setInterval(function() {
	$Pcs2('#spanjam').load('phpexec.php?func=JAMDINDING&acak='+ Math.random());
	}, 1000);
		
        $Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	show: false,
	hide: false,
	dragable: true,
	width : 800,	
	});

	$Pcs2("#setper").css({
	'width': mws-410+'px',
	'height': '19px',
	'line-height':'19px',
	'font-size':'12',
	});


	$Pcs2("#midinput").keypress(function() {
		mmv=event.keyCode
		if (mmv==13)
		{
		misi=$Pcs2("#midinput").val()

		mgg=taptabel("setkaryawan","*","karid='"+misi+"'")
		mnam=mgg.karnama
		if (mnam!=undefined)
		{
			mhh=$Pcs2("#spanjam").html()
			mhh=mhh.replace('WIB','')
			mjj=mhh.substr(12,8)

			mgg=taptabel('temporer','now() jt','true limit 0,1')
			mss=mgg.jt.substr(11,10)
			mss2=mgg.jt.substr(0,10)

			$Pcs2("#status").html("Sukses ! <br> Nama : "+mnam+" <br> Jam "+mjj)
			execajaxa("insert into absensi(karid,tgl,jam) values('"+misi+"','"+mss2+"','"+mjj+"') ")

			$Pcs2("#midinput").val("")
			$Pcs2("#midinput").focus()
		}
		else
		{
			$Pcs2("#status").html("Gagal ! ")
			$Pcs2("#midinput").val("")
			$Pcs2("#midinput").focus()
		}
		}
	
	})

	$Pcs2("#fsetstok").keydown(function() {	
		mmf2=event.element(event);
		tabOnEnter (mmf2, event);
	})
	
	$Pcs2("#tcetakb").click(function() {
		window.open("printbarcode.php")
	})

	$Pcs2("#btnkeluar").click(function() {
		$Pcs2("#kotakdialog2").dialog('close');
	})
	
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog2").dialog("isOpen");
			if (mopp){return};
			
			fil='12'+mtable1foc.substr(2,10)
			$Pcs2("#kotakdialog2").dialog('open');
			misi=$Pcs2("#"+fil).val()
			mf=$Pcs2("#karid")
			mf.val(misi);
			
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setkaryawan&kondisi=(karid='"+misi+"')",
			dataType:'json',
			success: function(data){
			
				$Pcs2("#karnama").val(data['karnama'])
				$Pcs2("#alamat").val(data['alamat'])
				$Pcs2("#telp").val(data['telp'])
				$Pcs2("#jabatan").val(data['jabatan'])
				$Pcs2("#ket").val(data['ket'])
			
			}
			});
			mf.focus();mf.select();
	    });

        $Pcs2("#tambah").click(function() {

	$Pcs2("#kotakdialog2").dialog('open');
	fsetstok.reset();
	datas=taptabel("setkaryawan","karid","1=1 order by karid desc limit 1");
	data=datas.karid;
	if (data!=undefined)
	{
	mmsupid=data.substr(0,3);
	//alert(mmsupid);
	mmsupid=parseFloat(mmsupid);
	//alert(mmsupid);
	mmsupid=mmsupid+1;
	mmsupid=''+mmsupid
	mmsupid=''+padl(mmsupid,'0',3);
	}
	else
	{
	mmsupid='001';
	}
	$Pcs2("#karid").val(mmsupid)
	$Pcs2("#karnama").select()

	})


        $Pcs2("#btnsimpan").click(function() {

	maj=document.getElementById("karid")
	msu=$Pcs2("#karid").val()
	execajaxas("delete from setkaryawan where karid='"+msu+"'")
	execajaxas("insert into setkaryawan (karid) values('"+msu+"')")

	for (var mii=1;mii<30;mii++)
	{
		maj=getNextElement(maj)
		mtp=maj.type
		if (mtp=='text')
		{
			mfieldna=maj.id.substr(0,100)
			execajaxa("update setkaryawan set "+mfieldna+"='"+maj.value+"' where karid='"+msu+"'")
			
		}
	}
	alert("Data Tersimpan !")	
	$Pcs2("#kotakdialog2").dialog('close');
	refreshgrid()
	return;	
	
	})

        $Pcs2("#btnhapus").click(function() {
	refreshgrid()
	var conf=window.confirm("Hapus Transaksi ?")
	if (conf==false){return}
	maj=document.getElementById("karid")
	msu=$Pcs2("#karid").val()
	execajaxas("delete from setkaryawan where karid='"+msu+"'")
	$Pcs2("#kotakdialog2").dialog('close');
	mtable1foc='12_1'
	refreshgrid()
	return;	

	})
	
	});

///awal functions
	
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
				if (mggg.type!='button')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			if (event.keyCode==13 || event.keyCode==39)
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
		

	function bukasuplier()
	{
		$Pcs2("#framehrg").attr('src','looksup.php?mobj=lookdfhutang')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Karyawan/Sales');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	}

	function refreshgrid()
	{

		mser="&mfilt="+$Pcs2("#mcari").val();
		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"3grid2.php",
		data : "mTform=setkaryawan"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
			$Pcs2("#"+mtable1foc).focus()
		}});

	}

	function baru(mgdn)
	{
		mstoksat="";
		$Pcs2("#mtgl").val(tglsekarang());
		$Pcs2("#mnid").val('');
		$Pcs2("#mfakturid").val('');
		$Pcs2("#msupid").val('');
		$Pcs2("#msupnama").val('');
		$Pcs2("#mket").val('');
		$Pcs2("#mtunaikredit").val(1);
		$Pcs2("#mtotal").val(0);
		$Pcs2("#mfakturid").select();
		$Pcs2("#mtgljt").val('');

		datas=taptabel("transbeli1","nid","1=1 order by nid desc limit 0,1")
		data=datas.nid;
			
			if (data!=undefined)
			{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='TB'+padl(mmmerkid,'0',7);
			}
			else
			{
			mmmerkid='TB0000001';
			}
			$Pcs2("#mnid").val(mmmerkid);
			execajaxa("delete from transbeli1 where nid='"+mmmerkid+"'")
			execajaxa("delete from transbeli2 where nid='"+mmmerkid+"'")
			execajaxa("delete from bkbesar where nid='"+mmmerkid+"'")
			refreshgrid()
				
	}

	function ambilstok(theid)
	{
		mmid=theid.id
		rownama=mmid.replace('12','13')
		rowsat1=mmid.replace('12','15')
		rowsat2=mmid.replace('12','17')
		rowsat3=mmid.replace('12','19')

		$Pcs2("#"+rownama).val("")
		misi=theid.value
		mstok=taptabel("setstok","stonama,satuan1,satuan2,satuan3","stoid='"+misi+"'")

		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)
		$Pcs2("#"+rowsat2).val(mstok.satuan2)
		$Pcs2("#"+rowsat3).val(mstok.satuan3)

	}
/////akhir function	
</script>
</head>

<body background='images/num.jpg' style='font-size:90%;font-family:arial'>
<?php 
	require("menu.php");
?>
	<center>
	<br><br><br><br><br>
	<span id="spanjam" style="font-size:16pt;color:white"></span>
	<br>
	<input type=text id='midinput' style="font-size:20pt;text-align:center">
	<br>
	<hr size=4>
	<span id="status" style="font-size:26pt;color:white"></span>
	</center>
	
</body>
</html>