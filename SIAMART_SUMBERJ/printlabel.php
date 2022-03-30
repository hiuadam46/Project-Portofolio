<html>
	<style>
	#container{width:100%;}
#left{float:left;width:30%;}
#right{float:right;width:65%;}
#center{margin:0 auto;width:100%;}
	</style>

<head>
<title>Print Label</title>
<!-- <link rel="stylesheet" href="main.css" type="text/css"> -->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
	$(".divdiv").corner("15px")
	buatbarcode()
})
</script>
<script type="text/javascript">
function printer()
{
	$("#divprint").hide()
	self.print();
	self.close();
	opener.focus();
}

function loadform()
{
	//window.print();
	//window.close();
	//parent.focus();
}

function buatbarcode()
{
	mgrpid=opener.document.getElementById("mgrpid").value
	mgrpid=mgrpid.substr(0,4)
	mcari=opener.document.getElementById("mcar").value
	aa=opener.aa

	if (mcari=='')
	{
		mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stoid in ("+aa+") ) order by stoid,POSITION('"+mcari+"' IN stonama),stonama";
	}
	else
	{
		mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stoid in ("+aa+") ) order by POSITION('"+mcari+"' IN stonama),stonama";
	}

	mdat='';
	$.ajax(
	{
		type:"POST",
		url:"phpexec.php",
		dataType:'json',
		async: false,
		chace :true,
		data : mjadi,
		success : function(data)
		{
			nn=1;
			mjadd='<table border=1 cellspacing=5 width=>'

			$.each(data, function(index, array)
			{
				mstoid=array['stoid']

				if (nn==1)
				{
					mjadd=mjadd+"<tr>"
				}
				mbarcode=array['barcode']
				isi1=array['isi']
				isi2=array['isi2']
				satuan1=array['satuan1']
				satuan2=array['satuan2']
				supid=array['supid']
				mstonama=array['stonama'].substring(0, 30);
				mhrgjual3=tra(toval(array['hrgjual3'])/toval(array['isi']));
				
				mgrpid=array['grpid'];

				function getit(param){
					return param;
				}
				

				var supnama;
				$.ajax(
				{
					type:"POST",
					url:"phpexec.php",    
					async: false,
					data: "func=getforprintlabel&supid="+supid+"&grpid="+mgrpid+"",
					success : function(data)
					{
						supnama = data
					}
				});

				outtable = supnama.split('||')

				d = new Date();

				mtanggal = (d.getDay()-1) +'-'+ (1+d.getMonth()) +'-'+ d.getFullYear();


				
				console.log(outtable[0])
				
				//mjadd=mjadd+"<td align=center width=350 ><br>E-DJA CORNER<hr> "+mstonama+" <br>"+mbarcode+" <br><font size=6>Rp. "+mhrgjual3+'</font><br>&nbsp;</td>'
				// mjadd=mjadd+"<td align=center width=350><b>"+mstonama+"<div align=center style='height:23;font-family:IDAutomationHC39M;font-size:15pt;overflow:hidden'>*"+mbarcode+"*</div>"+mbarcode+"<div align=center style='height:23;font-family:Arial;font-size:15pt;overflow:hidden'>"+mgrpid+"</div><font size=6><b>Rp. "+mhrgjual3+'</b></font><br>&nbsp;</td>';
				mjadd=mjadd+"<td align=center width=350 style='white-space:nowrap'><div id='container'><div align=left id='left' style='font-size:10pt'><b>"+mgrpid+"<br>"+outtable[1]+"</b></div><div align=left id='right' style='font-size:10pt'><div align=center style='font-family:IDAutomationHC39M;font-size:12pt;overflow:hidden'><b>*"+mbarcode+"*</b></div><div style='align=center'>"+mstonama+"</div></div></div><br><br><br><div align=left style='font-size:9pt'>Kode Barang : "+mstoid+" <br>Kode Nama Suplier : "+supid+" "+outtable[0]+"<br>Packing (isi) : "+satuan1+" ("+isi1+") "+satuan2+" ("+isi2+")<br>Tanggal Diterima : "+mtanggal+"</div><br><div id=right>______________________<br>Penanggung Jawab Inspektur</div></td>";
				
				if (nn==3)
				{
					mjadd=mjadd+"</tr>"
					nn=1;
				}
				else
				{
					nn++;
				}
			});

			mjadd=mjadd+"</table>"

			$("#divbar").html(mjadd)
		}
	});
}
</script>
</head>

<body onload="loadform()" style="background-color: #FFFFFF">

<div id="divprint" style="text-align: right">
	<a id="commprint" href="" onclick="printer()">
	<img alt="Cetak" src="images/icon_print.png"></a><hr></div>
<div id="divbar">
</div>

</body>

</html>
