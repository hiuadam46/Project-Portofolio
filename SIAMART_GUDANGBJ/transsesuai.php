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
    <title>Penyesuaian Stok</title>
    <link rel="stylesheet" type="text/css" href="themes/base/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.js"></script>
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
		$Pcs2("#setper").html("<img src='CSS3 Menu_files/css3menu1/stock.png'/><font size=3><i> Mutasi Antar Gudang</font></i>")
		$Pcs2("#mtgl").datepicker({dateFormat: 'dd-mm-yy'});
		//$Pcs2("#mlokid1").attr('disabled',true)

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

				mggg=getNextElement2(Event.element(event))
				mggg.focus()
				mggg.select()
				//$Pcs2("#"+mggg.id).css("background-color","lightgreen")
								
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
				toshow(mggg)
			}
			
			if (event.keyCode==37)
			{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")

				mjjj=getPrevElement2(Event.element(event))
				mjjj.focus()
				mjjj.select()
				//$Pcs2("#"+mjjj.id).css("background-color","lightgreen")

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
				//$Pcs2("#"+mjjj.id).css("background-color","lightgreen")
				
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
				//$Pcs2("#"+mdua+'_'+mbawah).css("background-color","lightgreen")
				$Pcs2("#bodiv_"+mbawah).css("background-color","yellow")
				//hiderow(mbawah)
				document.getElementById(mdua+'_'+mbawah).focus()
				document.getElementById(mdua+'_'+mbawah).select()

			}
		mmv=event.keyCode
		mobj=event.element(event)
		mnn=mobj.id.substr(0,1)

		if (mnn=='2' && mmv==116)
		{
		
		query1="select left(a.stoid,12) stoid,left(a.barcode,20) Barc,left(a.stonama,30) Nama,left(format(a.hrgbeli,0),15) rightHarga,'"+$Pcs2("#mlokid1").val()+"' QSALDO from setstok a "
		query2=" where true "

		mcomm=query1+query2

		mordd="stoid"
		mffff=" concat(barcode,stonama) "

		mmid=mobj.id

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Stok');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

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

	$Pcs2("#lookmnid").click(function() {
		mcomm="Select a.* from (select nid Nota,date_format(tgl,'%d-%m-%Y') Tgl from transsesuai group by nid,tgl) a where true"
		mordd="Nota"
		mffff=" concat(Nota,Tgl) "

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=mnid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Penyesuaian');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
	})
	
	$Pcs2("#btnsimpan").click(function() {

	mnid=$Pcs2("#mnid").val()
	execajaxas("delete from bkbesar where nid='"+mnid+"'")
	execajaxas("delete from transsesuai where nid='"+mnid+"'")
	
	mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
	mtgx=baliktanggal($Pcs2("#mtgl").val())
	mlokid1=$Pcs2("#mlokid1").val()	
	mket=$Pcs2("#mket").val()
	mnid=$Pcs2("#mnid").val()
	
	for (ma=1;ma<100;ma++)
		{
			mnomor=$Pcs2("#1_"+ma).val()
			mstoid=$Pcs2("#2_"+ma).val()
			mstoid=mstoid.trim()
			mmisi=toval($Pcs2("#10_"+ma).val())

			if (mstoid!='')
			{
			//alert(mnomor)

			mqty=toval($Pcs2("#4_"+ma).val())
			munit=toval($Pcs2("#7_"+ma).val())

			mqtya=toval($Pcs2("#6_"+ma).val())
			munita=toval($Pcs2("#9_"+ma).val())

			mket=$Pcs2("#mket").val()

			mtglx=baliktanggal( $Pcs2("#mtgl").val())
			
			execajaxa("insert into transsesuai(nid,tgl,nomor,stoid,qty,isi,lokid1,lokid2,ket,unit,qtya,unita) values('"+mnid+"','"+mtglx+"','"+ma+"','"+mstoid+"','"+mqty+"','"+mmisi+"','"+mlokid1+"',' ','"+mket+"','"+munit+"','"+mqtya+"','"+munita+"') ")
			
			mqty2=(toval($Pcs2("#6_"+ma).val())*mmisi)+toval($Pcs2("#9_"+ma).val())
			mqty=(toval($Pcs2("#4_"+ma).val())*mmisi)+toval($Pcs2("#7_"+ma).val())

						
			mqqty=mqty-mqty2

			if (mqqty>0)
			{			
			mjmlhrg=savstofifo(mlokid1,mstoid,mnid,mtglx,0,0,0,mqqty,'TRANSSESUAI',mqty)

if (toval(mjmlhrg)==0)
{
mjmlhrg=(mqqty*(mhrgbeli/mmisi))
}
			//alert(toval(mjmlhrg))

			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket) "
			msqql2="values('21010','','','"+mtglx+"','"+mnid+"',"+(mjmlhrg)+",0,'TRANSSESUAI','Peny. Stok "+mstoid+"')"
			execajaxa(msqql1+msqql2)
			
			}
			else
			{
			mqqty=-1*mqqty
			myy=taptabel("setstok","hrgbeli","stoid='"+mstoid+"'")
			mhrgbeli=myy.hrgbeli
			mjmlhrg=savstofifo(mlokid1,mstoid,mnid,mtglx,(mqqty*(mhrgbeli/mmisi)),0,mqqty,0,'TRANSSESUAI','Penyesuain stok')
		
			msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,qtyin,trans,ket) "
			msqql2="values('21010','','','"+mtglx+"','"+mnid+"',"+(mqqty*(mhrgbeli/mmisi))+",0,'TRANSSESUAI','Peny. Stok "+mstoid+"')"
			execajaxa(msqql1+msqql2)
			
			}

			}
			
		}	

		alert("Data Tersimpan")	

		baru()
	})

	$Pcs2("#btnhapus").click(function() {
		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false){return}
		mnid=$Pcs2("#mnid").val()
		execajaxas("delete from bkbesar where nid='"+mnid+"'")
		execajaxas("delete from transsesuai where nid='"+mnid+"'")
		alert("Data Terhapus")	
		baru()
	})

	$Pcs2("#btnbaru").click(function() {
		baru()
	})
	
	$Pcs2("#mnid").blur(function() {
			if (this.value==''){this.focus();this.select();}
			tb1=taptabel("transsesuai a","a.*,date_format(tgl,'%d-%m-%Y') tgly","nid='"+this.value+"'");

			mnid=tb1.nid;
			if (mnid!=undefined)	
			{	
				$Pcs2("#mtgl").val(tb1.tgly)
				$Pcs2("#mlokid1").val(tb1.lokid1)
				$Pcs2("#mket").val(tb1.ket)
				refreshgrid()
			}
			else
			{
				alert("Nomor Tidak Ada !");	
				baru(true);
			}
	
	})

	});

	function ambilstok(thee)
	{
	
		mid=thee.id

		mval=$Pcs2('#'+mid).val()
		if (mval=='')
		{return}

		mstonam=mid.replace('2_','3_')
		mqty=mid.replace('2_','4_')
		msat1=mid.replace('2_','5_')
		mqtya=mid.replace('2_','6_')
		munit=mid.replace('2_','7_')
		msat2=mid.replace('2_','8_')
		munita=mid.replace('2_','9_')
		misix=mid.replace('2_','10_')

		moo=taptabel("setstok","stoid,stonama,isi,satuan1,satuan2"," stoid='"+mval+"' or barcode='"+mval+"' ")

		mlokid1=$Pcs2('#mlokid1').val()
		

		
		//query1="select stoid,stonama,truncate(totqty/isi,0) qty,truncate(mod(totqty,isi),0)  unit from setstok a "
		//query2="left join (select bpid,sum(qtyin-qtyout) totqty from bkbesar where rekid like '103%' and bpid2='"+mlokid1+"' group by bpid) b on a.stoid=b.bpid where a.stoid='"+mstoid+"' "
		
		$Pcs2("#"+mstonam).val('')
		if (moo.stoid!=undefined)
		{
		thee.value=moo.stoid
		mval=moo.stoid
		$Pcs2("#"+mstonam).val(moo.stonama)		

		misi=moo.isi

		
		$Pcs2("#"+mqtya).focus()
		$Pcs2("#"+msat1).val(moo.satuan1)
		$Pcs2("#"+msat2).val(moo.satuan2)
		$Pcs2("#"+misix).val(moo.isi)	
		moo2=taptabel("bkbesar","truncate(ifnull(sum(qtyin-qtyout),0)/"+misi+",0) qty,truncate(mod(ifnull(sum(qtyin-qtyout),0),"+misi+"),0)  unit ","bpid='"+mval+"' and bpid2='"+mlokid1+"'")
		$Pcs2("#"+mqty).val(tra(moo2.qty))
		$Pcs2("#"+munit).val(tra(moo2.unit))
		
		}
	}

	function ambillot(thee)
	{
		mid=thee.id
		mstok=mid.replace('5_','2_')
		mstoid=$Pcs2("#"+mstok).val()
		mqty=mid.replace('5_','4_')
		misi=thee.value
		$Pcs2("#"+mqty).val(mtt.qty)
		mtt=taptabel("bkbesar","sum(qtyin-qtyout) qty","nid2='"+misi+"' and bpid='"+mstoid+"' ")
		mnext=mid.replace('5_','6_')
		$Pcs2("#"+mnext).focus()
		
	}
	
	function toshow(obj)
	{
			mname=obj.id;
			mlg=mname.indexOf("_")
			msatu=parseInt(mname.substr(mlg+1,1000))
			mdua=mname.substr(0,mlg)
			//$Pcs2("#bodiv_"+(msatu)).show()
			//$Pcs2("#bodiv_"+(msatu-mvv)).hide()
	}
	
	function toshow2(obj)
	{
			mname=obj.id;
			mlg=mname.indexOf("_")
			msatu=parseInt(mname.substr(mlg+1,1000))
			mdua=mname.substr(0,mlg)
			//$Pcs2("#bodiv_"+(msatu)).show()
			//$Pcs2("#bodiv_"+(mvv+msatu)).hide()
	}

	function refreshgrid()
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
		url:"grids/gridsesuai.php",
		data : "mTform=transproduksi"+mser,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
			$Pcs2("#2_1").select()						
		}});
	
	}
	

	function baru()
	{
		$Pcs2("#mtgl").val(tglsekarang());
		$Pcs2("#mnid").val('');
		$Pcs2("#mlokid1").val('L001');
		$Pcs2("#mket").val('');

		datas=taptabel("transsesuai","nid","true order by nid desc limit 0,1")
		data=datas.nid;
			
			if (data!=undefined)
			{
			mmmerkid=data.substr(2,7);
			//alert(mmmerkid);
			mmmerkid=parseFloat(mmmerkid);
			//alert(mmmerkid);
			mmmerkid=mmmerkid+1;
			mmmerkid=''+mmmerkid
			mmmerkid='PS'+padl(mmmerkid,'0',7);
			}
			else
			{
			mmmerkid='PS0000001';
			}
			$Pcs2("#mnid").val(mmmerkid);
			execajaxas("delete from bkbesar where nid='"+mmmerkid+"'")
			execajaxas("delete from transsesuai where nid='"+mmmerkid+"'")
			refreshgrid()
		}	
	</script>
