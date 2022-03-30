<html>
<head>
<title>SETUP STOK</title>
</head>
<body bgcolor=#286c00 onload='$mFoc' name=editstok style='font-family:Verdana;color:white'>

<?php
require ("utama.php");


$mstok=execute("
select a.*,b.grpnama,c.supnama 
from setstok a 
left join setgrp b on a.grpid=b.grpid
left join setsup c on a.supid=c.supid
where stoid='$_GET[mstoid]'");

$mmstoid=$mstok[stoid];
$mbarr=$mstok[barcode];
$meed='Edit';


$mtra=execute("select nid from bkbesar where bpid='$_GET[mstoid]' and rekid='10310' limit 0,1");
$mdisall='';
if ($mtra[nid]!='')
{$mdisall='readonly';}

if ($mmstoid=='')
{
$meed='Simpan';

$mstokx=execute("
select concat('B',lpad(convert(substring(stoid,2,5),signed)+1,5,'0')) nid
from setstok order by nid desc limit 0,1");

if ($mstokx[nid]=='')
{$mmstoid='B00001';}
else
{
$mmstoid=$mstokx[nid];
}
$mbarr=str_replace("B","",$mmstoid);

}
/*<tr><td>Nama Alias  </td><td> : <input type=text name=malias id=malias size=50 maxlength='200' value='<?php echo $mstok[alias] ?>' title='Isikan Nama Alias Stok'></td></tr>*/
?>

<form id='fform'>

<table>
<tr><td><input hidden type=text size='20' name=statform id=statform value='<?php echo $meed; ?>'></td> <td><input hidden type=text size='20' name=lastid id=lastid value=''></td></tr>
<tr hidden><td>Kode Stok  </td><td> : <input type=text size='20' name=mstoid id=mstoid value='<?php echo $mmstoid; ?>' maxlength='20' $msty readonly></td></tr>
<tr><td>Nama Stok  </td><td> : <input type=text name=mstonama id=mstonama size=50 maxlength='200' value='<?php echo $mstok[stonama] ?>' title='Isikan Nama Stok'></td></tr>
<tr><td>Barcode 1 </td><td> : <input type=text size='20' name=mbarcode id=mbarcode value='<?php echo $mstok[barcode] ?>' maxlength='20' $msty></td></tr>
<tr><td>Barcode 2 </td><td> : <input type=text size='20' name=mbarcode2 id=mbarcode2 value='<?php echo $mstok[barcode2] ?>' maxlength='20' $msty></td></tr>
<tr><td>Grup</td><td> : <input readonly type=text id=mgrpid name=mgrpid  value='<?php echo $mstok[grpid] ?>' size=10><input type=button value='Enter' id=lookgrup><input id=mgrpnama value='<?php echo $mstok[grpnama] ?>' disabled></td></tr>
<tr><td>Suplier</td><td> : <input readonly type=text id=msupid name=msupid  size=10 value='<?php echo $mstok[supid] ?>'><input type=button value='Enter' id=looksup><input id=msupnama value='<?php echo $mstok[supnama] ?>' disabled></td></tr>
</td></tr>
</table>

<br>
<table width=100% border=0 bordercolorlight=blue>
<tr><td align=left width=23%>Kemasan</td><td class='hju' > : <input readonly type=text id=msatid name=msatid size=5 value='<?php echo $mstok[satuan] ?>'><input type=button id=mlooksatuan value='Enter'><input type=text id=msatuan1 name=msatuan1 disabled size=5 value='<?php echo $mstok[satuan1] ?>'> Isi : <input size=5 maxsize=5 name='misi' id='misi' value='<?php echo $mstok[isi] ?>' <?php echo $mdisall ?> ><input type=text id=msatuan2 name=msatuan2  size=5 value='<?php echo $mstok[satuan2] ?>' disabled></td></tr>
<tr><td align=left>Hrg. Beli &nbsp</td> <td  colspan=3> : <input type=text size=10 name='mhrgbeli' id='mhrgbeli' $msty2 value='<?php echo number_format($mstok[hrgbeli],0,'.',',') ?>' style='text-align:right'></td></tr>
<tr><td align=left>Hrg. Jual Spesial&nbsp</td> <td colspan=3> : <input type=text size=10 name='mhrgjual' id='mhrgjual' $msty2  value='<?php echo number_format($mstok[hrgjual],0,'.',',') ?>' style='text-align:right'></td></tr>
<tr><td align=left>Hrg. Jual Grosir&nbsp</td> <td colspan=3> : <input type=text size=10 name='mhrgjual2' id='mhrgjual2' $msty2  value='<?php echo number_format($mstok[hrgjual2],0,'.',',') ?>'  style='text-align:right'></td></tr>
<tr><td align=left>Hrg. Jual Ecer&nbsp</td> <td colspan=3> : <input type=text size=10 name='mhrgjual3' id='mhrgjual3' $msty2  value='<?php echo number_format($mstok[hrgjual3],0,'.',',') ?>'  style='text-align:right'></td></tr>
<tr><td align=left>Stok Minimal&nbsp;</td><td align=left   class='hju' > : <input type=text size=5 id='mminimal' name='mminimal'   class='hju' $msty2  value='<?php echo number_format($mstok[minimal],0,'.',',') ?>'  style='text-align:right'></td>
</table>
<hr><font style='Verdana' size='4pt' color=white>
<input id=bsimpan type=button value='<?php echo $meed; ?>' $msty> <input id=bhapus type=button value='Hapus' $msty2> <input id=tutup type=button value='Tutup' $msty2> 
<<input type=button id='btnsaldo' style='font-color:white' value='Saldo Awal'></input>>

	<div id='kotakdialog2'>
		<center>
		<iframe id=framehrg width=100% height=350 top=30></iframe>
		</center>
	</div>	

</form>


<link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/ui.core.js"></script>
<script type="text/javascript" src="js/ui.dialog.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/myfunc.js"></script>
<script type="text/javascript">

// document.getElementById('mhrgjual3').onkeyup = function(e){
// 	if (!e) e = window.event;
// 	var keyCode = e.code || e.key;
// 	if (keyCode == 'Enter'){
// 		// Enter pressed
// 		if (document.getElementById('mhrgjual3').value == '0') {
// 		alert('Harga Jual Ecer tidak boleh Nol'); 
// 		}
// 	}
// }

  
// document.getElementById('misi').onkeypress = function(e){
// if (!e) e = window.event;
// var keyCode = e.code || e.key;
// if (keyCode == 'Enter'){
// 	// Enter pressed
// 	if (document.getElementById('misi').value == '') {
// 		console.log("wdw");
// 	}
// }
// }

  

//   document.getElementById('mhrgbeli').onkeypress = function(e){
//     if (!e) e = window.event;
//     var keyCode = e.code || e.key;
//     if (keyCode == 'Enter'){
//       // Enter pressed
// 	  if (document.getElementById('mhrgbeli').value == 0) {
//       	alert('Harga beli tidak boleh kosong'); 
// 	  }
//     }
//   }

//   document.getElementById('mstonama').onkeypress = function(e){
//     if (!e) e = window.event;
//     var keyCode = e.code || e.key;
//     if (keyCode == 'Enter'){
//       // Enter pressed
// 	  if (document.getElementById('mstonama').value == '') {
//       	alert('Nama tidak boleh kosong'); 
// 	  }
//     }
//   }
  
var $Pcs2 = jQuery.noConflict();
var mobjx='<?php echo $mobj; ?>'

$Pcs2(document).ready(function(){


///
$Pcs2('#mstonama').select();

///
$Pcs2("#kotakdialog2").dialog({
	autoOpen: false,
	modal: true,
	dragable: true,
	width : 730,

	close : function(){
	dialogisopen=false;
	},

	open : function(){
	dialogisopen=true;
	},
})

///
		$Pcs2(document).keydown(function(){
			var mmv=event
			mmf2=event.element(event);
			tabOnEnter (mmf2, mmv);
			document.activeElement

			if (mmv.keyCode==27)
			{
				$Pcs2('#tutup').click();			
			}
			
			if (mmv.keyCode==116 && mmf2.id=='mgrpid')
			{
				$Pcs2("#lookgrup").click()
			}

			if (mmv.keyCode==116 && mmf2.id=='mgrpid')
			{
				$Pcs2("#lookmerk").click()
			}
			
			if (mmv.keyCode==117 && mmf2.id=='mgrpid')
			{
				xxw=window.open('setgrp.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=450,height=400,right=200,top=10'));
				xxw.focus();
			}
			
			if (mmv.keyCode==116 && mmf2.id=='msatuan')
			{
				$Pcs2("#looksatuan").click()
			}

			if (mmv.keyCode==117 && mmf2.id=='msatuan')
			{
				xxw=window.open('setsatuan2.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=400,height=400,right=200,top=10'));
				xxw.focus();
			}

			if (mmv.keyCode==116 && mmf2.id=='msupid')
			{
				$Pcs2("#looksup").click()
			}

			if (mmv.keyCode==117 && mmf2.id=='msupid')
			{
				xxw=window.open('setsup.php','aa',('alwaysraised=yes,scrollbars=no,resizable=no,width=400,height=400,right=200,top=10'));
				xxw.focus();
			}
			
		})

///		
		$Pcs2(document).keyup(function(){
			var mmv=event
			mmf2=event.element(event);
			if (mmf2.id=='misi' || mmf2.id=='misi2' || mmf2.id=='mminimal' || mmf2.id.substr(0,8)=='mhrgbeli' || mmf2.id.substr(0,8)=='mhrgjual')
			{
				maa=tra(Event.element(event).value)
				Event.element(event).value=maa
			}
			
		})

///	
		$Pcs2('#misi').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.select()
			}
		})

		$Pcs2('#mstonama').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.select()
			}
		})

		$Pcs2('#mgrpid').blur(function(){
		valigrup()
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				$Pcs2('#lookgrup').click()
			}
		})

		
		$Pcs2('#msatid').blur(function(){
		valisat()
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				$Pcs2('#mlooksatuan').click()
			}

		})

		$Pcs2('#mhrgbeli').blur(function(){
			if (this.value=='' || this.value=='0' || this.value==0)
			{
				this.select()
			}
		})

		document.getElementById('mstonama').onkeypress = function(e) {
			if (document.getElementById('mstonama').value == '') {
				if(e.keyCode == 13) {
					alert('Nama tidak boleh kosong!');
					document.getElementById('mstonama').select();
				}
			}
		}

		document.getElementById('misi').onkeypress = function(e) {
			if (document.getElementById('misi').value == '' || document.getElementById('misi').value == 0) {
				if(e.keyCode == 13) {
					alert('Isi tidak boleh Nol/Kosong!');
					document.getElementById('misi').select();
				}
			}
		}

		document.getElementById('mhrgbeli').onkeypress = function(e) {
			if (document.getElementById('mhrgbeli').value == '0') {
				if(e.keyCode == 13) {
					alert('Harga Beli tidak boleh Nol!');
					document.getElementById('mhrgbeli').select();
				}
			}
		}

		document.getElementById('mhrgjual3').onkeypress = function(e) {
			if (document.getElementById('mhrgjual3').value == '0') {
				if(e.keyCode == 13) {
					alert('Harga Jual Ecer tidak boleh Nol!');
					document.getElementById('mhrgjual3').select();
				}
			}
		}

		

		$Pcs2('#mhrgjual3').blur(function(){

			if (this.value=='' || this.value=='0' || this.value==0)
			{
				
				this.select()
			}
		})

		function alert2(input){
			alert(""+input)
		}

		$Pcs2('#mbarcode').blur(function(){
			if (this.value!='' && this.value==$Pcs2('#mbarcode2').val())
			{
				alert("Barcode 1 dan 2 Tidak Boleh Sama !")
				this.select()
				this.value=''
				return;
			}
			tpt=taptabel("setstok","stoid,stonama","barcode='"+this.value+"' or barcode2='"+this.value+"' and stoid<>'"+$Pcs2('#mstoid').val()+"'")
			if (this.value!='' && $Pcs2('#mstoid').val()!=tpt.stoid && tpt.stonama!=undefined)
			{
				alert("Barcode  "+this.value+"  sudah dipakai di Stok "+tpt.stonama)
				this.select()
				this.value=''
				return;
			}
		})

		$Pcs2('#mbarcode2').blur(function(){
			if (this.value!='' && this.value==$Pcs2('#mbarcode').val())
			{
				alert("Barcode 1 dan 2 Tidak Boleh Sama !")
				this.select()
				this.value=''
				return;
			}
			tpt=taptabel("setstok","stonama","barcode='"+this.value+"' or barcode2='"+this.value+"'  and stoid<>'"+$Pcs2('#mstoid').val()+"' ")
			if (this.value!=''  && $Pcs2('#mstoid').val()!=tpt.stoid  && tpt.stonama!=undefined)
			{
			alert("Barcode "+this.value+" sudah dipakai di Stok "+tpt.stonama)
			this.select()
			this.value=''
			return;
			}
		})

		$Pcs2('#btnsaldo').click(function(){
			$Pcs2("#framehrg").attr('src','setsaldostok.php?mstoid='+$Pcs2("#mstoid").val())
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Stok');
			$Pcs2("#kotakdialog2").dialog('open');
			$Pcs2("#kotakdialog2").click();
			dialogisopen=true;		
		})
		
		$Pcs2('#lookgrup').click(function(){
		
		query1="select rpad(grpid,12,' ') Kode,rpad(grpnama,15,' ') Nama from setgrp "
		query2="where true "

		mcomm=query1+query2

		mordd="grpnama"
		mffff=" concat(grpnama) "
		mmid='mgrpid'

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		})

		$Pcs2('#looksup').click(function(){

		query1="select rpad(supid,12,' ') Kode,supnama Nama from setsup "
		query2="where true "

		mcomm=query1+query2

		mordd="supid"
		mffff=" concat(supnama) "
		mmid='msupid'

		$Pcs2("#framehrg").attr('src','genlookup.php?mobj='+mmid)
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Suplier');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	

		})
		
		$Pcs2('#lookmerk').click(function(){
			xxw=window.open('lookmerk.php?mobj=setstok1','aa',('alwaysraised=yes,scrollbars=yes,resizable=no,width=400,height=480,right=200,top=10'));
			xxw.focus();
		})
		
		$Pcs2('#mlooksatuan').click(function(){

		query1="select rpad(satuanid,12,' ') ID,satuan Satuan1,satuan2 Satuan2 from setsatuan where true "
		query2=""
		mcomm=query1+query2

		mordd="satuanid"
		mffff=" concat(satuan,satuan2) "
		$Pcs2("#framehrg").attr('src','genlookup.php?mobj=msatid')
		$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Satuan');
		$Pcs2("#kotakdialog2").dialog('open');
		$Pcs2("#kotakdialog2").click();
		$Pcs2("#framehrg").contentWindow.focus();	
		$Pcs2("#framehrg").tcari.focus();	

		})

		$Pcs2('#looksup').click(function(){
			xxw=window.open('looksup.php?mobj=setstok1','aa',('alwaysraised=yes,scrollbars=yes,resizable=no,width=500,height=400,right=200,top=10'));
			xxw.focus();
		})
		
	  $Pcs2('#mgrpid').focus(function(){
	  mmdd=fform.mgrpid.value;
	  if (mmdd=='')
	  {$Pcs2('#lookmerk').click()}
	  })

	  $Pcs2('#msatuan').focus(function(){
	  mmdd=fform.msatuan.value;
	  if (mmdd=='')
	  {$Pcs2('#looksatuan').click()}
	  })
	  
	$Pcs2('#msupid').blur(function(){
		valisup();
	})
	
    $Pcs2('#bsimpan').click(function(){ //newsimpan
		
		<?php
			$mtra3=execute("select * from setstok ORDER BY stoid DESC limit 0,1");

			$lastid1 = $mtra3['stoid'];
			$lastid1 = ltrim($lastid1, 'B');
			$lastid1 = $lastid1+1;
			$lastid = sprintf("%05d", $lastid1);
			$barcode = sprintf("%05d", $lastid1);
			$lastid = "B".$lastid;

			// echo "var idTerakhir = '".$lastid."';";
			echo "var idEdit = '".$mmstoid."';";
			// echo "var barcodeRaw = '".$barcode."';";

		?>

		
		

		


		grpid=$Pcs2("#mgrpid").val();
		stonama=$Pcs2("#mstonama").val();
		alias='';
		barcode2=$Pcs2("#mbarcode2").val();
		satuan=$Pcs2("#msatid").val();
		satuan1=$Pcs2("#msatuan1").val();
		satuan2=$Pcs2("#msatuan2").val();
		satuan3='';
		hrgbeli=$Pcs2("#mhrgbeli").val();
		hrgbeli=parseFloat(hrgbeli.replace(/,/g, ''));
		hrgjual=$Pcs2("#mhrgjual").val();
		hrgjual=parseFloat(hrgjual.replace(/,/g, ''));
		hrgjual2=$Pcs2("#mhrgjual2").val();
		hrgjual2=parseFloat(hrgjual2.replace(/,/g, ''));
		hrgjual3=$Pcs2("#mhrgjual3").val();
		hrgjual3=parseFloat(hrgjual3.replace(/,/g, ''));
		hrgjual4='';
		isi=$Pcs2("#misi").val();
		isi2=$Pcs2("#misi").val();
		minimal=$Pcs2("#mminimal").val();
		supid=$Pcs2("#msupid").val();
		qty3='';
		jmlhrg=$Pcs2("#mhargabeli").val();
		aktif=1;
		nomor=0;
		grpidold='';
		pb=0;


		if (stonama == '' || grpid == '' || supid == ''|| satuan == '' ) {
			alert('Isi form terlebih dahulu');
			return;
		}

		valigrup();
		valisup();
		valisat();

		if (document.getElementById('statform').value == 'Simpan') {
			// alert("SIMPAN :"+idTerakhir);
			$Pcs2.ajax({
				type:"POST",
				url:"phpexec.php",    
				data: "func=LASTID",
				dataType:'json',
				success: function(data){
					console.log(data);
				mmstoid=data.stoid;
				// //alert(data);
				if (mmstoid!=undefined)
				{
				// //alert(msatuanid);
				mmstoid=mmstoid.substr(1,15)
				mmstoid=parseFloat(mmstoid);
				// //alert(msatuanid);
				mmstoid=mmstoid+1;
				mmstoid=''+mmstoid
				var barcodeRaw=padl(mmstoid,'0',5);
				mmstoid='B'+padl(mmstoid,'0',5);
				}
				else
				{
				mmstoid='B00001';
				}
				var idTerakhir = mmstoid;
				stoid=idTerakhir;
				alert (idTerakhir);
				if (document.getElementById('mbarcode').value == '') {
					barcode = barcodeRaw;
				}else{
					barcode = $Pcs2("#mbarcode").val();
				}

				mq1="insert into setstok(grpid, stoid, stonama, alias, barcode, barcode2, satuan, satuan1, satuan2, satuan3, hrgbeli, hrgjual, hrgjual2, hrgjual3, hrgjual4, isi, isi2, minimal, supid, qty3, jmlhrg, aktif, nomor, grpidold, pb) ";
				mq2=" values('"+grpid+"','"+stoid+"','"+stonama+"','"+alias+"','"+barcode+"','"+barcode2+"','"+satuan+"','"+satuan1+"','"+satuan2+"','"+satuan3+"','"+hrgbeli+"','"+hrgjual+"','"+hrgjual2+"','"+hrgjual3+"','"+hrgjual4+"','"+isi+"','"+isi2+"','"+minimal+"','"+supid+"','"+qty3+"','"+jmlhrg+"','"+aktif+"','"+nomor+"','"+grpidold+"','"+pb+"')";
				execajaxas(mq1+mq2);
				document.getElementById("fform").reset();
				alert("Data Tersimpan !");
				document.getElementById("mstonama").select();
				// fform.mstoid.value=mmstoid;
				// $Pcs2('#mstoid').select();
				// execajaxas("insert into setstok(stoid,aktif) values('+mmstoid+',0)")
				}
			});
			
		}else{
			// alert("Update :"+idEdit);
			barcode = $Pcs2("#mbarcode").val();
			stoid=idEdit;
			execajaxa("UPDATE setstok SET grpid='"+grpid+"',stonama='"+stonama+"',alias='"+alias+"',barcode='"+barcode+"',barcode2='"+barcode2+"',satuan='"+satuan+"',satuan2='"+satuan2+"',satuan3='"+satuan3+"',hrgbeli='"+hrgbeli+"',hrgjual='"+hrgjual+"',hrgjual2='"+hrgjual2+"',hrgjual3='"+hrgjual3+"',hrgjual4='"+hrgjual4+"',isi='"+isi+"',isi2='"+isi2+"',minimal='"+minimal+"',supid='"+supid+"',qty3='"+qty3+"',jmlhrg='"+jmlhrg+"',aktif='"+aktif+"',nomor='"+nomor+"',grpidold='"+grpidold+"',pb='"+pb+"' WHERE stoid='"+stoid+"'");
			document.getElementById("fform").reset();
			var conf=window.confirm("Simpan Update Stok ?")
			if (conf==false){return}
			$Pcs2('#tutup').click();
		}

		stat = $Pcs2("#statform").val();
		// if (stat == 'Simpan') {
		// 	mq1="insert into setstok(grpid, stoid, stonama, alias, barcode, barcode2, satuan, satuan1, satuan2, satuan3, hrgbeli, hrgjual, hrgjual2, hrgjual3, hrgjual4, isi, isi2, minimal, supid, qty3, jmlhrg, aktif, nomor, grpidold, pb) ";
		// 	mq2=" values('"+grpid+"','"+stoid+"','"+stonama+"','"+alias+"','"+barcode+"','"+barcode2+"','"+satuan+"','"+satuan1+"','"+satuan2+"','"+satuan3+"','"+hrgbeli+"','"+hrgjual+"','"+hrgjual2+"','"+hrgjual3+"','"+hrgjual4+"','"+isi+"','"+isi2+"','"+minimal+"','"+supid+"','"+qty3+"','"+jmlhrg+"','"+aktif+"','"+nomor+"','"+grpidold+"','"+pb+"')";
		// 	execajaxas(mq1+mq2);
		// 	document.getElementById("fform").reset();
		// 	alert("Data Tersimpan !");
		// 	document.getElementById("mstonama").select();
		// }else{
		// 	execajaxa("UPDATE setstok SET grpid='"+grpid+"',stonama='"+stonama+"',alias='"+alias+"',barcode='"+barcode+"',barcode2='"+barcode2+"',satuan='"+satuan+"',satuan2='"+satuan2+"',satuan3='"+satuan3+"',hrgbeli='"+hrgbeli+"',hrgjual='"+hrgjual+"',hrgjual2='"+hrgjual2+"',hrgjual3='"+hrgjual3+"',hrgjual4='"+hrgjual4+"',isi='"+isi+"',isi2='"+isi2+"',minimal='"+minimal+"',supid='"+supid+"',qty3='"+qty3+"',jmlhrg='"+jmlhrg+"',aktif='"+aktif+"',nomor='"+nomor+"',grpidold='"+grpidold+"',pb='"+pb+"' WHERE stoid='"+stoid+"'");
		// 	document.getElementById("fform").reset();
		// 	var conf=window.confirm("Simpan Update Stok ?")
		// 	if (conf==false){return}
		// 	$Pcs2('#tutup').click();
		// }

			
			
			ambildata();	
	})

	  $Pcs2('#bhapus').click(function(){
			//Ceking valid
			//
			var conf=window.confirm("Hapus Data ?")

			transaksi($Pcs2("form").serialize()+"&mTransaksixx=fsstx002");			

			$Pcs2('#tutup').click();
		})	
	
	$Pcs2('#tutup').click(function(){
		//mmm=parent.document.title
		//if (mmm=="Setup Stok")
		//{
		//mm=parent.tableGrid1.keys._yCurrentPos;
		parent.$Pcs2("#lookup").dialog('close');
		//parent.tableGrid1.refresh(0,mm,true);
		parent.focus();
		//}

		//if (mmm=="Pembelian")
		//{
		//parent.$Pcs2("#kotakdialog2").dialog('close');
		//parent.focus();
		//}
		
	})
	
})

