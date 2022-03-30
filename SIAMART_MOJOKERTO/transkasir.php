<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_mojokerto_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}
$hakedit=$rrwx[edit];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Kasir</title>
    <link rel="stylesheet" type="text/css" href="themes/sunny/ui.all.css">
    <link rel="stylesheet" href="css/form-field-tooltip.css" media="screen" type="text/css">
    <script type="text/javascript"></script>
    <script src="js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>  
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script type="text/javascript" src="js/rounded-corners.js"></script>
    <script type="text/javascript" src="js/form-field-tooltip.js"></script>
    <script type="text/javascript">
	var $Pcs2 = jQuery.noConflict();
	var dialogisopen=false;
	var mvv=15;
	var mws=screen.width
	var mcomm
	var mordd
	var mffff	
	var inputobj="12_1"
	var lastobj="12_1"
	var mharga=3
	var msatuan=2
	var mkass='<?php echo $_SESSION['MANA']; ?>'
	var midkasir='<?php echo $_SESSION['MASUK']; ?>'
	var mkredit=false
	var hakedit='<?php echo $hakedit; ?>'
	
	$Pcs2(document).ready(function(){
	execajaxas("alter table transkasir2 add cdiskon varchar(10) ")	

	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Kasir");
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});

	$Pcs2("#header").css('width',mws-50);
	$Pcs2("#isinya").css('width',mws-50);
	execajaxas("alter table transkasir2 add column isi int(11) default 0")

	baru()

	refreshgrid2()


	$Pcs2("#kotakdialog").dialog({
	autoOpen: false,
	modal: true,
	show: true,
	hide: true,
	dragable: true,
	width : 850,	

	close : function(){
		$Pcs2("#"+lastobj).focus()
	},

	});

    $Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	show: false,
	hide: false,
	dragable: true,
	width : 800,

	close : function(){
		$Pcs2("#"+lastobj).focus()
	},
		  
	});

	
	$Pcs2("#setper").css({
	'width': mws-665+'px',
	'height': '19px',
	'line-height':'19px',
	'font-size':'12',
	});


	$Pcs2(document).keypress(function(){

	mmv=event.keyCode	
	mac=event.element(event).id ; if (event.which!=0){return;} ; 
	
	if (event.which!=0){return;}

	
	if (mmv==112)
	{mwo=window.open("transkasir.php");mwo.focus()}

	if (mmv==113)
	{$Pcs2('#btnbaru').click()}

	if (mmv==114)
	{
	arahsatuan(1)
	
	mss=mac.replace('12_','')
	if (event.element(event).value=='')
	{
	mss=toval(mss)-1
	}

	msebel=document.getElementById("12_"+mss)
	document.getElementById("13_"+mss).value=''
	ambilstok(msebel)

	}

	if (mmv==115)
	{
	arahsatuan(2)

	mss=mac.replace('12_','')
	if (event.element(event).value=='')
	{
	mss=toval(mss)-1
	}
	
	msebel=document.getElementById("12_"+mss)
	document.getElementById("13_"+mss).value=''
	ambilstok(msebel)
	
	}
	
	if (mmv==116)
	{$Pcs2('#look'+mac).click()}

	if (mmv==117)
	{$Pcs2('#btndiskon').click()}
	
//	if (mmv==118)
//	{arahharga(1)}

	if (mmv==119)
	{
	arahharga(2,true)
	
	mss=mac.replace('12_','')
	if (event.element(event).value=='')
	{
	mss=toval(mss)-1
	}

	msebel=document.getElementById("12_"+mss)
	document.getElementById("13_"+mss).value=''
	ambilstok(msebel)
	arahharga(3)
	
	}

	if (mmv==120)
	{
	arahharga(3,true)

	
	mss=mac.replace('12_','')
	if (event.element(event).value=='')
	{
	mss=toval(mss)-1
	}

	msebel=document.getElementById("12_"+mss)
	document.getElementById("13_"+mss).value=''
	ambilstok(msebel)
	arahharga(3)
	
	}

	if (mmv==121)
	{isretur(mac)}

	if (mmv==122)
	{$Pcs2('#btnmember').click()}
	
	if (mmv==123)
	{$Pcs2('#btnkeluar').click()}
	
	
	})

	$Pcs2("#fform2").keydown(function() {	
		mmf2=event.element(event);
		mmid=mmf2.id
		mmv=event.keyCode	
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
		tabOnEnter2 (mmf2, event);
		}
	})

	$Pcs2("#fform3").keydown(function() {	
		mmf2=event.element(event);
		mmid=mmf2.id
		mmv=event.keyCode	
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
		tabOnEnter2 (mmf2, event);
		}
	})

	$Pcs2("#fform").keyup(function() {
 		inputobj=event.element(event).id
	})
	
	$Pcs2("#mkembali").keyup(function() {
 		rumus2()
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

		if (mmv==116 && (mmid.substr(0,2)=='12' || mmid.substr(0,2)=='32') )
		{

//		query1="select stoid Kode,left(stonama,30) Nama,left(format(hrgjual3/isi,0),15) rightHarga,left( concat(format(ifnull(floor(b.totqty/isi),0),0),' ',satuan1,'  ',format(ifnull(mod(b.totqty,isi*isi2),0),0),' ',satuan2),15) rightSaldo from setstok a "
//		query2="left join (select bpid,sum(qtyin-qtyout) totqty from bkbesar where rekid like '103%' group by bpid) b on a.stoid=b.bpid where true "

		mha=mharga
		if (mharga==1)	
		{
		mha=''
		}

		//mstok=taptabel("setstok","stoid,stonama,satuan"+msatuan+" satuan,FORMAT(hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0) hrgjual","stoid='"+misi+"' or barcode='"+misi+"'")

		//query1="select left(a.stoid,12) Kode,left(a.stonama,30) Nama,satuan"+msatuan+" Sat,left(format(a.hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0),15) rightHarga,right(concat(truncate(totqty/isi,0),' ',satuan1,' ',truncate(mod(totqty,isi),0),' ',satuan2),20) rightQty from setstok a "
		//query2="left join (select bpid,sum(qtyin-qtyout) totqty from bkbesar where rekid like '103%' and bpid2='L001' group by bpid) b on a.stoid=b.bpid where stonama <>'' "
		if (hakedit==1)
		{
		query1="select  left(a.stoid,10) K, left(a.barcode,15) Barc,left(a.stonama,30) Nama,left(format(a.hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0),12) rightHarga,'L001' QSALDO,stoid from setstok a "
		query2=" where true "
		}
		else
		{
		query1="select  left(a.stoid,10) K, left(a.barcode,15) Barc,left(a.stonama,30) Nama,left(format(a.hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0),12) rightHarga  from setstok a "		
		query2=" where true "
		}	
		query1="select  left(a.stoid,10) K, left(a.barcode,15) Barc,left(a.stonama,30) Nama,left(format(a.hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0),12) rightHarga,'L001' QSALDO,stoid from setstok a "
		query2=" where true "
		//query1="select  left(a.stoid,10) K, left(a.barcode,15) Barc,left(a.stonama,30) Nama,left(format(a.hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0),12) rightHarga  from setstok a "		
		//query2=" where true "

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

	$Pcs2(document).keyup(function() {
		mmf2=event.element(event);
		mmid=mmf2.id
		m22=mmid.substr(0,2)
		
		if (m22==15 || m22==16 || mmid=='mbayar' || mmid=='medc')
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
		}
		
		if (mmid=='mdiskonp')
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
			if (!(miss=='' || miss=='0'))
			{
				$Pcs2("#mdiskonrp").val("")
			}
		}

		if (mmid=='mdiskonrp')
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
		if (!(miss=='' || miss=='0'))
		{

			$Pcs2("#mdiskonp").val("")
		}
		}

		//rumus1()	
	})
	
		
	
	$Pcs2("#bya").click(function() {
		mkredit=true
		$Pcs2("#btnsimpan").click()
	})

	$Pcs2("#bti").click(function() {
		$Pcs2("#mbayar").select()
	})

	$Pcs2("#mbayar").keyup(function() {
		$Pcs2("div[id$=tooltip]").show();	
	})
  
	$Pcs2("#mdiskon").focus(function() {
		$Pcs2("#cdiskon").html('Isikan Password');				
		this.type='password'
	})
	
	$Pcs2("#mdiskon").keypress(function() {
		if (event.keyCode==13 && event.which!=0)
		{
			if (this.type=='password')
			{
			mmm=this.value
			if (mmm=='123abc123')
			{
			this.value=''
			this.type='text'
			this.select()
			$Pcs2("#cdiskon").html('Diskon');				
			}
			else
			{
			$Pcs2("#cdiskon").html('Isikan Password');				
			this.select()
			}
			
			}
			
			else
			
			{
			$Pcs2("#mbayar").select()
			}
		}

		if (this.type=='text')
		{
		this.value=tra(this.value)
		}
	})

	$Pcs2("#mkarid").blur(function() {
		execajaxa("update transkasir1 set karid='"+this.value+"' where nid='"+mniddold+"'")
	echo("update transkasir1 set karid='"+this.value+"' where nid='"+mniddold+"'")
	return
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

	$Pcs2("#mlgnid").blur(function() {
		datas=taptabel("setlgn","lgnid,lgnnama,golongan","lgnid='"+this.value+"'")
		$Pcs2("#mlgnid").val("")
		$Pcs2("#mlgnnama").val("")
		$Pcs2("#mgolongan").val("")
		if (datas.lgnid!=undefined)
		{
		$Pcs2("#mlgnid").val(datas.lgnid)
		$Pcs2("#mlgnnama").val(datas.lgnnama)
		$Pcs2("#mgolongan").val(datas.golongan)
		$Pcs2("#mket").focus()
		arahharga(3)
		
		}
	})

	$Pcs2("#mnid").blur(function() {
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transkasir1","*","nid='"+mnid+"' ")
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))
			$Pcs2("#mlgnid").val(mgg.lgnid)
			$Pcs2("#mfakturid").val(mgg.fakturid)
			$Pcs2("#mbayar").val(tra(toval(mgg.bayar)))
			$Pcs2("#mtotal").val(tra(toval(mgg.total)))
			$Pcs2("#mdiskon").val(tra(toval(mgg.diskon)))
			$Pcs2("#mjumlah").val(tra(toval(mgg.jumlah)))
			$Pcs2("#medc").val(tra(toval(mgg.edc)))
			$Pcs2("#mkembali").val(tra(toval(mgg.kembali)))			
			$Pcs2("#mlgnid").blur()
			refreshgrid2(mgg)
			$Pcs2("#mfakturid").focus()
			if (hakedit==1)
			{
			$Pcs2("#btnsimpan").show()
			}
			else
			{
			//$Pcs2("#btnsimpan").hide()
			}
			
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

	$Pcs2("#lookmlgnid").click(function() {
		mcomm="Select rpad(lgnid,12,' ') Kode,left(lgnnama,50) Nama from setlgn where true"
		mordd="Kode"
		mffff=" concat(lgnid,lgnnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookmnid").click(function() {
		if (hakedit=='1')
		{
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,kasir Kasir,jam Jam,left(lgnnama,16) Pelanggan,total Total from transkasir1  a left join setlgn b on a.lgnid=b.lgnid where total<>0 "
		}
		else
		{
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,kasir Kasir,jam Jam,left(lgnnama,16) Pelanggan,total Total from transkasir1  a left join setlgn b on a.lgnid=b.lgnid  where total<>0 and kasir='"+$Pcs2("#mkasir").val()+"'"
		}

		//mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,kasir Kasir,jam Jam,total Total from transkasir1  where total<>0 and kasir='"+$Pcs2("#mkasir").val()+"'"
		mordd="Nota"
		mffff=" concat(nid,date_format(tgl,'%d-%m-%Y'),ifnull(lgnnama,'')) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Transaksi Kasir');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
		
	$Pcs2("#btntutup").click(function() {
		$Pcs2("#kotakdialog").dialog('close')
	})

	$Pcs2("#btnsimpan").click(function() {
///

		mbay=toval($Pcs2("#mbayar").val())
		mtot=toval($Pcs2("#mjumlah").val())
		if (mbay<mtot && $Pcs2("#mlgnid").val()=='')
		if (mbay+medc<mtot && $Pcs2("#mlgnid").val()=='')
		{
		$Pcs2("#mbayar").select();
		$Pcs2("#board").html("Bayar harus diisi !");
		$Pcs2("#yesno").hide();
		return;
		}

		if (mbay<mtot && $Pcs2("#mlgnid").val()!='' && mkredit==false)
		{

		$Pcs2("#board").html("Diberi Kredit ?");		
		$Pcs2("#bya").select()
		$Pcs2("#yesno").show()
		return;		

		}

///

	//$Pcs2("#kotakdialog").dialog('close')
			
		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
		mnid=$Pcs2("#mnid").val()
		mlgnid=$Pcs2("#mlgnid").val()
		mtotal=toval($Pcs2("#mtotal").val())
		mdiskon=toval($Pcs2("#mdiskon").val())
		mjumlah=toval($Pcs2("#mjumlah").val())
		medc=toval($Pcs2("#medc").val())
		mbayar=toval($Pcs2("#mbayar").val())
		mkembali=toval($Pcs2("#mkembali").val())
		mkartu=$Pcs2("#mkartu").val()
		mref1=$Pcs2("#mref1").val()
		mref2=$Pcs2("#mref2").val()
		mkasir=$Pcs2("#mkasir").val()
		mjam=$Pcs2("#mjam").val()

		xxw=window.open('printkasir.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=450,height=400,left=600,top=10'));
		xxw.focus()
		

			execajaxas("DELETE FROM transkasir1  where nid='"+mnid+"'")
			execajaxas("DELETE FROM transkasir2  where nid='"+mnid+"'")
			execajaxas("DELETE FROM bkbesar  where nid='"+mnid+"'")

			mq1="insert into transkasir1(nid,tgl,jam,kasir,total,diskon,jumlah,edc,bayar,kembali,status,kartu,referensi1,referensi2,lgnid) "
			mq2=" values('"+mnid+"',"+mtgl+",'"+mjam+"','"+mkasir+"','"+mtotal+"','"+mdiskon+"','"+mjumlah+"','"+medc+"','"+mbayar+"','"+mkembali+"',2,'"+mkartu+"','"+mref1+"','"+mref2+"','"+mlgnid+"')"
			execajaxas(mq1+mq2)
		
			mtot=0
			mkata=" insert into transkasir2(nid,tgl,stoid,qty,hrgsat,cdiskon,jmlhrg,satuan,isi,num) values "
			for (gg=1;gg<100;gg++)
			{
			
			mstoid=$Pcs2("#12_"+gg).val()
			mqty=toval($Pcs2("#15_"+gg).val())
			misi=toval($Pcs2("#19_"+gg).val())
			mtotqty=mqty*misi
			mcdiskon=$Pcs2("#17_"+gg).val()
			mjmlhrg=toval($Pcs2("#18_"+gg).val())
			mhrgsat=toval($Pcs2("#16_"+gg).val())
			msatuan=$Pcs2("#14_"+gg).val()
			
			if (mstoid==undefined)
			{
			break;
			}
			
			if (mstoid!='')
			{
						
			mtglx=baliktanggal( $Pcs2("#mtgl").val() )

			mstoid=$Pcs2("#12_"+gg).val()
			mq1="insert into transkasir2(nid,tgl,stoid,qty,hrgsat,cdiskon,jmlhrg,satuan,isi,num) "
			mq2=" ('"+mnid+"',"+mtgl+",'"+mstoid+"','"+mqty+"','"+mhrgsat+"','"+mcdiskon+"','"+mjmlhrg+"','"+msatuan+"','"+misi+"','"+gg+"'), "
			mkata=mkata+mq2
			execajaxas(mkata)
			
			}

			}

			mq2=" ('','','','','','','','','','') "
			mkata=mkata+mq2
			execajaxas(mkata)
			
$Pcs2.ajax({
type:"POST",
url:"jurnaling.php",
async: true,
data : "mnid="+mnid,
success : function(data){


}})
			
			alert("Data Tersimpan !")
			baru()
			$Pcs2("#mtotal").val(tra(mtotal))
			$Pcs2("#mdiskon").val(tra(mdiskon))
			$Pcs2("#mjumlah").val(tra(mjumlah))
			$Pcs2("#medc").val(tra(medc))
			$Pcs2("#mbayar").val(tra(mbayar))
			$Pcs2("#mkembali").val(tra(mkembali))
			$Pcs2("#mkartu").val(tra(mkartu))
			$Pcs2("#mref1").val(tra(mref1))
			$Pcs2("#mref2").val(tra(mref2))

		
/////////////

	})

	
	$Pcs2("#btnbaru").click(function() {
		baru()
	})

	$Pcs2("#btnsimpandiskon").click(function() {
		vo=$Pcs2("#"+inputobj)
		vll=vo.val()
		if (vll=='')
		{
		vid=toval(inputobj.replace('12_',''))-1
		vid=vid.toString()
		mid="17_"+vid
		}
		else
		{
		mid=inputobj.replace('12','17')
		}
		
		
		if ($Pcs2("#mdiskonp").val()!='')
		{$Pcs2("#"+mid).val($Pcs2("#mdiskonp").val()+'%')}
		if ($Pcs2("#mdiskonrp").val()!='')
		{$Pcs2("#"+mid).val($Pcs2("#mdiskonrp").val())}
		$Pcs2("#kotakdialog").dialog('close')
		$Pcs2("#"+inputobj).focus()
		rumus1()

	})

	$Pcs2("#btndiskon").click(function() {
		$Pcs2("#kotakdialog").dialog('option', 'width', 550);		
		$Pcs2("#kotakdialog").dialog('option', 'title', 'Diskon');
		//$Pcs2("#mtab1").hide()
		$Pcs2("#mtab2").show()
		$Pcs2("#kotakdialog").dialog('open');
		$Pcs2("#mdiskonp").focus()
	})

	$Pcs2("#btnhapus").click(function() {
		mnid=$Pcs2("#mnid").val()
		mconf=confirm("Menghapus Transaksi No. "+mnid+"?")
		if (mconf==false)
		{return;}
		execajaxas("delete from transkasir1 where nid='"+mnid+"'")
		execajaxas("delete from transkasir2 where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")
		alert("Data Terhapus !")
		baru()
	})

	$Pcs2("#btnmember").click(function() {

		query1="select rpad(lgnid,12,' ') Kode,left(lgnnama,30) Nama,rpad(golongan,12,' ') Gol from setlgn "
		query2=" where true "

		mcomm=query1+query2

		mordd="lgnid"
		mffff=" concat(lgnnama,lgnid) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelanggan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	
	})

	$Pcs2("#btnkeluar").click(function() {
		self.close()
	})
	
	});

///awal functions
	function isretur(theid)
	{
	 mmid=theid.replace('12','20')
	 mck=$Pcs2("#"+mmid).attr('checked')
	 if (mck)
	 {
	 $Pcs2("#"+mmid).attr('checked',false)
	 }
	 else
	 {
	 $Pcs2("#"+mmid).attr('checked',true)
	 }
	 rumus1()
	}
	
	function arahharga(theid,golikut)
	{
		$Pcs2("#btnsp").css("color","black")
		$Pcs2("#btngr").css("color","black")
		$Pcs2("#btnec").css("color","black")
		
		mgolongan=$Pcs2("#mgolongan").val()
		
		if (mgolongan=='A' && golikut==undefined )
		{
		theid=1
		}

		if (mgolongan=='B' && golikut==undefined)
		{
		theid=2
		}

		if (mgolongan=='C' && golikut==undefined)
		{
		theid=3
		}

		mharga=theid
		
		if (theid==1)
		{
		$Pcs2("#btnsp").css("color","red")
		}
	
		if (theid==2)
		{
		$Pcs2("#btngr").css("color","red")
		}
		
		if (theid==3)
		{
		$Pcs2("#btnec").css("color","red")
		}
		
		if (mharga==1)
		{mharga=''}
		
	}

	function arahsatuan(theid)
	{
		$Pcs2("#btnpartai").css("color","black")
		$Pcs2("#btnecer").css("color","black")
		msatuan=theid
		
		if (theid==1)
		{
		arahharga(2)
		$Pcs2("#btnpartai").css("color","red")
		}
	
		if (theid==2)
		{
		arahharga(3)
		$Pcs2("#btnecer").css("color","red")
		}
		
	}

function arah2(theid)
{
			mname=theid.id;
			lastobj=mname;
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

}	
	function arah(theid)
	{
			mopp=$Pcs2("#kotakdialog").dialog("isOpen");
			if (mopp){return};
			mopp=$Pcs2("#kotakdialog2").dialog("isOpen");
			if (mopp){return};	

			if (event.keyCode==13 && theid.value!='')
			{
				theid.blur()
			}

			if (event.keyCode==35)
			{
				if ($Pcs2("#divtot").html()=='<font size="8">0</font>')
				{return;}
				$Pcs2("#lblwalk").hide()
				//$Pcs2("#lblwalk").html("Akhir Transaksi")
				$Pcs2("#lblwalk").show()
				$Pcs2("#mtab2").hide()
				//$Pcs2("#mtab1").show()
				$Pcs2("#btnsimpan").show()
				//$Pcs2("#kotakdialog").dialog('option', 'width', 850);		
				//$Pcs2("#kotakdialog").dialog('open')
				$Pcs2("#mbayar").focus()
				$Pcs2("#mbayar").val('')
				rumus1()

				
			}

			mtitik=theid.value.indexOf('.')

  			if (event.keyCode==46 && theid.value!='' && mtitik<=0 && event.which==0)
			{
				$Pcs2("#lblwalk").html("Stok batal : "+$Pcs2("#13_"+msatu).val()+' '+$Pcs2("#15_"+msatu).val()+" X "+$Pcs2("#16_"+msatu).val()+" = "+$Pcs2("#18_"+msatu).val())
				mall=toval(msatu)
				for (jkk=mall;jkk<101;jkk++)
				{
					mset=jkk+1
					miss=$Pcs2("#12_"+mset).val()
					$Pcs2("#12_"+jkk).val($Pcs2("#12_"+mset).val())
					$Pcs2("#13_"+jkk).val($Pcs2("#13_"+mset).val())
					$Pcs2("#14_"+jkk).val($Pcs2("#14_"+mset).val())
					$Pcs2("#15_"+jkk).val($Pcs2("#15_"+mset).val())
					$Pcs2("#16_"+jkk).val($Pcs2("#16_"+mset).val())
					$Pcs2("#17_"+jkk).val($Pcs2("#17_"+mset).val())
					$Pcs2("#18_"+jkk).val($Pcs2("#18_"+mset).val())
					$Pcs2("#19_"+jkk).val($Pcs2("#19_"+mset).val())

					if (miss=='')
					{
					$Pcs2("#12_"+jkk).focus()
					$Pcs2("#12_"+jkk).select()
					$Pcs2("#bodiv_"+mset).hide()
					break;
					}
					
				}

				rumus1()
			}

			if (event.keyCode==39 || event.keyCode==40)
			{
				if (theid.value=='')
				{return;}
				mggg=getNextElement2(theid)			
				if (mggg.type!='button')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				mggg.focus()
				mggg.select()
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
			}
			
			if (event.keyCode==37 || event.keyCode==38)
			{
				mjjj=getPrevElement2(theid)
				if (mjjj.type!='button')
				{
				$Pcs2("#"+mjjj.id).css("background-color","lightblue")					
				}
				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)
				mjjj.focus()
				mjjj.select()
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			}
			
			
	}
		

	function refreshgrid2(mgg)
	{

		mser="&mnid="+$Pcs2("#mnid").val();
		$Pcs2.ajax({
		type:"POST",
		chace : true,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridkasir.php",
		data : "mTform=transkasir1"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
			for (mcc=1;mcc<101;mcc++)
			{
				if ($Pcs2("#12_"+mcc).val()=='')
				{$Pcs2("#12_"+mcc).select();break;}
			}
			$Pcs2("#divtot").html(tra(toval(mgg.jumlah)))

		}});

	}
	
	function baru(mgdn)
	{
		mnid=$Pcs2("#mnid").val()
		document.fform.reset()
		$Pcs2("#mtgl").val("")
		$Pcs2("#mnid").val("")
		$Pcs2("#mlgnid").val("")
		$Pcs2("#mlgnnama").val("")
		$Pcs2("#board").html("")
		$Pcs2("#yesno").hide()
		$Pcs2("#mkasir").val('<?php echo $_SESSION['MASUK']; ?>')
		mkredit=false
		///
		mjjj=jam()
		///
		$Pcs2("#mjam").val(mjj)
		$Pcs2("#lblwalk").hide(true)
		$Pcs2("#lblwalk").html("PUTRA MAJAPAHIT Siap Melayani Anda")
		$Pcs2("#lblwalk").show(true)
		inputobj="12_1"
		lastobj="12_1"

		$Pcs2("#mtgl").val(tglsekarang());


		datas=taptabel("transkasir1","nid","kasir='"+midkasir+"' order by nid desc limit 0,1")
		data=datas.nid;
			
		if (data!=undefined)
		{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			midkasir='<?php echo $_SESSION['MASUK']; ?>'
			mmmerkid='TK'+padl(mmmerkid,'0',7)+'/'+midkasir
		}
		else
		{
			midkasir='<?php echo $_SESSION['MASUK']; ?>'
			mmmerkid='TK0000001'+'/'+midkasir
		}


		$Pcs2("#mnid").val(mmmerkid);
		execajaxas("delete from transkasir1 where nid='"+mmmerkid+"'")
		execajaxa("insert into transkasir1(nid,tgl,jam,kasir) values('"+$Pcs2("#mnid").val()+"','"+baliktanggal2($Pcs2("#mtgl").val())+"','"+$Pcs2("#mjam").val()+"','"+$Pcs2("#mkasir").val()+"') ")
		document.title="Kasir :"+mmmerkid;
		$Pcs2("#subtitle").html("Kasir :"+mmmerkid)
		//execajaxa("insert into transkasir1(nid,status) values('"+mmmerkid+"',1)")
		//execajaxas("delete from transkasir2 where nid='"+mmmerkid+"'")
		//execajaxas("delete from bkbesar where nid='"+mmmerkid+"'")
		$Pcs2("#mnid").val(mmmerkid);
		$Pcs2("#divtot").html("<font size=8>0")
		arahharga(3)
		arahsatuan(2)
		//refreshgrid2()
		
		for (jkk=1;jkk<101;jkk++)
		{
			if ($Pcs2("#12_"+jkk).val()==undefined)
			{break;}
			$Pcs2("#12_"+jkk).val('')
			$Pcs2("#13_"+jkk).val('')
			$Pcs2("#14_"+jkk).val('')
			$Pcs2("#15_"+jkk).val('')
			$Pcs2("#16_"+jkk).val('')
			$Pcs2("#17_"+jkk).val('')
			$Pcs2("#18_"+jkk).val('')
			$Pcs2("#19_"+jkk).val('')

		}
		$Pcs2(".thebodiv").hide()
		$Pcs2("#bodiv_1").show()
		$Pcs2("#12_1").focus();
	}

	function ambilstok(theid)
	{
		mopp=$Pcs2("#kotakdialog2").dialog("isOpen");
		if (mopp){return};
		if (theid.value==''){return;};
		
		mmid=theid.id
		misi=theid.value
		misi=misi.toUpperCase()
		theid.value=misi
		
		rownama=mmid.replace('12','13')
		rowsat1=mmid.replace('12','14')
		rowqty=mmid.replace('12','15')
		rowhrg=mmid.replace('12','16')
		rowstoid=mmid.replace('12','stoid')
		rowisi=mmid.replace('12','19')
		rowdisk=mmid.replace('12','17')
		rowretur=mmid.replace('12','20')
		
		mrett=$Pcs2("#"+rowretur).attr('checked')
				
		if ($Pcs2("#"+rownama).val()!='')
		{
		isinya=toval($Pcs2("#"+rowisi).val())
		mjmll=toval(misi)
		if (mjmll>0)
		{

		mvseb=$Pcs2("#"+rowqty).val()
		$Pcs2("#"+rowqty).val(mjmll)
		theid.value=$Pcs2("#"+rowstoid).val()
		mhh=cekcukup($Pcs2("#"+rowstoid).val(),mjmll*isinya,mrett)

		if (mhh)
		{
		$Pcs2("#"+rowqty).val(mvseb)
		$Pcs2("#"+lastobj).focus()
		rumus1()	
		return;
		}


			mbef=toval(rowqty.substr(3,10))
			mseb=rowqty.substr(0,3)
			$Pcs2("#lblwalk").hide()
			$Pcs2("#lblwalk").html($Pcs2("#13_"+mbef).val()+' '+mjmll+" X "+$Pcs2("#16_"+mbef).val()+" = "+tra(toval($Pcs2("#16_"+mbef).val())*mjmll))
			$Pcs2("#lblwalk").show(true)
			$Pcs2("#"+lastobj).focus()
		}
		rumus1();
		return;
		}

		mha=mharga
		if (mharga==1)	
		{
		mha=''
		}

		//mstok=taptabel("setstok","stoid,stonama,satuan"+msatuan+" satuan,FORMAT(hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0) hrgjual","stoid='"+misi+"' or barcode='"+misi+"'")

		mfield="stoid,barcode,barcode2,stonama,satuan"+msatuan+" satuan,FORMAT(hrgjual"+mha+"/if("+msatuan+"=1,1,isi),0) hrgjual,format(hrgbeli,0) hrgbeli,0 diskon,if("+msatuan+"=1,isi,1) isi"

		mtabel="setstok a left join setgrp b on a.grpid=b.grpid "

		mkondisi="stoid='"+misi+"' or barcode='"+misi+"' or barcode2='"+misi+"'"

mjadi="func=EXEC&field="+mfield+"&tabel="+mtabel+"&kondisi="+mkondisi;
mdat='';
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
dataType:'json',
async: false,
data : mjadi,
success : function(data){
mstok=data

		if (mstok.stonama!=undefined )
		{

		theid.value=mstok.stoid

		msatuanold=msatuan
		
		if (misi==mstok.barcode2)
		{
		arahsatuan(1);
		mfield="stoid,barcode,barcode2,stonama,satuan"+msatuan+" satuan,FORMAT(hrgjual"+mharga+"/if("+msatuan+"=1,1,isi),0) hrgjual,format(hrgbeli,0) hrgbeli,0 diskon,if("+msatuan+"=1,isi,1) isi"
		mstok=taptabel(mtabel,mfield,mkondisi)		
		}

		if (misi==mstok.barcode)
		{
		arahsatuan(2);
		arahharga(3);
		mfield="stoid,barcode,barcode2,stonama,satuan"+msatuan+" satuan,FORMAT(hrgjual"+mharga+"/if("+msatuan+"=1,1,isi),0) hrgjual,format(hrgbeli,0) hrgbeli,0 diskon,if("+msatuan+"=1,isi,1) isi"
		mstok=taptabel(mtabel,mfield,mkondisi)		
		}
		arahsatuan(msatuanold);

		mhh=cekdoble(theid,mstok.satuan)
		if (mhh)
		{
		theid.value='';
		$Pcs2("#"+lastobj).focus()
		rumus1()	
		return;
		}

		mhh=cekcukup(mstok.stoid,1,mrett)
		if (mhh)
		{
		theid.value='';
		$Pcs2("#"+lastobj).focus()
		rumus1()	
		return;
		}
		
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan)
		$Pcs2("#"+rowisi).val(mstok.isi)
		$Pcs2("#"+rowdisk).val(mstok.diskon+'%')
		
		mqq=toval($Pcs2("#"+rowqty).val())
		if (mqq==0)
		{
			$Pcs2("#"+rowqty).val('1')
		}
		$Pcs2("#"+rowhrg).val(mstok.hrgjual)
		$Pcs2("#"+rowstoid).val(mstok.stoid)	
		theid.value=mstok.stoid
		$Pcs2("#lblwalk").hide()
		$Pcs2("#lblwalk").html(mstok.stonama+" 1 X "+mstok.hrgjual+" = "+mstok.hrgjual)
		$Pcs2("#lblwalk").show(true)

		mtrr=toval(mmid.substr(3,20))+1
		$Pcs2("#bodiv_"+mtrr).show()
		aaa=getNextElement2(theid)
		didi=aaa.id
		mooo=didi.replace('12','bodiv')
		$Pcs2("#"+mooo).show()
		aaa.focus()		
		lastobj=didi

		
		rumus1()	

		}
		else
		{

		misi=misi.replace('..','.')
		misi=misi.replace('..','.')
		misi=misi.replace('..','.')
		mjmll=toval(misi)
		if (misi.length<5 && mjmll>0)
		{			
			mbef=toval(rowqty.substr(3,10))-1
			mseb=rowqty.substr(0,3)
			msto=$Pcs2("#12_"+mbef).val()
			
			mrett=$Pcs2("#20_"+mbef).attr('checked')
		
			isinya=toval($Pcs2("#19_"+mbef).val())
			mjmll2=mjmll*isinya

		mhh=cekcukup(msto,mjmll2,mrett)
		if (mhh)
		{
		theid.value='';
		$Pcs2("#"+lastobj).focus()
		rumus1()	
		return;
		}
			
			$Pcs2("#"+mseb+mbef).val(mjmll)
			$Pcs2("#lblwalk").hide()
			$Pcs2("#lblwalk").html($Pcs2("#13_"+mbef).val()+' '+mjmll+" X "+$Pcs2("#16_"+mbef).val()+" = "+tra(toval($Pcs2("#16_"+mbef).val())*mjmll))
			$Pcs2("#lblwalk").show(true)
			$Pcs2("#"+lastobj).focus()
			theid.value=""
			rumus1()	
			return;
		}
		alert("Stok Tidak Ada !")
		lastobj=theid.id
		$Pcs2("#"+rownama).val("")
		$Pcs2("#"+rowsat1).val("")		
		$Pcs2("#"+rowqty).val("")
		theid.value=""
		$Pcs2("#"+lastobj).focus()
		}

}})
		

		rumus1()
	}

	function rumus1()
	{
		mj1=0
		mj2=0
		mnnn=1
		for (gg=1;gg<100;gg++)
		{
			$Pcs2("#11_"+gg).val(gg+".")

			if ($Pcs2("#12_"+gg).val()!='')
			{
			mqty=toval($Pcs2("#15_"+gg).val())
			mcc=$Pcs2("#20_"+gg).attr('checked')
			if (mcc)
			{
			mqty=-1*Math.abs(mqty)
			}
			else
			{
			mqty=Math.abs(mqty)
			}

			$Pcs2("#15_"+gg).val(tra(mqty))
			mhrg=toval($Pcs2("#16_"+gg).val())
			mdis=toval($Pcs2("#17_"+gg).val())
			md1=$Pcs2("#17_"+gg).val()
			mat=md1.indexOf('%')
			if (mat>0)
			{
				mds=md1.replace('%','')
				mdis=mhrg*toval(mds)*0.01
			}
			
			mjmlhrg=mqty*(mhrg-mdis)
			mjmlhrg=Math.round(mjmlhrg)
			
			$Pcs2("#18_"+gg).val(tra(mjmlhrg))
			
			mnii=$Pcs2("#18_"+gg).val()	
			mj1=mj1+toval(mnii)
			
			mnnn=mnnn+1

			}

			
			//rumus2()
		}
		
		mj1=mj1
		$Pcs2("#divtot").html("<font size=8>"+tra(mj1))

		$Pcs2("#mdiskon").val('')
		$Pcs2("#mjumlah").val('')
		$Pcs2("#medc").val('')
		$Pcs2("#mbayar").val('')
		$Pcs2("#mkembali").val('')
		
		$Pcs2("#mtotal").val(tra(mj1))
		$Pcs2("#mjumlah").val(tra(mj1))
		$Pcs2("#mkembali").val('-'+tra(mj1))
		rumus2()		
	}
	
	function rumus2()
	{
	mtotal=toval($Pcs2("#mtotal").val())
	mdiskon=toval($Pcs2("#mdiskon").val())
	mjumlah=mtotal-mdiskon
	$Pcs2("#mjumlah").val(tra(mjumlah))
	mbayar=toval($Pcs2("#mbayar").val())
	medc=toval($Pcs2("#medc").val())
	mkembali=(mbayar+medc)-mjumlah
	$Pcs2("#mkembali").val(tra(mkembali))
	}

