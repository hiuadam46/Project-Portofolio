<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Print</title>
    <link rel="stylesheet" type="text/css" href="themes/sunny/ui.all.css">
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="js/ui.core.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.draggable.js"></script>  
    <script type="text/javascript" src="js/prototype.js"></script>
    <script src="js/jquery.corner.js"></script>
    <script type="text/javascript" src="js/myfunc.js"></script>
    <script src="js/jquery.corner.js"></script>			
    <script type="text/javascript">
    var $Pcs2 = jQuery.noConflict();
     $Pcs2(document).ready(function(){
     

     mpel=taptabel('setlgn','alamat',"lgnid='"+opener.$Pcs2("#mlgnid").val()+"'")
     
////
htt=''
paw=1
pak=35
mstop=false
mtootal=0
for (att=1;att<5;att++)
{
if (mstop){break;}     
     htt=htt+'<table border=0 cellspacing=0 width=96%>'
     htt=htt+'<tr><td><font size=5>"METRO BIKE SHOP"</font></td><td align=right><font size=6>FAKTUR PENJUALAN</font></td></tr>'
     htt=htt+'<tr><td><font size=2>Jl. Putra Yudha 01 Sukun Malang Telp. 0341 327056</font></td><td align=right><font size=3>Tanggal : '+opener.$Pcs2("#mtgl").val()+'</font></td></tr>'
     htt=htt+'<tr><td>&nbsp;</td><td align=right>&nbsp;</td></tr>'
     htt=htt+'<tr><td><b><font size=5>Kepada : '+opener.$Pcs2("#mlgnnama").val()+'</font></td><td align=right>&nbsp;</td></tr>'
     htt=htt+'<tr><td><b><font size=3>'+mpel.alamat+'</font></td><td align=right> Faktur No.: '+opener.$Pcs2("#mnid").val()+'</td></tr>'
     htt=htt+'</table>'     
     htt=htt+'<hr width=96% color=white>'     
     htt=htt+"<table border=1 cellspacing=0 width=96% '>"
     htt=htt+'<tr><th>SATUAN</th><th>&nbsp;V&nbsp;</th><th>NAMA BARANG</th><th>HARGA</th><th>SUB TOTAL</th></tr>'

     for (abg=paw;abg<pak+1;abg++)
     {

     if (opener.$Pcs2("#12_"+abg).val()!=undefined && opener.$Pcs2("#12_"+abg).val()!='' )
     {

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

	htt=htt+"<tr><td> <table width=96% border=0 cellspacing=0><tr><td align=right width=30%>"+mq1+'</td><td>&nbsp;'+ms1+"</td><td align=right width=30%>&nbsp;&nbsp;"+mq2+'</td><td>&nbsp;'+ms2+"</td></tr></table> </td><td>&nbsp;</td><td>&nbsp;&nbsp;"+opener.$Pcs2("#13_"+abg).val()+"</td><td align=right>"+tra(toval(opener.$Pcs2("#22_"+abg).val())-toval(opener.$Pcs2("#23_"+abg).val()))+"&nbsp;</td><td align=right>"+opener.$Pcs2("#24_"+abg).val()+"&nbsp;</td></tr>"
	mtootal=mtootal+toval(opener.$Pcs2("#24_"+abg).val())
     }

     else
     {
     mstop=true;
     break;
     }

     }
     
          htt=htt+'</table>'

     htt=htt+"<table border=0 cellspacing=2 width=96% >"
     for (axx=abg;axx<pak+1;axx++)
     {
     htt=htt+'<tr><td>&nbsp;</td></tr>'
     }
     htt=htt+'</table>'
	  
          abb=taptabel("setpromo","*","1=1")
          htt=htt+'<table border=0 cellspacing=0 width=96%>'
          htt=htt+"<tr><td colspan=6><hr></td></tr>"
          htt=htt+"<tr><td>Jatuh Tempo : "+opener.$Pcs2("#mjt").val()+"</td><td colspan=3 align=right><b><font size=5><b>Jumlah Total&nbsp;&nbsp; s.d. Hal "+att+" </td><td align=right><font size=5><b>"+tra(mtootal)+"</td></tr>"
          htt=htt+"<tr><td colspan=6><hr></td></tr>"
          htt=htt+'</table>'
          htt=htt+'<table border=0 cellspacing=0 width=96%>'
          htt=htt+"<tr><td width=60% valign=top><div id='kotak'> Note:<br> - "+abb.promo13+" <br> - "+abb.promo14+" <br> - "+abb.promo15+" <br> - "+abb.promo16+" <br> - "+abb.promo17+" </div></td><td valign=top align=center>Yang menerima,<br><br><br><br><br><br>_______________<br>Ttd & Stempel</td><td valign=top align=center>Yang menyerahkan,<br><br><br><br><br><br>_______________</td></tr>"
          htt=htt+'</table><br><br>'

////
paw=axx
pak=axx+35
}

	  $Pcs2('#spanisi').html(htt)

    $Pcs2('#kotak').css({
   'border-color':'black',
   'border-style':'solid',
   'border-width':'2px',
   'height':'150px',
   })
   $Pcs2("#kotak").corner()

   window.print();
   window.close();
   opener.focus();

     })

    </script>
    <script type="text/javascript">
function loadform()
{
window.print();
window.close();
opener.focus();
}
</script>
<title>
</title>
</head>
<body bgcolor=#FFFFFF style='font-family:Draft 5cpi'>
<span id='spanisi' width='96%'></span>

</body>
</html>


