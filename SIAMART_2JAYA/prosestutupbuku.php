<?php
set_time_limit(0);
require("utama.php");

$mtrans='TTPBK';

$query8=executerow('select tgl from periode');
$mper=mysql_fetch_assoc ($query8);

$mtgl=$mper[tgl];

if ($mtgl<'2013-01-01')
{
	$mtgl=date("Y-m-01");
	$mtgl=date("Y-m-d",strtotime("$mtgl -1 month") );
	execute("update periode set tgl='$mtgl'");
}

$mtgla=$mtgl;
echo $mtgla;

$mtgl=date( "Y-m-d", strtotime( "$mtgl +1 month" ) );
echo $mtgl;

$mblth=date("mY",strtotime( "$mtgl"));
echo $mblth;
$mdatabase='siamart_2jaya_data';
$mdatabase2=$mdatabase.'_'.$mblth;

/***/
$dst="d:/xampp/mysql/data/$mdatabase2/" ;
@mkdir($dst);
$src="d:/xampp/mysql/data/$mdatabase/" ;
$dir = opendir($src);
@mkdir($dst); 
while(false !== ( $file = readdir($dir)) )
{
	echo $file;
	echo "
	<br>
	";
	if (( $file != '.' ) && ( $file != '..' ))
	{
		if ( is_dir($src . '/' . $file) )
		{
			$aaa=1;
			//@recurse_copy($src . '/' . $file,$dst . '/' . $file);
		}
		else
		{
			copy($src . '/' . $file,$dst . '/' . $file);
		}
	}
}
closedir($dir); 

/***/

$msql="SELECT TABLE_NAME NAMA,TABLE_SCHEMA DATAB 
FROM information_schema.TABLES WHERE TABLE_SCHEMA ='$mdatabase' and 
(TABLE_NAME like 'trans%') and TABLE_NAME<>'transnomor'
";

$mee=executerow($msql);
while ($mperr=mysql_fetch_object($mee))
{
	$mnaman=$mperr->NAMA;
	$mdatab=$mperr->DATAB;
	execute("delete from ".$mdatab.".".$mnaman." where tgl<'$mtgl'");
	echo("delete from ".$mdatab.".".$mnaman." where tgl<'$mtgl'");
}

execute("delete from bkbesar where tgl<'$mtgl' or ( tgl='$mtgl' and trans='SA')");

execute("
insert into bkbesar (rekid,nid,tgl,bpid,bpid2,qtyin,debet,trans,ket)
select a.rekid,'TUTUPBUKU',date_add('$mtgl',INTERVAL -1 DAY),bpid,bpid2,sum(qtyin-qtyout),sum(debet-kredit),'SA','Tutup Buku' from $mdatabase2.bkbesar a where tgl<'$mtgl' and rekid not in ('10210','20010') group by a.rekid,bpid,bpid2
");

/***Hutang Dagang*/

execute("
insert into bkbesar (rekid,nid,tgl,bpid,bpid2,kredit,trans,ket)
select '20010',nid,tgl,a.bpid,'',a.kredit-ifnull(b.debet,0),'SA',ket
from $mdatabase2.bkbesar a 
left join (select bpid,nid2,sum(debet) debet from $mdatabase2.bkbesar where rekid='20010' and tgl<'$mtgl' and debet>0 group by bpid,nid2) b on a.nid=b.nid2 and a.bpid=b.bpid
where a.tgl<'$mtgl' and rekid='20010' and a.kredit>0 and 
a.kredit-ifnull(b.debet,0)>0
");

/***Piutang Dagang*/

execute("
insert into bkbesar (rekid,nid,tgl,bpid,bpid2,debet,trans,ket)
select '10210',nid,tgl,a.bpid,'',a.debet-ifnull(b.kredit,0),'SA',ket
from $mdatabase2.bkbesar a 
left join (select bpid,nid2,sum(kredit) kredit from $mdatabase2.bkbesar where rekid='10210' and tgl<'$mtgl' and kredit>0 group by bpid,nid2) b on a.nid=b.nid2 and a.bpid=b.bpid
where a.tgl<'$mtgl' and rekid='10210' and a.debet>0 and 
a.debet-ifnull(b.kredit,0)>0
");

execute("update periode set tgl='$mtgl'");

echo "<script type='text/javascript'> alert('Tutup Buku selesai, Periode Sekarang ".date('d-M-Y',strtotime($mtgl))." '); parent.close() </script>";

return;
?>