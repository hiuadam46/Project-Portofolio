<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Mutasi Gudang</title>
    <link rel="stylesheet" type="text/css" href="themes/base/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
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
	  var mvv=13;
	  var obj='<?php echo $mobj;?>'
	  
	  var dialogisopen=false;
		$Pcs2(document).ready(function(){
		$Pcs2("#headertrans").html("<b>Mutasi Antar Gudang")

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
			
			//alert(msatu)
			//alert(mdua)
			
			if (event.keyCode==39)
			{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")

				mggg=getNextElement(Event.element(event))
				mggg.focus()
				mggg.select()
				//$Pcs2("#"+mggg.id).css("background-color","lightgreen")
								
				mlg=mggg.id.indexOf("_")
				msatu=mggg.id.substr(mlg+1,1000)
				$Pcs2("#bodiv_"+msatu).css("background-color","yellow")
				
				toshow(mggg)
			}

			if (event.keyCode==13)
			{
			
			if (obj.substr(0,12)=='lookkasmasuk')
			{
				mob=obj.substr(12,10)
				misi=event.element(event).value
				parent.$Pcs2("#"+mob).val(misi)
				mob2=mob.replace('2_','3_')
				mtois=event.element(event).id.replace("2_","3_")
				misi2=$Pcs2("#"+mtois).val()
				parent.$Pcs2("#"+mob2).val(misi2)				
				mob3=mob.replace('2_','4_')
				parent.$Pcs2("#"+mob3).select()
				parent.$Pcs2("#kotakdialog2").dialog('close');
				
			}

			}	

			if (event.keyCode==37)
			{
				$Pcs2("#bodiv_"+msatu).css("background-color","white")

				mjjj=getPrevElement(Event.element(event))
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
				hiderow(mbawah)
				document.getElementById(mdua+'_'+mbawah).focus()
				document.getElementById(mdua+'_'+mbawah).select()

			}
		mmv=event.keyCode
		mobj=event.element(event)
		mnn=mobj.id.substr(0,1)
		//alert(mobj.value)

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

	execajaxas("delete from transmutasigudang where nid='"+mnid+"'")
	execajaxas("delete from bkbesar where nid='"+mnid+"'")
	
	mtgl="str_to_date('"+$Pcs2("#mtgl").val()+"','%d-%c-%Y')"
	mlokid1=$Pcs2("#mlokid1").val()	
	mlokid2=$Pcs2("#mlokid2").val()	
	mket=$Pcs2("#mket").val()
	
	for (ma=1;ma<mvv;ma++)
		{
			mnomor=$Pcs2("#1_"+ma).val()
			mstoid=$Pcs2("#2_"+ma).val()
			mstoid=mstoid.trim()
			if (mstoid!='')
			{
			//alert(mnomor)
			msatid=$Pcs2("#4_"+ma).val()
			misi=$Pcs2("#5_"+ma).val()
			mqty=$Pcs2("#6_"+ma).val()
			mtotqty=toval(mqty)*toval(misi)
			execajaxa("insert into transmutasigudang values('"+mnid+"',"+mtgl+",'"+mnomor+"','"+mstoid+"','"+msatid+"','"+mqty+"','"+misi+"','"+mlokid1+"','"+mlokid2+"','"+mket+"')")
			execajaxs("mTransaksixx=jurnalmutasi&mnid="+mnid+"&mtgl="+mtgl+"&mlokid="+mlokid1+"&mstoid="+mstoid+"&mtotqty="+mtotqty+"&mket="+mket)
			
			}
		}	
	mnid=$Pcs2("#mnid").val()
	execajaxa("insert into bkbesar (rekid,nid,tgl,bpid,bpid2,debet,qtyin,trans,ket) select rekid,nid,tgl,bpid,'"+mlokid2+"',kredit,qtyout,trans,ket from bkbesar where nid='"+mnid+"'")
	alert("Data Tersimpan")	
	baru()
	})

	$Pcs2("#btnhapus").click(function() {
		var conf=window.confirm("Hapus Transaksi ?")
		if (conf==false){return}
		mnid=$Pcs2("#mnid").val()
		execajaxas("delete from transmutasigudang where nid='"+mnid+"'")
		execajaxas("delete from bkbesar where nid='"+mnid+"'")
		alert("Data Terhapus")	
		baru()
	})

	$Pcs2("#btnbaru").click(function() {
		baru()
	})
	
	$Pcs2("#mnid").blur(function() {
			if (this.value==''){this.focus();this.select();}
			tb1=taptabel("transmutasigudang a","a.*,date_format(tgl,'%d-%m-%Y') tgly","nid='"+this.value+"'");
			mnid=tb1.nid;
			if (mnid!=undefined)	
			{	
				$Pcs2("#mtgl").val(tb1.tgly)
				$Pcs2("#mlokid1").val(tb1.lokid1)
				$Pcs2("#mlokid2").val(tb1.lokid2)
				$Pcs2("#mket").val(tb1.ket)
				refreshgrid()
			}
			else
			{
				alert("Nomor Tidak Ada !");	
				baru(true);
			}
	
	})

	$Pcs2("#mfilt").keyup(function() {
		refreshgrid()	
	})

	$Pcs2("#mfilt").keydown(function() {
		if (event.keyCode==13 || event.keyCode==40)
		{
			$Pcs2("#2_1").focus();
			$Pcs2("#2_1").select();
		}	
	})
	
	
	});

	function hiderow(mbawah)
	{
		$Pcs2("#bodiv_"+(mbawah-mvv)).hide()
		$Pcs2("#bodiv_"+mbawah).show()
	}
	function hiderow2(mbawah)
	{
		$Pcs2("#bodiv_"+(mbawah)).show()
		$Pcs2("#bodiv_"+(mbawah+mvv)).hide()
	}
	function toshow(obj)
	{
			mname=obj.id;
			mlg=mname.indexOf("_")
			msatu=parseInt(mname.substr(mlg+1,1000))
			mdua=mname.substr(0,mlg)
			$Pcs2("#bodiv_"+(msatu)).show()
			$Pcs2("#bodiv_"+(msatu-mvv)).hide()
	}
	
	function toshow2(obj)
	{
			mname=obj.id;
			mlg=mname.indexOf("_")
			msatu=parseInt(mname.substr(mlg+1,1000))
			mdua=mname.substr(0,mlg)
			$Pcs2("#bodiv_"+(msatu)).show()
			$Pcs2("#bodiv_"+(mvv+msatu)).hide()
	}

	function refreshgrid()
	{
		mfilt=$Pcs2("#mfilt").val()
		$Pcs2.ajax({
		type:"POST",
		url:"3grid.php",
		data : "mTform=mlookrek&mjog="+mvv+"&mfilt="+mfilt,
		async: true,
		success : function(data){
			$Pcs2("#spantabel").html(data)
		}});

	}
	

	function baru()
	{
		$Pcs2("#mfilt").focus()
		refreshgrid()
	}	
	</script>
</head>

<body background='images/num.jpg'>
<?php
	
?>
	Filter <input type=text size=30 id=mfilt>
	
	<form name='fform' id='fform'>
	<span id='spantabel'>
	</span>
	<hr>
	<div id='tombols' style="position:Relative">
	<input type='button' id='btnsimpan' value='OK'></input>
	</div>	
	</form>

</body>
</html>
	