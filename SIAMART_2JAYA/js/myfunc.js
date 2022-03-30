document.write('<link rel=”SHORTCUT ICON” href=”images/keranjang1.png”>')

self.history.replaceState('Object', 'Title', '/SISTEM_INFORMASI_AKUNTANSI_DAGANG_DAN_INDUSTRI');
var mws=screen.width

function lookgrup(nama)
{
	mcomm="Select concat(grpid, '-', grpnama) Grup from setgrp where true"
	mordd="grpid"
	mffff=" concat(grpid, grpnama) "

	$Pcs2("#framehrg").attr('src', 'genlookup.php?mobj='+nama)
	$Pcs2("#kotakdialog2").dialog('option', 'title', 'Lookup Grup');
	$Pcs2("#kotakdialog2").dialog('open');
	$Pcs2("#kotakdialog2").click();
	$Pcs2("#framehrg").contentWindow.focus();
}

function jam()
{

var waktu = new Date();
var jam = waktu.getHours();
var menit = waktu.getMinutes();
var detik = waktu.getSeconds();
if (jam < 10){
jam = '0' + jam;
}
if (menit < 10){
menit = '0' + menit;
}
if (detik < 10){
detik = '0' + detik;
}
mjj = jam + ':' + menit + ':' + detik;

return mjj

}

function printdos(kataa)
{

	$Pcs2.ajax({
	type : 'POST',
	url:"kasir.php",
	chace :true,
	async : false,
	data : "mdata="+kataa,
	success : function(data){
	}})

}

function bulatkanrp(mbil)
{
mbils=mbil.toString()
amb=right(mbils,2)
pul=toval(amb)
jadi=mbil
if (pul>0)
{
jadi=mbil-pul+100
}
return jadi
}

function right(kata,mdi)
{
pann=kata.length
mjad=kata.substr(pann-mdi,mdi)
return mjad
}

function savstofifo(mlokid, mstoid, mnid, mtgl, mhrgin, mhrgout, mqtyin, mqtyout, mtrans, mket)
{
	mpr="mlokid="+mlokid+"&mstoid="+mstoid+"&mnid="+mnid+"&mtgl="+mtgl+"&mhrgin="+mhrgin+"&mhrgout="+mhrgout+"&mqtyin="+mqtyin+"&mqtyout="+mqtyout+"&mtrans="+mtrans+"&mket="+mket

	mdu=0
	$Pcs2.ajax(
	{
		type:"POST",
		url:"phpexec2.php",
		cache :true,
		data: "mTransaksixx=savstofifo&"+mpr,
		async:   false,
		cache :true,
		success : function(data)
		{
			mdu=data
		}
	});
	return mdu
}

function baliktanggal(mttgl)
{
mh=mttgl.substr(0,2);
mb=mttgl.substr(3,2);
mt=mttgl.substr(6,4);
mjadi=mt+'-'+mb+'-'+mh;
return mjadi
}

function baliktanggal2(mttgl)
{
mt=mttgl.substr(0,4);
mb=padl(mttgl.substr(5,2),'0',2);
mh=padl(mttgl.substr(8,2),'0',2);
mjadi=mh+'-'+mb+'-'+mt;
return mjadi
}

function bulu(mangk)
{
mhas=mangk;
pba=Math.round(mangk);
//pbb=pba.length-2
//pbc=pba.substring(pbb,20)
//if (pbc!=0)
//{
//mhas=(pba-pbc)+100
//}
mhas=pba
return mhas
}

function padl(mdata,mtambah,mbanyak)
{
  var pan=mdata.length;
  var hasil=mdata;
  var mkurang=mbanyak-pan;  
  for (var e = 0; e < mkurang; e++) {
		hasil=mtambah+hasil
  }
  return hasil
}

function getPrevElement(field) {
  var fieldFound = false;
  var form = field.form;
  for (var e = form.elements.length; e > 0; e--) {
    if (fieldFound && form.elements[e].type != 'hidden')
      break;
    if (field == form.elements[e])
      fieldFound = true;
  }
  mgg=form.elements[e % form.elements.length];
  disa=mgg.disabled;
  msisi=mgg.value
  jhh=$Pcs2("#"+mgg.id).attr('readonly')

  if (disa || msisi=='F5c' || msisi=='F6c')
  {
  mgg=getPrevElement(mgg)
  }
  return mgg;
}

