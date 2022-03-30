<html>

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
				mstonama=array['stonama'].substring(0, 30);
				mhrgjual3=tra(toval(array['hrgjual3'])/toval(array['isi']));
				
				mgrpid=array['grpid'];
				
				//mjadd=mjadd+"<td align=center width=350 ><br>E-DJA CORNER<hr> "+mstonama+" <br>"+mbarcode+" <br><font size=6>Rp. "+mhrgjual3+'</font><br>&nbsp;</td>'
				mjadd=mjadd+"<td align=center width=350><b>"+mstonama+"<div align=center style='height:23;font-family:IDAutomationHC39M;font-size:15pt;overflow:hidden'>*"+mbarcode+"*</div>"+mbarcode+"<div align=center style='height:23;font-family:Arial;font-size:15pt;overflow:hidden'>"+mgrpid+"</div><font size=6><b>Rp. "+mhrgjual3+'</b></font><br>&nbsp;</td>';
				
				if (nn==5)
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
