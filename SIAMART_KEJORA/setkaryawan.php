<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','esae1797_admin','+FeBJfl6&G]u') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('esae1797_kejora',$links);
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
    <title>Karyawan/Sales</title>
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
	$Pcs2("#setper").html("<font size=3><i>Karyawan/Sales</font></i>")
	$Pcs2("#mtglsj").datepicker({dateFormat: 'dd-mm-yy'});
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
	'width': mws-410+'px',
	'height': '19px',
	'line-height':'19px',
	'font-size':'12',
	});

	$Pcs2("#lokid").css({
	'font-size':'10pt',
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

	$Pcs2("#mcari").keyup(function() {	
	refreshgrid()
	})
	
	$Pcs2("#tcetakb").click(function() {
		window.open("printbarcode.php")
	})

	$Pcs2("#tcetak").click(function() {
	window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setkaryawan&detitle=Master Karyawan/Sales<br>")
	})
	
	$Pcs2("#btnkeluar").click(function() {
		$Pcs2("#kotakdialog2").dialog('close');
	})
	
        $Pcs2("#buka").click(function() {
			mopp=$Pcs2("#kotakdialog2").dialog("isOpen");
			if (mopp){return};
			
			fil='12'+mtable1foc.substr(2,10)
			fsetstok.reset()
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
			
	maj=document.getElementById("karid")

	for (var mii=1;mii<30;mii++)
	{
		maj=getNextElement(maj)
		mid=maj.id
		if (maj.type!='button')
		{
		mtp=$Pcs2("#"+maj.id).attr('class')
		maj.value=data[mid]	
		}
	}
			
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
		if ((mtp=='text' || mtp=='select-one') && maj.id!='gaji')
		{
			mfieldna=maj.id.substr(0,100)
			execajaxa("update setkaryawan set "+mfieldna+"='"+maj.value+"' where karid='"+msu+"'")
		}

		if (mtp=='text' && maj.id=='gaji')
		{
			mfieldna=maj.id.substr(0,100)
			execajaxa("update setkaryawan set "+mfieldna+"='"+toval(maj.value)+"' where karid='"+msu+"'")
			
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
	function ambilprint(theid)
	{
		maa=theid.id.substr(2,10)
		mbb='12'+maa
		mid=$Pcs2("#"+mbb).val()
		if (theid.checked)
		{ execajaxa("update setkaryawan set print=1 where karid='"+mid+"'") }
		else
		{ execajaxa("update setkaryawan set print=0 where karid='"+mid+"'") }
	}

	function chkalls(theid)
	{

	if (theid.checked)
		{ 
		$Pcs2(".chkhk").prop('checked','true')
		execajaxa("update setkaryawan set print=1") 
		}
		else
		{ 
		$Pcs2(".chkhk").prop('checked','')
		execajaxa("update setkaryawan set print=0") 
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
				
			if (event.keyCode==13)
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
	execute("update setkaryawan set print=1");
	execute("delete from setlok where lokid in (select concat('K',karid) from setkaryawan) or lokid=''");
?>
	<form name='fform' id='fform'>
	
	<font face='arial' color='white'><b>
	<table width=100%>
	
	<tr>
	<td>Cari </td><td>:<input type='text' id='mcari' size=50></td>
	</tr>

	</table>
	</font>
	<span id='spantabel'>
	</span>	
		
	<div id='tombols' style="position:Relative;left:5px">
	<hr>
	<input type='button' id="bCari" value="F1 = Cari" >&nbsp;&nbsp;
	<input type='button' id="buka" value="F2/Enter = Edit" >&nbsp;&nbsp;
	<input type='button' id="tambah" value="F3 = Baru" >&nbsp;&nbsp;
	<input type='button' id="tcetak" value="F7 = Print" >&nbsp;&nbsp;
	<input type='button' id="tcetakb" value="Print Barcode" >&nbsp;&nbsp;	
	<input type='button' id="tkeluar" value="Tutup" >
	</div>
	</form>
	
	<div id="kotakdialog2" title="Setup Karyawan/Sales">	
	<form name='fsetstok' id='fsetstok'>
	<font size=4>
	<table border=0 cellpadding=0 cellspacing=0 width=100%>

	<?php

	$msql="SELECT COLUMN_NAME kolom,DATA_TYPE tipe,NUMERIC_PRECISION panjang1,CHARACTER_MAXIMUM_LENGTH 	
	panjang2,COLUMN_COMMENT koment
	FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='esae1797_kejora' and TABLE_NAME='setkaryawan' and COLUMN_COMMENT<>''
	order by COLUMN_COMMENT";

	$rww=executerow($msql);
	while ($row=mysql_fetch_assoc($rww))
	{

	$mpand=($row[panjang1]+$row[panjang2])*(70/100);
	if ($mpand>100)
	{$mpand=50;}
	$mpand=50;

	$mrod='';
	if (($row[kolom])=='karid')
	{$mrod='readonly';}

	$mal='';
	if (($row[tipe])=='double')
	{$mal='text-align:right;';}
	
	echo "<tr>";
	echo "<td width=25%><font size=3pt>";
	echo "".substr($row[koment],2,100)."";
	echo "</td>";
	echo "<td>";


	switch ($row[kolom])
	{

	case 'lokid':
	echo ":";combobox("select lokid misi,concat(lokid,'-',loknama) mtampil from setlok order by misi","lokid");
	break;
	
	case  'grup':
	
	echo "
	 : <select id='grup' style='font-size:10pt;'>
	<option value='A'>A</option>
	<option value='B'>B</option>
	<option value='C'>C</option>
	<option value='D'>D</option>
	<option value='Non-shift'>Non-shift</option>
	<option value='Koordinator'>Koordinator</option>
	</select>";
	break;

	case  'jeniskelamin':
	
	echo "
	 : <select id='jeniskelamin' style='font-size:10pt;'>
	<option value='L'>Laki-laki</option>
	<option value='P'>Perempuan</option>
	</select>";
	break;
	
	default :;
	echo ": <input width=65% type=text id='".$row[kolom]."' name='".$row[kolom]."' size=".$mpand." style='font-size:10pt;$mal' $mrod >";
	break;

	}	
	if ($row[kolom]=='gaji')
	{echo " %";}
	
	echo "</td>";
	echo "</tr>";
	}

	?>
	</table>
	<hr>
	<input type=button id='btnsimpan' value=Simpan>
	<input type=button id='btnhapus' value=Hapus>
	<input type=button id='btnkeluar' value=Tutup>
	</form>
	</div>
	
	</form>
	
</body>
</html>