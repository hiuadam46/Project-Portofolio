<?php

$func=$_POST['func'];
$funcg=$_GET['funcg'];

if ($func=='LOGIN1')
{
$links=mysql_connect('localhost','esae1797_admin','+FeBJfl6&G]u') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('esae1797_pancurmas',$links);
$mStrSql="select * from user where id='$_POST[id]'";
$result = mysql_query ($mStrSql,$links) or die ("Kesalahan pada perintah $mStrSql");
$row=mysql_fetch_assoc($result);
echo $row[nama];
return;
}

if ($func=='LOGIN2')
{
$links=mysql_connect('localhost','esae1797_admin','+FeBJfl6&G]u') or die ("Database tidak dapat dihubungkan!");
mysql_select_db('esae1797_pancurmas',$links);
$mStrSql="select * from user where id='$_POST[id]' and password='$_POST[password]' ";
$result = mysql_query ($mStrSql,$links) or die ("Kesalahan pada perintah $mStrSql");
$row=mysql_fetch_assoc($result);
if ($row[password]=='')
{session_start();$_SESSION['MASUK']='GAGAAAL';$_SESSION['MAPA']='GAGAAAL';}
else
{session_start();$_SESSION['MASUK']=$_POST[id];$_SESSION['MAPA']=$_POST[password];$_SESSION['MANA']=$row[nama];}

echo $row[nama];
return;
}

if ($func=='EXECUTETAB')
{
require("utama.php");
$mpd=$mtab[password];
$sql = "$_POST[comm]";
$mtab=execute($sql);
echo json_encode($mtab);
return;
}

if ($func=='EXECUTE')
{
require("utama.php");
$mpd=$mtab[password];
$sql = "$_POST[comm]";
$mtab=executerow($sql);
echo $mtab;
return;
}

if ($func=='EXEC')
{
require("utama.php");
$mpd=$mtab[password];
$sql = "select $_POST[field] from $_POST[tabel] where $_POST[kondisi]";
$mtab=execute($sql);
echo json_encode($mtab);
return;
}

if ($func=='EXECTAB')
{
require("utama.php");
$sql = "select $_POST[field] from $_POST[tabel] where $_POST[kondisi]";
$result = executerow($sql);
$data = array();
$idx = 0;
$idx2 = 0;
while($row = mysql_fetch_array($result)) {
            $data[$idx++] = $row;
}
print json_encode($data);
return;
}
	
if ($funcg=='JAMDINDING')
{
   date_default_timezone_set("Asia/Jakarta");
   $jam = date("d-M-Y H:i:s"); 
   echo "$jam WIB";
   return;
}  

if ($func=='misqrt')
{
require("utama.php");
$mpd=$mtab[password];
$sql = "delete from setstok where stoid='$_POST[mstoid]'";
$mtab=executerow($sql);
echo $mtab;
return;
}  

if ($func=='TRAxx')
{
   $hasils=number_format(floatval($cnumberxx),0,'.',',');
   echo $hasils;
   return;
}  

if ($func=='simta')
{
$msql="select COLUMN_NAME kolom,DATA_TYPE tipe from information_schema.COLUMNS 
where TABLE_SCHEMA and TABLE_NAME='$tabl'";
$mrww=executerow($msql);
$mi1="insert into $mtabl values(";
while ($row=mysql_fetch_assoc($mrww))
{
	$mko=$row[kolom];
	$mti=$row[tipe];
	$mi1=$mi1+"'m$mko'";
}

return;
}  



?>