function getNextElement(field) {
  var fieldFound = false;
  var form = field.form;
  for (var e = 0; e < form.elements.length; e++) {
    if (fieldFound && form.elements[e].type != 'hidden')
      break;
    if (field == form.elements[e])
      fieldFound = true;
  }
  mgg=form.elements[e % form.elements.length];

  if (mgg.id=='')
  {mgg=getNextElement2(mgg)}
 
  disa=mgg.disabled;
  msisi=mgg.value

  jhh=$Pcs2("#"+mgg.id).attr('readonly')

  if (disa || msisi=='ccF5' || msisi=='ccF6')
  {
  mgg=getNextElement(mgg)
  }
  return mgg;
}

function getPrevElement2(field) {
  var fieldFound = false;
  var form = field.form;
  for (var e = form.elements.length; e > 0; e--) {
    if (fieldFound && form.elements[e].type != 'hidden')
      break;
    if (field == form.elements[e])
      fieldFound = true;
  }
  mgg=form.elements[e % form.elements.length];
  disa=mgg.disabled;
  msisi=mgg.value
  jhh=$Pcs2("#"+mgg.id).attr('readonly')

  if (disa || msisi=='F5c' || msisi=='F6c' || jhh)
  {
  mgg=getPrevElement2(mgg)
  }
  return mgg;
}

function getNextElement2(field) {
  var fieldFound = false;
  var form = field.form;
  for (var e = 0; e < form.elements.length; e++) {
    if (fieldFound && form.elements[e].type != 'hidden')
      break;
    if (field == form.elements[e])
      fieldFound = true;
  }
  mgg=form.elements[e % form.elements.length];
  disa=mgg.disabled;
  msisi=mgg.value

  if (mgg.id=='')
  {mgg=getNextElement2(mgg)}

  jhh=$Pcs2("#"+mgg.id).attr('readonly')

  if (disa || msisi=='ccF5' || msisi=='ccF6' || jhh)
  {
  mgg=getNextElement2(mgg)
  }
  return mgg;
}

function tabOnEnter (field, evt) {

	var keyCode = document.layers ? evt.which : document.all ? 
	evt.keyCode : evt.keyCode;
	switch(keyCode) {
	case 13:

	//if(field.type=='select-one')
	//{alert(this.selected)}
	if (field.type!='button' && field.type!='select-one')
	{
    getNextElement(field).focus();
    getNextElement(field).select();
	//field.style.border='2px solid grey';
    //getNextElement(field).style.border='2px solid red';
    return false;
	}
	break;
	
	
	case 37:
    //getPrevElement(field).focus();
    //getPrevElement(field).select();
    //return false;
	break;

	case 38:
	if (field.type!='select-one')
	{
    getPrevElement(field).focus();
    getPrevElement(field).select();

	//field.style.border='2px solid grey';
    //getPrevElement(field).style.border='3px solid red';
	}
    return false;
	break;

	case 39:
    //getNextElement(field).focus();
    //getNextElement(field).select();
    //return false;
	break;

	case 40:
	if (field.type!='select-one')
	{
    getNextElement(field).focus();
    getNextElement(field).select();
	//field.style.border='2px solid grey';
    //getNextElement(field).style.border='3px solid red';
	}
    return false;
	break;
	
}

//  if (keyCode == 13)
//    return true;
//  else {
//    getNextElement(field).focus();
//    getNextElement(field).select();
return false;
//  }

}

function tabOnEnter2 (field, evt) {

	var keyCode = document.layers ? evt.which : document.all ? 
	evt.keyCode : evt.keyCode;
	switch(keyCode) {
	case 13:

	//if(field.type=='select-one')
	//{alert(this.selected)}
	if (field.type!='button' && field.type!='select-one')
	{

	getNextElement2(field).focus();
	getNextElement2(field).select();
	//field.style.border='2px solid grey';
    //getNextElement(field).style.border='2px solid red';
    return false;
	}
	break;
	
	
	case 37:
    //getPrevElement(field).focus();
    //getPrevElement(field).select();
    //return false;
	break;

	case 38:
	if (field.type!='select-one')
	{
    getPrevElement2(field).focus();
    getPrevElement2(field).select();

	//field.style.border='2px solid grey';
    //getPrevElement(field).style.border='3px solid red';
	}
    return false;
	break;

	case 39:
    //getNextElement(field).focus();
    //getNextElement(field).select();
    //return false;
	break;

	case 40:
	if (field.type!='select-one')
	{
    getNextElement2(field).focus();
    getNextElement2(field).select();
	//field.style.border='2px solid grey';
    //getNextElement(field).style.border='3px solid red';
	}
    return false;
	break;

}

//  if (keyCode == 13)
//    return true;
//  else {
//    getNextElement(field).focus();
//    getNextElement(field).select();
return false;
//  }

}

