<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_sumberj_data',$links);
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
    <title>Pelunasan Hutang</title>
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
	$Pcs2("#setper").html("<font size=3><i>Pelunasan Hutang</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Pelunasan Hutang");
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

		if (mmv==116 && mmid.substr(0,2)=='16')
		{

		query1="select rekid Kode,reknama Nama from setrek "
		query2="where nrcid='101'"
		mcomm=query1+query2

		mordd="Kode"
		mffff=" reknama "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Rek. Bank');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		}
	})

	$Pcs2("#fform").keyup(function() {	
		mmf2=event.element(event);
		mmid=mmf2.id
		m22=mmid.substr(0,2)
		if (m22==18 || mmid=='mongkos'  || mmid=='mtransfer')
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
		refreshgrid2()
		refreshgrid()
		}
	})

	$Pcs2("#mnid").blur(function() {
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("bkbesar","tgl,nid,bpid,sum(debet) debet","nid='"+mnid+"' and nid2<>'' and debet>0 group by tgl,nid,bpid")

		$Pcs2("#mtotal").val("")
		$Pcs2("#mtransfer").val("")
		$Pcs2("#mrekid").val("")
		$Pcs2("#mkas").val("")
		
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))
			$Pcs2("#msupid").val(mgg.bpid)
			$Pcs2("#mket").val(mgg.ket)
			$Pcs2("#msupid").blur()

			$Pcs2("#mtotal").val(tra(mgg.debet))

			mgg2=taptabel("bkbesar","ifnull(kredit,0) kredit","nid='"+mnid+"' and rekid='10010'")
			$Pcs2("#mkas").val('')
			if (mgg2.kredit!=undefined)
			{
			$Pcs2("#mkas").val(tra(mgg2.kredit))
			}

			mgg3=taptabel("bkbesar","ifnull(rekid,'') rekid,ifnull(kredit,0) kredit","nid='"+mnid+"' and rekid like '101%' and ket not like 'Pencairan%' ")
			$Pcs2("#mtransfer").val('')
			if (mgg3.kredit!=undefined)
			{
			$Pcs2("#mrekid").val(mgg3.rekid)
			$Pcs2("#mtransfer").val(tra(mgg3.kredit))
			}

			mgg4=taptabel("bkbesar","ifnull( sum(kredit),0) kredit","nid='"+mnid+"' and rekid='20110'")
			$Pcs2("#mtotalgiro").val('')
			if (mgg4.kredit!=undefined)
			{
			$Pcs2("#mtotalgiro").val(tra(mgg4.kredit))
			}

			refreshgrid2(mgg)
			refreshgrid()

			
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
		mcomm="select Nota,Tgl,Suplier,rightTotal from (Select CONCAT(nid,DATE_FORMAT(tgl,'%d-%m-%Y'),supnama) as filter,nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,left(concat(a.bpid,'-',supnama),30) Suplier,left(FORMAT(sum(debet),0),12) rightTotal from bkbesar a left join setsup b on a.bpid=b.supid where trans='TRANSLUNASHUTANG' and a.debet>0 and ket not like '%Pencairan%' group by a.nid,a.tgl,a.bpid,b.supnama) as ax WHERE true"
		mordd="Nota"
		mffff=" ax.filter	 "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelunasan Hutang');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
	
	$Pcs2("#btnsimpan").click(function() {
		mnid=$Pcs2("#mnid").val()
		if (mnid==''){alert('Nota Kosong !');$Pcs2("#mnid").focus();return;}

		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"

		msupid=$Pcs2("#msupid").val()
		if (msupid==''){alert('Suplier Kosong !');$Pcs2("#msupid").focus();return;}

		mket=$Pcs2("#mket").val()

		msupnama=$Pcs2("#msupnama").val()
	
		mtotal=toval($Pcs2("#mtotal").val())
		mtotalgiro=toval($Pcs2("#mtotalgiro").val())
		mtransfer=toval($Pcs2("#mtransfer").val())
		mrekid=toval($Pcs2("#mrekid").val())
		mkas=toval($Pcs2("#mkas").val())

		if (mtotal==0){alert('Total Bayar Kosong !');$Pcs2("#18_1").focus();return;}

////Cek giro
			for (gg=200;gg<301;gg++)
			{
			
			mgiroid=$Pcs2("#12_"+gg).val()
			mrekid=$Pcs2("#16_"+gg).val()
			mtglg=$Pcs2("#13_"+gg).val()

			if (mgiroid==undefined || mgiroid=='')
			{break;}
			
			mjumlah=toval($Pcs2("#15_"+gg).val())

			if (mgiroid!='' && mjumlah==0)
			{
				alert("Ada Giro Yang Jumlahnya Kosong !")
				$Pcs2("#15_"+gg).select()
				return;
				break;
			}

			if (mgiroid!='' && mrekid=='')
			{
				alert("Ada Rek. Giro Yang Belum Terisi !")
				$Pcs2("#16_"+gg).select()
				$Pcs2("#16_"+gg).focus()
				return;
				break;
			}

			if (mgiroid!='' && mtglg=='')
			{
				alert("Ada Tgl. Cair Yang Belum Terisi !")
				$Pcs2("#13_"+gg).select()
				return;
				break;
			}

			}
////Cek giro			
		
		mnid=$Pcs2("#mnid").val()
		msql="delete from bkbesar where nid='"+mnid+"'"
		
		$Pcs2.ajax({
		type : 'POST',
		url:"phpexec.php",
		data : "func=EXECUTE&comm="+msql,
		success : function(data){
			
			mtot=0			

			for (gg=1;gg<100;gg++)
			{
			
			mbeliid=$Pcs2("#12_"+gg).val()
			if (mbeliid==undefined || mbeliid=='')
			{break;}

			mtglbeli=baliktanggal2($Pcs2("#13_"+gg).val())
			mbayar=toval($Pcs2("#18_"+gg).val())
			if (mbeliid!='' && mbayar!=0)
			{

			mtglx=baliktanggal( $Pcs2("#mtgl").val() )

			msqql1="insert into bkbesar(rekid ,bpid,tgl,nid,debet,trans,ket,nid2) "			
			msqql2="values('20010','"+msupid+"',"+mtgl+",'"+mnid+"',"+mbayar+",'TRANSLUNASHUTANG','Pelunasan No. "+mbeliid+"','"+mbeliid+"')"
			execajaxa(msqql1+msqql2)
			
			}

			}

////giro
			for (gg=200;gg<301;gg++)
			{
			
			mgiroid=$Pcs2("#12_"+gg).val()

			if (mgiroid==undefined || mgiroid=='')
			{break;}
			
			mtglgiro=baliktanggal($Pcs2("#13_"+gg).val())
			mket=$Pcs2("#14_"+gg).val()
			mjumlah=toval($Pcs2("#15_"+gg).val())
			mrekid=$Pcs2("#16_"+gg).val()
			
			if (mgiroid!='' && mjumlah!=0)
			{

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,trans,ket,nid2,tgl2) "			
			msqql2="values('20110','"+msupid+"','"+mrekid+"',"+mtgl+",'"+mnid+"',"+mjumlah+",'TRANSLUNASHUTANG','Pelunasan No. "+mnid+"','"+mgiroid+"','"+mtglgiro+"')"
			execajaxa(msqql1+msqql2)
			
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,trans,ket,nid2,tgl2) "
			msqql2="values('"+mrekid+"','','','"+mtglgiro+"','"+mnid+"',"+mjumlah+",'TRANSLUNASHUTANG','Pencairan Giro No. "+mnid+"','"+mgiroid+"','"+mtglgiro+"')"
			execajaxa(msqql1+msqql2)

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,trans,ket,nid2,tgl2) "			
			msqql2="values('20110','"+msupid+"','"+mrekid+"','"+mtglgiro+"','"+mnid+"',"+mjumlah+",'TRANSLUNASHUTANG','Pencairan Giro No. "+mnid+"','"+mgiroid+"','"+mtglgiro+"')"
			execajaxa(msqql1+msqql2)
			
			}

			}
////giro			
			msqql1="insert into bkbesar(rekid ,bpid,tgl,nid,kredit,trans,ket) "
			msqql2="values('"+$Pcs2("#mrekid").val()+"','',"+mtgl+",'"+mnid+"',"+mtransfer+",'TRANSLUNASHUTANG','Pelunasan ke "+msupnama+"')"
			execajaxa(msqql1+msqql2)
			
			msqql1="insert into bkbesar(rekid ,bpid,tgl,nid,kredit,trans,ket) "
			msqql2="values('10010','',"+mtgl+",'"+mnid+"',"+mkas+",'TRANSLUNASHUTANG','Pelunasan ke "+msupnama+"')"
			execajaxa(msqql1+msqql2)

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
		execajaxas("delete from translunashutang1 where nid='"+mnid+"'")
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
		mser=mser+"&msupid="+$Pcs2("#msupid").val();

		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridlunashutang.php",
		data : "mTform=translunashutang1"+mser,
		async: false,
		success : function(data){
			$Pcs2("#spantabel").html(data)			
		}});

	}

	function refreshgrid(mgg)
	{

		mser="&mnid="+$Pcs2("#mnid").val();
		mser=mser+"&msupid="+$Pcs2("#msupid").val()+"&mtr=LUNASHUTANG";

		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridgiro.php",
		data : "mTform=translunashutang1"+mser,
		async: false,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
			for (mkkk=200;mkkk<301;mkkk++)
			{
			$Pcs2("#13_"+mkkk).datepicker({dateFormat: 'dd-mm-yy'});
			}

		}});

	}
	
	function baru(mgdn)
	{
		mnid=$Pcs2("#mnid").val()
		datasx=taptabel("translunashutang1","nid","nid='"+mnid+"' and status=2")
		
		$Pcs2("#mtgl").val("")
		$Pcs2("#mnid").val("")
		$Pcs2("#msupid").val("")
		$Pcs2("#msupnama").val("")
		$Pcs2("#mket").val("")
		$Pcs2("#mtotal").val("")
		$Pcs2("#mtotalgiro").val("")
		$Pcs2("#mtransfer").val("")
		$Pcs2("#mkas").val("")
		
		$Pcs2("#mtgl").val(tglsekarang());

		datas=taptabel("bkbesar","nid","trans='TRANSLUNASHUTANG' order by nid desc limit 0,1")
		data=datas.nid;
			
		if (data!=undefined)
		{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='LH'+padl(mmmerkid,'0',7);
		}
		else
		{
			mmmerkid='LH0000001';
		}

		$Pcs2("#mnid").val(mmmerkid);		
		//execajaxas("delete from translunashutang1 where nid='"+mmmerkid+"'")
		//execajaxa("insert into translunashutang1(nid,status) values('"+mmmerkid+"',1)")
		//execajaxa("delete from translunashutang2 where nid='"+mmmerkid+"'")
		execajaxa("delete from bkbesar where nid='"+mmmerkid+"'")
			
		refreshgrid2()
		refreshgrid()
		$Pcs2("#msupid").focus()
				
	}

	function ambilrek(theid)
	{
		mmid=theid.id
		misi=theid.value		
		if (misi=='')
		{
		return;
		}

		rownama=mmid.replace('16','17')
		mstok=taptabel("setrek","rekid,reknama","rekid='"+misi+"'")
		$Pcs2("#"+rownama).val("")	
		theid.value=''
		if (mstok.reknama!=undefined)
		{
		$Pcs2("#"+rownama).val(mstok.reknama)
		theid.value=mstok.rekid
		getNextElement(theid).focus()
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
			
			msaldo=toval($Pcs2("#17_"+gg).val())
			mbayar=toval($Pcs2("#18_"+gg).val())
			msisa=toval(msaldo-mbayar)
			$Pcs2("#19_"+gg).val(tra(msisa))
	
			if (mbayar>msaldo)
			{
				alert("Pembayaran Terlalu besar !")
				$Pcs2("#18_"+gg).select()
				return
			}
	
			mj1=mj1+toval(mbayar)
			}

			
		}

		mj3=0
		for (gg=200;gg<301;gg++)
		{
			if ($Pcs2("#12_"+gg).val()==undefined)
			{break;}
			
			if ($Pcs2("#12_"+gg).val()!='')
			{
			
			mtotal=toval($Pcs2("#15_"+gg).val())			
			mj3=mj3+toval(mtotal)
			
			}

			
		}
		
		$Pcs2("#mtotal").val(tra(mj1))
		$Pcs2("#mtotalgiro").val(tra(mj3))
		mtg=toval($Pcs2("#mtotalgiro").val())
		mtr=toval($Pcs2("#mtransfer").val())
		$Pcs2("#mkas").val(tra(mj1-mtg-mtr))
		
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
	<td>Tgl. </td><td>: <input type=text id=mtgl size=10 >
	Kode : <input type=text id=mnid size=10 ></input><input type=button id=lookmnid value='F5'></td> 
	</tr>
	
	<tr>
	<td>Suplier </td><td colspan=5>: <input type=text  size=5 id='msupid'><input type=button id=lookmsupid value='F5'><input type=text id=msupnama size=45 disabled></td>
	</tr>
	<tr>
	<td>Catatan </td><td colspan=5>: <input type='text' id='mket' size=100></td>
	</tr>
	</table>

	<table width=100% border=0>		
	
	<tr>
	<td colspan=3 valign=top>Nota: <br> <font face='arial' color='black'><span id='spantabel'></span></td>
	</tr>

	<tr>
	<td colspan=3 valign=top>Giro: <br> <font face='arial' color='black'><span id='spantabel2'></span></td>
	</tr>

	<tr>
	<td rowspan=4>
	<hr>
	<input type='button' value='F1-Simpan' id='btnsimpan'>	
	<input type='button' value='F2-Baru' id='btnbaru'>	
	<input type='button' value='F3-Hapus' id='btnhapus'>
	<input type='button' value='F12-Keluar'  id='btnkeluar'>			
	</td>
	<td align=right>Total Bayar : <input type=text id='mtotal' size=10 disabled style='text-align:right'></td>
	</tr>	

	<tr>
	<td align=right>Total Giro : <input type=text id='mtotalgiro' size=10  disabled style='text-align:right'></td>
	</tr>	

	<tr>
	<td align=right>Transfer : <input type=text id='mtransfer' size=10 style='text-align:right'></td>
	<td>Dari Bank :<?php combobox("select rekid misi,concat(rekid,'-',reknama) mtampil from setrek where nrcid='101' ","mrekid"); ?></td>
	</tr>	

	<tr>
	<td align=right>Kas : <input type=text id='mkas' size=10 disabled style='text-align:right'></td>
	</tr>	
	
	</table>

	</font>
	
	
	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></td></tr>
		</center>
	</div>	
	
	</form>
	
</body>
</html>