<?php

require("utama.php");

set_time_limit(0);

$arr=executerow("select * from transkasir1");

while ( $ttt=mysql_fetch_object($arr) )
{

$mnid=$ttt->nid;


execute("delete from bkbesar where nid='$mnid' and trans='TRANSJUAL' ");

$moo1=execute("select * from transjual1 where nid='$mnid'");

$mnid=$moo1->nid;
$mtgl=$moo1->tgl;
$mtotal=$moo1->total;
$mtunai=$moo1->tunai;
$mjumlah=$moo1->jumlah;
$mlgnid=$moo1->lgnid;
$mlokid=$moo1->lokid;

$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,trans,ket) "	;
$msqql2="values('30010','','','$mtgl','$mnid','$mtotal','TRANSJUAL','Penjualan')";
execute($msqql1.$msqql2);
			

			$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,trans,ket) "	;
			$msqql2="values('10210','$mlgnid','','$mtgl','$mnid','$mjumlah','TRANSJUAL','Penjualan')";
			execute($msqql1.$msqql2);

			$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,trans,ket) "	;
			$msqql2="values('10010','','','$mtgl','$mnid','$mtunai','TRANSJUAL','Penjualan')";
			execute($msqql1.$msqql2);


$moo2=executerow("select * from transjual2 where nid='$mnid' order by nomor");
$mtot=0;

while($meer=mysql_fetch_object($moo2))
{

$mstoid=$meer->stoid;
$mqty=$meer->qty;
$munit=$meer->unit;
$misi=$meer->isi;
$mtotqty=($mqty*$misi)+$munit;
$mjmlhrg=$meer->jmlhrg;
$mlokid='L001';

$mjm=savstok($mlokid,$mstoid,$mnid,$mtgl,0,0,0,$mtotqty,'TRANSJUAL',"Penjualan");
 			
$mtot=$mtot+$mjm;

}

$msql3="insert into bkbesar(rekid,tgl,nid,debet,trans,ket) select '31010',tgl,nid,sum(kredit-debet),trans,ket from bkbesar where rekid='10310' and nid='$mnid'";
execute($msql3);

}


?>