function execajaxa(mperintah)
{
var mpr=mperintah;
mdu=0
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
data: "func=EXECUTE&comm="+mpr,
chace :true,
async:   true,
success : function(data){
if (data==1){mdu=1}
else
{alert(data)}
}});
return mdu
}

function execajaxas(mperintah)
{
var mpr=mperintah;
mdu=0
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
data: "func=EXECUTE&comm="+mpr,
async:   false,
chace :true,
success : function(data){
if (data==1){mdu=1}
}});
return mdu
}


function taptabel(mtabel,mfield,mkondisi)
{
mjadi="func=EXEC&field="+mfield+"&tabel="+mtabel+"&kondisi="+mkondisi;
mdat='';
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
dataType:'json',
async: false,
chace :true,
data : mjadi,
success : function(data){
mdat=data
}});
return mdat
}

function taptabel2(mperintah)
{
var mpr=mperintah;
alert(mperintah)
mdat='';
$Pcs2.ajax({
type:"POST",
url:"phpexec.php",
chace :true,
dataType:'json',
async: false,
data: "func=EXECUTE&comm=("+mpr+")",
success : function(data){
alert(data)
mdat=data
}});
return mdat
}

function execajaxs(mperintah,mret)
{
var mpr=mperintah
mdu=0
$Pcs2.ajax({
type:"POST",
url:"phpexec2.php",
chace :true,
data: mpr,
async:   false,
success : function(data){
if (data.trim()!='')
{
if (mret!=false)
{
alert(data);
}
}
mdu=data;
}});
return mdu
}

function execajaxsa(mperintah)
{
var mpr=mperintah
mdu=0
$Pcs2.ajax({
type:"POST",
chace :true,
url:"phpexec2.php",
data: mpr,
async:   true,
success : function(data){
if (data.trim()!='')
{
alert(data);
}
mdu=data;
}});
}

function transaksi(msercom)
{
muu=1;
$Pcs2.ajax({
type:"POST",
url:"phpexec2.php",
chace :true,
data: msercom,
async:   false,
success : function(data){
if (data!='')
{
alert(data);
}
}});
}

function cekangka(field, evt) 
{
mdd=field.value.trim()
if (mdd=='0'){return '0';}
if (mdd==''){return '0';}
var keyCode = document.layers ? evt.which : document.all ? 
evt.keyCode : evt.keyCode;
//window.alert(keyCode);
if (keyCode==9){return;}
if (keyCode==39){return;}
if (keyCode==38){return;}
if (keyCode==40){return;}
if (keyCode==37){return;}

	var pan=field.value.length;
	var tt=field.value.trim();
	var kat=field.value;
if ((keyCode<=47 || keyCode>=58) && (keyCode<=95 || keyCode>=106) && keyCode!=8 && keyCode!=188 && keyCode!=13)
{
	var kat=tt.substring(0,pan-1);
}
	var poskoma=field.value.indexOf(".");
	komanya='';
	if (poskoma>=1)
	{
	field.value=kat;
	return;
	}

	var jadi=kat;
	var tanpa=kat.replace(',','');
	var tanpa=tanpa.replace(',','');
	var tanpa=tanpa.replace(',','');
	var tanpa=tanpa.replace(',','');
	var tanpa=tanpa.replace(',','');
	var tanpa=tanpa.replace(',','');
	var tanpa=tanpa.replace(',','');
	var tanpa=tanpa.replace(',','');
	var pan=tanpa.length;
	if (pan<4)
	{
		field.value=tanpa;
		return;
	}
	if (pan>=4 && pan<<7)
	{
	kesatu=tanpa.substring(pan,pan-3);
	seterus=tanpa.substring(0,pan-3);
	jadi=seterus+','+kesatu;
	}
	if (pan>=7 && pan<<10)
	{
	kesatu=tanpa.substring(pan,pan-3);
	kedua=tanpa.substring(pan-3,pan-6);
	seterus=tanpa.substring(0,pan-6);
	jadi=seterus+','+kedua+','+kesatu;
	}
	if (pan>=10 && pan<<13)
	{
	kesatu=tanpa.substring(pan,pan-3);
	kedua=tanpa.substring(pan-3,pan-6);
	ketiga=tanpa.substring(pan-6,pan-9);
	seterus=tanpa.substring(0,pan-9);
	jadi=seterus+','+ketiga+','+kedua+','+kesatu;
	}
	if (pan>=13 && pan<<16)
	{
	kesatu=tanpa.substring(pan,pan-3);
	kedua=tanpa.substring(pan-3,pan-6);
	ketiga=tanpa.substring(pan-6,pan-9);
	keempat=tanpa.substring(pan-9,pan-12);	
	seterus=tanpa.substring(0,pan-12);
	jadi=seterus+','+keempat+','+ketiga+','+kedua+','+kesatu;
	}
	field.value=jadi;
	evt.stop();

field.focus();
}

