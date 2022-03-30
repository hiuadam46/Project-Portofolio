<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_cvstm_data',$links);
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
	var mnidd='<?php echo $mnidd; ?>'
	var mgolongan=''
	
  $Pcs2(document).ready(function(){
  
	$Pcs2("#setper").html("<font size=3><i>Transaksi Penjualan</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Transaksi Penjualan");
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
	
	execajaxas("alter table transjual1 add nomorfp varchar(20) default '' ")
	execajaxas("ALTER TABLE `transjual1` CHANGE `nomorfp` `nomorfp` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL")

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
		//alert("nilai mmid= " + mmid)
		mmv=event.keyCode	
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
			tabOnEnter2 (mmf2, event);
		}
		if (mmid.substr(0,2)=='12' && (mmv==116 || (mmv==13 && mmf2.value=='') ))
		{
		if (mgolongan=='A')
		{mh=''}
		if (mgolongan=='B')
		{mh='2'}
		if (mgolongan=='C')
		{mh='3'}
		if (mgolongan=='D')
		{mh='4'}
		if (mgolongan=='')
		{mh='3'}

		query1="select left(a.stoid,12) stoid,left(a.stonama,30) Nama,left(format(a.hrgjual"+mh+",0),15) rightHarga,'L001' QSALDO from setstok a "
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
		if (m22==14 || m22==15 || m22==16 || m22==17 || mmid=='mtunai' || mmid=='mongkos' || mmid=='mdiskon'|| tal=='right')
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
		$Pcs2("#12_1").focus()
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

	$Pcs2("#mnid").blur(function()
	{
		mnid=$Pcs2("#mnid").val();
		mgg=taptabel("transjual1", "*", "nid='"+mnid+"'");
		if (mgg.nid!=undefined)
		{
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl));
			
			$Pcs2("#mkarid").val(mgg.karid);
			$Pcs2("#mlgnid").val(mgg.lgnid);
			$Pcs2("#mkarid").val(mgg.sales);
			$Pcs2("#mket").val(mgg.ket);
			$Pcs2("#mfakturpajak").val(mgg.nomorfp);
			$Pcs2("#mlokid").val(mgg.lokid);
			$Pcs2("#mlokid").blur();
			$Pcs2("#mkarid").blur();
			$Pcs2("#mlgnid").blur();
			
			refreshgrid2(mgg);
		}
		else
		{
			baru();
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
	mlokid=$Pcs2("#mlokid").val()
	$Pcs2("#mloknama").val("")
	mll=taptabel("setlok","lokid,loknama","lokid='"+mlokid+"'")
	if(mll.lokid!=undefined)
	{
		$Pcs2("#mlokid").val(mll.lokid)
		$Pcs2("#mloknama").val(mll.loknama)
	}
	else
	{
		$Pcs2("#mlokid").val("")
		$Pcs2("#mloknama").val("")
	}
	$Pcs2("#mkarid").focus()
	})

	$Pcs2("#lookmlgnid").click(function() {
		mcomm="Select rpad(lgnid,12,' ') Kode,left(lgnnama,50) Nama,rpad(golongan,12,' ') rightGol from setlgn where true"
		mordd="Kode"
		mffff=" concat(lgnid,lgnnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mlgnid&selectType=transjual')
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
		mnomorfp=$Pcs2("#mfakturpajak").val()

		if (mnid=='')
		{
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

			adappn=$Pcs2("#detekppn").html()
			if (adappn=='PPN')
			{
				datas2=taptabel("setnomorfakturpajak","nomorfp","nidpakai='' order by nomorfp limit 0,1")
				mnomorfp=datas2.nomorfp;
				execajaxa("update setnomorfakturpajak set nidpakai='"+mnid+"' where nomorfp='"+mnomorfp+"'")
			}
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
		limitplafon = $Pcs2("#limitplafon").val();
		mtunai=toval($Pcs2("#mtunai").val())
		mhutang=toval($Pcs2("#mhutang").val())
		//mongkos=toval($Pcs2("#mongkos").val())
		mongkos=0
		mdiskon=toval($Pcs2("#mdiskon").val())
		mlokid=$Pcs2("#mlokid").val()

		if(mtotal > limitplafon){
			malert="TIDAK BISA DISIMPAN ! <br> Melebihi limit <br> Sisa hanya :"+tra(limitplafon);
			mseb=$Pcs2("#spanket").html()
			$Pcs2("#spanket").html(mseb+malert)
			return;
		}

		if (mtotal==0){
		malert="TIDAK BISA DISIMPAN ! <br> Total jual Kosong"
		mseb=$Pcs2("#spanket").html()
		$Pcs2("#spanket").html(mseb+malert)
		$Pcs2("#12_1").focus();
		return;}

		mseb=$Pcs2("#spanket").html()
		mseb=mseb.trim()
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
		
		msql="delete from transjual1 where nid='"+mnid+"'"
		
		$Pcs2.ajax({
		type : 'POST',
		url:"phpexec.php",
		data : "func=EXECUTE&comm="+msql,
		success : function(data){

			execajaxas("delete from bkbesar where nid='"+mnid+"'")
			execajaxa("delete from transjual2 where nid='"+mnid+"'")
			
			mq1="insert into transjual1(nid,tgl,tgljt,ket,lgnid,total,tunai,jumlah,ongkos,sales,status,nomorfp,lokid,diskon) "
			mq2=" values('"+mnid+"',"+mtgl+","+mjt+",'"+mket+"','"+mlgnid+"','"+mtotal+"','"+mtunai+"','"+mhutang+"','"+mongkos+"','"+mkarid+"',2,'"+mnomorfp+"','"+mlokid+"','"+mdiskon+"')"
			execajaxa(mq1+mq2)
						
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
				mdiskrp=toval($Pcs2("#diskrp_"+gg).val())
				mjmlhrg=toval($Pcs2("#24_"+gg).val())

				if (mstoid!='')
				{			
					mtglx=baliktanggal( $Pcs2("#mtgl").val() )
					mjm=savstofifo(mlokid,mstoid,mnid,mtglx,0,0,0,mtotqty,'TRANSJUAL',"Penjualan ke "+mlgnnama)
					
					mq1="insert into transjual2(nomor,nid,tgl,stoid,qty,unit,extra,extraunit,totqty,hrgsat,jmlhrg,isi,diskonrp,diskonp) "
					mq2=" values('"+gg+"','"+mnid+"',"+mtgl+",'"+mstoid+"','"+mqty+"','"+munit+"','"+mextra+"','"+mextraunit+"','"+mtotqty+"','"+mhrgsat+"','"+mjmlhrg+"','"+misi+"','"+mdisk+"','"+mdiskrp+"')"

					execajaxa(mq1+mq2)
					mtot=mtot+toval(mjm)
				}
			}
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,qtyin,trans,ket) "
			msqql2="values('30010','','',"+mtgl+",'"+mnid+"',"+mtotal+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)
			
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('10010','','',"+mtgl+",'"+mnid+"',"+mtunai+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "			
			msqql2="values('10210','"+mlgnid+"','',"+mtgl+",'"+mnid+"',"+mhutang+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)

			// msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			// msqql2="values('40210','','',"+mtgl+",'"+mnid+"',"+mongkos+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			// execajaxa(msqql1+msqql2)

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('40210','','',"+mtgl+",'"+mnid+"',"+mdiskon+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)
			
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('31010','','',"+mtgl+",'"+mnid+"',"+mtot+",0,'transjual','Penjualan ke "+mlgnnama+"')"
			execajaxa(msqql1+msqql2)
			
			malert="DATA TERSIMPAN DNG NOMOR "+mnid+" <br> Nomor faktur Pajak "+mnomorfp+" !"
			$Pcs2("#spanket").html(malert)
			
			xxw=window.open('printjual.php?mnid='+mnid,'aa',('alwaysraised=yes,scrollbars=no,resizable=no'));
			xxw.focus();
		}});
	})

	$Pcs2("#btnbaru").click(function() {
		baru()
	})

	$Pcs2("#btnprint").click(function(){
		xxw=window.open('printjual.php?mnid='+mnid,'aa',('alwaysraised=yes,scrollbars=no,resizable=no'));
		xxw.focus();
	})

	$Pcs2("#btnhapus").click(function() {
		mnid=$Pcs2("#mnid").val()
		mconf=confirm("Menghapus Transaksi No. "+mnid+"?")
		if (mconf==false)
		{return;}
		execajaxas("delete from transjual1 where nid='"+mnid+"'")
		execajaxas("delete from transjual2 where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")
		execajaxa("update setnomorfakturpajak set nidpakai='' where nidpakai='"+mnid+"'")
		
		malert="DATA TERHAPUS !"
		$Pcs2("#spanket").html(malert);
		
		baru();
	})
	
	$Pcs2("#btnprintfp").click(function()
	{
		xxw=window.open('fakturpajak.php?mnid='+mnid, 'aa', ('alwaysraised=yes, scrollbars=no, resizable=no'));
		xxw.focus();
	})
	
	$Pcs2("#btnkeluar").click(function() {
		self.close()
	})
	
	if (mnidd!='')
	{
		$Pcs2("#mnid").val(mnidd)
		$Pcs2("#mnid").blur()
	}
	});

