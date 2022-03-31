<html>
<head>
<title>Print Label</title>
<link rel="stylesheet" href="main.css" type="text/css" />
<script src="js/jquery-1.3.2.min.js"></script>
<script src="js/jquery.corner.js"></script>
<script src="js/myfunc.js"></script>
<script>
$(document).ready(function(){
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
mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stoid in ("+aa+") )  order by POSITION('"+mcari+"' IN stonama),stonama";
}

mdat='';
$.ajax({
type:"POST",
url:"phpexec.php",
dataType:'json',
async: false,
chace :true,
data : mjadi,
success : function(data){
			
		nn=1;
		mjadd='<table border=1 cellspacing=5 width=>'

	        $.each(data, function(index, array) {

		mstoid=array['stoid']

		if (nn==1)
		{
		mjadd=mjadd+"<tr>"
		}
			mbarcode=array['barcode']
			mstonama=array['stonama']	
			mhrgjual3=tra(toval(array['hrgjual3'])/toval(array['isi']))

			mjadd=mjadd+"<td align=center width=350 ><br>METRO BIKE SHOP<hr> "+mstonama+" <br><font size=5>Rp. "+mhrgjual3+'</font><br>&nbsp;</td>'

		if (nn==4)
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
}});

}
</script>
<title>
</title>
</head>
<body bgcolor=#FFFFFF onload='loadform()'>
<div id='divprint' align=right><a href="" id='commprint'  onclick=printer() > <img src="images/icon_print.png"></a><hr></div>
<div id='divbar'></div>
</body>
</html>


