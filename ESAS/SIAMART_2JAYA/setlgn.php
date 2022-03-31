<?php 

ob_start("ob_gzhandler");
session_start();

$links=mysql_connect('localhost','root','') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('siamart_2jaya_data',$links);
$resultx = mysql_query ("select * from user where id='".$_SESSION['MASUK']."' and password='".$_SESSION['MAPA']."'",$links) or die ("");
$rrwx=mysql_fetch_assoc ($resultx);
if ($rrwx[id]=='')
{
echo "<script> window.location='index.php' </script>";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">

<html><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Pelanggan</title>
    <link rel="stylesheet" type="text/css" href="themes/le-frog/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script type="text/javascript">
	  var $Pcs2 = jQuery.noConflict();
	  var dialogisopen=false;
      $Pcs2(document).ready(function(){
		$Pcs2("#subtitle").html("Master Pelanggan")
		$Pcs2(document).keydown(function(){
			var mmv=event.keyCode
			mmf=tableGrid1.keys.thefocus;
			mmf2=Event.element(event).id;
			//alert(event.ctrlKey);

			if (mmv==112){$Pcs2("#tcari").focus();}
			if (mmv==113){$Pcs2("#buka").click();}
			if (mmv==114){$Pcs2("#tambah").click();}
			if (mmv==13){
			if (mmf && mmf2!='tcari'){$Pcs2("#buka").click();}
			}

			if (mmv==27){
			
			if ($Pcs2("#kotakdialog").dialog("isOpen"))
			{
			var mm=tableGrid1.keys._yCurrentPos;
			tableGrid1.refresh(0,mm,true);
			dialogisopen=false;
			}
			
			}
			
		});
	  
        $Pcs2("#kotakdialog").dialog({
 		  autoOpen: false,
  		  modal: true,
		  show: false,
		  hide: false,
		  dragable: true,
		  width : 800,
		  close : function(){
		  
		  $Pcs2("#framehrg").attr('src','');
		  mm=tableGrid1.keys._yCurrentPos;
		  tableGrid1.refresh(0,mm,true);

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
			$Pcs2("#btnsimpan").focus();
		  },		  
		  });

		$Pcs2(".fieldna").focus(function() {
			mmnn=document.activeElement.id	
			$Pcs2(".trtr").css("background-color","transparent")
			$Pcs2("#tr"+mmnn).css("background-color","green")
		})
		  
        $Pcs2("#tambah").click(function() {
			fsetstok.btnsimpan.value='Simpan'
            $Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.reset();
			datas=taptabel("setlgn","lgnid","1=1 order by lgnid desc limit 1");
			data=datas.lgnid;
			
			if (data!=undefined)
			{
			mmlgnid=data.substr(0,5);
			//alert(mmlgnid);
			mmlgnid=parseFloat(mmlgnid);
			//alert(mmlgnid);
			mmlgnid=mmlgnid+1;
			mmlgnid=''+mmlgnid
			mmlgnid=padl(mmlgnid,'0',5);
			}
			else
			{
			mmlgnid='00001';
			}
			fsetstok.mlgnid.value=mmlgnid;

		fsetstok.mlgnnama.focus();fsetstok.mlgnnama.select();
		$Pcs2("#mlgnnama").click()
		})

        $Pcs2("#btnharga").click(function() {
			$Pcs2("#framehrg").attr('src','rsethrglgn.php')
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup per Principal');
            $Pcs2("#kotakdialog2").dialog('open');
			dialogisopen=true;
		})

        $Pcs2("#btnsaldo").click(function() {
			$Pcs2("#framehrg").attr('src','setsaldolgn.php?mlgnid='+$Pcs2("#mlgnid").val())
			$Pcs2("#kotakdialog2").dialog('option', 'title', 'Setup Saldo Awal Piutang');
            $Pcs2("#kotakdialog2").dialog('open');
			dialogisopen=true;
		})
		
        $Pcs2("#buka").click(function() {
			
			mopp=$Pcs2("#kotakdialog").dialog("isOpen");

			if (mopp){return};

			fsetstok.btnsimpan.value='Edit'
			var mm=tableGrid1.keys._yCurrentPos;
			var isi=tableGrid1.getValueAt(1,mm);
			fsetstok.mlgnid.enabled=true;
            $Pcs2("#kotakdialog").dialog('open');
			dialogisopen=true;
			fsetstok.mlgnid.value=isi;

			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",    
			data: "func=EXEC&field=*&tabel=setlgn&kondisi=(lgnid='"+isi+"')",
			dataType:'json',
			success: function(data){

	maj=document.getElementById("mlgnid")

	for (var mii=1;mii<30;mii++)
	{
		maj=getNextElement(maj)
		mid=maj.id.substr(1,30)
		mtp=maj.type
		if (mtp=='text')
		{
			maj.value=data[mid]	
		}
	}

			}
			});
			fsetstok.mlgnid.focus();fsetstok.mlgnid.select();
			});


	$Pcs2("#btnsimpan").click(function() {

	majj=taptabel("setlgn","lgnid","lgnid='"+$Pcs2("#mlgnid").val()+"'")
	
	mab='lama'
	if (majj.lgnid==undefined)
	{

	mab='baru'

	}
	
	maj=document.getElementById("mlgnid")
	msu=$Pcs2("#mlgnid").val()
	execajaxas("delete from setlgn where lgnid='"+msu+"'")
	execajaxas("insert into setlgn (lgnid) values('"+msu+"')")

	for (var mii=1;mii<30;mii++)
	{
		maj=getNextElement(maj)
		mtp=maj.type
		if (mtp=='text')
		{
			mfieldna=maj.id.substr(1,100)
			execajaxa("update setlgn set "+mfieldna+"='"+maj.value+"' where lgnid='"+msu+"'")
			//alert("update setlgn set "+mfieldna+"='"+maj.value+"' where lgnid='"+msu+"'")
			
		}
	}
	
	alert("Data Tersimpan !")	
	if (mab=='lama')
	{
	$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
	}
	else
	{
	$Pcs2("#tambah").click()
	}
	return;	
		})

        $Pcs2("#btnhapus").click(function() {

			var conf=window.confirm("Hapus Transaksi ?")
			if (conf==false){return}
		
			mlgnid=fsetstok.mlgnid.value;
			$Pcs2.ajax({
			type:"POST",
			url:"phpexec.php",
			data: "func=EXECUTE&comm=delete from setlgn where lgnid='"+mlgnid+"'",
			//dataType:'json',
			success: function(data){
			if(data==1)
				{tableGrid1.refresh(0,0,true);}
			}
			}
			)
			execajaxa("delete from bkbesar where bpid='"+mlgnid+"'")
			execajaxs("mTransaksixx=tosald00231")
			focustogrid(0,0);
			$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
		});		
	
        $Pcs2("#btnkeluar").click(function() {
		tableGrid1.refresh(0,0,true);
		$Pcs2("#kotakdialog").dialog('close');dialogisopen=false;
		});

        $Pcs2("#tkeluar").click(function() {
		window.close();
		});
		
        $Pcs2("#tcetak").click(function() {
		//MenuIDMenuBar1.hide();
		//tombols.hide();
		//window.print()
		//MenuIDMenuBar1.show();
		//tombols.show();
		});
		
		$Pcs2("#mgolongan").blur(function() {
		this.value=this.value.toUpperCase()
		if (! (this.value=='A' || this.value=='B' || this.value=='C' ))
		{
		this.value='Isikan hanya A atau B atau C !'
		this.select()
		}
		
		})
		
		//$Pcs2("#tcari").keyup(function() {
		//var mfilt=tcari.value;
		//mfilt=mfilt.trim();
		//alert(mfilt);
		//tableGrid1.request="msql=select * from setlgn where (concat(lgnid,lgnnama,rekid) like '!!"+mfilt+"!!') order by lgnid"
		//tableGrid1.refresh()
		//});		

		$Pcs2("#tcari").keyup(function() {
			var mfilt=tcari.value;
			mfilt=mfilt.trim();
			tableGrid1.request="mfilt="+mfilt
			tableGrid1.refresh()
		});
		
		var mws=screen.width
		var mhs=screen.height
		
		$Pcs2("#mytable1").css({
		'position':'relative',
		'height': mhs-280+'px',
		'background-color':'white',
		'font-size':'12',
		});

		var mws=screen.width
		$Pcs2("#setperxx").css({		'width': mws-665+'px',
		'height': '19px',
		'line-height':'19px',
		'font-size':'12',
		});
		
		$Pcs2("#sethrg").css({
		'position':'absolute',
		'top':'50px', 
		'left':'400px',
		'width': '400px',
		'height': '300px',
		'background-color':'white',
		'font-size':'12',
		});

		$Pcs2("#fsetstok").keydown(function() {
			mmf2=Event.element(event);
			tabOnEnter (mmf2, event);
		})
				
		$Pcs2("#tcari").keydown(function() {
			if (event.keyCode==13){this.blur();focustogrid(0,0);}
		})
		
		$Pcs2("#tcetak").click(function() {
			window.open("isilaporan.php?mLapo=mSetup&mtabelnya=setlgn&detitle=Master Pelanggan<br>")
		})

		
    });
    </script>
    <link type="text/css" href="css/mytablegrid.css" rel="stylesheet">
    <link type="text/css" href="css/shCore.css" rel="stylesheet">
    <link type="text/css" href="css/shThemeRDark.css" rel="stylesheet" id="shTheme">
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js"></script>
	<script type="text/javascript" src="js/builder.js"></script>
	<script type="text/javascript" src="js/effects.js"></script>
	<script type="text/javascript" src="js/dragdrop.js"></script>
	<script type="text/javascript" src="js/controls.js"></script>
	<script type="text/javascript" src="js/slider.js"></script>
	<script type="text/javascript" src="js/sound.js"></script>
    <script type="text/javascript" src="js/mytablegrid.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript" src="js/format.js"></script>
	<script type="text/javascript" src="js/tablegrid.js"></script>
	<script type="text/javascript" src="js/keytable.js"></script>
	<script type="text/javascript" src="js/controls_002.js"></script>
    <script type="text/javascript" src="js/shCore.js"></script>
    <script type="text/javascript" src="js/shBrushJScript.js"></script>
    <script type="text/javascript" src="js/shBrushXml.js"></script>
    <script type="text/javascript" src="js/shBrushPlain.js"></script>
    <script type="text/javascript">