function fokes(theee)
{
		$Pcs2("#"+theee.id).css("background-color","lightgreen")

}	

function lostfokes(theee)
{
		$Pcs2("#"+theee.id).css("background-color","white")
}	

	function ceksaldo(theid)
	{
	mdidi=theid.id
	mqty=toval(theid.value)
	mdidi2=mdidi.replace("15","12")
	mdidi3=mdidi.replace("15","19")
	mstoid=$Pcs2("#"+mdidi2).val()
	misi=toval($Pcs2("#"+mdidi3).val())
	mnid=toval($Pcs2("#"+mdidi3).val())
	mgh=taptabel("bkbesar","sum(qtyin-qtyout) saldo","bpid='"+mstoid+"' and nid<>'"+toval($Pcs2("#"+mnid).val())+"'")
	if ((mqty*misi)>mgh.saldo)
	{
		alert("Stok Tidak Mencukup ! Saldo :"+mgh.saldo);
		theid.value=0;
		mbef=toval(rowqty.substr(3,10))-1
		mseb=rowqty.substr(0,3)			
		return;
	}	
	}

	function cekdoble(theid,satt)
	{
	misi=theid.value
	for (gg=1;gg<100;gg++)
	{
		mii=$Pcs2("#12_"+gg).val()
		mnn=$Pcs2("#13_"+gg).val()
		msa=$Pcs2("#14_"+gg).val()
		if (satt==msa && misi==mii && theid.id!="12_"+gg && mnn!='')
		{

		mqt=toval($Pcs2("#15_"+gg).val())+1
		mis=toval($Pcs2("#19_"+gg).val())
		mrett=$Pcs2("#20_"+gg).attr('checked')
		mqt=mqt //*mis
		
		mhh=cekcukup(misi,mqt,mrett)
		if (mhh)
		{
		theid.value='';
		$Pcs2("#"+lastobj).focus()
		rumus1()
		return true;
		}

		$Pcs2("#15_"+gg).val(tra(mqt))
		$Pcs2("#lblwalk").hide()
		$Pcs2("#lblwalk").html($Pcs2("#13_"+gg).val()+' '+mqt+" X "+$Pcs2("#16_"+gg).val()+" = "+tra(toval($Pcs2("#16_"+gg).val())*mqt))		
		$Pcs2("#lblwalk").show(true)
		return true;
		}
	}

	return false
	}	

	function cekcukup(mkode,jumlah,mrett)
	{
	
	if (mrett)
	{return false}
	
	mstokss=taptabel("bkbesar a left join setstok b on a.bpid=b.stoid","b.stonama,right(concat(truncate(sum(qtyin-qtyout)/b.isi,0),' ',b.satuan1,' ',truncate(mod(sum(qtyin-qtyout),b.isi),0),' ',b.satuan2),20) cqty, sum(qtyin-qtyout) saldo","bpid='"+mkode+"' and bpid2='L001' and nid<>'"+$Pcs2("#mnid").val()+"' ")	
	if (mstokss.saldo!=undefined)
	{
	msal=toval(mstokss.saldo)
	}
	else
	{
	msal=0
	}

	if (jumlah>msal)
	{
	alert("Stok "+mstokss.stonama+" Tinggal "+' '+mstokss.cqty+" !")
	return true;
	}
	return false

	}	

	/////akhir function	