///awal functions

////////////////////////////////////////////////////////////////////////

function collect_dtgrid(matcd)
	{	
		subtotqty=0
		subtotunit=0
		myarray = [];
		mycollectdt=taptabel("setstok","grpid,isi","stoid='"+matcd+"'")
		mcd=mycollectdt.grpid
		if(mcd!=undefined)
		{
			for (ggt=1;ggt<50;ggt++)
			{
				if ($Pcs2("#12_"+ggt).val() != '')
				{
					mtabgrp=taptabel("setstok","grpid","stoid='"+ $Pcs2("#12_"+ggt).val() +"'")
					if(mtabgrp.grpid==mcd) 
					{
						myarray.push({no_row:ggt});
						subtotqty=subtotqty + (toval($Pcs2("#14_"+ggt).val())*toval($Pcs2("#misi_"+ggt).val()))+toval($Pcs2("#16_"+ggt).val());
					}
				}
				else
				{break;}
			}
				mgrpset = taptabel("setgrp","diskon,qty","grpid = '" +mcd + "'")
				if (mgrpset.diskon != undefined)
				{
					//mdisc=mgrpset.diskon;
					mdisc1=mgrpset.diskon
					mdisc=parseFloat(mdisc1).toFixed(0);

					mqty=mgrpset.qty;
					//alert("discon = " + mdisc + " qty= " + mqty + "subtotqty = "+ subtotqty)
					if(mqty <= subtotqty)
					{
						rownya=1
						for(i=0;i<myarray.length;i++)
						{
							rownya=myarray[i]['no_row']
							$Pcs2("#23_"+rownya).val(tra(mdisc));
						}
					}
					/////////////reset diskon////////////////
					else
					{
						rownya=1
						for(i=0;i<myarray.length;i++)
						{
							rownya=myarray[i]['no_row']
							$Pcs2("#23_"+rownya).val(0);
						}
					}	
					/////////////reset diskon////////////////
				}
			//}
		}
	} 

