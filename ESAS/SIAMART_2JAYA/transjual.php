<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_2jaya_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Penjualan</title>
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
	var thefoc = ''
	var mdd='<?php echo session_id(); ?>'
	var mgolongan=''
	var mnidopen='<?php echo $mnidopen; ?>'
	
  $Pcs2(document).ready(function(){
	$Pcs2("#setper").html("<font size=3><i>Transaksi Penjualan</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Transaksi Penjualan");
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
	execajaxas("alter table transjual2 add column ratehrgjual int default 0")
	execajaxa("delete from transjual2 where nid=''")

	baru()
	
	if("<?php echo $_GET['mnid']; ?>" != ''){
		$Pcs2("#mnid").val("<?php echo $_GET['mnid']; ?>");
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transjual1","*","nid='"+mnid+"'")
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))

			$Pcs2("#mkarid").val(mgg.karid)
			$Pcs2("#mlgnid").val(mgg.lgnid)
			$Pcs2("#mkarid").val(mgg.sales)
			$Pcs2("#mket").val(mgg.ket)

			$Pcs2("#mkarid").blur()
			$Pcs2("#mlgnid").blur()

			refreshgrid2(mgg)
		}
	}
	
	
		
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

		if (mgolongan=='A')
		{mh='';mh2='2';}
		if (mgolongan=='B')
		{mh='4';mh2='5';}
		if (mgolongan=='C')
		{mh='';mh2='3';}
		if (mgolongan=='D')
		{mh='3'}
		if (mgolongan=='E')
		{mh='5'}
		if (mgolongan=='')
		{mh='3'}
		mlokid=$Pcs2("#mlokid").val()
		query1="select left(a.stoid,12) stoid,left(a.stonama,30) Nama,left(format(a.hrgjual"+mh+",0),15) rightHarga,'"+mlokid+"' QSALDO from setstok a "
		query2=" where true "

		mcomm=query1+query2

		mordd="stoid"
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
		tal=$Pcs2("#"+mmid).css('text-align')
		m22=mmid.substr(0,2)
		if (m22==15 || m22==16 || m22==17 || mmid=='mtunai' || mmid=='mongkos' || tal=='right')
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
		}
		
		rumus1()	
	})

	
	$Pcs2("#mkarid").blur(function() {
		datas=taptabel("setkaryawan","karid,karnama,lokid","karid='"+this.value+"'")
		$Pcs2("#mkarid").val("")
		$Pcs2("#mkarnama").val("")
		if (datas.karid!=undefined)
		{
		$Pcs2("#mkarid").val(datas.karid)
		$Pcs2("#mkarnama").val(datas.karnama)
		$Pcs2("#12_1").focus()
		$Pcs2("#mlokid").blur()
		}
	})

	$Pcs2("#mlgnid").blur(function() {
		//datas=taptabel("setlgn","lgnid,lgnnama","lgnid='"+this.value+"'")
		datas=taptabel("setlgn","golongan,lgnid,plafon,lgnnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","lgnid='"+this.value+"'")

		$Pcs2("#mlgnid").val("")
		$Pcs2("#mlgnnama").val("")
		if (datas.lgnid!=undefined)
		{
		$Pcs2("#mlgnid").val(datas.lgnid)
		$Pcs2("#mlgnnama").val(datas.lgnnama)
		$Pcs2("#mjt").val(baliktanggal2(datas.jt))
		mgolongan=datas.golongan
		
		$Pcs2("#mkarid").focus()

		mplafon=datas.plafon
		}
	})

	$Pcs2("#mnid").blur(function() {
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transjual1","*","nid='"+mnid+"'")
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))

			$Pcs2("#mkarid").val(mgg.karid)
			$Pcs2("#mlgnid").val(mgg.lgnid)
			$Pcs2("#mkarid").val(mgg.sales)
			$Pcs2("#mket").val(mgg.ket)

			$Pcs2("#mkarid").blur()
			$Pcs2("#mlgnid").blur()

			refreshgrid2(mgg)
		}
		else
		{
			baru()
		}
		
	})
	
	$Pcs2("#looklok").click(function() {
		mcomm="Select rpad(lokid,12,' ') Kode,left(loknama,50) Nama from setlok where true"
		mordd="Kode"
		mffff=" concat(lokid,loknama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlokid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Lokasi');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
	
	$Pcs2("#mlokid").blur(function() {
	mll=taptabel("setlok","loknama","lokid='"+this.value+"'")
	$Pcs2("#mloknama").val(mll.loknama)
	//$Pcs2("#mkarid").focus()
	})

	$Pcs2("#lookmlgnid").click(function() {
		mcomm="Select rpad(lgnid,12,' ') Kode,left(lgnnama,30) Nama,left(alamat,35) Alamat,rpad(golongan,12,' ') rightGol from setlgn where true"
		mordd="Kode"
		mffff=" concat(lgnid,lgnnama,alamat,'gol:',golongan) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookkarid").click(function() {
		mcomm="Select rpad(karid,12,' ') Kode,left(karnama,50) Nama  from setkaryawan where true"
		mordd="Kode"
		mffff=" concat(karid,karnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mkarid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookmnid").click(function() {
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,left(concat(a.lgnid,'-',lgnnama),30) Pelanggan,left(FORMAT(total,0),12) rightTotal from transjual1 a left join setlgn b on a.lgnid=b.lgnid where true"
		mordd="Nota"
		mffff=" concat(nid,date_format(tgl,'%d-%m-%Y'),lgnnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Sales');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#btnsimpan").click(function() {
		mnid=$Pcs2("#mnid").val()

		if (mnid==''){

		datas=taptabel("transjual1","nid","1=1 order by nid desc limit 0,1")
		data=datas.nid;
			
		if (data!=undefined)
		{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='TJ'+padl(mmmerkid,'0',7);
		}
		else
		{
			mmmerkid='TJ0000001';
		}

		$Pcs2("#mnid").val(mmmerkid);		
		mnid=mmmerkid	

		}

		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
		mjt="str_to_date('"+$Pcs2("#mjt").val()+"','%d-%c-%Y')"

		mlgnid=$Pcs2("#mlgnid").val()
		if (mlgnid==''){
		mseb=$Pcs2("#spanket").html()
		malert="TIDAK BISA DISIMPAN ! <br> Pelanggan Kosong"
		$Pcs2("#spanket").html(mseb+malert)		
		$Pcs2("#mlgnid").focus();
		return;}

		mket=$Pcs2("#mket").val()
		mfakturid=$Pcs2("#mfakturid").val()

		mlgnnama=$Pcs2("#mlgnnama").val()
		mkarid=$Pcs2("#mkarid").val()
	
		mtotal=toval($Pcs2("#mtotal").val())
		mtunai=toval($Pcs2("#mtunai").val())
		mhutang=toval($Pcs2("#mhutang").val())
		mongkos=toval($Pcs2("#mongkos").val())

		if (mtotal==0){
		malert="TIDAK BISA DISIMPAN ! <br> Total jual Kosong"
		mseb=$Pcs2("#spanket").html()
		$Pcs2("#spanket").html(mseb+malert)
		$Pcs2("#12_1").focus();
		return;}

		mseb=$Pcs2("#spanket").html()
		mseb=mseb.trim()
		if (mseb==NaN){mseb==''}
		if (mseb!=''){
		malert="TIDAK BISA DISIMPAN ! Masih Ada Message !"
		$Pcs2("#spanket").html(+malert)
		return;
		}
		
		if (mhutang>0)
		{
		mgg=taptabel("bkbesar","sum(kredit-debet) hutang","bpid='"+mlgnid+"' and rekid='20010' and nid<>'"+mnid+"'")
		if (mgg.hutang!=undefined)
		{
			mhht=toval(mgg.hutang)+mhutang
			if (mhht>mplafon)
			{
			//alert("Hutang Melebihi Plafon ("+mplafon+")!")
			malert="TIDAK BISA DISIMPAN ! <br> Piutang Melebihi Plafon ("+tra(mplafon)+") <br> Total Piutang "+tra(mgg.hutang)
			$Pcs2("#spanket").html(malert)
			return;
			}
		}
		
		}
		
		
			execajaxas("delete from transjual1 where nid='"+mnid+"'")
			execajaxas("delete from transjual2 where nid='"+mnid+"'")
			execajaxas("delete from bkbesar where nid='"+mnid+"'")
			
			mq1="insert into transjual1(nid,tgl,tgljt,ket,lgnid,total,tunai,jumlah,ongkos,sales,status) "
			mq2=" values('"+mnid+"',"+mtgl+","+mjt+",'"+mket+"','"+mlgnid+"','"+mtotal+"','"+mtunai+"','"+mhutang+"','"+mongkos+"','"+mkarid+"',2)"
			execajaxas(mq1+mq2)
			
			mq1x="insert into transjual2(nomor,nid,tgl,stoid,qty,unit,extra,extraunit,totqty,hrgsat,jmlhrg,isi,diskonrp,ratehrgjual) values "
			
			mtot=0			
			for (gg=1;gg<100;gg++)
			{
			
			mstoid=$Pcs2("#12_"+gg).val()
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#16_"+gg).val())
			mextra=toval($Pcs2("#18_"+gg).val())
			mextraunit=toval($Pcs2("#20_"+gg).val())
			misi=toval($Pcs2("#misi_"+gg).val())
			mtotqty=((mqty+mextra)*misi)+munit+mextraunit
			mhrgsat=toval($Pcs2("#22_"+gg).val())			
			mdisk=toval($Pcs2("#23_"+gg).val())
			mjmlhrg=toval($Pcs2("#24_"+gg).val())
			mratejual=toval($Pcs2("#25_"+gg).val())

			if (mstoid!='')
			{
			mlokid=$Pcs2("#mlokid").val()
			
			mtglx=baliktanggal( $Pcs2("#mtgl").val() )
			mjm=savstofifo(mlokid,mstoid,mnid,mtglx,0,0,0,mtotqty,'TRANSJUAL',"Penjualan ke "+mlgnnama)
			
			mq1x=mq1x+" ('"+gg+"','"+mnid+"',"+mtgl+",'"+mstoid+"','"+mqty+"','"+munit+"','"+mextra+"','"+mextraunit+"','"+mtotqty+"','"+mhrgsat+"','"+mjmlhrg+"','"+misi+"','"+mdisk+"','"+mratejual+"'), "

			mtot=mtot+toval(mjm)
			
			}

			}

			mq1x=mq1x+" ('','','','','','','','','','','','','','') "

			execajaxas(mq1x)

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,qtyin,trans,ket) "
			msqql2="values('30010','','',"+mtgl+",'"+mnid+"',"+mtotal+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)
			
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('10010','','',"+mtgl+",'"+mnid+"',"+mtunai+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "			
			msqql2="values('10210','"+mlgnid+"','',"+mtgl+",'"+mnid+"',"+mhutang+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('40210','','',"+mtgl+",'"+mnid+"',"+mongkos+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)
			
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('31010','','',"+mtgl+",'"+mnid+"',"+mtot+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)

			xxw=window.open('printjual.php?mnid='+mnid,'aa',('alwaysraised=yes,scrollbars=no,resizable=no'));
			xxw.focus();

$Pcs2.ajax({
type:"POST",
url:"jurnaling.php",
async: true,
data : "mnid="+mnid,
success : function(data){
}})
			
			malert="DATA TERSIMPAN !"
			alert(malert)
			
			
			
	})

	$Pcs2("#btnbaru").click(function() {
		baru()
	})

	$Pcs2("#btnhapus").click(function() {
		mnid=$Pcs2("#mnid").val()
		mconf=confirm("Menghapus Transaksi No. "+mnid+"?")
		if (mconf==false)
		{return;}
		execajaxas("delete from transjual1 where nid='"+mnid+"'")
		execajaxas("delete from transjual2 where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")

		malert="DATA TERHAPUS !"
		$Pcs2("#spanket").html(malert)		
		
		baru()		
	})

	$Pcs2("#btnkeluar").click(function() {
		self.close()
	})

	if (mnidopen!='')
	{
		$Pcs2("#mnid").val(mnidopen)
		$Pcs2("#mnid").blur()
	}
	});

///awal functions
	function cekqtyx(thiee) 
	{
		mmid=thiee.id
		m22=mmid.substr(0,2)
		
		m23=mmid.replace('14_','')
		m23=m23.replace('16_','')
		m23=m23.replace('18_','')
		m23=m23.replace('20_','')
		
		mqty=toval($Pcs2("#14_"+m23).val())
		munit=toval($Pcs2("#16_"+m23).val())
		mextra=toval($Pcs2("#18_"+m23).val())
		mextraunit=toval($Pcs2("#20_"+m23).val())
		misi=toval($Pcs2("#misi_"+m23).val())
		mtotqty=((mqty+mextra)*misi)+munit+mextraunit
		
		
		cck=ceksaldo($Pcs2("#12_"+m23),mtotqty,$Pcs2("#13_"+m23).val())
					
		if (cck==false)
		{
			thiee.value=''
			return
		}
		
		$Pcs2("#23_"+m23).val('')
		if (mqty>0)
		{
		mlgn=$Pcs2("#mlgnid").val()	
		mstoid=$Pcs2("#12_"+m23).val()
		ahh=taptabel("transjual2 a left join transjual1 b on a.nid=b.nid ","a.stoid,format(a.diskonrp,0) diskon ","b.lgnid='"+mlgn+"' and a.stoid='"+mstoid+"' order by a.tgl desc,a.nid desc limit 0,1")
		//$Pcs2("#23_"+m23).val(ahh.diskon)
		}
		
	}

	function bukastok(theid)
	{
		mid=theid.id.replace('25','12')
		mstoid=$Pcs2("#"+mid).val()
		
		$Pcs2("#framehrg").attr('src','setstok2.php?mstoid='+mstoid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Stok');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
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
		mser="&mnid="+$Pcs2("#mnid").val();
		$Pcs2.ajax({
		type:"POST",
		chace : true,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		type : 'GET',
		url:"grids/gridjual.php",
		data : "mTform=transjual1"+mser,
		async: true,
		success : function(data){


			$Pcs2("#spantabel2").html(data)

			for (abd=1;abd<101;abd++)
			{
			$Pcs2("#26_"+abd).datepicker({dateFormat: 'dd-mm-yy'});
			}
			
			$Pcs2("#mtotal").val(tra(mgg.total))
			$Pcs2("#mongkos").val(tra(mgg.ongkos))
			$Pcs2("#mtunai").val(tra(mgg.tunai))
			$Pcs2("#mhutang").val(tra(mgg.jumlah))
			$Pcs2("#mctunai").attr('checked',false)
			$Pcs2("#mcppn").attr('checked',false)

			if (mgg.jumlah==0)
			{
				$Pcs2("#mctunai").attr('checked',true)
			}

			if (toval(mgg.ongkos)!=0)
			{
				$Pcs2("#mcppn").attr('checked',true)
			}

			$Pcs2("#mjt").val(baliktanggal2(mgg.tgljt))
			$Pcs2("#12_1").focus()
		}});

	}
	
	function baru(mgdn)
	{
		mnid=$Pcs2("#mnid").val()
		datasx=taptabel("transjual1","nid","nid='"+mnid+"' and status=2")
		
		$Pcs2("#mtgl").val("")
		$Pcs2("#mnid").val("")
		$Pcs2("#mkarid").val("")
		$Pcs2("#mlgnid").val("")
		$Pcs2("#mfakturid").val("")
		$Pcs2("#mlgnnama").val("")
		$Pcs2("#mket").val("")
		mgolongan=""
		refreshgrid2()
		
		$Pcs2("#mtgl").val(tglsekarang());

		$Pcs2("#mlgnid").focus()
		mlkk=taptabel("setlok","lokid,loknama","lokid='L001' order by lokid limit 0,1")
		$Pcs2("#mlokid").val(mlkk.lokid)
		$Pcs2("#mloknama").val(mlkk.loknama)
		
		mcomm=''
		mordd=''
		mffff=''
		mstokall=''
		mplafon=0
		
	}

	function ambilstok(theid)
	{
		mmid=theid.id
		
		mlokid=$Pcs2("#mlokid").val()
		
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
		rowdis=mmid.replace('12','23')
		rownom=mmid.replace('12','11')
		rowisi=mmid.replace('12','misi')
		rowrate=mmid.replace('12','25')
		$Pcs2("#"+rownama).val("")
		$Pcs2("#"+rowsat1).val("")

		mnnm=toval(mmid.replace('12_',''))
		for (ggt=1;ggt<101;ggt++)
		{
		msst=$Pcs2("#12_"+ggt).val()
		mnama=$Pcs2("#13_"+ggt).val()

		/*if (misi!='' && ggt!=mnnm && misi==msst)
		{

		malert="STOK "+misi+" "+mnama+" SUDAH DIINPUT !"
		$Pcs2("#spanket").html(malert)		
		
		theid.value=''
		theid.focus()
		theid.select()
		$Pcs2("#"+mmid).select()
		return;

		}*/
		}
		
		if (mgolongan=='A')
		{mh='';mh2='2';}
		if (mgolongan=='B')
		{mh='4';mh2='5';}
		if (mgolongan=='C')
		{mh='';mh2='3';}
		if (mgolongan=='D')
		{mh='3'}
		if (mgolongan=='E')
		{mh='5'}
		if (mgolongan=='')
		{mh='3'}

		mlgn=$Pcs2("#mlgnid").val()
		
		mstok=taptabel("setstok a ","a.stoid,a.stonama,a.satuan1,a.satuan2,a.satuan3,format(a.hrgjual"+mh+",0) hrgjual,a.isi","a.stoid='"+misi+"'")

		//alert("select"+" a.stonama,a.satuan1,a.satuan2,a.satuan3,format(a.hrgjual"+mh+",0) hrgjual,a.isi,b.diskonrp from"+"setstok a left join (select a.stoid,a.diskonrp from transjual2 a left join transjual1 b on a.nid=b.nid where b.lgnid='"+mlgn+"' and a.stoid='"+misi+"' order by a.tgl desc limit 0,1) b on a.stoid=b.stoid")
		
		if (mstok.stonama!=undefined)
		{

		msal=taptabel("bkbesar","ifnull(sum(qtyin),0)-ifnull(sum(qtyout),0) saldo"," rekid='10310' and bpid='"+mstok.stoid+"' and bpid2='"+mlokid+"' ")

		if (msal.saldo==undefined || toval(msal.saldo)<0.1)
		{
		
		alert("Stok 0 !")
		theid.value=""
		theid.select()
		return;
		
		}
		//alert(mh);
		
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)
		$Pcs2("#"+rowsat2).val(mstok.satuan2)
		$Pcs2("#"+rowsat3).val(mstok.satuan1)
		$Pcs2("#"+rowsat4).val(mstok.satuan2)
		$Pcs2("#"+rowhrg).val(mstok.hrgjual)
		$Pcs2("#"+rowrate).val(mstok.hrgjual)
		$Pcs2("#"+rowdis).val(mstok.diskonrp)
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

		misix=$Pcs2("#misi_"+def).val()
		$Pcs2("#misi_"+abc).val(misix)

		for (axx=12;axx<26;axx++)
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
		mstokall=''
		$Pcs2("#spanket").html('')
		for (gg=1;gg<100;gg++)
		{
			if ($Pcs2("#12_"+gg).val()!='')
			{
			//alert('asdsa');
			
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#16_"+gg).val())
			misi=toval($Pcs2("#misi_"+gg).val())
			mhrgunit = 0;
			
			if(munit != '' || munit != 0){
				if (mgolongan=='A')
				{mh='';mh2='2';}
				if (mgolongan=='B')
				{mh='4';mh2='5';}
				if (mgolongan=='C')
				{mh='';mh2='3';}
				if (mgolongan=='D')
				{mh='3'}
				if (mgolongan=='E')
				{mh='5'}
				if (mgolongan=='')
				{mh='3'}

				//mlgn=$Pcs2("#mlgnid").val()
				
				mstok=taptabel("setstok a ","a.stoid,a.stonama,a.satuan1,a.satuan2,a.satuan3,format(a.hrgjual"+mh2+",0) hrgjual,a.isi","a.stoid='"+$Pcs2("#12_"+gg).val()+"'");
				
				if(mstok.hrgjual != ''){
					mhrgunit = (toval(mstok.hrgjual)/misi)*munit;
					
				}
				
			}
			
			mextra=toval($Pcs2("#18_"+gg).val())
			mextraunit=toval($Pcs2("#20_"+gg).val())

			
			mtotqty=(mqty*misi)+(mextra*misi)+munit+mextraunit

			//ceksaldo($Pcs2("#12_"+gg),mtotqty,$Pcs2("#13_"+gg).val())
			
			//$Pcs2("#mket").val(misi) 
			mhrgr=toval($Pcs2("#25_"+gg).val())
			mdis=toval($Pcs2("#23_"+gg).val())

			if (mqty==0 && munit>0)
			{
			mhrgr=toval(mstok.hrgjual)/misi
			mhrgr=Math.round(mhrgr,0)
			$Pcs2("#22_"+gg).val(tra(mhrgr))
			mhrg=mhrgr-mdis
			}

			if (mqty>0)
			{
			mhrg=(mhrgr-mdis)/misi
			$Pcs2("#22_"+gg).val(tra(mhrgr))
			}
			
			//alert('hrg unit '+mhrgunit);
			mjmlhrg=(((mqty*misi))*mhrg)+mhrgunit
			mjmlhrg=Math.round(mjmlhrg,0)
			
			$Pcs2("#24_"+gg).val(tra(mjmlhrg))
			
			mnii=$Pcs2("#24_"+gg).val()	
			mj1=mj1+toval(mnii)
			mstokall=mstokall+"'"+$Pcs2("#12_"+gg).val()+"',"
			}
			
		}
		mstokall=mstokall+"'axxxff'"
		$Pcs2("#mtotal").val(tra(mj1))

		mcck2=$Pcs2("#mcppn").attr("checked")
		
		if (mcck2)
		{

		mpppn=mj1*0.01
		
		$Pcs2("#mongkos").val(tra(mpppn))
		
		}
		else
		{

		//$Pcs2("#mongkos").val('')

		} 

		mong=toval($Pcs2("#mongkos").val())
		mkk=mj1+mong
		mcck=$Pcs2("#mctunai").attr("checked")
		
		if (toval($Pcs2("#mtunai").val())==mkk)
		{

		$Pcs2("#mtunai").val('0')		

		}
		
		if (mcck)
		{

		$Pcs2("#mtunai").val(tra(mkk))
		
		}


		mtun=toval($Pcs2("#mtunai").val())
		$Pcs2("#mhutang").val(tra(mj1+mong-mtun))
		if (tra(mj1+mong-mtun)==0)
		{
			$Pcs2("#mjt").val("")
		}	
		else
		{

		mlgn=$Pcs2("#mlgnid").val()
		datas=taptabel("setlgn","lgnid,lgnnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","lgnid='"+mlgn+"'")
		$Pcs2("#mjt").val(baliktanggal2(datas.jt))

		}
	}
	
	function ceksaldo(msto,mqty,mstonama)
	{
	mstoid=msto.val()
	mlokid=$Pcs2("#mlokid").val()

	mgh=taptabel("bkbesar","ifnull(sum(qtyin),0)-ifnull(sum(qtyout),0) saldo","bpid='"+mstoid+"' and bpid2='"+mlokid+"' ")
		
	if ( (mqty>mgh.saldo && mgh.saldo!=null) || mgh.saldo==null )
	{

		malert="Stok "+mstonama+" Tidak Mencukup ! Saldo :"+mgh.saldo
		alert(malert)
		mmg=false		
	}
	else
	{
		mmg=true
	}
	
	return mmg
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
	<table width=100% border=0>
	<tr>
	<td>Tgl. </td><td>: <input type=text id=mtgl size=10 >
	Kode : <input type=text id=mnid size=10 ></input><input type=button id=lookmnid value='F5'></td> 
	</tr>
	
	<tr>
	<td hidden>Nota </td><td hidden>: <input type=text id=mfakturid size=10 disabled></input></td> 
	<td>Pelanggan </td><td colspan=5>: <input type=text  size=5 id='mlgnid'><input type=button id=lookmlgnid value='F5'><input type=text id=mlgnnama size=45 disabled>
	&nbsp;&nbsp;&nbsp;Lokasi : <input type=text  size=5 id='mlokid' value='01'><input type=button id=looklok value='F5' ><input type=text id=mloknama size=15 disabled>
	</td>
	</tr>
	<tr>
	<td>Sales </td><td colspan=5>: <input type=text  size=5 id='mkarid'><input type=button id=lookkarid value='F5'><input type=text id=mkarnama size=45 disabled>
	</tr>
	</table>

	<table width=100% border=0>	
	<tr>
	<td colspan=1 valign=top><font face='arial' color='black'><span id='spantabel2'></span></td>
	</tr>
	</table>

	</font>
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