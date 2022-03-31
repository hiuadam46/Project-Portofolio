<html>
<head>
<title>Print Barcode</title>
<link rel="stylesheet" href="main.css" type="text/css" />
<script src="js/jquery-1.3.2.min.js"></script>
<script src="js/jquery.corner.js"></script>
<script src="js/myfunc.js"></script>
<script>
    var $Pcs2 = jQuery.noConflict();

$Pcs2(document).ready(function(){
   $Pcs2(".divdiv").corner("15px")
   buatnota()
   printer()
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
	self.print();
	self.close();
	opener.focus();
}

function buatnota()
{
	abc=opener
	mjadd="<table>"		
	mjadd=mjadd+'<tr height=0><td colspan=2>No.'+abc.$Pcs2("#mnid").val()+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. '+abc.$Pcs2("#mtgl").val()+'</td></tr>'
	mjadd=mjadd+'<tr height=0><td colspan=2>Pel.'+abc.$Pcs2("#mlgnid").val()+' '+abc.$Pcs2("#mlgnnama").val()+'</td></tr>'
	mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'			
	mjadd=mjadd+'<table width=100% cellspacing=0 cellpadding=0 border=0>'
			for (gg=1;gg<101;gg++)
			{
			
			mstoid=abc.$Pcs2("#stoid_"+gg).val()
			mqty=abc.$Pcs2("#15_"+gg).val()
			mqty=mqty.replace('.00','')
			
			mjmlhrg=abc.$Pcs2("#18_"+gg).val()
			mhrgsat=abc.$Pcs2("#16_"+gg).val()

			mhrgsat=tra(toval(mjmlhrg)/toval(mqty))
			
			mstonama=abc.$Pcs2("#13_"+gg).val()
			msatuan=abc.$Pcs2("#14_"+gg).val()
			
			mjumlahcc=padl(mqty+" X "+padl(tra(toval(mjmlhrg)/toval(mqty))+' '+msatuan,' ',10)+" = "+padl(mjmlhrg,' ',11),' ',40)

			mjumlahcc=mjumlahcc.replace('.00','')
			
			if (mstoid==undefined || mstoid=='')
			{
			break;
			}
			
				mjadd=mjadd+'<tr height=0><td colspan=6>'+mstonama+'</td></tr>'
				mjadd=mjadd+'<tr height=0><td align=right>'+padl(mqty,'&nbsp;',6)+'</td> <td>&nbsp;'+padl(msatuan,'&nbsp;',5)+'</td><td>X</td> <td>'+padl(mhrgsat,'&nbsp;',9)+'</td><td>=</td><td align=right width=10%>'+padl(mjmlhrg,'&nbsp;',12)+'</td></tr>'
			
			}
			mjadd=mjadd+'</table>'
			
			mjadd=mjadd+'<table cellpadding=0 cellspacing=0 border=0 width=100%>'
			mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'
			mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL  </td><td align=right width=10%>'+padl(abc.$Pcs2("#mtotal").val(),' ',11)+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDC </td><td align=right>'+padl(abc.$Pcs2("#medc").val(),' ',11)+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BAYAR  </td><td align=right width=10%>'+padl(abc.$Pcs2("#mbayar").val(),' ',11)+'</td></tr>'

			//if (abc.$Pcs2("#mkembali").val()>=0)
			//{
			mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KEMBALI</td><td align=right width=10%>'+padl(abc.$Pcs2("#mkembali").val(),' ',11)+'</td></tr>'
			//}
			//else
			//{
			//mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BON</td><td align=right width=10%>'+padl(abc.$Pcs2("#mkembali").val(),' ',11)+'</td></tr>'
			//}
			
			mkett=taptabel("setpromo","*","1=1")
	
			if (mkett.promo1!='' && mkett.promo1!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Promo Hari Ini:'
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo1+'</td></tr>'
			}
			if (mkett.promo2!='' && mkett.promo2!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo2+'</td></tr>'
			}
			if (mkett.promo3!='' && mkett.promo3!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo3+'</td></tr>'
			}
			if (mkett.promo4!='' && mkett.promo4!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo4+'</td></tr>'
			}
			if (mkett.promo5!='' && mkett.promo5!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo5+'</td></tr>'
			}
			if (mkett.promo6!='' && mkett.promo6!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo6+'</td></tr>'
			}
			if (mkett.promo7!='' && mkett.promo7!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo7+'</td></tr>'
			}
			if (mkett.promo8!='' && mkett.promo8!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo8+'</td></tr>'
			}
			if (mkett.promo9!='' && mkett.promo9!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo9+'</td></tr>'
			}
			if (mkett.promo10!='' && mkett.promo10!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo10+'</td></tr>'
			}
			if (mkett.promo11!='' && mkett.promo11!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo11+'</td></tr>'
			}
			if (mkett.promo12!='' && mkett.promo12!=undefined)	
			{
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo12+'</td></tr>'
			}
			mjadd=mjadd+'<tr height=0><td colspan=2 align=left>&nbsp;</td></tr>'			
			mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Terima Kasih'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Kami tunggu kedatangan anda kembali'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2>'+'&nbsp;'
			mjadd=mjadd+'<tr height=0><td colspan=2>'+'========================================'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'GUDANG BALI JAYA '+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Blitar'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Telp. 0342-801048'+'</td></tr>'
			mjadd=mjadd+'<tr height=0><td colspan=2>'+'========================================'+'</td></tr>'
			mjadd=mjadd+'</table>'
			
			$Pcs2("#divbar").html(mjadd)
}


</script>
<title>
</title>
</head>
<body bgcolor=#FFFFFF onload='loadform()'>
<div id='divbar'></div>
</body>
</html>