</head>

<body background='images/num.jpg'>
<?php
	require("menu.php");
	
?>
	<form name='fform1' id='fform1'>
	<font face='Arial' color='white' >

	<table width=100%>

	<tr>
	<td>Tgl.</td><td> : <input type=text id=mtgl size=10 readonly></td>
	<td>Lokasi Stok</td>
	<td> :
	<?php
	combobox("select lokid misi,concat(loknama,' - ',lokid) mtampil from setlok order by lokid","mlokid1");
	?>
	</td>

	<td>Keterangan</td><td> :<input type=editbox size=50 id=mket></td>
	
	</tr>

	<tr>
	<td>No.</td><td> : <input type=text id=mnid size=10> </input><input type=button id=lookmnid value='F5'> </td>

	<td> </td>
	<td> 
	</td>
	<td></td>

	<td> :<input type=editbox size=50 id=mket2></td>
	
	<tr>


	
	</table>
	
	</font>

	</form>
	
	<form name='fform' id='fform'>
	<span id='spantabel'>
	</span>

	<hr>
	<input type='button' id='btnsimpan' value='Simpan'></input> <input type=button id='btnbaru' value='Baru'></input> <input type=button id='btnhapus' value='Hapus'></input> <input type=button id='btnkeluar' value='Keluar'></input>
	</form>

	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>
		<tr><td><iframe id=framehrg width=750 height=400 top=30></td></tr>
		</center>
	</div>	
	
</body>
</html>
	