///
	// function ambilstok()
	// {
	// 	mvstoid=$Pcs2('#mstoid').val();
	// 	if (mvstoid==''){
	// 	fform.bsimpan.value='Simpan'
	// 	$Pcs2.ajax({
	// 		type:"POST",
	// 		url:"phpexec.php",    
	// 		data: "func=EXEC&field=stoid&tabel=setstok&kondisi=(1=1)  order by stoid desc limit 1",
	// 		dataType:'json',
	// 		success: function(data){
	// 		mmstoid=data.stoid;
	// 		//alert(data);
	// 		if (mmstoid!=undefined)
	// 		{
	// 		//alert(msatuanid);
	// 		mmstoid=mmstoid.substr(1,15)
	// 		mmstoid=parseFloat(mmstoid);
	// 		//alert(msatuanid);
	// 		mmstoid=mmstoid+1;
	// 		mmstoid=''+mmstoid
	// 		mmstoid='B'+padl(mmstoid,'0',5);
	// 		}
	// 		else
	// 		{
	// 		mmstoid='B00001';
	// 		}
	// 		fform.mstoid.value=mmstoid;
	// 		$Pcs2('#mstoid').select();
	// 		execajaxas("insert into setstok(stoid,aktif) values('+mmstoid+',0)")
	// 		}
	// 	});
	// 	}
	// 	else
	// 	{
	// 	setstok=taptabel("setstok","*","stoid='"+mvstoid+"'");
	// 	fform.bsimpan.value='Edit'
	// 	$Pcs2('#mstonama').val(setstok.stonama);
	// 	$Pcs2('#mbarcode').val(setstok.barcode);
	// 	$Pcs2('#mbarcode2').val(setstok.barcode2);
	// 	$Pcs2('#msatid').val(setstok.satuan);
	// 	$Pcs2('#mgrpid').val(setstok.grpid);
	// 	$Pcs2('#msupid').val(setstok.supid);
	// 	$Pcs2('#msatuan').val(setstok.satuan);
	// 	$Pcs2('#misi').val(setstok.isi);
	// 	$Pcs2('#misi2').val(setstok.isi2);				
	// 	$Pcs2('#mhrgbeli').val(tra(toval(setstok.hrgbeli)));
	// 	$Pcs2('#mhrgjual').val(tra(toval(setstok.hrgjual)));
	// 	$Pcs2('#mhrgjual2').val(tra(toval(setstok.hrgjual2)));
	// 	$Pcs2('#mhrgjual3').val(tra(toval(setstok.hrgjual3)));
	// 	$Pcs2('#mminimal').val(tra(toval(setstok.minimal)));
	// 	valigrup();
	// 	valisup();
	// 	valisat();
	// 	$Pcs2('#mstoid').attr('readonly','true')
	// 	$Pcs2('#mstonama').select();
		
	// 	saldo=taptabel("bkbesar","qtyin","bpid='"+mvstoid+"' and trans='SA'");
		
	// 	if (saldo.qtyin!=undefined)
	// 	{
	// 	msd=saldo.qtyin;
	// 	mi1=setstok.isi;
	// 	mi2=setstok.isi2;
	// 	mss1=parseInt(msd/(mi1*mi2),0);

	// 	if (mi1==1){mss1=0;}

	// 	mp1=(msd-(mss1*mi1*mi2));

	// 	$Pcs2('#msaldo1').val(mss1);
	// 	$Pcs2('#msaldo2').val(mp1);
	// 	//$Pcs2('#msaldo3').val(mss3);
	// 	}
		
	// 	}
	// }

	
	function valigrup()
	{
		mvgrpid=$Pcs2('#mgrpid').val();

		if (mvgrpid==''){$Pcs2("#mmerknama").val("");return;}
		setgrp=taptabel("setgrp","*","grpid='"+mvgrpid+"'")
		if (!setgrp)
			{
				alert('Grup Tidak Valid !');
				$Pcs2('#mgrpid').select();
				return;
			}
			else 
			{
				$Pcs2("#mgrpid").val(setgrp.grpid);
				$Pcs2("#mmerknama").val(" "+setgrp.merknama+" ");
				setgrup=taptabel("setgrp","grpid,grpnama,supid","grpid='"+setgrp.grpid+"'")
				$Pcs2("#mgrpid").val(setgrup.grpid);
				$Pcs2("#mgrpnama").val(setgrup.grpnama);
				$Pcs2("#msupid").select();
			}	
	}

	function valisup()
	{
		mvsupid=$Pcs2('#msupid').val();
		if (mvsupid==''){$Pcs2("#msupnama").val("");return;}
		setsup=taptabel("setsup","supnama","supid='"+mvsupid+"'")
		if (!setsup)
			{
				alert('Suplier Tidak Valid !');
				$Pcs2('#msupid').select();
				return;
			}
			else 
			{
				$Pcs2("#msupid").val(setsup.supid);
				$Pcs2("#msupnama").val(" "+setsup.supnama+" ");
				$Pcs2('#msatid').select();
			}	
	}
	
	function valisat()
	{
		mvsatuanid=$Pcs2('#msatid').val();
		if (mvsatuanid==''){return;}
		data=taptabel("setsatuan","*","satuanid='"+mvsatuanid+"'")
		msatuanid=data.satuanid;
				if (msatuanid==undefined)
					{
						alert('Satuan Tidak Valid !');
						$Pcs2('#msatid').select();
						return;
					}
				else 
					{

						$Pcs2("#msatuan1").val(data.satuan);
						$Pcs2("#msatuan2").val(data.satuan2);
						$Pcs2("#misi").select();

						
					}
	
	}

///
</script>

</body>
</html>