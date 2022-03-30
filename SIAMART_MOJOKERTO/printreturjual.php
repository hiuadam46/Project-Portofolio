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

     htt=htt+"<table border=0 cellspacing=0 width='1220px'>"  
     htt=htt+'<tr><td><font size=3>"PUTRA MAJAPAHIT"</font></td><td align=right><font size=3>FAKTUR RETUR PENJUALAN</font></td></tr>'
     htt=htt+'<tr><td><font size=2>Jln Raya No 312 C Babat Lamongan</font></td><td align=right><font size=3>Tanggal : '+opener.$Pcs2("#mtgl").val()+'</font></td></tr>'
     htt=htt+'<tr><td>&nbsp;</td><td align=right>&nbsp;</td></tr>'
     htt=htt+'<tr><td><b><font size=3>Kepada : '+opener.$Pcs2("#mlgnnama").val()+'</font></td><td align=left>&nbsp;</td></tr>'
     htt=htt+'<tr><td><b><font size=3>'+mpel.alamat+'</font></td><td align=right><font size=3>  Faktur No.: '+opener.$Pcs2("#mnid").val()+'</font></td></tr>'
     htt=htt+'<tr><td><b><font size=3>               </font></td><td align=right><font size=3>Dipotong No.: '+opener.$Pcs2("#mjualid").val()+'</font></td></tr>'
     htt=htt+'<tr><td><b><font size=3>               </font></td><td align=right><font size=3>Tgl.: '+opener.$Pcs2("#mjualtgl").val()+'</font></td></tr>'
     htt=htt+'<tr><td><b><font size=3>               </font></td><td align=right><font size=3>Sales: '+opener.$Pcs2("#mkarnama").val()+'</font></td></tr>'
     htt=htt+'</table>'     
     htt=htt+'<hr width=93% color=white>'     
     htt=htt+"<table border=0 cellspacing=0 width='1220'>"
     htt=htt+'<tr><th colspan=7><hr></th></tr>'
     htt=htt+"<tr><th width='120px'>SATUAN</th><th width='140px'>&nbsp;-&nbsp;</th><th width='300px' align=left>NAMA BARANG</th><th width='100px' align=center>HARGA</th><th width='105px' align=right>&emsp;&emsp;SUB TOTAL</th></tr>"
     htt=htt+'<tr><th colspan=7><hr></th></tr></table>'

paw=1
pak=1000
mstop=false
mtootal=0
for (att=1;att<20;att++)
{
if (mstop){break;}     
     htt=htt+'<table border=0 cellspacing=0 width=1220px>'

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

	//htt=htt+"<tr><td> <table width='200px' border=1 cellspacing=0><tr><td align=right width='50px'>"+mq1+'</td><td>&nbsp;'+ms1+"</td><td align=right width='50px'>&nbsp;&nbsp;"+mq2+'</td><td>&nbsp;'+ms2+"</td></tr></table> </td><td>&nbsp;</td><td width='150px'>&nbsp;&nbsp;"+opener.$Pcs2("#13_"+abg).val()+"</td><td align=right>"+tra(toval(opener.$Pcs2("#18_"+abg).val())-toval(opener.$Pcs2("#19_"+abg).val()))+"&nbsp;</td><td align=right>"+opener.$Pcs2("#20_"+abg).val()+"&nbsp;</td></tr>" -->
     
     htt=htt+"<tr><td align=right width='10px'>"+mq1+"</td><td width='10px'>&nbsp;"+ms1+"</td><td align=right width='40px'>&nbsp;&nbsp;"+mq2+"</td><td width='100px'>&nbsp;"+ms2+"</td><td width='170px'>&nbsp;</td><td width='400px'>&nbsp;&nbsp;"+opener.$Pcs2("#13_"+abg).val()+"</td><td align=right width='100px'>"+tra(toval(opener.$Pcs2("#18_"+abg).val())-toval(opener.$Pcs2("#19_"+abg).val()))+"&nbsp;</td><td align=right width='180px'>"+opener.$Pcs2("#20_"+abg).val()+"&nbsp;</td></tr>"
	mtootal=mtootal+toval(opener.$Pcs2("#20_"+abg).val())
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
          htt=htt+"<table border=0 cellspacing=0 width='1220px'>"
          htt=htt+"<tr><td colspan=6><hr></td></tr>"
          htt=htt+"<tr><td>   </td><td colspan=3 align=right><b><font size=3><b>Jumlah &nbsp;&nbsp; </td><td align=right><font size=3><b>"+tra(mtootal)+"</td></tr>"
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
<title>
</title>
</head>
<body bgcolor=#FFFFFF style='font-family:Draft 5cpi'>
<span id='spanisi' width='93%'></span>

</body>
</html>


