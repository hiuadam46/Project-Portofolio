<?php

require("utama.php");

$abc=substr($mnid,0,2);

if ($abc=='TK')
{

execute("delete from transkasir2 where nid=''");

execute("delete from bkbesar where nid='$mnid'");

$moo1=execute("select * from transkasir1 where nid='$mnid'");

$mnid=$moo1[nid];
$mtgl=$moo1[tgl];
$mtotal=$moo1[total];
$mbayar=$moo1[bayar];
$mkembali=$moo1[kembali];
$mjumlah=$moo1[jumlah];
$mlgnid=$moo1[lgnid];
$mkartu=strtoupper($moo1[kartu]);
$medc=$moo1[edc];

$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,kredit,trans,ket) "	;
$msqql2="values('30010','','','$mtgl','$mnid','$mjumlah','TRANSKASIR','Penjualan Kasir')";
execute($msqql1.$msqql2);
			
if ($mlgnid!='' and $mkembali<0)
{

			$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,trans,ket) "	;
			$msqql2="values('10210','$mlgnid','','$mtgl','$mnid',abs($mkembali),'TRANSKASIR','Penjualan Kasir')";
			execute($msqql1.$msqql2);

			$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,trans,ket) "	;
			$msqql2="values('10010','','','$mtgl','$mnid','$mbayar','TRANSKASIR','Penjualan Kasir')";
			execute($msqql1.$msqql2);

}
else
{

			$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,trans,ket) "	;
			$msqql2="values('10010','','','$mtgl','$mnid',($mbayar-$mkembali),'TRANSKASIR','Penjualan Kasir')";
			execute($msqql1.$msqql2);


}

if ($medc<>0)
{
	$rek = '10120';
	if($mkartu == 'BCA'){
		$rek = '10120';
	}else if($mkartu == 'MANDIRI'){
		$rek = '10110';
	}else if($mkartu == 'MUAMALAT'){
		$rek = '10130';
	}
			$msqql1="insert into bkbesar(rekid ,bpid,bpid2,tgl,nid,debet,trans,ket) "	;
			$msqql2="values('$rek','$mkartu','','$mtgl','$mnid',$medc,'TRANSKASIR','EDC')";
			execute($msqql1.$msqql2);
}
			
$moo2=executerow("select * from transkasir2 where nid='$mnid'");
$mtot=0;

while($meer=mysql_fetch_assoc($moo2))
{

$mstoid=$meer[stoid];
$mqty=$meer[qty];
$misi=$meer[isi];
$mtotqty=$mqty*$misi;
$mjmlhrg=$meer[jmlhrg];

if ($mtotqty>0)
{
	$mjm=savstok('L001',$mstoid,$mnid,$mtgl,0,0,0,$mtotqty,'TRANSKASIR',"Penjualan Kasir");
}
			
if ($mtotqty<0)
{
	$mjm=savstok('L001',$mstoid,$mnid,$mtgl,0,0,(-1*$mtotqty),0,'TRANSKASIR',"Penjualan Kasir");
}
			
$mtot=$mtot+$mjm;

}

$msql3="insert into bkbesar(rekid,tgl,nid,debet,trans,ket) select '31010',tgl,nid,sum(kredit-debet),trans,ket from bkbesar where rekid='10310' and nid='$mnid'";
execute($msql3);

}

if ($abc=='TB')
{

echo "Pembelian";

execute("update transbeli1 set total=(select sum(jmlhrg) from transbeli2 where transbeli2.nid=transbeli1.nid) where nid like '$mnid%' ");

execute("update transbeli1 set jumlah=total-tunai+ongkos where nid like '$mnid%' ");

execute("update transbeli2 set isi=(select isi from setstok where setstok.stoid=transbeli2.stoid) where nid like '$mnid%' ");

execute("update transbeli2 set totqty=(qty*isi)+(extra*isi)+unit+extraunit where nid like '$mnid%' ");

execute("delete from bkbesar where trans='TRANSBELI' and nid like '$mnid%' ");

$msqql1="insert into bkbesar(rekid  ,bpid  ,bpid2  ,tgl ,nid ,qtyin ,debet  ,trans         ,ket) " ;
$msqql2="            select '10310' ,a.stoid ,b.lokid,a.tgl ,a.nid ,a.totqty    ,a.jmlhrg,'TRANSBELI'  ,'Pembelian'   from transbeli2 a left join transbeli1 b on a.nid=b.nid where a.nid like '$mnid%' ";
execute($msqql1.$msqql2);

$msqql1="insert into bkbesar(rekid ,bpid  ,tgl,nid,kredit,trans       ,ket              ) "	;
$msqql2=" 	      select '20010',supid ,tgl,nid,total-tunai+ongkos,'TRANSBELI','Pembelian' from transbeli1 where nid like '$mnid%' ";
execute($msqql1.$msqql2);

$msqql1="insert into bkbesar(rekid   ,tgl,nid,kredit,trans       ,ket              ) "	;
$msqql2=" 	      select '10010' ,tgl,nid,tunai,'TRANSBELI','Pembelian' from transbeli1 where nid like '$mnid%' ";
execute($msqql1.$msqql2);

$msqql1="insert into bkbesar(rekid   ,tgl,nid,debet,trans       ,ket              ) "	;
$msqql2=" 	      select '40020' ,tgl,nid,ongkos,'TRANSBELI','Pembelian' from transbeli1 where nid like '$mnid%' ";
execute($msqql1.$msqql2);

}
			

?>