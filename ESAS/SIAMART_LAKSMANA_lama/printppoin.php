<html>

<head>
<title>Print Poin</title>
<!-- <link rel="stylesheet" href="main.css" type="text/css" /> -->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script src="js/myfunc.js" type="text/javascript"></script>
<script type="text/javascript">
var $Pcs2 = jQuery.noConflict();
$Pcs2(document).ready(function()
{
	buatnota();
	printer();
})
</script>
<script type="text/javascript">
function printer()
{
	self.print();
	self.close();
	opener.focus();
}

function buatnota()
{
	abc=opener;
	mjadd='<table>';
	mjadd=mjadd+'<tr height=0><td colspan=2>No.'+abc.$Pcs2("#mnid").val()+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tgl. '+abc.$Pcs2("#mtgl").val()+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2>Pel.'+abc.$Pcs2("#mlgnid").val()+' '+abc.$Pcs2("#mlgnnama").val()+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'+'</td></tr>';
	
	mjadd=mjadd+'</table>';
	mjadd=mjadd+'<table cellpadding=0 cellspacing=0 border=0>';
	
	mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Poin </td><td align=right width=10%>'+padl(abc.$Pcs2("#mjumlah").val(),' ',11)+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Poin ditukar </td><td align=right width=10%>'+padl(abc.$Pcs2("#mtukar").val(),' ',11)+'</td></tr>';
	
	mjadd=mjadd+'<tr height=0><td colspan=1>'+'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SALDO POIN </td><td align=right width=10%>'+Math.floor(padl(abc.$Pcs2("#msisa").val(),' ',11))+'</td></tr>';
	
	mkett=taptabel('setpromo', '*', '1=1');
	
	if (mkett.promo1!='' && mkett.promo1!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'+'</td></tr>';
		mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Promo Hari Ini:'+'</td></tr>';
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo1+'</td></tr>';
	}
	if (mkett.promo2!='' && mkett.promo2!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo2+'</td></tr>';
	}
	if (mkett.promo3!='' && mkett.promo3!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo3+'</td></tr>';
	}
	if (mkett.promo4!='' && mkett.promo4!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo4+'</td></tr>';
	}
	if (mkett.promo5!='' && mkett.promo5!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo5+'</td></tr>';
	}
	if (mkett.promo6!='' && mkett.promo6!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo6+'</td></tr>';
	}
	if (mkett.promo7!='' && mkett.promo7!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo7+'</td></tr>';
	}
	if (mkett.promo8!='' && mkett.promo8!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo8+'</td></tr>';
	}
	if (mkett.promo9!='' && mkett.promo9!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo9+'</td></tr>';
	}
	if (mkett.promo10!='' && mkett.promo10!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo10+'</td></tr>';
	}
	if (mkett.promo11!='' && mkett.promo11!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo11+'</td></tr>';
	}
	if (mkett.promo12!='' && mkett.promo12!=undefined)
	{
		mjadd=mjadd+'<tr height=0><td colspan=2 align=left>-'+mkett.promo12+'</td></tr>';
	}
	mjadd=mjadd+'<tr height=0><td colspan=2 align=left>&nbsp;</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Terima Kasih'+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Kami tunggu kedatangan anda kembali'+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2>'+'----------------------------------------'+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2>'+'&nbsp;'+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2>'+'========================================'+'</td></tr>';
	mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'TOKO LAKSMANA JAYA'+'</td></tr>'
	mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Jl.Raya Pasar Ngentak Gandusari'+'</td></tr>'
	mjadd=mjadd+'<tr height=0><td colspan=2 align=center>'+'Telp 08125971291, 081252416388'+'</td></tr>'
	mjadd=mjadd+'<tr height=0><td colspan=6 align=center>'+'081556746930'+'</td></tr>'
	mjadd=mjadd+'<tr height=0><td colspan=2>'+'========================================'+'</td></tr>';
	mjadd=mjadd+'</table>'
	
	$Pcs2("#divbar").html(mjadd);
}
</script>
</head>

<body onload="" style="background-color: #FFFFFF">

<div id="divbar">
</div>

</body>

</html>
