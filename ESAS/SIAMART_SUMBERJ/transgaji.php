<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Validasi Absensi</title>
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
  
  $Pcs2(document).ready(function(){
	$Pcs2("#setper").html("<font size=3><i>Validasi Absensi</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Validasi Absensi");
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});

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
		tabOnEnter (mmf2, event);
		}

		if (mmv==116 && (mmid.substr(0,2)=='12' || mmid.substr(0,2)=='32') )
		{

		query1="select stoid Kode,left(stonama,30) Nama,left(format(ifnull(b.totqty,0),00),11) rightSaldo,satuan1 'Sat.' from setstok a "
		query2="left join (select bpid,sum(qtyin-qtyout) totqty from bkbesar where rekid like '103%' group by bpid) b on a.stoid=b.bpid where true "
		mcomm=query1+query2

		mordd="Kode"
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
		if (m22==15 || m22==16 || m22==17 || mmid=='mtunai' || mmid=='mongkos')
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
		}
		rumus1()	
	})
	
	$Pcs2("#mkarid").blur(function() {
		datas=taptabel("setkaryawan","karid,karnama","karid='"+this.value+"'")
		$Pcs2("#mkarid").val("")
		$Pcs2("#mkarnama").val("")
		if (datas.karid!=undefined)
		{
		$Pcs2("#mkarid").val(datas.karid)
		$Pcs2("#mkarnama").val(datas.karnama)
		$Pcs2("#mket").focus()
		}
	})

	$Pcs2("#msupid").blur(function() {
		datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		if (datas.supid!=undefined)
		{
		$Pcs2("#msupid").val(datas.supid)
		$Pcs2("#msupnama").val(datas.supnama)
		$Pcs2("#mket").focus()
		}
	})

	$Pcs2("#mtgl").change(function() {
		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
		msss=taptabel("transgaji","karid","tgl="+mtgl+" limit 0,1")
		$Pcs2("#mstatus").val("")

		if (msss.karid!=undefined)
		{
		$Pcs2("#mstatus").val("Tervalidasi")
		}
		
		refreshgrid2()
	})
	
	$Pcs2("#mnid").blur(function() {
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transbeli1","*","nid='"+mnid+"'")
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))
			$Pcs2("#mkarid").val(mgg.karid)
			$Pcs2("#msupid").val(mgg.supid)
			$Pcs2("#mket").val(mgg.ket)
			$Pcs2("#mfakturid").val(mgg.fakturid)

			$Pcs2("#mkarid").blur()
			$Pcs2("#msupid").blur()

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

	$Pcs2("#lookmsupid").click(function() {
		mcomm="Select rpad(supid,12,' ') Kode,left(supnama,50) Nama from setsup where true"
		mordd="Kode"
		mffff=" concat(supid,supnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msupid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookmnid").click(function() {
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,left(concat(a.supid,'-',supnama),30) Suplier,left(FORMAT(total,0),12) rightTotal from transbeli1 a left join setsup b on a.supid=b.supid where true"
		mordd="Nota"
		mffff=" concat(nid,date_format(tgl,'%d-%m-%Y'),supnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Produksi');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
	
	$Pcs2("#btnsimpan").click(function() {

		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"

		msql="delete from transgaji where tgl="+mtgl+""
		
		$Pcs2.ajax({
		type : 'POST',
		url:"phpexec.php",
		data : "func=EXECUTE&comm="+msql,
		success : function(data){			
			
			mtot=0			
			mhh=toval($Pcs2("#tabjumlah").val())+1
			for (gg=1;gg<mhh;gg++)
			{
			
			mkarid=$Pcs2("#12_"+gg).val()
			m1=($Pcs2("#16_"+gg).val())
			m2=($Pcs2("#17_"+gg).val())
			m3=($Pcs2("#18_"+gg).val())
			m4=($Pcs2("#19_"+gg).val())
			m5=($Pcs2("#20_"+gg).val())
			
			mq1="insert into transgaji(tgl,karid,borongan,tambahan,harian,lembur,potongan)"
			mq2="               values("+mtgl+",'"+mkarid+"','"+m1+"','"+m2+"','"+m3+"','"+m4+"','"+m5+"')"
			execajaxa(mq1+mq2)			

			}
			
			alert("Data Tersimpan !")
			baru()		
			
		}});
	})

	$Pcs2("#btnbaru").click(function() {
		baru()
	})

	$Pcs2("#btnhapus").click(function() {
		mnid=$Pcs2("#mnid").val()
		mconf=confirm("Menghapus Transaksi No. "+mnid+"?")
		if (mconf==false)
		{return;}
		execajaxas("delete from transbeli1 where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")
		alert("Data Terhapus !")
		baru()
	})

	$Pcs2("#btnkeluar").click(function() {
		self.close()
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
				
			
			if (event.keyCode==13 || event.keyCode==39)
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
		

	function refreshgrid2(mgg)
	{

		mser="&mnid="+$Pcs2("#mnid").val();
		mser=mser+"&mtgl="+baliktanggal($Pcs2("#mtgl").val());
		mser=mser+"&mstatus="+$Pcs2("#mstatus").val();

		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridgaji.php",
		data : "mTform=transbeli1"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
			$Pcs2("#mtotal").val(tra(mgg.total))
			$Pcs2("#mongkos").val(tra(mgg.ongkos))
			$Pcs2("#mtunai").val(tra(mgg.tunai))
			$Pcs2("#mhutang").val(tra(mgg.jumlah))
		}});

	}
	
	function baru(mgdn)
	{
		mnid=$Pcs2("#mnid").val()
		datasx=taptabel("transbeli1","nid","nid='"+mnid+"' and status=2")
		
		$Pcs2("#mtgl").val("")
		$Pcs2("#mnid").val("")
		$Pcs2("#mkarid").val("")
		$Pcs2("#msupid").val("")
		$Pcs2("#mfakturid").val("")
		$Pcs2("#msupnama").val("")
		$Pcs2("#mket").val("")
		
		$Pcs2("#mtgl").val(tglsekarang());

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
		execajaxas("delete from transbeli1 where nid='"+mmmerkid+"'")
		//execajaxa("insert into transbeli1(nid,status) values('"+mmmerkid+"',1)")
		execajaxa("delete from transbeli2 where nid='"+mmmerkid+"'")
		execajaxa("delete from bkbesar where nid='"+mmmerkid+"'")
			
		refreshgrid2()
		$Pcs2("#mfakturid").focus()
				
	}

	function ambilstok(theid)
	{
		mmid=theid.id
		
		if (mmid.substr(0,2)=='12')
		{
		rownama=mmid.replace('12','13')
		rowsat1=mmid.replace('12','14')
		rowqty=mmid.replace('12','15')
		rowhrg=mmid.replace('12','16')
		rowlot=mmid.replace('12','19')
		rownom=mmid.replace('12','11')
		}

		if (mmid.substr(0,2)=='32')
		{		
		rownama=mmid.replace('32','33')
		rowsat1=mmid.replace('32','34')
		rowqty=mmid.replace('32','35')
		rowhrg=mmid.replace('32','36')
		}

		$Pcs2("#"+rownama).val("")
		$Pcs2("#"+rowsat1).val("")
		//$Pcs2("#"+rowqty).val("")
		
		misi=theid.value
		mstok=taptabel("setstok","stonama,satuan1,satuan2,satuan3,format(hrgbeli,0) hrgbeli","stoid='"+misi+"'")
		
		if (mstok.stonama!=undefined)
		{
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)
		$Pcs2("#"+rowhrg).val(mstok.hrgbeli)
		
		mnn=$Pcs2("#"+rownom).val()
		mnn=mnn.replace('.','')
		mnn=padl(mnn,'0',2)
		
		mtgll=baliktanggal($Pcs2("#mtgl").val())
		mtgll=mtgll.substr(0,7)
		mnid=$Pcs2("#mnid").val()
		
		mstok=taptabel("transbeli1","count(*) cnt ","left(tgl,7)='"+mtgll+"' and nid<'"+mnid+"'")
		
		mnomm=toval(mstok.cnt)+1		
		mnomm=mnomm.toString()
		mnomm=padl(mnomm,'0',3)
		
		mnolot=$Pcs2("#mtgl").val()
		mnolot='B.'+mnolot.substr(3,2)+mnolot.substr(8,2)+'.'+mnomm+'.'+mnn

		$Pcs2("#"+rowlot).val(mnolot)
		getNextElement(theid).focus()
		}
		rumus1()
	}

	function rumus1()
	{
		return;
		mj1=0
		mj2=0
		
		for (gg=1;gg<100;gg++)
		{
			if ($Pcs2("#12_"+gg).val()!='')
			{
			
			mqty=toval($Pcs2("#15_"+gg).val())
			mhrg=toval($Pcs2("#16_"+gg).val())
			mdis=mhrg*toval($Pcs2("#17_"+gg).val())*0.01
			mjmlhrg=mqty*(mhrg-mdis)
			
			$Pcs2("#18_"+gg).val(tra(mjmlhrg))
			
			mnii=$Pcs2("#18_"+gg).val()	
			mj1=mj1+toval(mnii)
			}

			
		}

		
		$Pcs2("#mtotal").val(tra(mj1))
		mong=toval($Pcs2("#mongkos").val())
		mtun=toval($Pcs2("#mtunai").val())
		$Pcs2("#mhutang").val(tra(mj1+mong-mtun))
		
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
		alert("Stok Tidak Mencukup ! Saldo :"+mgh.saldo);
		theid.value=0;
		return;
	}	
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
	<table width=85% border=0>
	<tr>
	<td>Tgl. </td><td>: <input type=text id=mtgl size=10 > Status : <input type=text id=mstatus size=15 disabled value=''> </td>
	</tr>
	
	<tr>
	<td>Catatan </td><td colspan=5>: <input type='text' id='mket' size=100></td>
	</tr>
	</table>

	<table width=100% border=0>		
	
	<tr>
	<td colspan=1 valign=top><font face='arial' color='black'><span id='spantabel2'></span></td>
	</tr>
	</table>

	</font>
	<hr>
	<input type='button' value='F1-Simpan' id='btnsimpan'>	
	<input type='button' value='F2-Baru' id='btnbaru'>	
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