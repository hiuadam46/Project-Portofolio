<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_gudangbj_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Kas Masuk</title>
    <link rel="stylesheet" type="text/css" href="themes/base/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script type="text/javascript" src="js/prototype.js"></script>
	<script type="text/javascript" src="js/controls.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript" src="js/format.js"></script>
	<script type="text/javascript" src="js/jScrollPane.min.js"></script>
    <script type="text/javascript">
	  var $Pcs2 = jQuery.noConflict();
  	  var databaru=true;
	  var mvv=18;
	  
	  var dialogisopen=false;
		$Pcs2(document).ready(function(){
		$Pcs2("#headertrans").html("<b>Transaksi Kas Masuk")
		$Pcs2("#lblheader2").html("Kas/Bank Masuk");
		$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
		baru()
		
		$Pcs2("#fform").click(function() {

			for (var md=1;md<50;md++)
			{
				$Pcs2("#bodiv_"+md).css("background-color","white")
			}	

			midd=event.element(event).id
			mlg=midd.indexOf("_")
			msatu=midd.substr(mlg+1,1000)
			mdua=midd.substr(0,mlg)
			$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
			
			if (event.element(event).type=='checkbox')
			{
			mhari=mdua-3
			mlgnid=$Pcs2("#2_"+msatu).val()
			msalesid=$Pcs2("#msalesid").val()
			mchk=event.element(event).checked
			execajaxas("delete from setkunjungan where lgnid='"+mlgnid+"' and hari="+mhari+" and salesid='"+msalesid+"'")
			//alert("delete from setkunjungan where lgnid='"+mlgnid+"' and hari="+mhari+" and salesid='"+msalesid+"'")

			if (mchk)
			{
				execajaxas("insert setkunjungan values('"+mlgnid+"',"+mhari+",'"+msalesid+"')")
				//alert("insert setkunjungan values('"+mlgnid+"',"+mhari+",'"+msalesid+"')")
			}
			}
			
			
		})
		
		$Pcs2("#msalesid").change(function() {
				refreshgrid()
		})

		$Pcs2(document).keyup(function() {
			mid=Event.element(event).id
			if (mid.substr(0,2)=='4_')
			{
			maa=tra(Event.element(event).value)
			Event.element(event).value=maa
			}
		})
		
		$Pcs2("#tcari").keyup(function() {
				refreshgrid()
		})

		$Pcs2("#fform1").keydown(function() {
			if (event.element(event).id!='mket')
			{
			tabOnEnter (event.element(event), event)
			}

			if (event.element(event).id=='mket' && event.keyCode==13)
			{
				$Pcs2("#2_1").focus();
				$Pcs2("#2_1").select();
			}

		})

		$Pcs2(document).keydown(function() {

			tootal()
		})
		
		$Pcs2("#fform").keypress(function() {
			mname=Event.element(event).id;
			$Pcs2("#"+mname).css("background-color","transparent")

			mlg=mname.indexOf("_")
			msatu=mname.substr(mlg+1,1000)
			mdua=mname.substr(0,mlg)
			
			//alert(mpar)
			//alert(msatu)
			//alert(mdua)
			
			if (event.keyCode==13 || event.keyCode==39)
			{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")

				mggg=getNextElement(Event.element(event))
				mggg.focus()
				mggg.select()
				$Pcs2("#"+mggg.id).css("background-color","lightgreen")
								
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
				toshow(mggg)
			}
			
			if (event.keyCode==37)
			{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")

				mjjj=getPrevElement(Event.element(event))
				mjjj.focus()
				mjjj.select()
				$Pcs2("#"+mjjj.id).css("background-color","lightgreen")

				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
				toshow2(mjjj)
			}
			
			if (event.keyCode==38)
			{

				if (msatu!='1')
				{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")
				}

				mbawah=parseInt(msatu)-1
				mjjj=document.getElementById(mdua+'_'+mbawah)
				mjjj.focus()
				mjjj.select()
				$Pcs2("#"+mjjj.id).css("background-color","lightgreen")
				
				mlg=mjjj.id.indexOf("_")
				msatu=mjjj.id.substr(mlg+1,1000)

				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				hiderow2(mbawah)
			}
			if (event.keyCode==40)
			{
				mjjjd=$Pcs2("#tabjumlah").val()
				if (parseInt(msatu)<mjjjd)
				{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")
				}
				mbawah=parseInt(msatu)+1
				$Pcs2("#"+mdua+'_'+mbawah).css("background-color","lightgreen")
				$Pcs2("#bodiv_"+mbawah).css("background-color","yellow")
				hiderow(mbawah)
				document.getElementById(mdua+'_'+mbawah).focus()
				document.getElementById(mdua+'_'+mbawah).select()

			}
		mmv=event.keyCode
		mobj=event.element(event)
		mnn=mobj.id.substr(0,1)
		//alert(mobj.value)
		if (mnn=='2' && (mmv==13 || mmv==116))
		{
		if (mobj.value!=''){return;}
		
		query1="select rekid Kode,left(reknama,30) Nama from setrek where true "
		query2=""
		mcomm=query1+query2

		mordd="Kode"
		mffff=" concat(rekid,reknama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mobj.id)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
		$Pcs2("#framehrg").tcari.focus();	

		}
		
		if (mnn=='5' && mmv==116)
		{

		midd=mobj.id.replace('5','2')

		if ($Pcs2("#"+midd).val()=='20010')
		{
		query1="select supid Kode,left(supnama,30) Nama from setsup where true "
		query2=""
		mcomm=query1+query2

		mordd="Kode"
		mffff=" concat(supid,supnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mobj.id)

		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		}

		if ($Pcs2("#"+midd).val()=='10210')
		{
		query1="select lgnid Kode,left(lgnnama,30) Nama from setlgn where true "
		query2=""
		mcomm=query1+query2

		mordd="Kode"
		mffff=" concat(lgnid,lgnnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mobj.id)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Pelanggan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
		}
		
		if ($Pcs2("#"+midd).val()=='10230')
		{
		query1="select rpad(karid,20,' ') Kode,left(karnama,30) Nama from setkaryawan where true "
		query2=""
		mcomm=query1+query2

		mordd="Kode"
		mffff=" concat(karid,karnama) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mobj.id)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Karyawan/Sales');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
		}
		
		return;
		}

		
		})

    $Pcs2('#backtabel').css({
   'position':'relative',
   'background-color':'white',
   'border-color':'black',
   'border-style':'solid',
   'border-width':'1px',
   })

   
    $Pcs2('#footer').css({
   'position':'relative',
   'background-color':'lightblue',
   'border-color':'black',
   'border-style':'solid',
   'border-width':'1px'
   })

   $Pcs2("#kotakdialog2").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 800,	
		  close : function(){
	},		  
	});
   
	$Pcs2("#btnsimpan").click(function() {

	mnid=$Pcs2("#mnid").val()

	execajaxas("delete from transkasmasuk where nid='"+mnid+"'")
	execajaxas("delete from bkbesar where nid='"+mnid+"'")
	
	mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
	mket=$Pcs2("#mket").val()
	
	for (ma=1;ma<mvv;ma++)
		{
			mnomor=$Pcs2("#1_"+ma).val()
			mrekid=$Pcs2("#2_"+ma).val()
			mbpid=$Pcs2("#5_"+ma).val()
			mrekid=mrekid.trim()
			mjumlah=toval($Pcs2("#4_"+ma).val())
			mrekida=$Pcs2("#mrekid").val()
			if (mrekid!='' && mjumlah!='')
			{
			//execajaxa("insert into transkasmasuk(nid,tgl,nomor,rekid,jumlah,ket) values('"+mnid+"',"+mtgl+",'"+mnomor+"','"+mrekid+"','"+mjumlah+"','"+mket+"')")

			msqql="insert into bkbesar(rekid ,bpid ,tgl,nid,kredit,trans,ket) values('"+mrekid+"','"+mbpid+"',"+mtgl+",'"+mnid+"',"+mjumlah+",'TRANSKASMASUK','"+mket+"')"
			execajaxa(msqql)
			
			msqql="insert into bkbesar(rekid ,bpid ,tgl,nid,debet,trans,ket) values('"+mrekida+"','',"+mtgl+",'"+mnid+"',"+mjumlah+",'TRANSKASMASUK','"+mket+"')"
			execajaxa(msqql)

			}
		}	
	alert("Data Tersimpan")	
	baru()
	})

	$Pcs2("#btnhapus").click(function() {
		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false){return}
		mnid=$Pcs2("#mnid").val()
		execajaxas("delete from transkasmasuk where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")
		alert("Data Terhapus")	
		baru()
	})

	$Pcs2("#btnbaru").click(function() {
		baru()
	})
	
	$Pcs2("#mnid").blur(function() {
			if (this.value==''){this.focus();this.select();}
			tb1=taptabel("bkbesar a","a.*,date_format(tgl,'%d-%m-%Y') tgly","nid='"+this.value+"' and kredit>0");
			mnid=tb1.nid;
			if (mnid!=undefined)	
			{	
				$Pcs2("#mtgl").val(tb1.tgly)
				$Pcs2("#mket").val(tb1.ket)
				$Pcs2("#mrekid").val(tb1.rekid)
				refreshgrid()
			}
			else
			{
				alert("Nomor Tidak Ada !");	
				baru(true);
			}
	
	})

	});

	function ambilbp(thie)
	{
		mv=thie.value
		midd=thie.id.replace('5','2')
		if ($Pcs2("#"+midd).val()=='20010')
		{
			mtt=taptabel("setsup","supid,supnama","supid='"+mv+"'")
			midd=thie.id.replace('5','6')
			$Pcs2("#"+midd).val(mtt.supnama)
			getNextElement(thie).focus()		
		}		

		if ($Pcs2("#"+midd).val()=='10210')
		{
			mtt=taptabel("setlgn","lgnid,lgnnama","lgnid='"+mv+"'")
			midd=thie.id.replace('5','6')
			$Pcs2("#"+midd).val(mtt.lgnnama)
			getNextElement(thie).focus()		
		}		
		
		if ($Pcs2("#"+midd).val()=='10230')
		{
			mtt=taptabel("setkaryawan","karid,karnama","karid='"+mv+"'")
			midd=thie.id.replace('5','6')
			$Pcs2("#"+midd).val(mtt.karnama)
			getNextElement(thie).focus()		
		}		

	}

	function ambilrek(thie)
	{
		mv=thie.value
		midd=thie.id.replace('2','3')
		mtt=taptabel("setrek","rekid,reknama","rekid='"+mv+"'")
		$Pcs2("#"+midd).val(mtt.reknama)
		getNextElement(thie).focus()		

	}
	
	function hiderow(mbawah)
	{
		$Pcs2("#bodiv_"+mbawah).show()
	}
	function hiderow2(mbawah)
	{
		$Pcs2("#bodiv_"+(mbawah)).show()
	}
	function toshow(obj)
	{
			mname=obj.id;
			mlg=mname.indexOf("_")
			msatu=parseInt(mname.substr(mlg+1,1000))
			mdua=mname.substr(0,mlg)
			$Pcs2("#bodiv_"+(msatu)).show()
	}
	
	function toshow2(obj)
	{
			mname=obj.id;
			mlg=mname.indexOf("_")
			msatu=parseInt(mname.substr(mlg+1,1000))
			mdua=mname.substr(0,mlg)
			$Pcs2("#bodiv_"+(msatu)).show()
	}
