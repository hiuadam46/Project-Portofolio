<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_laksmana_data',$links);
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
    <title>Daftar Faktur & Tagihan</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
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
	$Pcs2("#setper").html("<font size=3><i>Daftar Faktur & Tagihan</font></i>")
	baru()
		

$Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	show: false,
	hide: false,
	dragable: true,
	width : 800,	
	});

	$Pcs2("#setperxx").css({	'width': mws-680+'px',
	'height': '19px',
	'line-height':'19px',
	'font-size':'12',
	});


	$Pcs2("#fform").keydown(function() {
	
		mmf2=event.element(event);
		mmid=mmf2.id
		mat=mmid.indexOf('_')
		if (mat<=0)
		{
		tabOnEnter (mmf2, event);
		}
	})

	$Pcs2("#fsetstok").keydown(function() {	
		mmf2=event.element(event);
		tabOnEnter (mmf2, event);
	})
	
	$Pcs2("#msupid").change(function() {
		refreshgrid2()
		refreshgrid3()
	})

	$Pcs2("#msalesid").change(function() {
		$Pcs2("#mnota").val('')
		refreshgrid2()
		refreshgrid3()
	})

	$Pcs2("#mnid").blur(function() {

	mser=$Pcs2("#mnid").val();
	mggg=taptabel("transjual1","date_format(tgl,'%d-%m-%Y') tgl,mobil","tagihanid='"+mser+"' limit 0,1")
	
	mser=$Pcs2("#mtgl").val(mggg.tgl)
	mser=$Pcs2("#mobilid").val(mggg.mobil)
	
	refreshgrid1()
	refreshgrid2()
	refreshgrid3()

	})
	
	$Pcs2("#btnkeluar").click(function() {
		$Pcs2("#kotakdialog2").dialog('close');
	})
	
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog2").dialog("isOpen");
			if (mopp){return};
			
			fil='13'+mtable1foc.substr(2,10)
			fsetstok.reset()
			$Pcs2("#kotakdialog2").dialog('open');
			misi=$Pcs2("#"+fil).val()
			mf=$Pcs2("#seri")
			mf.val(misi);
			
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setasset&kondisi=(seri='"+misi+"')",
			dataType:'json',
			success: function(data){

				$Pcs2("#jenis").val(data['jenis'])			
				$Pcs2("#nama").val(data['nama'])
				$Pcs2("#pemegang").val(data['pemegang'])
				$Pcs2("#lokasi").val(data['lokasi'])
				$Pcs2("#ket").val(data['ket'])
				$Pcs2("#nilai").val(tra(data['nilai']))
			
			}
			});
			mf.focus();mf.select();
	    });

    $Pcs2("#tambah").click(function() {
	
	$Pcs2("#kotakdialog2").dialog('open');
	fsetstok.reset();
	$Pcs2("#jenis").select()

	})


        $Pcs2("#btnsimpan").click(function() {

	maj=document.getElementById("seri")
	msu=$Pcs2("#seri").val()
	execajaxas("delete from setasset where seri='"+msu+"'")
	execajaxas("insert into setasset (seri) values('"+msu+"')")

	for (var mii=1;mii<30;mii++)
	{
		maj=getNextElement(maj)
		mtp=maj.type
		if (mtp=='text')
		{
			nilai=maj.value
			if (maj.id=='nilai')
			{nilai=toval(maj.value)}
			mfieldna=maj.id.substr(0,100)
			execajaxa("update setasset set "+mfieldna+"='"+nilai+"' where seri='"+msu+"'")
			
		}
	}
	alert("Data Tersimpan !")	
	$Pcs2("#kotakdialog2").dialog('close');
	refreshgrid1()
	return;	
	
	})

    $Pcs2("#btnhapus").click(function() {
	refreshgrid1()
	var conf=window.confirm("Hapus Transaksi ?")
	if (conf==false){return}
	maj=document.getElementById("seri")
	msu=$Pcs2("#seri").val()
	execajaxas("delete from setasset where seri='"+msu+"'")
	$Pcs2("#kotakdialog2").dialog('close');
	mtable1foc='12_1'
	refreshgrid1()
	return;	

	})

    $Pcs2("#mcari").blur(function() {
	refreshgrid1()
	})
	
	$Pcs2("#tcetak").click(function() {
		window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setasset&detitle=Daftar Asset<br>")
	})
	
	});

