<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Print</title>
<link href="themes/sunny/ui.all.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/ui.core.js" type="text/javascript"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script src="js/ui.dialog.js" type="text/javascript"></script>
<script src="js/ui.draggable.js" type="text/javascript"></script>
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
$Pcs2(document).ready(function()
{
	mpel=taptabel('setlgn','alamat',"lgnid='"+opener.$Pcs2("#mlgnid").val()+"'")

	////
	htt=''

	htt=htt+'<table border=0 cellspacing=0 width=93%>'
	htt=htt+'<tr><td><font size=4>"CV. WPS"</font></td><td align=right><font size=4>SURAT JALAN</font></td></tr>'
	htt=htt+'<tr><td><font size=3>Jl. Dr. Wahidin 51 Blitar</font></td><td align=right><font size=3>Tanggal : '+opener.$Pcs2("#mtgl").val()+'</font></td></tr>'
	htt=htt+'<tr><td>&nbsp;</td><td align=right>&nbsp;</td></tr>'
	htt=htt+'<tr><td><b><font size=3>Kepada : '+opener.$Pcs2("#mlgnnama").val()+'</font></td><td align=right>&nbsp;</td></tr>'
	htt=htt+'<tr><td><b><font size=3>'+mpel.alamat+'</font></td><td align=right> Faktur No.: '+opener.$Pcs2("#mnid").val()+'</td></tr>'
	htt=htt+'</table>' 
	htt=htt+'<hr width=93% color=white>' 
	htt=htt+"<table border=0 cellspacing=0 width=93% '>"
	htt=htt+'<tr><th colspan=7><hr></th></tr>'
	htt=htt+'</table>' 	 
	htt=htt+'<table border=0 cellspacing=0 width=93%>'
	htt=htt+'<tr><th>SATUAN</th><th>&nbsp;V&nbsp;</th><th>ISI</th><th>NAMA BARANG</th><th>&nbsp;</th><th>&nbsp;</th></tr>'
	htt=htt+'<tr><th colspan=7><hr></th></tr>'

	paw=1
	pak=1000
	mstop=false
	mtootal=0
	for (att=1;att<20;att++)
	{
		if (mstop)
		{
			break;
		}

		for (abg=paw;abg<pak+1;abg++)
		{
			if (opener.$Pcs2("#12_"+abg).val()!=undefined && opener.$Pcs2("#12_"+abg).val()!='' )
			{
				mq1=''

				if (toval(opener.$Pcs2("#14_"+abg).val())>0)
				{
					mq1=opener.$Pcs2("#14_"+abg).val()
					ms1=opener.$Pcs2("#15_"+abg).val()
				}
				else
				{
					mq1=''
					ms1=''
				}

				if (toval(opener.$Pcs2("#16_"+abg).val())>0)
				{
					mq2=opener.$Pcs2("#16_"+abg).val()
					ms2=opener.$Pcs2("#17_"+abg).val()
				}
				else
				{
					mq2=''
					ms2=''
				}

				mharga=toval(opener.$Pcs2("#22_"+abg).val())-toval(opener.$Pcs2("#23_"+abg).val())
				mharga=Math.round(mharga,0)

				misi=''
				if (toval(mq1)>0)
				{
					misi=opener.$Pcs2("#misi_"+abg).val()
					mharga=( toval(opener.$Pcs2("#22_"+abg).val())-toval(opener.$Pcs2("#23_"+abg).val()) )/toval( opener.$Pcs2("#misi_"+abg).val() )
					mharga=Math.round(mharga,0)
				}
				mharga=tra(mharga)

				htt=htt+"<tr><td align=right> <table border=0 cellspacing=0><tr><td align=right >"+mq1+'</td><td>&nbsp;'+ms1+"</td><td align=right >&nbsp;&nbsp;"+mq2+'</td><td>&nbsp;'+ms2+"</td></tr></table> </td><td>&nbsp;</td><td align=center>"+misi+"</td><td>&nbsp;&nbsp;"+opener.$Pcs2("#13_"+abg).val()+"</td><td align=right>&nbsp;</td><td align=right>&nbsp;</td></tr>"
				mtootal=mtootal+toval(opener.$Pcs2("#24_"+abg).val())
			}
			else
			{
				mstop=true;
				break;
			}
		}

		htt=htt+'</table>'

		htt=htt+"<table border=0 cellspacing=2 width=93% >"
		for (axx=abg;axx<pak+1;axx++)
		{
			//htt=htt+'<tr><td>&nbsp;</td></tr>'
		}
		htt=htt+'</table>'

		////
		paw=axx
		pak=axx+18
	}

	abb=taptabel("setpromo","*","1=1")
	htt=htt+'<table border=0 cellspacing=0 width=93%>'
	htt=htt+"<tr><td colspan=6><hr></td></tr>"
	htt=htt+"<tr><td>Jatuh Tempo : "+opener.$Pcs2("#mjt").val()+"</td><td colspan=3 align=right><b><font size=3><b>&nbsp;</td><td align=right><font size=3><b>&nbsp;</td></tr>"
	htt=htt+"<tr><td colspan=6><hr></td></tr>"
	htt=htt+'</table>'
	htt=htt+'<table border=0 cellspacing=0 width=93%>'
	htt=htt+"<tr><td width=60% valign=top> </td><td valign=top align=center>&nbsp;</td><td valign=top align=center>&nbsp;</td></tr>"
	htt=htt+"<tr><td width=60% valign=top> </td><td valign=top align=center>&nbsp;</td><td valign=top align=center>&nbsp;</td></tr>"
	htt=htt+"<tr><td width=60% valign=top> </td><td valign=top align=center>&nbsp;</td><td valign=top align=center>&nbsp;</td></tr>"
	htt=htt+"<tr><td width=60% valign=top> </td><td valign=top align=center>&nbsp;</td><td valign=top align=center>&nbsp;</td></tr>"
	htt=htt+"<tr><td width=60% valign=top> </td><td valign=top align=center>&nbsp;</td><td valign=top align=center>&nbsp;</td></tr>"
	htt=htt+"<tr><td width=60% valign=top> </td><td valign=top align=center>&nbsp;</td><td valign=top align=center>&nbsp;</td></tr>"
	htt=htt+"<tr><td width=60% valign=top> </td><td valign=top align=center>Yang menerima,<br><br><br>_______________</td><td valign=top align=center>Yang menyerahkan,<br><br><br>_______________</td></tr>"
	htt=htt+'</table>'

	$Pcs2('#spanisi').html(htt)

	window.print();
	window.close();
	opener.focus();
})
</script>
<script type="text/javascript">
function loadform()
{
	//window.print();
	//window.close();
	//opener.focus();
}
</script>
<title></title>
</head>

<body style="font-family: tahoma; background-color: #FFFFFF">

<span id="spanisi" style="width: 93%"></span>

</body>

</html>