//    SyntaxHighlighter.config.clipboardSwf = '../scripts/highlighter/clipboard.swf';
//    SyntaxHighlighter.all();

    function toggleSampleCode(id, element) {
        if ($Pcs(id).getStyle('display') == 'none') {
            Effect.BlindDown(id);
            element.innerHTML = 'Hide sample code';
        } else {
            Effect.BlindUp(id);
            element.innerHTML = 'See sample code';
        }
    }

    var countryList = [
        {value: 'UK', text: 'United Kingdon'},
        {value: 'US', text: 'United States'},
        {value: 'CL', text: 'Chile'}
    ];

   var mws=screen.width
    var tableModel = {
        options : {
            title: 'Daftar Pelanggan',
            rowClass : function(rowIdx) {
                var className = '';
                if (rowIdx % 2 == 0) {
                    className = 'hightlight';
                }
                return className;
            },
			
			pager: {
                total: 100,
                pages: 1,
                currentPage: 1,
                from: 1,
                to: 100
            },

        },
        columnModel : [
            {
                id : 'nomor',
                title : 'No.',
                type: 'number',				
                width : 40,
                editable: false,
            },
            {
                id : 'lgnid',
                title : 'Kode',
                width : 50,
                editable: false,
            },
            {
                id : 'lgnnama',
                title : 'Nama',
                width : 200,
                editable: false,
            },
            {
                id : 'golongan',
                title : 'Gol',
                width : 30,
                editable: false,
            },
            {
                id : 'alamat',
                title : 'Alamat',
                width : 250,
                editable: false,
            },
            {
                id : 'rute',
                title : 'Rute',
                width : 200,
                editable: false,
            },
            {
                id : 'telp',
                title : 'Telpon',
                width : 100,
                editable: false,
            },			
            {
                id : 'keterangan',
                title : 'Keterangan',
                width : 200,
                editable: false,
            },			

		],
	url: "item.php?mTparam=smlgg001",
	request: ""
    };

    var tableGrid1 = null;
    window.onload = function() {
		var $Pcs = jQuery.noConflict();
        tableGrid1 = new MyTableGrid(tableModel);
        tableGrid1.render('mytable1',true);	
        $Pcs('contactLink').onclick = function() {
            if ($Pcs('contact').getStyle('display') == 'none') {
                Effect.BlindDown('contact');
            } else {
                Effect.BlindUp('contact');
            }
        };
	};

	
	window.onkeypress=function(){
	};
	  
	function proses(){
		//var mm=tableGrid1.keys._yCurrentPos;
		//var isi=tableGrid1.getValueAt(1,mm);
		$Pcs("#buka").click();
		//alert(isi);
		//window.location='setlgn.php?mlgnid='+isi;
		//cell = tableGrid1.keys.getCellFromCoords(1,1);
		//tableGrid1.keys.setFocus(cell);
		//mytable1.select();	
		//$Pcs("#kotakdialog").dialog('open');
	}

	function focustogrid(xx,yy){
		cell = tableGrid1.keys.getCellFromCoords(xx,yy);
		tableGrid1.keys.setFocus(cell);
		tableGrid1.keys.captureKeys();
		tableGrid1.keys.eventFire("action", tableGrid1.keys._nCurrentFocus);
	}

