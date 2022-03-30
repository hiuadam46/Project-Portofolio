<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
    <title>Print</title>
    <?php
    require("utama.php");
    ?>
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

     mpel=taptabel('setlgn','alamat,tempo,telp,telp2',"lgnid='"+opener.$Pcs2("#mlgnid").val()+"'")
     
htt=''
paw=1
pak=100
mstop=false
mtootal=0
mtotaldiscper=0
mtotaldiscrp=0
mtotaldisc=0
gtotal=0
mjmlhrg=0
for (att=1;att<5;att++)
{
if (mstop){break;}     
     htt=htt+'<table border=0 cellspacing=0 width=1220px>'
     htt=htt+'<th width=30%> </th><th width=30%> </th><th width=30%></th>'
     htt=htt+'<tr><td align=left><b><font size=2>CV. SUMBER TANI MANDIRI</font></td><td></td><td></td></tr>'     
     htt=htt+'<tr><td align=left><font size=2>Jl Jombang Dpn Zipur Nob5 Babat </font></td><td></td><td></td></tr>'
     htt=htt+'<tr><td align=left colspan=3><font size=2>Telp 082233228865, 081234234424 </font></td></tr>'
	 htt=htt+'<tr><td align=left colspan=3><font size=2>. </font></td></tr>'
     htt=htt+'<tr><td></td><td align=center><b><font size=3><u>FAKTUR PENJUALAN</u></font></td><td align=right>&nbsp;</td></tr>'
     htt=htt+'</table>'  
     
     htt=htt+'<table border=0 cellspacing=0 width=1220px>'

     htt=htt+'<tr><td width=5% style="<?php echo borders(1,0,1,0,1) ?>;">Pelanggan </td>'
     htt=htt+'<td width=35% colspan=2 style="<?php echo borders(0,1,1,0,1) ?>;">:&nbsp;'+opener.$Pcs2("#mlgnnama").val() +'</td>'
     htt=htt+'<td width=16%></td>'
     htt=htt+'<td width=10% style="<?php echo borders(1,0,1,0,1) ?>;">No-Invoice </td>'
     htt=htt+'<td width=30% colspan=20 style="<?php echo borders(0,1,1,0,1) ?>;">:&nbsp;'+opener.$Pcs2("#mnid").val() +'</td>'
     htt=htt+'</tr>'

     htt=htt+'<tr><td width=5% style="<?php echo borders(1,0,0,0,1) ?>;">Alamat </td>'
     htt=htt+'<td width=35% colspan=2 style="<?php echo borders(0,1,0,0,1) ?>;"><font size=2>:&nbsp;'+mpel.alamat +'</font></td>'
     htt=htt+'<td width=16%></td>'
     htt=htt+'<td width=10% style="<?php echo borders(1,0,0,0,1) ?>;">Tgl-Invoice </td>'
     htt=htt+'<td width=30% colspan=2 style="<?php echo borders(0,1,0,0,1) ?>;">:&nbsp;'+opener.$Pcs2("#mtgl").val() +'</td>'
     htt=htt+'</tr>'

     htt=htt+'<tr><td width=5% style="<?php echo borders(1,0,0,0,1) ?>;">Kota </td>'
     htt=htt+'<td width=35% colspan=2 style="<?php echo borders(0,1,0,0,1) ?>;">:&nbsp; '+mpel.telp2 +' </td>'
     htt=htt+'<td width=16%></td>'
     htt=htt+'<td width=10% style="<?php echo borders(1,0,0,0,1) ?>;">Jatuh Tempo </td>'
     htt=htt+'<td width=30% colspan=2 style="<?php echo borders(0,1,0,0,1) ?>;">:&nbsp;'+opener.$Pcs2("#mjt").val()+'</td>'
     htt=htt+'</tr>'

     htt=htt+'<tr><td width=5% style="<?php echo borders(1,0,0,0,1) ?>;">Id </td>'
     htt=htt+'<td width=35% colspan=2 style="<?php echo borders(0,1,0,0,1) ?>;">:&nbsp;'+ opener.$Pcs2("#mlgnid").val() +'</td>'
     htt=htt+'<td width=16%></td>'
     htt=htt+'<td width=10% style="<?php echo borders(1,0,0,0,1) ?>;">TOP </td>'
     htt=htt+'<td width=30% colspan=2 style="<?php echo borders(0,1,0,0,1) ?>;">:&nbsp;'+mpel.tempo+'</td></tr>'
     htt=htt+'<tr><td width=5% style="<?php echo borders(1,0,0,1,1) ?>;">Telpon </td>'
     htt=htt+'<td width=35% colspan=2 style="<?php echo borders(0,1,0,1,1) ?>;">:&nbsp;'+ mpel.telp +'</td>'
     htt=htt+'<td width=16%></td>'
     htt=htt+'<td width=10% style="<?php echo borders(1,0,0,1,1) ?>;">Salesman </td>'
     htt=htt+'<td width=30% colspan=2 style="<?php echo borders(0,1,0,1,1) ?>;">:&nbsp;'+opener.$Pcs2("#mkarnama").val()+'</td></tr></table> <br>'
     htt=htt+"<table border=0 cellspacing=2px padding=0 cellpadding=2px width=1220px>"
     htt=htt+'<tr><th width=49px style="<?php echo borders(1,0,1,1,2) ?>;">&nbsp;&nbsp;&nbsp;NO</th>'
     htt=htt+'<th width=87px align=left style="<?php echo borders(1,0,1,1,2) ?>;">KODE </th>'
     htt=htt+'<th width=586px align=left style="<?php echo borders(1,0,1,1,2) ?>;">&nbsp;&nbsp;DESCRIPTION</th>'
     htt=htt+'<th width=100px style="<?php echo borders(1,0,1,1,2) ?>;">HARGA&nbsp;&nbsp;</th>'
     htt=htt+'<th width=100px style="<?php echo borders(1,0,1,1,2) ?>;">Quantity</th>'
     htt=htt+'<th width=63px style="<?php echo borders(1,0,1,1,2) ?>;">DISC %</th>'
     htt=htt+'<th width=63px style="<?php echo borders(1,0,1,1,2) ?>;">DISC Rp.</th>'
     htt=htt+'<th width=125px style="<?php echo borders(1,1,1,1,2) ?>;">&nbsp;JUMLAH (Rp)</th></tr>'
     for (abg=paw;abg<pak+1;abg++)
     {
          if (opener.$Pcs2("#12_"+abg).val()!=undefined && opener.$Pcs2("#12_"+abg).val()!='' )
          {
               mqty1=toval(opener.$Pcs2("#14_"+abg).val())
               unitqty1 = opener.$Pcs2("#15_"+abg).val()
               mqty2= toval(opener.$Pcs2("#16_"+abg).val())
               unitqty2= opener.$Pcs2("#17_"+abg).val()
               fmstrqty=strmqty(mqty1,unitqty1,mqty2,unitqty2)
               mstonama=opener.$Pcs2("#13_"+abg).val()
               mstonama=mstonama.replace("(PPN)","")
               mstonama=mstonama.replace("(Non PPN)","")
               mstoid=opener.$Pcs2("#12_"+abg).val()
               rsetstoid=taptabel("setstok","barcode","stoid='" +mstoid+"'")
               mjmlhrg = toval(opener.$Pcs2("#24_"+abg).val())
               htt=htt+'<tr height=15px><td align=center style="<?php echo borders(1,0,0,0,2) ?>;">'+ abg 
               htt=htt+'</td><td style="<?php echo borders(1,0,0,0,2) ?>;">'+opener.$Pcs2("#12_"+abg).val() +"</td>"
               htt=htt+'<td style="<?php echo borders(1,0,0,0,2) ?>;"><font size=3>'+mstonama+"</font></td>"
               htt=htt+'<td align=right style="<?php echo borders(1,0,0,0,2) ?>;">'+opener.$Pcs2("#22_"+abg).val() + "</td>"
               
               htt=htt+'<td align=right style="<?php echo borders(1,0,0,0,2) ?>;">' + strmqty(mqty1,unitqty1,mqty2,unitqty2)  +"&nbsp;&nbsp;&nbsp;"
               //htt=htt+'<table border=0px cellpadding=0px cellpadding=0px width=35px align="left">'
               //htt=htt+'<td align="left" width=15px>&nbsp;&nbsp;'+resetQty(mqty1,unitqty1,1)+'</td>'
               //htt=htt+'<td align="right" width=15px>&nbsp;&nbsp;'+resetQty(mqty1,unitqty1,2)+'</td></table>'
               //htt=htt+'<table border=0px cellpadding=0px cellpadding=0px width=35px align="right">'
               //htt=htt+'<td align="left" width=15px>'+resetQty(mqty2,unitqty2,1)+'</td>'
               //htt=htt+'<td align="right" width=15px>'+resetQty(mqty2,unitqty2,2)+'</td></table>'
               htt=htt+'</td>'
               htt=htt+'<td align=center style="<?php echo borders(1,0,0,0,2) ?>;">'+opener.$Pcs2("#23_"+abg).val()
               htt=htt+'</td><td align=center style="<?php echo borders(1,0,0,0,2) ?>;">'+opener.$Pcs2("#diskrp_"+abg).val()
               htt=htt+'</td><td align=right style="<?php echo borders(1,1,0,0,2) ?>;">'+ tra(mjmlhrg) +"&nbsp;</td></tr>"                              
               mtootal=mtootal+mjmlhrg                      
          }
          else
          {
               mstop=true;
               break;
          }
     }

     for (axx=abg;axx<pak;axx++)
     {
		 if (mstop){break;}
          htt=htt+'<tr><td align=center style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;'
          htt=htt+'</td><td style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;</td><td style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;</td><td align=right style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;</td><td align=center style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;&nbsp;</td><td align=center style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;&nbsp;</td><td align=center style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;&nbsp;</td><td align=right style="<?php echo borders(1,1,0,0,2) ?>;">&nbsp;</td></tr>'
     }
     htt=htt+'<tr><td colspan=8  style="<?php echo borders(1,1,0,1,2) ?>;"></td></tr>'
     htt=htt+'<tr><td colspan=7  style="<?php echo borders(1,0,0,1,2) ?>;">&nbsp;&nbsp;</td>'
     htt=htt+'<td align=right style="<?php echo borders(1,1,0,1,2) ?>;">'+format(mtootal)+'&nbsp;</td></tr>'
     //mtotaldisc=mtotaldiscper+mtotaldiscrp
     mtotaldisc=toval(opener.$Pcs2("#mdiskon").val())
     gtotal = mtootal-mtotaldisc
     htt=htt+'<tr><td colspan=3 style="<?php echo borders(1,1,0,0,2) ?>;">&nbsp;Note :&nbsp;'+ opener.$Pcs2("#mket").val() +'&nbsp;&nbsp;&nbsp;&nbsp;</td>'
     htt=htt+'<td></td><td></td><td colspan=2 style="<?php echo borders(1,0,0,0,2) ?>;">&nbsp;Potongan&nbsp;</td>'
     htt=htt+'<td align=right style="<?php echo borders(1,1,0,1,2) ?>;">'+format(mtotaldisc)+'&nbsp;</td></tr>'

     htt=htt+'<tr><td colspan=3 style="<?php echo borders(1,1,0,1,2) ?>;">&nbsp;&nbsp;</td>'
     htt=htt+'<td></td><td></td><td colspan=2 style="<?php echo borders(1,0,1,1,2) ?>;">&nbsp;TOTAL &nbsp;</td>'
     htt=htt+'<td align=right style="<?php echo borders(1,1,0,1,2) ?>;">'+format(gtotal)+'&nbsp;</td></tr>'
     htt=htt+'</table>' 
     htt=htt+'<table border=0 cellspacing=0 width=1220px>'
     htt=htt+"<tr><td width=14% align=center>Penerima</td>"
     htt=htt+"<td width=14% align=center>Pengirim</td>"
     htt=htt+"<td width=14% align=center>Supervisor</td>"
     htt=htt+"<td width=14% align=center>Sales</td>"
     htt=htt+"<td  align=center>&nbsp;&nbsp;</td>"
     htt=htt+"<td width=14% align=center>Ka. Gudang</td>"
     htt=htt+"<td width=14% align=center>Adm.Penjualan</td></tr></table>"

     htt=htt+"<table border=0 cellspacing=0 width=1220px>"
     htt=htt+"<br><tr><td align=left width=7%>(</td><td align=right width=7%>)</td>"
     htt=htt+"<td align=left width=7%>(</td><td align=right width=7%>)</td>"
     htt=htt+"<td align=left width=7%>&emsp;&emsp;(</td><td align=right width=7%>)</td>"
     htt=htt+"<td align=left width=7%>&emsp;(</td><td align=right width=7%>)</td>"
     htt=htt+"<td  align=center>&emsp;&emsp;&emsp;&emsp;</td>"
     htt=htt+"<td align=left width=7%>&emsp;&emsp;(</td><td align=right width=7%>)</td>"
     htt=htt+"<td align=left width=7%>(</td><td align=right width=7%>)</td>"


     //htt=htt+"<tr><td><br><br><br><br><br><br><br></td>"
    // htt=htt+"<tr><td><br></td>"
     //htt=htt+"<td valign=top align=center><br><br><br><br><br><br><br></td></tr>"
     //htt=htt+"<td valign=top align=center><br><br></td></tr>"
     //htt=htt+'</table><br>'

     paw=axx
     pak=axx+7
}
     $Pcs2('#spanisi').html(htt)
    //$Pcs2("#kotak").corner()

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
function format(x) {
    return isNaN(x)?"":x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function resetQty(mnqty,munt,x)
{
     str_ret=""
     if(mnqty==0)
     {str_ret=""}
     else
     {
          if (x==1)
          {str_ret=mnqty}
          else
          {str_ret=munt}
     }

     return str_ret
}
function strmqty(mqty1,munitqty,munit1,munitunit)
{
     strqty = ""
     if(mqty1!=0)
          {strqty = String(mqty1) + "&nbsp;" + munitqty} 
     if(munit1!=0)
          {
               if(String(mqty1)!=0)
               {
                    strqty = String(mqty1) +  "&nbsp;" +munitqty + "-" + String(munit1)+ "&nbsp;" +munitunit
               }
               else
               {
                    strqty = String(munit1)+ "&nbsp;" +munitunit
               }
          }
     return strqty   
}

</script>
<title>
</title>
</head>
<body bgcolor=#FFFFFF style='font-family:Draft 5cpi'>
<span id='spanisi' width='96%'></span>

</body>
</html>


