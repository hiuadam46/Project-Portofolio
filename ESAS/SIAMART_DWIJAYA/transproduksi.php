<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Produksi</title>
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
	var mdatabaru=true

  $Pcs2(document).ready(function(){
	$Pcs2("#setper").html("<font size=3><i>Pembelian</font></i>")
	$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
	$Pcs2("#lblheader2").html("Produksi");
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

		if (mmv==116 && mmid.substr(0,2)=='32')
		{

		query1="select stoid Kode,left(stonama,30) Nama,left(format(ifnull(b.totqty,0),00),11) rightSaldo,satuan1 'Sat.' from setstok a "
		query2="left join (select bpid,sum(qtyin-qtyout) totqty from bkbesar where rekid like '103%' group by bpid) b on a.stoid=b.bpid where true "
		mcomm=query1+query2

		mordd="Kode"
		mffff=" concat(stoid,stonama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		}

		if (mmv==116 && mmid.substr(0,2)=='12')
		{

		query1="select a.nid2 LOT,date_format(a.tgl,'%d-%m-%Y') Tgl,a.bpid Kode,left(b.stonama,30) Nama,left(format(ifnull(a.qtyin,0),00),11) rightQty  from bkbesar a left join setstok b on a.bpid=b.stoid where a.nid2<>'' and a.trans in ('TRANSBELI','TRANSPRODUKSI') and a.qtyin>0 and nid2 not in (select nid2 from bkbesar where left(ket,1)='F')"
		mcomm=query1

		mordd="Tgl,LOT"
		mffff=" concat(bpid,stonama) "

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
		if (m22==15 || m22==35)
		{
			miss=tra(mmf2.value)
			$Pcs2("#"+mmid).val(miss)
		}
		rumus1()	
	})
	
	
	$Pcs2("#mgrup").change(function() {
		refreshgrid3()	
	})
		
	$Pcs2("#mprosesid").blur(function() {
		datas=taptabel("setproses","prosesid,nama","prosesid='"+this.value+"'")
		$Pcs2("#mprosesid").val("")
		$Pcs2("#mprosesnama").val("")
		if (datas.prosesid!=undefined)
		{
		$Pcs2("#mprosesid").val(datas.prosesid)
		$Pcs2("#mprosesnama").val(datas.nama)
		$Pcs2("#mprosesid2").focus()
		}
		refreshgrid3()
	})

	$Pcs2("#mnid").blur(function() {
		mnid=$Pcs2("#mnid").val()
		mgg=taptabel("transproduksi","*","nid='"+mnid+"'")
		mdatabaru=true
		if (mgg.nid!=undefined)
		{
			mdatabaru=false
			$Pcs2("#mtgl").val(baliktanggal2(mgg.tgl))
			$Pcs2("#mgrup").val(mgg.grup)
			
			$Pcs2("#mprosesid").val(mgg.prosesid)
			$Pcs2("#mprosesid2").val(mgg.prosesid2)

			$Pcs2("#mket").val(mgg.ket)

			$Pcs2("#mprosesid").blur()
			refreshgrid()
			refreshgrid2()
			refreshgrid3()
			$Pcs2("#mtotal1").val(mgg.total1)
			$Pcs2("#mtotal2").val(mgg.total2)
			$Pcs2("#mtot1").val(mgg.total1)
			$Pcs2("#mselisih").val(mgg.selisih)
			$Pcs2("#mprosesid").focus()

		}
		else
		{
			baru()
		}
		
	})
	
	$Pcs2(".lookkar").click(function() {
		mcomm="Select rpad(karid,12,' ') Kode,left(karnama,50) Nama,Grup,Bagian from setkaryawan where grup='"+$Pcs2("#mgrup").val()+"'"
		mordd="Kode"
		mffff=" concat(karid,karnama) "
		mname=this.id.replace("look","")

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mname)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Karyawan/Sales');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookmprosesid").click(function() {
		mcomm="Select rpad(prosesid,12,' ') Kode,left(nama,50) Nama from setproses where true"
		mordd="Kode"
		mffff=" concat(prosesid,nama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mprosesid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Proses');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})

	$Pcs2("#lookmprosesid2").click(function() {
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,concat(a.prosesid,'-',nama) Proses,total1 Bahan,total2 Hasil,selisih Susut from transproduksi a left join setproses b on a.prosesid=b.prosesid where true"
		mordd="Nota"
		mffff=" concat(nid,date_format(tgl,'%d-%m-%Y')) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mprosesid2')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Produksi');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
	
	$Pcs2("#lookmnid").click(function() {
		mcomm="Select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl,total1 Bahan,total2 Hasil,selisih Susut from transproduksi where true"
		mordd="Nota"
		mffff=" concat(nid,date_format(tgl,'%d-%m-%Y')) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Produksi');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
	
	$Pcs2("#btnsimpan").click(function() {
		mnid=$Pcs2("#mnid").val()
		if (mnid==''){alert('Nota Kosong !');$Pcs2("#mnid").focus();return;}

		mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"

		mprosesid=$Pcs2("#mprosesid").val()
		if (mprosesid==''){alert('Proses Kosong !');$Pcs2("#mprosesid").focus();return;}

		mlotid=""
	
		mprosesid2=$Pcs2("#mprosesid2").val()
		
		mkarid=""
		mkarid2=""
		mkarid3=""
		mkarid4=""
		mkarid5=""
		mkarid6=""
		
		mket=$Pcs2("#mket").val()

		mprosesnama=$Pcs2("#mprosesnama").val()
		mgrup=$Pcs2("#mgrup").val()
	
		mtotal1=toval($Pcs2("#mtotal1").val())

		mtotal2=toval($Pcs2("#mtotal2").val())

		
		mselisih=toval($Pcs2("#mselisih").val())
		
		msql="delete from transproduksi where nid='"+mnid+"'"
		
		$Pcs2.ajax({
		type : 'POST',
		url:"phpexec.php",
		data : "func=EXECUTE&comm="+msql,
		success : function(data){

			execajaxas("delete from bkbesar where nid='"+mnid+"'")

			execajaxa("insert into transproduksi values('"+mnid+"',"+mtgl+",'"+mket+"','"+mprosesid+"','"+mkarid+"','"+mtotal1+"','"+mtotal2+"','"+mselisih+"','"+mkarid2+"','"+mkarid3+"','"+mkarid4+"','"+mkarid5+"','"+mkarid6+"','"+mprosesid2+"','"+mgrup+"','"+mlotid+"','"+mtahap+"')")

			mtot=0			
			for (gg=1;gg<100;gg++)
			{
			
			mstoid=$Pcs2("#13_"+gg).val()			
			mqty=toval($Pcs2("#16_"+gg).val())
			mtahap=$Pcs2("#17_"+gg).val()
			mtoth=toval($Pcs2("#mtotal2").val())
			
			if (mtoth>0){mtahap=mtahap.replace('T','F')}
			
			if (mstoid!='' && mlot!='')
			{
			
			mtglx=baliktanggal( $Pcs2("#mtgl").val() )
			mjmlhrg=savstofifo('L001',$Pcs2("#13_"+gg).val(),mnid,mtglx,0,0,0,mqty,'TRANSPRODUKSI',mtahap+" Bahan Produksi")
			mtot=mtot+toval(mjmlhrg)
			mlot=$Pcs2("#12_"+gg).val()
			
			execajaxa("update bkbesar set nid2='"+mlot+"' where nid='"+mnid+"' and bpid='"+mstoid+"'")

			if (mtoth>0)
			{
			execajaxa("update bkbesar set rekid='10330' where nid='"+mnid+"' and bpid='"+mstoid+"' and qtyout<>0")
			}
			
			if (mtoth==0)
			{

			mrekid='10330'
			mtglx=baliktanggal( $Pcs2("#mtgl").val() )

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket,nid2) "			
			msqql2="values('"+mrekid+"','"+mstoid+"','L001','"+mtglx+"','"+mnid+"',"+toval(mjmlhrg)+","+mqty+",'TRANSPRODUKSI','"+mtahap+" BDP "+mprosesnama+"','"+mlot+"')"

			execajaxa(msqql1+msqql2)

			}

			}
			
			}

			mjh=taptabel("bkbesar","count(*) cnt","rekid='20110' and nid2='"+mlot+"' and nid<>'"+mnid+"'")
			mt1=toval(mjh.cnt)
			
			for (gg=1;gg<100;gg++)
			{
			mpilih=$Pcs2("#45_"+(gg+299)).attr('checked')
			if (mpilih)
			{
			mt1=mt1+1
			}
			}
			
			mtotupah=0
			if (mtoth!=0 && mt1>0)
			{
			mhh=taptabel("setproses","upah","prosesid='"+$Pcs2("#mprosesid").val()+"'")
			mtotupah=toval(mhh.upah)*mtoth
			}

			
			for (gg=1;gg<100;gg++)
			{
			
			mstoid=$Pcs2("#32_"+(gg+199)).val()
			mqty=toval($Pcs2("#35_"+(gg+199)).val())
			mqtyall=toval($Pcs2("#mtotal2").val())
			mlot=$Pcs2("#36_"+(gg+199)).val()
			
			if (mstoid!='')
			{

			mrekid='10310'
			mjmlhrg=(mtot+mtotupah)*(mqty/mqtyall)
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket,nid2) "
			msqql2="values('"+mrekid+"','"+mstoid+"','L001',"+mtgl+",'"+mnid+"',"+mjmlhrg+","+mqty+",'TRANSPRODUKSI','Hasil Produksi "+mprosesnama+"','"+mlot+"')"
			execajaxa(msqql1+msqql2)
			
			}

			}
//Karyawan/Sales
			muper=1
			if (mtotupah>0)
			{
			mlot=$Pcs2("#12_1").val()
			
			if (mt1>0)
			{
			muper=mtotupah/mt1			
			execajaxa("update bkbesar set kredit="+muper+" where rekid='20110' and nid2='"+mlot+"' and kredit>0")
			}
			
			}
			

			for (gg=1;gg<100;gg++)
			{
			
			mkarid=$Pcs2("#42_"+(gg+299)).val()
			mkarnama=$Pcs2("#43_"+(gg+299)).val()
			mpilih=$Pcs2("#45_"+(gg+299)).attr('checked')
			mlot=$Pcs2("#12_1").val()
			
			if (mpilih)
			{

			mrekid='20110'
			mjmlhrg=muper
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,qtyin,trans,ket,nid2) "			
			msqql2="values('"+mrekid+"','"+mkarid+"','',"+mtgl+",'"+mnid+"',"+mjmlhrg+",'0','TRANSPRODUKSI','Hutang Gaji Ke "+mkarnama+"','"+mlot+"')"
			execajaxa(msqql1+msqql2)
			

			}
			
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
		execajaxas("delete from transproduksi where nid='"+mnid+"'")
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
				if (!(mggg.type=='button' || mggg.type=='checkbox'))
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
		url:"grids/gridproduksi1.php",
		data : "mTform=transproduksi"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
			mnid=$Pcs2("#mnid").val()
			rumus1()
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
		data : "mTform=transproduksi"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
			rumus1()
		}});

	}

	function refreshgrid3()
	{
		mser=''
		mser=mser+"&mgrup="+$Pcs2("#mgrup").val();
		mser=mser+"&mbagian="+$Pcs2("#mprosesid").val();
		mser=mser+"&mnid="+$Pcs2("#mnid").val();

		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"grids/gridproduksi3.php",
		data : "mTform=transproduksi"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spankar").html(data)
			rumus1()
		}});

	}
	
	function baru(mgdn)
	{
		$Pcs2("#mtgl").val("")
		$Pcs2("#mnid").val("")
		$Pcs2("#mprosesid").val("")
		$Pcs2("#mkarnama").val("")
		$Pcs2("#mprosesnama").val("")
		$Pcs2("#mket").val("")
		
		$Pcs2("#mtgl").val(tglsekarang());

		datas=taptabel("transproduksi","nid","1=1 order by nid desc limit 0,1")
		data=datas.nid;
			
			if (data!=undefined)
			{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='TP'+padl(mmmerkid,'0',7);
			}
			else
			{
			mmmerkid='TP0000001';
			}
			$Pcs2("#mnid").val(mmmerkid);
			execajaxa("delete from transproduksi where nid='"+mmmerkid+"'")
			execajaxa("delete from transproduksi where nid='"+mmmerkid+"'")
			execajaxa("delete from bkbesar where nid='"+mmmerkid+"'")
			refreshgrid()
			refreshgrid2()
			refreshgrid3()
			$Pcs2("#mprosesid").focus()
				
	}

	function ambilstok(theid)
	{
		mmid=theid.id
		
		if (mmid.substr(0,2)=='32')
		{		
		rownama=mmid.replace('32','33')
		rowsat1=mmid.replace('32','34')
		rowqty=mmid.replace('32','35')
		}

		$Pcs2("#"+rownama).val("")
		$Pcs2("#"+rowsat1).val("")
		//$Pcs2("#"+rowqty).val("")
		
		misi=theid.value
		mstok=taptabel("setstok","stonama,satuan1,satuan2,satuan3","stoid='"+misi+"'")
		mpr=taptabel("setproses","susut","prosesid='"+$Pcs2("#mprosesid").val()+"'")
		msusut=0
		if (mpr.susut!=undefined)
		{msusut=mpr.susut}
		
		if (mstok.stonama!=undefined)
		{
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)

		
		if (mmid.substr(0,2)=='32')
		{				
		mhasil=toval($Pcs2("#mtotal1").val())-(toval($Pcs2("#mtotal1").val())*toval(msusut)*0.01)
		$Pcs2("#"+rowqty).val(mhasil)
		
		mtgll=baliktanggal($Pcs2("#mtgl").val())
		mtgll=mtgll.substr(0,7)
		mnid=$Pcs2("#mnid").val()
		//mstok=taptabel("transproduksi","count(*) cnt ","left(tgl,7)='"+mtgll+"' and nid<'"+mnid+"'")		
		//alert("left(tgl,7)='"+mtgll+"' and nid<'"+mnid+"'")
		//mnomm=toval(mstok.cnt)+1
		//mnomm=mnomm.toString()
		//mnomm=padl(mnomm,'0',3)
		rownom=mmid.replace('32','31')
		mnn=$Pcs2("#"+rownom).val()
		mnn=mnn.replace('.','')
		mnn=padl(mnn,'0',2)

		mnomm=mnid.substr(6,3)

		mnolot=$Pcs2("#mtgl").val()
		mnolot='P.'+mnolot.substr(3,2)+mnolot.substr(8,2)+'.'+mnomm+'.'+mnn

		rowlot=mmid.replace('32','36')
		$Pcs2("#"+rowlot).val(mnolot)
		
		}
		
		getNextElement(theid).focus()
		}
		rumus1()
	}

	function ambillot(theid)
	{
	
		mopp=$Pcs2("#kotakdialog2").dialog("isOpen");
		if (mopp){return};
	
		mmid=theid.id		
		misi=theid.value

		mstok=taptabel("bkbesar","bpid,qtyin","nid2='"+misi+"' and qtyin>0 and nid2<>'' and trans in ('TRANSBELI','TRANSPRODUKSI')")

		mlot=mstok.bpid
		mqty=mstok.qtyin
		
		mnid=$Pcs2("#mnid").val()
		mdl=taptabel("bkbesar","count(*) cnt","nid2='"+misi+"' and qtyout>0 and nid<'"+mnid+"'")

		mtahap=toval(mdl.cnt)+1
		mtahap='T'+mtahap
		
		mstok=taptabel("setstok","stoid,stonama,satuan1,satuan2,satuan3","stoid='"+mlot+"'")
		if (mstok.stonama!=undefined)
		{
		rowstoid=mmid.replace('12','13')
		rownama=mmid.replace('12','14')
		rowsat1=mmid.replace('12','15')
		rowqty=mmid.replace('12','16')
		rowtahap=mmid.replace('12','17')

		$Pcs2("#"+rowstoid).val(mstok.stoid)
		$Pcs2("#"+rownama).val(mstok.stonama)
		$Pcs2("#"+rowsat1).val(mstok.satuan1)
		$Pcs2("#"+rowqty).val(mqty)
		$Pcs2("#"+rowtahap).val(mtahap)
		
		//getNextElement(theid).focus()
		}
		rumus1()
	}
	
	function rumus1()
	{
		mj1=0
		mj2=0
		for (gg=1;gg<100;gg++)
		{
			if ($Pcs2("#12_"+gg).val()!='')
			{
			mnii=$Pcs2("#16_"+gg).val()	
			mj1=mj1+toval(mnii)
			}

			if ($Pcs2("#32_"+(gg+199)).val()!='')
			{			
			mnii2=$Pcs2("#35_"+(gg+199)).val()	
			mj2=mj2+toval(mnii2)
			}
			
		}

		
		$Pcs2("#mtotal1").val(tra(mj1))
		$Pcs2("#mtotal2").val(tra(mj2))
		$Pcs2("#mtot1").val(tra(mj1))
		$Pcs2("#mselisih").val(tra(mj2-mj1))
		
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
	<table width=100% border=0>
	<tr>
	<td>Tgl. </td><td  width=30%>&nbsp;&nbsp;: <input type=text id=mtgl size=10 readonly> Kode : <input type=text id=mnid size=10 ></input><input type=button id=lookmnid value='F5'></td></td>
	<td >Catatan </td><td>: <input type='text' id='mket' size=15></td>
	</tr>
	
	<tr>
	<td>Proses </td><td>&nbsp;&nbsp;: <input type=text  size=5 id='mprosesid'><input type=button id=lookmprosesid value='F5'><input type=text size=20 id=mprosesnama disabled></td>
	<td>Ref #</td><td>: <input type=text  size=5 id='mprosesid2'><input type=button id=lookmprosesid2 value='F5'><input type=text size=20 id=mprosesnama2 disabled></td>
	</tr>
	
	</table>
		
	<table width=100% border=1 cellspacing=0 cellpadding=0>

	<tr>
	<td colspan=1 valign=top><i>Pelaksana:</i>
	<br><?php combobox("select '' misi,'-Grup-' mtampil union select grup misi, grup mtampil from setkaryawan group by grup order by misi","mgrup"); ?></td>
	<td colspan=2><font color=black><span id='spankar'></span></font></td>
	</tr>
	
	<tr>
	<td colspan=2><i>Stok Bahan:</i>
	</td><td colspan=2><i>Stok Hasil:</i></td>
	</tr>
	
	<tr>
	<td colspan=2 valign=top><font face='arial' color='black'><b><span id='spantabel'></span></td>
	<td colspan=2 valign=top><font face='arial' color='black'><span id='spantabel2'></span></td>
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