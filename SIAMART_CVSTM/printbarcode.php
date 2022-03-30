<html>
<head>
<title>Print Barcode</title>
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
function loadform()
{
//window.print();
//window.close();
//parent.focus();
}

function printer()
{
	$("#divprint").hide()
	self.print();
	self.close();
	opener.focus();
}

function buatbarcode()
{
mgrpid=opener.document.getElementById("mgrpid").value
mgrpid=mgrpid.substr(0,4)
mcari=opener.document.getElementById("mcar").value
awal=opener.mmul

if (mcari=='')
{
mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stonama like '!!"+mcari+"!!' or stoid like '!!"+mcari+"!!' or barcode like '!!"+mcari+"!!' or barcode2 like '!!"+mcari+"!!' ) and grpid like '!!"+mgrpid+"!!'  order by stoid,POSITION('"+mcari+"' IN stonama),stonama limit "+awal+",100";
}
else
{
mjadi="func=EXECTAB&field=*&tabel=setstok&kondisi= ( stonama like '!!"+mcari+"!!' or stoid like '!!"+mcari+"!!' or barcode like '!!"+mcari+"!!' or barcode2 like '!!"+mcari+"!!'  ) and grpid like '!!"+mgrpid+"!!'  order by POSITION('"+mcari+"' IN stonama),stonama limit "+awal+",100";
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
		mjadd="<table border=1 cellspacing=0' width='97%'>"

	        $.each(data, function(index, array) {

		mstoid=array['stoid']

		for (hjk=1;hjk<101;hjk++)
		{
			msto=opener.document.getElementById("12_"+hjk).value
			if (msto==mstoid)
			{
			mkali=opener.document.getElementById("23_"+hjk).value
			break;
			}
		}

		for (nana=0;nana<mkali;nana++)
		{

		if (nn==1)
		{
		mjadd=mjadd+"<tr height=70>"
		}
			mbarcode=array['barcode']
			mstonama=array['stonama']
			mstonama=mstonama.substr(0,20)	
			mhrgjual3=tra(toval(array['hrgjual3'])/toval(array['isi']))

			mjadd=mjadd+"<td align=center width='20%' valign=top><font size=2>"+mstonama+"<div align=center style='height:28;font-family:IDAutomationHC39M;font-size:15pt;overflow:hidden'>*"+mbarcode+'*</div>'+mbarcode+' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp. '+mhrgjual3+' </td>'

		if (nn==5)
		{
		mjadd=mjadd+"</tr>"
		nn=1;
		}
		else
		{
		nn++;
		}	

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
<body bgcolor=#FFFFFF onload='loadform()' style='top-margin:0;padding=0'>
<div id='divprint' align=right><a href="" id='commprint'  onclick=printer() > <img src="images/icon_print.png"></a><hr></div>
<div id='divbar'></div>
</body>
</html>