</script>
</head>

<body background='images/num.jpg' style='font-size:90%;font-family:arial' opacity=40%>
<?php 
	require("menu.php");
	//execute("ALTER TABLE `transkasir1` CHANGE `nid` `nid` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL");
	//execute("ALTER TABLE `transkasir1` ADD `lgnid` VARCHAR( 20 ) NOT NULL DEFAULT ''");
	
?>
	<form name='fform' id='fform'>
	
	<font face='arial' color='white'><b>
	<table width=100% border=0 style='border-collapse:'>

	<tr>
	<td colspan=3 align=left>
	&nbsp;Tgl.&nbsp;: <input type=text id=mtgl size=10 readonly style='font-weight: bold'>
	&nbsp;Nota&nbsp;: <input type=text id=mnid size=10  readonly style='font-weight: bold'><input type=button id=lookmnid value='F5'>
	&nbsp;Kasir&nbsp;: <input type=text id='mkasir' readonly size=10 style='font-weight: bold'  disabled>
	&nbsp;Jam&nbsp;: <input type=text id='mjam' readonly size=8 style='font-weight: bold'  disabled>
	&nbsp;Member&nbsp;: <input type=text  size=5 id='mlgnid'  readonly style='font-weight: bold'><input type=text id=mgolongan size=1 readonly style='font-weight: bold'><input type=text id=mlgnnama size=25 readonly style='font-weight: bold'>
	<hr></td>
	</tr>

	<tr>
	<td rowspan=1 colspan=1 width=75% align=center valign=center>
	<font size=4><marqueex direction='up' height='50' scrollamount='1'><label id=lblwalk>ABILIYAN SWALAYAN & GROSIR Siap Melayani Anda</marquee>
	</td>
	<td colspan=2 valign=bottom align=right bgcolor=orangex background='images/numx.jpg'><font size=8><label id=divtot >0</label></font><br><label id=lblbilang></label></td>
	</tr>
	
	<tr>
	<td colspan=2 valign=top><font face='arial' color='black'><span id='spantabel2'>
	<td align=right valign=top bgcolor=orange>
	
	<table style='font-size:12pt' id=mtab1 border=0 width=100%  bgcolor=brown>
	<tr hidden><td>Total</td><td>: <input type=text id=mtotal size=10 readonly style='text-align:right;font-weight: bold;font-size:16pt' onkeyup=rumus2()></td><tr>
	<tr height=30><td align=center valign=top bgcolor=pink id='board' style='font-weight:bold' colspan=2> </td></tr>
	<tr><td align=center bgcolor=pink id='yesno' colspan=2><input type=button value='Ya' id='bya'><input type=button value='Tidak' id='bti'> </td><tr>
	<tr hidden><td id='cdiskon'>Diskon</td><td> <input type=text id=mdiskon size=10   style='text-align:right;font-weight: bold;font-size:16pt' onkeyup=rumus2() onfocus=fokes(this) onblur=lostfokes(this)></td><tr>
	<tr><td>Jumlah</td><td> <input type=text id=mjumlah size=10   readonly style='text-align:right;font-weight: bold;font-size:16pt' onkeyup=rumus2()></td><tr>
	<tr><td>EDC</td><td> <input type=text id=medc size=10   style='text-align:right;font-weight: bold;font-size:16pt' onkeyup=rumus2()></td><tr>
	<td align=right> Kartu </td><td> <select id=mkartu><option value='BCA'>BCA</option><option value='Mandiri'>Mandiri</option></select> </td><tr>
	<td align=right> Ref </td><td> <input type=text id=mref1 size=10 style='text-align:right;font-weight: bold;font-size:16pt'> </td><tr>
	<td align=right> </td><td><input type=text id=mref2 size=10 style='text-align:right;font-weight: bold;font-size:16pt'></td><tr>
	<tr><td>Bayar</td><td> <input type=text id=mbayar size=10   tooltipText="Type in your firstname in this box" style='text-align:right;font-weight: bold;font-size:16pt' onkeyup=rumus2() onfocus=fokes(this) onblur=lostfokes(this)></td><td></td><tr>
	<tr><td colspan=2><hr></td><tr>
	<tr><td width=160>Kembali</td><td> <input type=text id=mkembali size=10   style='text-align:right;font-weight: bold;font-size:16pt' onfocus=fokes(this) onblur=lostfokes(this)></td><td></td><tr>
	<tr><td colspan=3 align=center><hr><input type=button value='Simpan' id='btnsimpan'> <br><br></td></tr>
	</table>
	
	</td>
	</span></td>
	</tr>

	</table>

	</font>

	</form>

	<input type='button' value='End-Bayar' id='btnbayar'>	
	<input type='button' value='F1-Antian Baru' id='btnantri'>	
	<input type='button' value='F2-Baru' id='btnbaru'>	
	<input type='button' value='F3-Partai' id='btnpartai'>
	<input type='button' value='F4-Ecer'  id='btnecer'>		
	<input type='button' value='F5-Stok'  id='btnstok'>		
	<input type='button' value='F6-Diskon'  id='btndiskon'>		
	<input type='button' value='F7-Sp'  id='btnsp' hidden>		
	<input type='button' value='F8-Gr'  id='btngr'>		
	<input type='button' value='F9-Ec'  id='btnec'>		
	<input type='button' value='F10-Retur'  id='btnretur'>		
	<input type='button' value='F11-Member'  id='btnmember'>		
	<input type='button' value='F12-Keluar'  id='btnkeluar'>
	<input type='button' value='DEL-Hapus Item'  id='btnhapusitem'>
	<input type='button' value='Ctrl+Tab-Ganti Antrian'  id='btnganti'>
	
	<?php
	if ($hakedit==1)
	{
	echo "<input type='button' value='Hapus'  id='btnhapus'>";
	}
	?>
	

	<div id="kotakdialog" title="Akhir Transaksi" align=right>

	<form name='fform2' id='fform2'>
	
	</form>

	<form name='fform3' id='fform3'>
	
	<table style='font-size:12pt'  id=mtab2 border=0  width=100%>
	<tr><td rowspan=5><img src='images/diskon2.png'></td><td align=right> Diskon %</td><td width=45%>: <input type=text id=mdiskonp  style='text-align:right'><tr>
	<tr> <td align=right>Diskon Rp.</td><td width=45%>: <input type=text id=mdiskonrp  style='text-align:right'><tr>
	<tr><td align=center colspan=2><hr><input type=button value='OK' id='btnsimpandiskon'> <input type=button value='Batal' id='btnbataldiskon'></td></tr>
	</table>
	
	</div>	
		
	</form>

	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></td></tr>
		</center>
	</div>	
	
	</body>
</html>