function toval(maa)
{
maa=maa.toString()
if (maa==''){return 0;}
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
maa=parseFloat(maa);
return maa;
}

function toval2(maa)
{
maa=maa.toString()
if (maa==''){return 0;}
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
var maa=maa.replace(',',"");
maa=parseFloat(maa);
return maa;
}

function tra(nNumber)
{


mpos=''
if (nNumber<0)
{mpos='-'}

var cFormat="###,###,###,###,###,###"
var cNumber=nNumber.toString();

maa=cNumber.indexOf(".")
if (maa>0) return cNumber;

cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");
cNumber=cNumber.replace(',',"");

var cHasil=""
var aa=cFormat.length;
var bb=cNumber.length;
var cc=aa-bb+1;
var i=cFormat.length;
while (i>=0)
{
	if (i-cc>=0)
	{
	var cStr=cFormat.substr(i,1);
	if (cStr=='#')
	{
	var cStrtambah=cNumber.substr(i-cc,1)
	}
	else 
	{
	var cStrtambah=cStr;
	cc=cc-1;
	}
	if ( !(cStrtambah=='0' || cStrtambah=='1' || cStrtambah=='2' || cStrtambah=='3' || cStrtambah=='4' || cStrtambah=='5' || cStrtambah=='6' || cStrtambah=='7' || cStrtambah=='8' || cStrtambah=='9' || cStrtambah==','  || cStrtambah=='-'))
	{cStrtambah='';}
	cHasil=cStrtambah+cHasil;
	}
	i=i-1;
}
cHasil=mpos+cHasil
cHasil=cHasil.replace('--',"-");
cHasil=cHasil.replace('-,',"-");

return cHasil;

}

function tglsekarang()
{
	var waktu=new Date();
	hari=padl(waktu.getDate()+'','0',2);
	bulan=padl(waktu.getMonth()+1+'','0',2);
	tahun=waktu.getFullYear()+'';
	jadi=hari+'-'+bulan+'-'+tahun
	return jadi;
}

function totgl(mcrr)
{
	lght=mcrr.length
	madd=mcrr.substr(lght-1,1)+''
	if (!(madd=='0' || madd=='1' || madd=='2' || madd=='3' || madd=='4' || madd=='5' || madd=='6' || madd=='7' || madd=='8' || madd=='9'))
	{
		jadi=mcrr.substr(0,lght-1);
		return jadi;
	}
	jadi=mcrr
	if(lght==1){return jadi;}
	if(lght==2){
	jadi=jadi+'-'
	return jadi;
	}
	if(lght==4){
	jadi=mcrr;
	return jadi;
	}
	if(lght==5){
	jadi=jadi+'-'
	return jadi;
	}
	if(lght==6){
	jadi=mcrr;
	return jadi;
	}
	if(lght==7){
	jadi=mcrr;
	return jadi;
	}
	if(lght==8){
	jadi=mcrr;
	return jadi;
	}
	if(lght==9){
	jadi=mcrr;
	return jadi;
	}
	if(lght==10){
	jadi=mcrr;
	return jadi;
	}

	if (lght>10)
	{
	jadi=mcrr.substr(0,10)
	return jadi;
	}
}

function jamsekarang()
{
	var waktu=new Date();
	jadi=waktu.getHours()+':'+padl(waktu.getMinutes()+'','0',2)+':'+padl(waktu.getSeconds()+'','0',2);
	return jadi
}

