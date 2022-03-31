<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_timur_data',$links);
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
    <title>Retur Pembelian</title>
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
	$Pcs2("#setper").html("<font size=3><i>Transaksi Retur Pembelian</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Transaksi Retur Pembelian");
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
		tabOnEnter (mmf2, event);
		}

		if (mmid.substr(0,2)=='12' && (mmv==116 || (mmv==13 && mmf2.value=='') ))
		{

		query1="select left(a.stoid,12) stoid,left(a.barcode,15) Barc,left(a.stonama,30) Nama,left(format(a.hrgbeli,0),15) rightHarga,'L001' QSALDO from setstok a "
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
		//datas=taptabel("setsup","supid,supnama","supid='"+this.value+"'")
		datas=taptabel("setsup","supid,plafon,supnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","supid='"+this.value+"'")

		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		if (datas.supid!=undefined)
		{
		$Pcs2("#msupid").val(datas.supid)
		$Pcs2("#msupnama").val(datas.supnama)
		$Pcs2("#mjt").val(baliktanggal2(datas.jt))
		$Pcs2("#mbeliid").focus()
		mplafon=datas.plafon
		}
	})

	$Pcs2("#mbeliid").blur(function() {
		mndd=this.value
		if (mndd!='')
		{
		
		datab=taptabel("bkbesar","nid,tgl","nid='"+mndd+"' and kredit>0")
		if (datab.nid==undefined)
		{

		$Pcs2("#spanket").html("Nota Beli Tidak Valid !")
		this.focus()

		}
		else
		{

		$Pcs2("#mbelitgl").val(baliktanggal2(datab.tgl))
		$Pcs2("#mket").focus()

		}
		
		}
	})
	
	$Pcs2("#mnid").blur(function() {
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transreturbeli1","*","nid='"+mnid+"'")
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))
			$Pcs2("#mkarid").val(mgg.karid)
			$Pcs2("#msupid").val(mgg.supid)
			$Pcs2("#mket").val(mgg.ket)
			$Pcs2("#mfakturid").val(mgg.fakturid)
			$Pcs2("#mkarid").blur()
			$Pcs2("#msupid").blur()
			$Pcs2("#mbeliid").val(mgg.beliid)
			$Pcs2("#mbeliid").blur()
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
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,left(concat(a.supid,'-',supnama),30) Suplier,left(FORMAT(total,0),12) rightTotal from transreturbeli1 a left join setsup b on a.supid=b.supid where true"
		mordd="Nota"
		mffff=" concat(nid,date_format(tgl,'%d-%m-%Y'),supnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Nota Retur');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})


	$Pcs2("#lookbeli").click(function() {
		msup=$Pcs2("#msupid").val()
		mcomm="Select a.nid Nota,date_format(a.tgl,'%d-%m-%Y') Tgl,FORMAT(a.kredit,0) rightJumlah  from bkbesar a left join (select nid2,sum(debet) debet from bkbesar where rekid='20010' and bpid='"+msup+"' group by nid2) b on a.nid=b.nid2 where bpid='"+msup+"' and rekid='20010' and a.kredit>0 and a.kredit-ifnull(b.debet,0)>0 "
		mordd="Nota"
		mffff=" nid "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mbeliid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Nota Beli');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#btnsimpan").click(function() {

		mnid=$Pcs2("#mnid").val()
		if (mnid==''){

		malert="TIDAK BISA DISIMPAN ! <br> Nota Kosong"
		$Pcs2("#spanket").html(malert)		
		$Pcs2("#mnid").focus();

		return;}

		mbeliid=$Pcs2("#mbeliid").val()
		if (mbeliid==''){

		malert="TIDAK BISA DISIMPAN ! <br> Nota Beli Kosong"
		$Pcs2("#spanket").html(malert)		
		$Pcs2("#mbeliid").focus();

		return;}
		
		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
		mbelitgl="str_to_date('"+$Pcs2("#mbelitgl").val()+"','%d-%c-%Y')"

		msupid=$Pcs2("#msupid").val()
		if (msupid==''){
		malert="TIDAK BISA DISIMPAN ! <br> Suplier Kosong"
		$Pcs2("#spanket").html(malert)		
		$Pcs2("#msupid").focus();
		return;}

		mket=$Pcs2("#mket").val()

		msupnama=$Pcs2("#msupnama").val()
	
		mtotal=toval($Pcs2("#mtotal").val())

		if (mtotal==0){
		malert="TIDAK BISA DISIMPAN ! <br> Total Retur Kosong"
		$Pcs2("#spanket").html(malert)
		$Pcs2("#12_1").focus();
		return;}
		
		
		msql="delete from transreturbeli1 where nid='"+mnid+"'"
		
		$Pcs2.ajax({
		type : 'POST',
		url:"phpexec.php",
		data : "func=EXECUTE&comm="+msql,
		success : function(data){

			execajaxas("delete from bkbesar where nid='"+mnid+"'")
			execajaxas("delete from transreturbeli2 where nid='"+mnid+"'")

			
			mq1="insert into transreturbeli1(nid,tgl,beliid,ket,supid,total,status) "
			mq2=" values('"+mnid+"',"+mtgl+",'"+mbeliid+"','"+mket+"','"+msupid+"','"+mtotal+"',2)"
			execajaxa(mq1+mq2)
			
			
			mtot=0			
			for (gg=1;gg<100;gg++)
			{
			
			mstoid=$Pcs2("#12_"+gg).val()
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#16_"+gg).val())
			misi=toval($Pcs2("#misi_"+gg).val())
			mtotqty=(mqty*misi)+munit
			mhrgsat=toval($Pcs2("#18_"+gg).val())			
			mdisk=toval($Pcs2("#19_"+gg).val())
			mjmlhrg=toval($Pcs2("#20_"+gg).val())

			
			if (mstoid!='')
			{

			mtglx=baliktanggal( $Pcs2("#mtgl").val() )
			mjm=savstofifo('L001',mstoid,mnid,mtglx,0,0,0,mtotqty,'TRANSRETURBELI',"Retur Pembelian")
			
			mq1="insert into transreturbeli2(nomor,nid,tgl,stoid,qty,unit,totqty,hrgsat,jmlhrg,isi,diskonp) "
			mq2=" values('"+gg+"','"+mnid+"',"+mtgl+",'"+mstoid+"','"+mqty+"','"+munit+"','"+mtotqty+"','"+mhrgsat+"','"+mjmlhrg+"','"+misi+"','"+mdisk+"')"
			execajaxa(mq1+mq2)

			mtot=mtot+toval(mjm)
			
			}

			}


			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('40220','','',"+mtgl+",'"+mnid+"',"+(mtot-mtotal)+",0,'TRANSRETURBELI','Selisih Retur ke "+msupnama+"')"
			execajaxa(msqql1+msqql2)

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket,nid2) "			
			msqql2="values('20010','"+msupid+"','',"+mtgl+",'"+mnid+"',"+mtotal+",0,'TRANSRETURBELI','Retur Ke "+msupnama+"','"+mbeliid+"')"
			execajaxa(msqql1+msqql2)

			malert="DATA TERSIMPAN !"
			$Pcs2("#spanket").html(malert)
			
			//xxw=window.open('printbeli.php?mnid='+mnid,'aa',('alwaysraised=yes,scrollbars=no,resizable=no,height=550,left=200,top=10'));
			//xxw.focus();
			
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
		execajaxas("delete from transreturbeli1 where nid='"+mnid+"'")
		execajaxas("delete from transreturbeli2 where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")

		malert="DATA TERHAPUS !"
		$Pcs2("#spanket").html(malert)		
		
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
		url:"grids/gridreturbeli.php",
		data : "mTform=transreturbeli1"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
			$Pcs2("#mtotal").val(tra(mgg.total))
			$Pcs2("#mongkos").val(tra(mgg.ongkos))
			$Pcs2("#mtunai").val(tra(mgg.tunai))
			$Pcs2("#mhutang").val(tra(mgg.jumlah))			
			$Pcs2("#mjt").val(baliktanggal2(mgg.tgljt))
			$Pcs2("#mbeliid").val(mgg.nid2)
			$Pcs2("#mbeliid").blur()
		}});

	}
	
	function baru(mgdn)
	{
		mnid=$Pcs2("#mnid").val()
		datasx=taptabel("transreturbeli1","nid","nid='"+mnid+"' and status=2")
		
		$Pcs2("#mtgl").val("")
		$Pcs2("#mnid").val("")
		$Pcs2("#mkarid").val("")
		$Pcs2("#msupid").val("")
		$Pcs2("#mfakturid").val("")
		$Pcs2("#msupnama").val("")
		$Pcs2("#mket").val("")
		$Pcs2("#mbeliid").val("")
		$Pcs2("#mbelitgl").val("")
	
		refreshgrid2()
		
		$Pcs2("#mtgl").val(tglsekarang());

		datas=taptabel("transreturbeli1","nid","1=1 order by nid desc limit 0,1")
		data=datas.nid;
			
		if (data!=undefined)
		{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='RB'+padl(mmmerkid,'0',7);
		}
		else
		{
			mmmerkid='RB0000001';
		}

		$Pcs2("#mnid").val(mmmerkid);		
		execajaxas("delete from transreturbeli1 where nid='"+mmmerkid+"'")
		//execajaxa("insert into transreturbeli1(nid,status) values('"+mmmerkid+"',1)")
		execajaxas("delete from transreturbeli2 where nid='"+mmmerkid+"'")
		execajaxas("delete from bkbesar where nid='"+mmmerkid+"'")		
		$Pcs2("#msupid").focus()

		mcomm=''
		mordd=''
		mffff=''
		mstokall=''
		mplafon=0
		
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
		rowqty=mmid.replace('12','14')
		rowunit=mmid.replace('12','16')
		rowhrg=mmid.replace('12','18')
		rownom=mmid.replace('12','11')
		rowisi=mmid.replace('12','misi')
		$Pcs2("#"+rownama).val("")
		$Pcs2("#"+rowsat1).val("")

		mnnm=toval(mmid.replace('12_',''))
		for (ggt=1;ggt<101;ggt++)
		{
		msst=$Pcs2("#12_"+ggt).val()
		mnamaa=$Pcs2("#13_"+ggt).val()

		if (misi!='' && ggt!=mnnm && misi==msst)
		{

		malert="STOK "+misi+" "+mnamaa+" SUDAH DIINPUT !"
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
		$Pcs2("#"+rowhrg).val(mstok.hrgbeli)
		$Pcs2("#"+rowisi).val(mstok.isi)	
		mnn=$Pcs2("#"+rownom).val()
		mnn=mnn.replace('.','')
		mnn=padl(mnn,'0',2)
		getNextElement(theid).focus()
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
		misixx=toval($Pcs2("#misi_"+def).val())

		if (misi==undefined)
		{break;}

		$Pcs2("#"+axx+"_"+abc).val(misi)
		$Pcs2("#misi_"+abc).val(misixx)
		}
		
	}
	}
	
	function rumus1()
	{
		mj1=0
		mj2=0
		mstokall=''
		for (gg=1;gg<100;gg++)
		{
			if ($Pcs2("#12_"+gg).val()!='')
			{
			
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#16_"+gg).val())

			misi=toval($Pcs2("#misi_"+gg).val())
			//$Pcs2("#mket").val(misi)
			mhrg=toval($Pcs2("#18_"+gg).val())
			mdis=mhrg*toval($Pcs2("#19_"+gg).val())*0.01
			mhrg=(mhrg-mdis)/misi
			
			mjmlhrg=((mqty*misi)+munit)*mhrg
			mjmlhrg=Math.round(mjmlhrg,0)
			
			$Pcs2("#20_"+gg).val(tra(mjmlhrg))
			
			mnii=$Pcs2("#20_"+gg).val()	
			mj1=mj1+toval(mnii)
			mstokall=mstokall+"'"+$Pcs2("#12_"+gg).val()+"',"
			}
			
		}
		mstokall=mstokall+"'axxxff'"
		$Pcs2("#mtotal").val(tra(mj1))
		mong=toval($Pcs2("#mongkos").val())
		mkk=mj1+mong
		mcck=$Pcs2("#mctunai").attr("checked")
		
		if (toval($Pcs2("#mtunai").val())==mkk)
		{

		$Pcs2("#mtunai").val('0')		

		}
		
		if (mcck=='checked')
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

		msup=$Pcs2("#msupid").val()
		datas=taptabel("setsup","supid,supnama,DATE_ADD(str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y'), INTERVAL tempo DAY) jt","supid='"+msup+"'")
		$Pcs2("#mjt").val(baliktanggal2(datas.jt))

		}
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
		return false;
	}
	return true;
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
	<td>Tgl. </td><td>: <input type=text id=mtgl size=10 >
	Kode : <input type=text id=mnid size=10 ></input><input type=button id=lookmnid value='F5'></td> 
	</tr>
	
	<tr>
	<td>Suplier </td><td colspan=5>: <input type=text  size=5 id='msupid'><input type=button id=lookmsupid value='F5'><input type=text id=msupnama size=45 disabled></td>
	</tr>

	<tr>
	<td>Atas Nota</td><td>: <input type=text id=mbeliid size=10 ></input><input type=button id=lookbeli value='F5'>
	Tgl : <input type=text id=mbelitgl size=10 disabled> </td> 
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