s
	function tootal()

	{
		$Pcs2("#mtotal").val('')
		mtt=0
		for (ma=1;ma<mvv;ma++)
		{
			abc=toval($Pcs2("#4_"+ma).val())
			if (abc!=0)
			{
			mtt=mtt+abc
			}
		}	
		$Pcs2("#mtotal").val(tra(mtt))


	}
	
	function refreshgrid()
	{
		mnidd=$Pcs2("#mnid").val()
		$Pcs2.ajax({
		type:"POST",
		url:"grids/gridkasmasuk.php",
		data : "mTform=tkasmasuk&mjog="+mvv+"&mnnid="+mnidd,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
			tootal()
		}});
		
	}
	

	function baru()
	{
		$Pcs2("#mtgl").val(tglsekarang());
		$Pcs2("#mnid").val('');
		$Pcs2("#mket").val('');
		$Pcs2("#mrekid").val('10010');

		datas=taptabel("bkbesar","nid","trans='TRANSKASMASUK' order by nid desc limit 0,1")
		data=datas.nid;
			
			if (data!=undefined)
			{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='KM'+padl(mmmerkid,'0',7);
			}
			else
			{
			mmmerkid='KM0000001';
			}
			$Pcs2("#mnid").val(mmmerkid);
			execajaxa("delete from transkasmasuk where nid='"+mmmerkid+"'")
			execajaxa("delete from transkasmasuk where nid='"+mmmerkid+"'")
			execajaxa("delete from bkbesar where nid='"+mmmerkid+"'")
			refreshgrid()
			$Pcs2("#mket").focus()

		}	
	</script>
