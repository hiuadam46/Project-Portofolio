<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Saldo Stok</title>
    <link rel="stylesheet" type="text/css" href="themes/sunny/ui.all.css">
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
	var mcomm
	var mordd
	var mffff
	var mstokall=''
	var mplafon=0
	
  $Pcs2(document).ready(function(){
	$Pcs2("#setper").html("<font size=3><i>Transaksi Pembelian</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Transaksi Pembelian");
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#mstoid").val(parent.$Pcs2("#mstoid").val());
	$Pcs2("#mstonama").val(parent.$Pcs2("#mstonama").val());
	var msat1=parent.$Pcs2("#msatuan1").val()
	var msat2=parent.$Pcs2("#msatuan2").val()
	var mhrgsat=parent.$Pcs2("#mhrgbeli").val()

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


	$Pcs2(document).keypress(function(){

	$Pcs2("#spanket").html("")		

	mmv=event.keyCode	
	mac=event.element(event).id ; if (event.which!=0){return;}

	if (mmv==112)
	{$Pcs2('#btnsimpan').click()}

	if (mmv==113)
	{$Pcs2('#btnbaru').click()}

	if (mmv==114)
	{$Pcs2('#btnhapus').click()}
	
	if (mmv==116)
	{$Pcs2('#look'+mac).click()}

	if (mmv==123)
	{$Pcs2('#btnkeluar').click()}
	
	
	})
	
	$Pcs2("#fform").keydown(function() {	
		mmf2=event.element(event);
		mmid=mmf2.id
		mmv=event.keyCode	
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
		tabOnEnter2 (mmf2, event);
		}

		if (mmid.substr(0,2)=='12' && (mmv==116 || (mmv==13 && mmf2.value=='') ))
		{

		query1="select stoid Kode,left(stonama,30) Nama,left(format(ifnull(b.totqty,0),00),11) rightSaldo,satuan1 'Sat.' from setstok a "
		query2="left join (select bpid,sum(qtyin-qtyout) totqty from bkbesar where rekid like '103%' group by bpid) b on a.stoid=b.bpid where true "
		mcomm=query1+query2

		mordd="Nama"
		mffff=" stonama "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		}
	})

	$Pcs2("#fform").keyup(function() {	
		mmf2=event.element(event);
		mmid=mmf2.id
		m22=mmid.substr(0,2)
		if (m22==14 || m22==15 || m22==16 || m22==17)
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
		}
		rumus1()	
	})
	
	$Pcs2("#mrekid").change(function() {
		refreshgrid2();
	})

	$Pcs2("#mstoid").blur(function() {
		//datas=taptabel("setstok","stoid,stonama","stoid='"+this.value+"'")
		datas=taptabel("setstok","stoid,plafon,stonama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","stoid='"+this.value+"'")

		$Pcs2("#mstoid").val("")
		$Pcs2("#mstonama").val("")
		if (datas.stoid!=undefined)
		{
		$Pcs2("#mstoid").val(datas.stoid)
		$Pcs2("#mstonama").val(datas.stonama)
		$Pcs2("#mjt").val(baliktanggal2(datas.jt))
		$Pcs2("#mket").focus()
		mplafon=datas.plafon
		}
	})

	$Pcs2("#mnid").blur(function() {
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transbeli1","*","nid='"+mnid+"'")
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))

			$Pcs2("#mkarid").val(mgg.karid)
			$Pcs2("#mstoid").val(mgg.stoid)
			$Pcs2("#mket").val(mgg.ket)
			$Pcs2("#mfakturid").val(mgg.fakturid)

			$Pcs2("#mkarid").blur()
			$Pcs2("#mstoid").blur()

			refreshgrid2(mgg)
			$Pcs2("#mfakturid").focus()
		}
		else
		{
			baru()
		}
		
	})
	
	$Pcs2("#lookmkarid").click(function() {
		mcomm="Select rpad(karid,12,' ') Kode,left(karnama,50) Nama,Grup,Bagian from setkaryawan where true"
		mordd="Kode"
		mffff=" concat(karid,karnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mkarid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Karyawan/Sales');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookmstoid").click(function() {
		mcomm="Select rpad(stoid,12,' ') Kode,left(stonama,50) Nama from setstok where true"
		mordd="Kode"
		mffff=" concat(stoid,stonama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mstoid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookmnid").click(function() {
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,left(concat(a.stoid,'-',stonama),30) stoklier,left(FORMAT(total,0),12) rightTotal from transbeli1 a left join setstok b on a.stoid=b.stoid where true"
		mordd="Nota"
		mffff=" concat(nid,date_format(tgl,'%d-%m-%Y'),stonama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Nota Beli');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#btnsimpan").click(function() {
		mstoid=$Pcs2("#mstoid").val()

		if (mstoid==''){
		$Pcs2("#mstoid").focus();
		return;}
			
		msql="delete from bkbesar where bpid='"+mstoid+"' and trans='SA' "
		mgp=parent.$Pcs2("#mgrpid").val()
		mrrr=taptabel("setgrp","rekid","grpid='"+mgp+"'")
		mrekid=mrrr.rekid
		misi=parent.$Pcs2("#misi").val()
			
		$Pcs2.ajax({
		type : 'POST',
		url:"phpexec.php",
		data : "func=EXECUTE&comm="+msql,
		success : function(data){

			
			mtot=0			
			for (gg=1;gg<101;gg++)
			{
			
			mnid=$Pcs2("#12_"+gg).val()
			if (mnid==undefined)
			{break;}
			
			if (mnid!='')
			{

			mtglx='2012-01-01'
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#15_"+gg).val())
			mtotqty=(mqty*misi)+munit
			mdebet=toval($Pcs2("#17_"+gg).val())
			mlokid=$Pcs2("#12_"+gg).val()
			
			msqql1="insert into bkbesar(rekid,bpid,bpid2,tgl,nid,qtyin,debet,trans,ket) "
			msqql2="values('"+mrekid+"','"+mstoid+"','"+mlokid+"','"+mtglx+"','SA',"+mtotqty+","+mdebet+",'SA','Saldo Awal')"
			execajaxas(msqql1+msqql2)
			
			
			}

			}
			
			$Pcs2("#spantabel2").load("phpexec2.php?mTransaksixx=tosald00231")
			
			alert("Data Tersimpan !")
			parent.$Pcs2("#kotakdialog2").dialog('close')
			
		}});
	})

	$Pcs2("#btnbaru").click(function() {
		baru()
	})

	$Pcs2("#btnhapus").click(function() {
		mnid=$Pcs2("#mnid").val()
		mstoid=$Pcs2("#mstoid").val()
		mrekid=$Pcs2("#mrekid").val()
		msql="delete from bkbesar where bpid='"+mstoid+"' and trans='SA' and rekid='"+mrekid+"' "
		execajaxas(msql);
		alert("Data Terhapus !")
		baru();
	})

	$Pcs2("#btnkeluar").click(function() {
		parent.$Pcs2("#kotakdialog2").dialog('close')	})
	
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
				
			
			if (event.keyCode==13 || event.keyCode==39)
			{

				mggg=getNextElement2(theid)
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

				mjjj=getPrevElement2(theid)
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
		

	function refreshgrid2(mgg)
	{
		//$Pcs2("#spantabel2").html(data)
		mser="&mstoid="+$Pcs2("#mstoid").val();
		mser=mser+"&mrekid="+$Pcs2("#mrekid").val();
		$Pcs2.ajax({
		type:"POST",
		chace : true,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		type : 'GET',
		url:"grids/gridsaldostok.php",
		data : "mTform=transbeli1"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
			$Pcs2("#12_1").select()
			msat1=parent.$Pcs2("#msatuan1").val()
			msat2=parent.$Pcs2("#msatuan2").val()
			misi=parent.$Pcs2("#misi").val()
			mhb=parent.$Pcs2("#mhrgbeli").val()
			$Pcs2("#spanq").html(msat1)
			$Pcs2("#spanu").html(msat2)
			for (eer=1;eer<100;eer++)
			{
				if ($Pcs2("#12_"+eer).val()==undefined)
				{break;}
				
				if (toval($Pcs2("#16_"+eer).val())==0)
				{
				$Pcs2("#16_"+eer).val(mhb)
				}

				mqtyy=toval($Pcs2("#14_"+eer).val())
				mqty=parseInt(mqtyy/misi)
				munit=mqtyy-(mqty*misi)
				
				$Pcs2("#14_"+eer).val(tra(mqty))
				$Pcs2("#15_"+eer).val(tra(munit))
				
			}
			rumus1()
		}});

	}
	
	function baru(mgdn)
	{
		refreshgrid2()	
		$Pcs2("#mstoid").blur()
	}

	function ambilstok(theid)
	{
		mmid=theid.id
		misi=theid.value
		
		rownama=mmid.replace('12','13')

		if (misi=='')
		{
		geserdata(theid)
		return;
		}

		if ($Pcs2("#"+rownama).val()!='')
		{
		return;
		}

		rowsat1=mmid.replace('12','15')
		rowsat2=mmid.replace('12','17')
		rowsat3=mmid.replace('12','19')
		rowsat4=mmid.replace('12','21')
		rowqty=mmid.replace('12','14')
		rowunit=mmid.replace('12','16')
		rowextra=mmid.replace('12','18')
		rowextraunit=mmid.replace('12','20')		
		rowhrg=mmid.replace('12','22')
		rownom=mmid.replace('12','11')
		rowisi=mmid.replace('12','misi')
		$Pcs2("#"+rownama).val("")
		$Pcs2("#"+rowsat1).val("")

		mnnm=toval(mmid.replace('12_',''))
		for (ggt=1;ggt<101;ggt++)
		{
		msst=$Pcs2("#12_"+ggt).val()
		mnama=$Pcs2("#13_"+ggt).val()

		if (misi!='' && ggt!=mnnm && misi==msst)
		{

		malert="STOK "+misi+" "+mnama+" SUDAH DIINPUT !"
		$Pcs2("#spanket").html(malert)		
		
		theid.value=''
		theid.focus()
		theid.select()
		$Pcs2("#"+mmid).select()
		return;

		}
		}
		
		mstok=taptabel("setstok","stonama,satuan1,satuan2,satuan3,format(hrgbeli,0) hrgbeli,isi","stoid='"+misi+"'")
		
		if (mstok.stonama!=undefined)
		{
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)
		$Pcs2("#"+rowsat2).val(mstok.satuan2)
		$Pcs2("#"+rowsat3).val(mstok.satuan1)
		$Pcs2("#"+rowsat4).val(mstok.satuan2)
		$Pcs2("#"+rowhrg).val(mstok.hrgbeli)
		$Pcs2("#"+rowisi).val(mstok.isi)	
		mnn=$Pcs2("#"+rownom).val()
		mnn=mnn.replace('.','')
		mnn=padl(mnn,'0',2)
		getNextElement2(theid).focus()
		}
		rumus1()
	}

	function geserdata(theid)
	{
	mid=theid.id
	maa=toval(mid.replace('12_',''))
	for (abc=maa;abc<101;abc++)
	{
		def=abc+1

		for (axx=12;axx<25;axx++)
		{	
		misi=$Pcs2("#"+axx+"_"+def).val()

		if (misi==undefined)
		{break;}

		$Pcs2("#"+axx+"_"+abc).val(misi)
		}
		
	}
	}
	
	function rumus1()
	{
		mj1=0
		mj2=0
		for (gg=1;gg<100;gg++)
		{
			if ($Pcs2("#12_"+gg).val()==undefined)
			{break;}
			if ($Pcs2("#12_"+gg).val()!='')
			{			

			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#15_"+gg).val())
			misi=toval(parent.$Pcs2("#misi").val())
			mhrgsat=toval($Pcs2("#16_"+gg).val())
			mjmlhrg=(mqty*mhrgsat)+(munit*(mhrgsat/misi))
			mjmlhrg=parseInt(mjmlhrg)
			$Pcs2("#17_"+gg).val(tra(mjmlhrg))
			mj1=mj1+mjmlhrg

			}
			
		}
		$Pcs2("#mtotal").val(tra(mj1))
	}
	
	function ceksaldo(theid)
	{
	mdidi=theid.id
	mqty=toval(theid.value)
	mdidi2=mdidi.replace("15","12")
	mstoid=$Pcs2("#"+mdidi2).val()
	mgh=taptabel("bkbesar","sum(qtyin-qtyout) saldo","bpid='"+mstoid+"'")
	if (mqty>mgh.saldo)
	{

		malert="Stok Tidak Mencukup ! Saldo :"+mgh.saldo
		$Pcs2("#spanket").html(malert)		
		
		theid.value=0;
		return;
	}	
	}
/////akhir function	
</script>
</head>

<body background='images/num.jpg' style='font-size:90%;font-family:arial'>
<?php 
	require("utama.php");
?>
	<form name='fform' id='fform'>
	
	<font face='arial' color='white'><b>
	<table width=100% border=0>	
	<tr>
	<td>Stok </td><td colspan=5>: <input type=text  size=5 id='mstoid' value=<?php echo $mstoid; ?>><input type=button id=lookmstoid value='F5'><input type=text id=mstonama size=45 disabled>
	</td>
	</tr>

	</table>

	<table width=100% border=0>		
	
	<tr>
	<td colspan=1 valign=top><font face='arial' color='black'><span id='spantabel2'></span></td>
	</tr>
	</table>

	</font>
	<input type='button' value='F1-Simpan' id='btnsimpan'>	
	<input type='button' value='F3-Hapus' id='btnhapus'>
	<input type='button' value='F12-Keluar'  id='btnkeluar'>		
	
	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></td></tr>
		</center>
	</div>	
	
	</form>
	
</body>
</html>