function inputtable(cTable,thegrid,tambahnya1,tambahnya2,kurangnya,kosongnya)
{
	var mjadi="insert into "+cTable+"("+tambahnya1
	//alert(mjadi)
	if (kosongnya==undefined){kosongnya=''}		
	
    for (var i = 0; i < thegrid.columnModel.length; i++) {		
		mfield=thegrid.columnModel[i].id
		nada=kurangnya.indexOf(mfield)
		if (nada<0)
		{
		mjadi=mjadi+mfield+","
		}	
	}
	mlg=mjadi.length
	mjadi=mjadi.substr(0,mlg-1)+") values "
	
    for (var i2 = 0; i2 < thegrid.rows.length; i2++) {

	misinya="("+tambahnya2

    for (var i = 0; i < thegrid.columnModel.length; i++) {

		mfield=thegrid.columnModel[i].id
		mtipe=thegrid.columnModel[i].type

		nada=kurangnya.indexOf(mfield)
		nada2=kosongnya.indexOf(mfield)

		if (nada<0)
		{
		misiss=thegrid.rows[i2][i]

		if (mtipe=='number' && ! (nada2>0 && (misiss==0 || misiss=='0' || misiss=='' )) )
		{
		if (misiss==''){misiss='0';}
		misinya=misinya+toval(misiss)+','
		}

		if (mtipe=='date' && ! (nada2>0 && (misiss=='0000-00-00' || misiss.trim()==''  || misiss=='00-00-0000' )) )
		{ 
		//alert(mtipe)
		misinya=misinya+"str_to_date('"+misiss+"', '%d-%c-%Y'),"	
		}
		
		if ((mtipe=='text' || mtipe=='string') && ! (nada2>0 && misiss.trim()=='') )
		{
		misinya=misinya+"'"+misiss+"',"	
		}
		
		}
	
	}
		mlg=misinya.length
		misinya=misinya.substr(0,mlg-1)+")"

		mjadinya=mjadi+misinya
		execajaxa(mjadinya);
		//alert(mjadinya)
	}
}

function sumthegrid(mgridnya,mf1)
{
	var mjuml=0;
	mco1=mgridnya.getIndexOf(mf1);
	for (var ix2 = 0; ix2 < mgridnya.rows.length; ix2++) 
	{
			minil=mgridnya.rows [ix2][mco1]
			if (minil!=null)
			{
			mjuml=mjuml+parseInt(toval(minil))
			}
	}
	return mjuml;
}

function instabel(thegrid,tabelnya,tambahnya1,tambahnya2,kurangnya,yyy)
{
	var mjadi="insert into "+tabelnya+"("+tambahnya1
	//alert(mjadi)
	
    for (var i = 0; i < thegrid.columnModel.length; i++) {		
		mfield=thegrid.columnModel[i].id
		nada=kurangnya.indexOf(mfield)
		if (nada<0)
		{
		mjadi=mjadi+mfield+","
		}	
	}
	mlg=mjadi.length
	mjadi=mjadi.substr(0,mlg-1)+") values "

	misinya=" ("+tambahnya2
	for (var i = 0; i < thegrid.columnModel.length; i++) {

		mfield=thegrid.columnModel[i].id
		mtipe=thegrid.columnModel[i].type

		nada=kurangnya.indexOf(mfield);

		if (nada<0)
		{
		misiss=thegrid.rows[yyy][i]
		
		if (mtipe=='number')
		{
		misinya=misinya+toval(misiss)+','
		}

		if (mtipe=='date')
		{ 
		misinya=misinya+"str_to_date('"+misiss+"', '%d-%c-%Y'),"	
		}
		
		if (mtipe=='text' || mtipe=='string')
		{
		misinya=misinya+"'"+misiss+"',"	
		}
		
		}
	
	}
		mlg=misinya.length
		misinya=misinya.substr(0,mlg-1)+")"

		mjadinya=mjadi+misinya
		return mjadinya
}

function todate(strdate)
{
	mday=parseInt(strdate.substr(0,2))
	mmon=parseInt(strdate.substr(3,2))
	myea=parseInt(strdate.substr(6,4))
	mtgl=new Date(myea,mmon,mday)
	return mtgl
	
}

function simpandoc(mfi,mtab)
{

$Pcs2.ajax({
type:"POST",
url:"phpexec.php?func=simta&tabl="+mtab+mfi,
dataType:'json',
chace :true,
async: true,
data : mjadi,
success : function(data){
	
}});

}