///awal functions
	function ambilprint(theid)
	{
		maa=theid.id.substr(2,10)
		mbb='12'+maa
		mid=$Pcs2("#"+mbb).val()
		if (theid.checked)
		{ execajaxa("update setasset set print=1 where seri='"+mid+"'") }
		else
		{ execajaxa("update setasset set print=0 where seri='"+mid+"'") }
	}

	function chkalls(theid)
	{

	if (theid.checked)
		{ 
		$Pcs2(".chkhk").prop('checked','true')
		execajaxa("update setasset set print=1") 
		}
		else
		{ 
		$Pcs2(".chkhk").prop('checked','')
		execajaxa("update setasset set print=0") 
		}
	}
	
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
				if (mggg.type!='button' && mggg.type!='checkbox')
				{
				$Pcs2("#"+mggg.id).css("background-color","lightblue")					
				}
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
			if (event.keyCode==117 && mdua=='12')
			{
				//alert('ambil Sales')
				bukasales()
			}
			
			if (event.keyCode==39 || event.keyCode==13)
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
		

	function bukasales()
	{
		$Pcs2("#framehrg").attr('src','looksales2.php?mobj=lookdfhutang')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Sales');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	}

	function refreshgrid1()
	{
		mser="&mrekap="+$Pcs2("#mnid").val();
		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"3grid3.php",
		data : "mTform=rekaptagihansales"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel1").html(data)
			$Pcs2("#"+mtable1foc).focus()
		}});

	}

	function refreshgrid2()
	{			
		mser="&mcari="+$Pcs2("#mcari").val();
		mser=mser+"&msupid="+$Pcs2("#msupid").val();		
		mser=mser+"&mrekap=("+$Pcs2("#mnota").val()+"'')";
		mser=mser+"&msales="+$Pcs2("#msalesid").val();
		$Pcs2.ajax({
		type:"POST",
		chace : true,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"3grid3.php",
		data : "mTform=rekaptagihannota"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel2").html(data)
			//$Pcs2("#"+mtable1foc).focus()
		}});

	}

	function refreshgrid3()
	{
		mser="&mrekap=("+$Pcs2("#mnota").val()+"'')";
		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"3grid3.php",
		data : "mTform=rekaptagihannota2"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel3").html(data)
			$Pcs2("#"+mtable1foc).focus()
		}});

	}
	
	function baru(mgdn)
	{
	$Pcs2("#mtgl").val(tglsekarang());

		datas=taptabel("transjual1","tagihanid","tagihanid<>'' group by tagihanid order by tagihanid desc limit 0,1")
		data=datas.tagihanid;
			
		if (data!=undefined)
		{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='RK'+padl(mmmerkid,'0',7);
		}
		else
		{
			mmmerkid='RT0000001';
		}
		execajaxa("update transjual1 set tagihanid='' where tagihanid='"+mmmerkid+"'")
		$Pcs2("#mnid").val(mmmerkid);
	
	refreshgrid1()
	refreshgrid2()
	refreshgrid3()
				
	}

	function ambilsales(theid)
	{

		mmid=theid.id
		this.value=''
		rownama=mmid.replace('12','13')
		$Pcs2("#"+rownama).val("")
		misi=theid.value

		mtab=taptabel("setkaryawan","karid,karnama","karid='"+misi+"'")
		if (mtab.karid!=undefined)
		{
		this.value=mtab.karid
		$Pcs2("#"+rownama).val(mtab.karnama)
		}
		else
		{
		theid.value=''
		}

		refreshgrid2()
	}

	function ambilnota(theid)
	{
		misi=theid
		mgggh=$Pcs2("#mnota").val()
		if (misi=='***')
		{
		mjm=toval($Pcs2("#tabjumlah1").val())+1
		for (ggg=1;ggg<mjm;ggg++)
		{
		mss=$Pcs2("#12_"+ggg).val()
		mgggh=mgggh+"'"+mss+"',"		
		}
		}
		else
		{
		mgggh=mgggh+"'"+theid+"',"
		}
		$Pcs2("#mnota").val(mgggh)
		refreshgrid2()
		refreshgrid3()
	}

	function hapusnota(theid)
	{
	
		if (theid=='***')
		{
		mgggh=''
		}
		else
		{
		misi="'"+theid+"',"
		mgggh=$Pcs2("#mnota").val()
		mgggh=mgggh.replace(misi,'')
		}
		$Pcs2("#mnota").val(mgggh)
		refreshgrid2()
		refreshgrid3()
	}
	
function rekapjualoutlet()
{
		mtagihanid=$Pcs2("#mnid").val()
		mser="&mrekap=("+$Pcs2("#mnota").val()+"'')";
		mser=mser+"&msalesid="+$Pcs2("#msalesid").val();
		window.open("printfakturtagihan.php?"+mser)
}

function carioutlet(mid)
{
		$Pcs2.ajax({
		type:"POST",
		chace : false,
		context: document.body,		
		global : false,
		isLocal : true,
		processData : false,
		traditional : true,
		type : 'GET',
		url:"3grid3.php",
		data : "mTform=cariout&mlgnnama="+mid.value,
		async: true,
		success : function(data){
			$Pcs2("#mlookout").html(data)
		}});
}

	function bukapelanggan()
	{
		//if ($Pcs2("#mlgnid").val()!=''){return}
		$Pcs2("#framehrg").attr('src','looklgn.php?mobj=looklgntagihan')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup pelanggan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();
	}
	
/////akhir function	
</script>
</head>

<body background='images/num.jpg' style='font-size:90%;font-family:arial'>
<?php 
	require("menu.php");
	
	execute("update transjual1 set report=0");
?>
	<font face='arial' color='white'><b>
	
	<form name='fform' id='fform'>

	<table width=100%>
	<tr>
	<td>Sales</td><td>:<?php combobox("select '' misi,'' mtampil union select karid misi,concat(karid,' - ',karnama) mtampil from setkaryawan order by misi","msalesid") ?>
	Rute :<?php combobox("select '' misi,'' mtampil union select rute misi,rute mtampil from setlgn order by misi","msupid") ?></td> 	
	</tr>
	<tr>
	<td>Cari </td><td colspan=3>: <input type=text id=mcari size=30 onkeyup=refreshgrid2(this.value)> ( No. Faktur / No. Outlet / Nama Outlet / Alamat )</td>
	</tr>	
	</table>	
	</font>
	<hr>

	<font face='arial' color='white'><i>Semua Nota :</i></font>
	<span id='spantabel2'></span>	



	<font face='arial' color='white'><i>Nota Dipilih :</i></font>
	<span id='spantabel3'></span>	

	<input type=hidden id=mnota size=50>	
	
	</form>
	<hr>
	<center>
	<input type=button value='Print Daftar' id='mprint1' onclick=rekapjualoutlet()>
	</center>
	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=400 top=30></td></tr>
		</center>
	</div>
	
	
</body>
</html>