////////////////////////////////////////////////////////////////////////
	// function cekqtyx(thiee)
	// {
	// 	mmid=thiee.id
	// 	m22=mmid.substr(0,2)

	// 	if (m22==14 || m22==16)
	// 	{
	// 		m23=mmid.replace('14_','')
	// 		m23=m23.replace('16_','')
	// 		mqty=toval($Pcs2("#14_"+m23).val())
	// 		munit=toval($Pcs2("#16_"+m23).val())
	// 		mextra=toval($Pcs2("#18_"+m23).val())
	// 		mextraunit=toval($Pcs2("#20_"+m23).val())
	// 		misi=toval($Pcs2("#misi_"+m23).val())
	// 		mtotqty=((mqty+mextra)*misi)+munit+mextraunit
	// 		cck=ceksaldo($Pcs2("#12_"+m23),mtotqty,$Pcs2("#13_"+m23).val())
	// 		if (cck==false)
	// 		{
	// 			thiee.select()
	// 			return
	// 		}
	// 	}
	// 	mstoid=$Pcs2("#12_"+m23).val()
	// 	collect_dtgrid(mstoid)
	// }

	function cekqty(thiee) 
	{
		mmid=thiee.id
		m22=mmid.substr(0,2)
		mrow=mmid.substr(3,2)
		if (m22==14||m22==16)
		{
			mstoid=$Pcs2("#12_"+mrow).val()
			collect_dtgrid(mstoid)
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
			$Pcs2("#mdiskon").val(tra(mgg.diskon))
			$Pcs2("#mtunai").val(tra(mgg.tunai))
			$Pcs2("#mhutang").val(tra(mgg.jumlah))
			$Pcs2("#mctunai").attr('checked',false)
			$Pcs2("#mcppn").attr('checked',false)

			if (mgg.jumlah==0)
			{
				$Pcs2("#mctunai").attr('checked',true)
			}

			// dicomment 20AGS2020
			if (toval(mgg.ongkos)!=0)
			{
				$Pcs2("#mcppn").attr('checked',true)
			}
			// dicomment 20AGS2020

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
		$Pcs2("#mfakturpajak").val("")
		$Pcs2("#mkarid").val("")
		$Pcs2("#mlgnid").val("")
		$Pcs2("#mfakturid").val("")
		$Pcs2("#mlgnnama").val("")
		$Pcs2("#mket").val("")
		mgolongan=""
		refreshgrid2()
		
		$Pcs2("#mtgl").val(tglsekarang());

		$Pcs2("#mlgnid").focus()
		mlkk=taptabel("setlok","lokid,loknama","1=1 order by lokid limit 0,1")
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
		if (mgolongan=='A')
		{mh=''}
		if (mgolongan=='B')
		{mh='2'}
		if (mgolongan=='C')
		{mh='3'}
		if (mgolongan=='D')
		{mh='4'}
		if (mgolongan=='')
		{mh='3'}
		mstok=taptabel("setstok","concat(stonama,' (',isppn,')') stonama,satuan1,satuan2,satuan3,format(hrgjual"+mh+",0) hrgjual,isi","stoid='"+misi+"'")
		if (mstok.stonama!=undefined)
		{
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)
		$Pcs2("#"+rowsat2).val(mstok.satuan2)
		$Pcs2("#"+rowsat3).val(mstok.satuan1)
		$Pcs2("#"+rowsat4).val(mstok.satuan2)
		$Pcs2("#"+rowhrg).val(mstok.hrgjual)
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
	//alert(mid)
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

	function getdiskon(mcd,mqty)
	{
		mdisk=0
		rsdisk=taptabel("setgrp a,setstok b","diskon","a.grpid=b.grpid and b.stoid='" +mcd+ "' and b.qty >= " + mqty)
		if (rsdisk.diskon != undefined)
		{
			mdisk=rsdisk.diskon
		}
		return mdisk
	}

	function rumus1()
	{
		mnid=$Pcs2("#mnid").val()
		mj1=0
		mj2=0
		mstokall=''
		mjmlhrg2=0
		mdisk=0
		mong=0
		mj1=0
		$Pcs2("#spanket").html('')
		$Pcs2("#detekppn").html("Non PPN")
		for (gg=1;gg<100;gg++)
		{
			if ($Pcs2("#12_"+gg).val()!='')
			{
			mstonam=$Pcs2("#13_"+gg).val()
			mada=mstonam.indexOf("(PPN)")
			if (mada>0)
			{
			$Pcs2("#detekppn").html("PPN")
			}
			
			mqty=toval($Pcs2("#14_"+gg).val())
			munit=toval($Pcs2("#16_"+gg).val())

			mextra=toval($Pcs2("#18_"+gg).val())
			mextraunit=toval($Pcs2("#20_"+gg).val())

			misi=toval($Pcs2("#misi_"+gg).val())
			mtotqty=(mqty*misi)+(mextra*misi)+munit+mextraunit
			cksld=ceksaldo($Pcs2("#12_"+gg),mtotqty,$Pcs2("#13_"+gg).val(),mnid)
			if (cksld==false)
			{
				alert("stok tidak cukup")
				$Pcs2("#12_"+gg).focus()
				//$Pcs2("#12_"+gg).val('')
				return;
			}
			mhrg=toval($Pcs2("#22_"+gg).val())
			mdis=mhrg*toval($Pcs2("#23_"+gg).val())*0.01

			mhrg=(mhrg-mdis)/misi
			mjmlhrg=((mqty*misi)+munit)*mhrg			
			//mdisrp=mjmlhrg*(toval($Pcs2("#diskrp_"+gg).val())*0.01)
			mdisrp=toval($Pcs2("#diskrp_"+gg).val())*((mqty*misi)+munit);
			
			mjmlhrg=mjmlhrg-mdisrp
			mjmlhrg=Math.round(mjmlhrg,0)
			
			$Pcs2("#24_"+gg).val(tra(mjmlhrg))
			mnii=$Pcs2("#24_"+gg).val()	
			mj1=mj1+toval(mnii)
			mstokall=mstokall+"'"+$Pcs2("#12_"+gg).val()+"',"
			}			
		}
		mstokall=mstokall+"'axxxff'"
		$Pcs2("#mtotal").val(tra(mj1))
		stotal = $Pcs2("#mtotal").val()
		mcck2=$Pcs2("#mcppn").attr("checked")
		// alert("mcck2= " + mcck2)
		// if (mcck2)
		// {
		// 	mpppn=mj1*0.01
		// 	$Pcs2("#mongkos").val(tra(mpppn))
		// }
		// else
		// {
		// 	$Pcs2("#mongkos").val('')
		// }
		//mong=toval($Pcs2("#mongkos").val())

		mdisk=toval($Pcs2("#mdiskon").val())
		mkk=mj1+mong-mdisk
		mcck=$Pcs2("#mctunai").attr("checked")
		//alert("mcck= "+mcck)
		if (toval($Pcs2("#mtunai").val())==mkk)
		{
			$Pcs2("#mtunai").val('0')		
		}
		if (mcck)
		{
			$Pcs2("#mtunai").val(tra(mkk))
		}

		mtun=toval($Pcs2("#mtunai").val())
		$Pcs2("#mhutang").val(tra(mj1+mong-mtun-mdisk))
		if (tra(mj1+mong-mtun-mdisk)==0)
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
	
	function soucettlqty(mnid,mstoid) 
	{
		mtotqty=0;
		datasaldo=taptabel("transjual2","totqty","nid='" + mnid + "' and stoid='"+ mstoid + "'")		
		if(datasaldo.totqty!=undefined)
		{
			mtotqty=datasaldo.totqty;
		}
		else
		{
			mtotqty=0;
		}
		return mtotqty;
	}
	
	function ceksaldo(msto,mqty,mstonama,mnid)
	{
	mstoid=msto.val()

	mlokid=$Pcs2("#mlokid").val()
	mfield="sum(qtyin-qtyout) saldo"
	mtabel="bkbesar"
	mkondisi="bpid='"+mstoid+"' and bpid2='"+mlokid+"'"

	mjadi="func=EXEC&field="+mfield+"&tabel="+mtabel+"&kondisi="+mkondisi;
	mdat='';
	$Pcs2.ajax({
	type:"POST",
	url:"phpexec.php",
	dataType:'json',
	async: false,
	data : mjadi,
	success : function(data){
	mgh=data
	
	mdqty=toval(mgh.saldo)+toval(soucettlqty(mnid,mstoid))
	//alert("material= "+ mstoid +" history trx= " + soucettlqty(mnid,mstoid) + " saldo di DB= " + mgh.saldo + " baru di entry= " + mqty) 
	//if ((mqty>mgh.saldo && mgh.saldo!=null) || mgh.saldo==null)
	if ((mqty>mdqty && mgh.saldo!=null) || mgh.saldo==null)
	{
		// malert="Stok "+mstonama+" Tidak Mencukup ! Saldo :"+mgh.saldo
		// mseb=$Pcs2("#spanket").html()
		// $Pcs2("#spanket").html(mseb+"<br>"+malert)
		mmg=false
	}
	else
	{
		mmg=true
	}
	}})
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
	Kode : <input type=text id=mnid size=10 ></input><input type=button id=lookmnid value='F5'> 
	FP : <input type=text id='mfakturpajak' readonly> <input type=text id='limitplafon' hidden><span id='detekppn'></span> </td> 
	</tr>
	
	<tr>
	<td hidden>Nota </td><td hidden>: <input type=text id=mfakturid size=10 disabled></input></td> 
	<td>Pelanggan </td><td colspan=5>: <input type=text  size=5 id='mlgnid'><input type=button id=lookmlgnid value='F5'><input type=text id=mlgnnama size=50 disabled>
	&nbsp;&nbsp;&nbsp;
	Lokasi : <input type=text  size=5 id='mlokid' value='01'>
	<input type=button id=looklok value='F5' >
	<input type=text id=mloknama size=15 disabled>
	</td>
	</tr>
	<tr>
		<td>Sales </td><td colspan=5>: <input type=text  size=5 id='mkarid'><input type=button id=lookkarid value='F5'><input type=text id=mkarnama size=50 disabled>
	</tr>

	<tr>
		<td>Notes </td><td colspan=5>: <input type=text  size=105 id='mket'></td>
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
	<input type='button' value='F4-Print Faktur Pajak' id='btnprintfp'>
	<input type='button' value='F12-Keluar'  id='btnkeluar'>	

	<input type='button' value='print' id='btnprint'> 
	
	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450></td></tr>
		</center>
	</div>	
	
	</form>
	
</body>
</html>