</script>
</head>

<body background='images/num.jpg'>

<?php
require("menu.php");
?>

	<font face='arial' color='white'>
	<table>
	<tr>
	</td>
	<b>
	C a r i : <input type='text' id='tcari' size=47>
	</b>
	</td>
	</tr>
	</table>
	</font>
	
	<div id="mytable1" >
	</div>	

	<div id='tombols' style="position:Relative;left:5px">
	<hr>
	<input type='button' id="bCari" value="F1 = Cari" >&nbsp;&nbsp;
	<input type='button' id="buka" value="F2/Enter = Edit" >&nbsp;&nbsp;
	<input type='button' id="tambah" value="F3 = Baru" >&nbsp;&nbsp;
	<input type='button' id="tcetak" value="F7 = Print" >&nbsp;&nbsp;
	<input type='button' id="tkeluar" value="Tutup" >
	</div>
    
	<div id="kotakdialog" title="Setup Pelanggan">

	<form name='fsetstok' id='fsetstok'>
	<font size=4>
	<table border=0 cellpadding=0 cellspacing=0 width=100%>
	<?php
		
	$msql="
	SELECT COLUMN_NAME kolom, DATA_TYPE tipe, NUMERIC_PRECISION panjang1, CHARACTER_MAXIMUM_LENGTH panjang2, COLUMN_COMMENT koment
	FROM information_schema.COLUMNS
	WHERE TABLE_SCHEMA='siamart_2jaya_data' and TABLE_NAME='setlgn' and COLUMN_COMMENT<>''
	order by COLUMN_COMMENT
	";

	$rww=executerow($msql);
	while ($row=mysql_fetch_assoc($rww))
	{

	$mpand=($row[panjang1]+$row[panjang2])*(70/100);
	if ($mpand>60)
	{$mpand=60;}
	$mpand=60;
	$mmax=$row[panjang1]+$row[panjang2];
	$mrod='';

	$mtpe="style='font-size:10pt;'";
	if ($row[tipe]=='decimal' or $row[tipe]=='int' or $row[tipe]=='double' )
	{
	$mtpe=" style='font-size:10pt;text-align:right' ";
	}	
	
	if (($row[kolom])=='lgnid')
	{$mrod='readonly';}
	echo "<tr>";
	echo "<td width=20% align=left class='trtr' id='trm".$row[kolom]."'><font size=3pt>";
	echo "&nbsp;".substr($row[koment],2,100)."";
	echo "</td>";
	echo "<td>";
	echo ": <input width=65% type=text class='fieldna' id='m".$row[kolom]."' $mtpe maxlength=$mmax size=".$mpand." $mrod >";
	if ($row[kolom]=='tempo')
	{echo " hari"; }	
	echo "</td>";
	echo "</tr>";
	}

	?>
	</table>
	
	<hr>
	<<a href id='btnsaldo'><i>Awal Piutang</i></a>>
	<input type=button id='btnsimpan' value=Simpan>
	<input type=button id='btnhapus' value=Hapus>
	<input type=button id='btnkeluar' value=Tutup>
	</form>

	<div id="kotakdialog2" title="Setup Pelanggan">
		<center>		<tr><td><iframe id=framehrg width=100% height=400 top=30></td></tr>
		</center>
	</div>	

</body>
</html>