</head>

<body background='images/num.jpg'>
<?php
	require("menu.php");	
?>
	<form name='fform1' id='fform1'>
	<font face='Arial' color='white' >

	<table>
	<tr><td>Tgl.</td><td> : <input type=text id=mtgl size=10> No. : <input type=text id=mnid size=10></td></tr>
	<tr><td>Keterangan </td><td> : <input type=text size=80 id=mket></td></tr>
	<tr><td>Ke Rekening</td><td> : <?php combobox("select rekid misi,concat(rekid,'-',reknama) mtampil from setrek where nrcid in ('100','101') order by rekid","mrekid"); ?> </td></tr>
	</table>

	</font>
	
	</form>
	
	<form name='fform' id='fform'>
	<span id='spantabel'></span>
	
	<div align=right>TOTAL <input type=text id=mtotal readonly style='text-align:right;font-bold:true;'></div>
	<div id='tombols' style="position:Relative">
	<input type='button' id='btnsimpan' value='Simpan'></input> <input type=button id='btnbaru' value='Baru'></input> <input type=button id='btnhapus' value='Hapus'></input> <input type=button id='btnkeluar' value='Tutup'></input>
	</div>
	
	</form>

	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=100% height=450 top=30></td></tr>
		</center>
	</div>	
	
</body>
</html>
	