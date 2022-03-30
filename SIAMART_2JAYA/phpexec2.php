<?php
require("utama.php");

if ($mTransaksixx=='SETSALSTO')
{
	execute(" delete from bkbesar where bpid='$mstoid' and bpid2='$mlokid' and trans='SA' ");
	execute(" insert into bkbesar(rekid,tgl,nid,bpid,bpid2,qtyin,debet,trans) values ('10310','2012-01-01','SA','$mstoid','$mlokid',$mqty,$mjmlhrg,'SA') ");
	saldomodalawal();

	return;
}

if ($mTransaksixx=='savstofifo')
{
	savstok($mlokid,$mstoid,$mnid,$mtgl,$mhrgin,$mhrgout,$mqtyin,$mqtyout,$mtrans,$mket);
}

if ($mTransaksixx=='comboforproduk')
{
	combobox("select a misi,a mtampil from temporer limit 0,1 union select stoid misi,stonama mtampil from setstok where supid='$msupid'",'mproduk'.$nomor);
}

if ($mTransaksixx=='comboforbrand')
{
	combobox("select a misi,a mtampil from temporer limit 0,1 union select grpid misi,grpnama mtampil from setgrp where supid='$msupid'","mgrpid");
}

if ($mTransaksixx=='comboforsbrand')
{
	combobox("select a misi,a mtampil from temporer limit 0,1 union select merkid misi,merknama mtampil from setmerk where grpid='$mgrpid'","mmerkid");
}

if ($mTransaksixx=='fsstrrr001')
{
	$sqlstr="delete from bkbesar where rekid='$mrekid' and trans='SA'";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Delete Bkbesar Awal!");

	$sqlstr="select * from periode ";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Ambil periode!");
	$row = mysql_fetch_assoc ($result);
	$mtglaw=$row[tgl];

	$sqlstr="select dork from setklas a left join setneraca b on a.clid=b.clid where nrcid='$mnrcid' ";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Ambil Klas! $sqlstr");
	$row = mysql_fetch_assoc ($result);
	$mdork=$row[dork];

	if ($msaldoawal=='')
	{
		$msaldoawal='0';
	}

	if ($mdork=='D')
	{
		if ($msaldoawal>=0)
		{
			$mdebet=$msaldoawal;
			$mkredit=0;
		}
		else
		{
			$mkredit=-$msaldoawal;
			$mdebet=0;
		}
	}

	if ($mdork=='K')
	{
		if ($msaldoawal>=0)
		{
			$mkredit=$msaldoawal;
			$mdebet=0;
		}
		else
		{
			$mdebet=-$msaldoawal;
			$mkredit=0;
		}
	}

	$sqlstr="insert into bkbesar(rekid,bpid,nid,tgl,ket,debet,kredit,qtyin,trans) values('$mrekid','','SA00001','$mtglaw','Saldo Awal',$mdebet,$mkredit,0,'SA')";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Insert Bkbesar Stok! $sqlstr");

	saldomodalawal();
}

if ($mTransaksixx=='ftsrsk021')
{
	$sqlstr="delete from transkasir1 where nid='$mnid'";
	$query91=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query91);
	
	$mkembali=str_replace( '.', '',$mbayar)-str_replace( '.', '',$mtotal);
	$mtgl=substr($mtgl,6,4).'-'.substr($mtgl,3,2).'-'.substr($mtgl,0,2);

	$sqlstr="insert into transkasir1(nid,tgl,jam,total,bayar,kembali,status) values('$mnid','$mtgl','$mjam',$mtotal,$mbayar,$mkembali,2)";
	$sqlstr=str_replace( '.', '',$sqlstr);
	$query99=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query99);
	
	$sqlstr="update bkbesar set tgl='$mtgl' where nid='$mnid'";
	$query103=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query103);
}

if($mTransaksixx=='1f2ik0stk')
{
	$sqlstr="select num from transkasir2 where stoid='$mstoid' and nid='$mnid'";
	$query110=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query110);
	
	$mnm=$maa[num];

	$sqlstr="update transkasir2 set num=num-1 where num>$mnm and nid='$mnid'";
	$query116=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query116);
	
	$sqlstr="delete from transkasir2 where stoid='$mstoid' and nid='$mnid'";
	$query120=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query120);
	
	$sqlstr="delete from bkbesar where bpid='$mstoid' and nid='$mnid'";
	execute($sqlstr);
}

if($mTransaksixx=='fukstkm')
{
	$sqlstr="select * from setstok where stoid='$mstoid' or barcode='$mstoid'";
	$query130=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query130);
	
	$mstoid=$maa[stoid];

	$sqlstr="delete from bkbesar where bpid='$mstoid' and nid='$mnid'";
	$query136=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query136);
	
	$sqlstr="select ifnull(sum(saldoqty),0) as saldoqty from vstokfifo where bpid='$mstoid' limit 0,1";
	$query140=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query140);
	
	$msaldo=($maa[saldoqty]);
	$msaldo2=$msaldo-$mvl;
	if ($msaldo2<0)
	{
		echo("Saldo Tidak Mencukupi ! Saldo $msaldo ");
		return;
	}

	$sqlstr="update transkasir2 set qty=$mvl,jmlhrg=(hrgsat*$mvl) where stoid='$mstoid' and nid='$mnid'";
	execute($sqlstr);
	/*savstok($mstoid,$mnid,$mdebet,$mkredit,$mqtyin,$mqtyout,$mtrans,$mket)*/
	savstok($mstoid,$mnid,0,0,0,$mvl,'TRANSKASIR','Kasir');
}

if($mTransaksixx=='fikstk')
{
	$sqlstr="select * from setstok where stoid='$mstoid' or barcode='$mstoid'";
	$query160=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query160);
	
	$mstoid=$maa[stoid];

	$sqlstr="select ifnull(sum(saldoqty),0) as saldoqty from vstokfifo where bpid='$mstoid' limit 0,1";
	$query166=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query166);
	
	$msaldo=($maa[saldoqty]);
	$msaldo2=$msaldo-1;
	if ($msaldo2<0)
	{
		echo("Saldo Tidak Mencukupi ! Saldo $msaldo");
		return;
	}

	$sqlstr="select * from transkasir2 where stoid='$mstoid' and nid='$mnid'";
	$query178=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query178);
	
	$mnam=$maa[stoid];
	if ($mnam=='')
	{
		$sqlstr="select count(*) as nor from transkasir2 where nid='$mnid'";
		$query185=executerow($sqlstr);
		$maa=mysql_fetch_assoc ($query185);
		
		$mnam=($maa[nor])+1;
		$sqlstr="insert into transkasir2(num,nid,stoid,satuan,qty,hrgsat,jmlhrg) select $mnam,'$mnid',stoid,'Pcs',1,hrgjualc3,hrgjualc3 from setstok where stoid='$mstoid' or barcode='$mstoid' ";
		execute($sqlstr);
	}
	else
	{
		$sqlstr="update transkasir2 set qty=qty+1,jmlhrg=(hrgsat*qty+1) where stoid='$mstoid' and nid='$mnid'";
		execute($sqlstr);
	}

	$sqlstr="select qty from transkasir2 where nid='$mnid' and stoid='$mstoid'";
	$query199=executerow($sqlstr);
	$maa=mysql_fetch_assoc ($query199);
	
	$mqty=($maa[qty]);
	$mqty=$mqty+0;
	/*savstok($mstoid,$mnid,$mdebet,$mkredit,$mqtyin,$mqtyout,$mtrans,$mket)*/
	savstok($mstoid,$mnid,0,0,0,$mqty,'TRANSKASIR','Kasir');
}

if($mTransaksixx=='fsstx001')
{
	$mhrgbeli=str_replace ( ',', '',$mhrgbeli);
	$mhrgjual=str_replace ( ',', '',$mhrgjual);
	$mhrgjual2=str_replace ( ',', '',$mhrgjual2);
	$mhrgjual3=str_replace ( ',', '',$mhrgjual3);
	$mhrgjual4=str_replace ( ',', '',$mhrgjual4);
	$mhrgjual5=str_replace ( ',', '',$mhrgjual5);
	$mhrgjual6=str_replace ( ',', '',$mhrgjual6);
	$mhrgjual7=str_replace ( ',', '',$mhrgjual7);
	$mminimal=str_replace ( ',', '',$mminimal);
	$mminimal2=str_replace ( ',', '',$mminimal2);
	$mminimal3=str_replace ( ',', '',$mminimal3);
	$misi=str_replace ( ',', '',$misi);
	$misi2=str_replace ( ',', '',$misi2);
	if ($misi=='' or $misi=='0')
	{
		$misi=1;
	}
	if ($misi2=='' or $misi2=='0')
	{
		$misi2=1;
	}
	$minimum=0;
	$mhppi=str_replace ( ',', '.',$mhrgbeli);
	$msaldo1=str_replace ( ',', '.',$msaldo1);
	$msaldo2=str_replace ( ',', '.',$msaldo2);
	$msaldo3=str_replace ( ',', '.',$msaldo3);

	$sqlstr="delete from setstok where stoid='$mstoid' ";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Hapus Setstok! $sqlstr");

	$mstonama=addslashes($mstonama);
	$sqlstr="insert into setstok(
	stoid,
	barcode,
	barcode2,
	stonama,
	grpid,
	supid,
	satuan,
	satuan1,
	satuan2,
	hrgbeli,
	hrgjual,
	hrgjual2,
	hrgjual3,
	hrgjual4,
	hrgjual5,
	minimal,
	isi,isi2,aktif
	) 
	values(
	'$mstoid',
	'$mbarcode',
	'$mbarcode2',
	'$mstonama',
	'$mgrpid',
	'$msupid',
	'$msatid',
	'$msatuan1',
	'$msatuan2',
	'$mhrgbeli',
	'$mhrgjual',
	'$mhrgjual2',
	'$mhrgjual3',
	'$mhrgjual4',
	'$mhrgjual5',
	'$mminimal',
	'$misi',
	'$misi2',1
	)";

	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Insert Setstok! $sqlstr");
}

if($mTransaksixx=='fsstx002')
{
	$sqlstr="delete from setstok where stoid='$mstoid' ";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Hapus Setstok! $sqlstr");

	$mrekid='10310';
	$sqlstr="delete from bkbesar where rekid='$mrekid' and bpid='$mstoid' and trans='SA'";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Delete Bkbesar Awal!");

	saldomodalawal();
}

if($mTransaksixx=='tosald00231')
{
	saldomodalawal();
}

function saldomodalawal()
{
	$sqlstr="delete from bkbesar where trans='SA' and (debet+kredit=0 or nid='' or tgl='0000-00-00')";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Delete Bkbesar Awal!");

	$mrekmod='21010';
	$sqlstr="delete from bkbesar where rekid='$mrekmod' and trans='SA'";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Delete Bkbesar Awal!");

	$sqlstr="select * from periode ";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Ambil periode!");
	$row = mysql_fetch_assoc ($result);
	$mtglaw=$row[tgl];

	$sqlstr="select sum(ifnull(debet,000000)-ifnull(kredit,000000)) as saldo from bkbesar where rekid<>'$mrekmod' and trans='SA'";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Hitung Debet Kredit! $sqlstr");
	$row = mysql_fetch_assoc ($result);
	$msaldoaw=$row[saldo];
	if ($msaldoaw<0)
	{
		$mdebet=abs($msaldoaw);
		$mkredit=0;
	}
	else
	{
		$mdebet=0;
		$mkredit=abs($msaldoaw);
	}
	if ($msaldoaw==''){$msaldoaw=0;}
	$sqlstr="insert into bkbesar(rekid,nid,tgl,ket,debet,kredit,trans) values('$mrekmod','SA00001','$mtglaw','Saldo Awal',$mdebet,$mkredit,'SA')";
	$result = mysql_query ($sqlstr) or die ("Kesalahan Pada Hitung Debet Kredit! $sqlstr");
}

if ($mTransaksixx=='jurnalbeli')
{
	$msqql="delete from bkbesar where nid='$mnid' and trans='TRANSBELI'";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,debet ,qtyin ,trans ,ket)
	SELECT 
	'10310',stoid,lokid ,tgl,nid,sum(jmlhrg),sum(coba3+coba4),'TRANSBELI','Pembelian' from
	(select 
	nid,tgl,a.stoid,a.lokid,stonama,hrgsat,jmlhrg,qty,extra,isi,b.isi2,a.satid,b.satuan1,
	if(a.satid=b.satuan1,isi*isi2,1)*
	if(a.satid=b.satuan2,isi2,1)*
	if(a.satid=b.satuan3,1,1)*qty coba3,
	if(a.satid=b.satuan1,isi*isi2,1)*
	if(a.satid=b.satuan2,isi2,1)*
	if(a.satid=b.satuan3,1,1)*extra coba4 
	FROM `transbeli2` a 
	left join setstok b on a.stoid=b.stoid
	where nid='$mnid'
	) a group by nid,tgl,stoid,lokid,stonama
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,kredit ,qtyin ,trans ,ket)
	SELECT 
	if(tunaikredit=1,'20010','10010'),supid,'',tgl,nid,total,0,'TRANSBELI','Pembelian' from transbeli1 where nid='$mnid' and total<>0
	";
	$query365=executerow($msqql);
	$mrow=mysql_fetch_assoc ($query365);
}

if ($mTransaksixx=='jurnalreturbeli')
{
	$msqql="delete from bkbesar where nid='$mnid' and trans='TRANSRETURBELI'";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,kredit ,qtyout ,trans ,ket)
	SELECT 
	'10310',stoid,lokid ,tgl,nid,sum(jmlhrg),sum(coba3+coba4),'TRANSRETURBELI','Retur Pembelian' from
	(select 
	nid,tgl,a.stoid,a.lokid,stonama,hrgsat,jmlhrg,qty,extra,isi,b.isi2,a.satid,b.satuan1,
	if(a.satid=b.satuan1,isi*isi2,1)*
	if(a.satid=b.satuan2,isi2,1)*
	if(a.satid=b.satuan3,1,1)*qty coba3,
	if(a.satid=b.satuan1,isi*isi2,1)*
	if(a.satid=b.satuan2,isi2,1)*
	if(a.satid=b.satuan3,1,1)*extra coba4 
	FROM `transreturbeli2` a 
	left join setstok b on a.stoid=b.stoid
	where nid='$mnid'
	) a group by nid,tgl,stoid,lokid,stonama
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,nid2,debet ,qtyout ,trans ,ket)
	SELECT 
	'20010',supid,'',tgl,nid,nid2,total,0,'TRANSRETURBELI','Retur Pembelian' from transreturbeli1 where nid='$mnid' and total<>0
	";
	$query400=executerow($msqql);
	$mrow=mysql_fetch_assoc ($query400);
}

if ($mTransaksixx=='jurnaljual')
{
	savstok($mlokid,$mstoid,$mnid,$mtgl,0,0,0,$mtotqty,"TRANSJUAL",$mket);
}

if ($mTransaksixx=='jurnalmutasi')
{
	savstok($mlokid,$mstoid,$mnid,$mtgl,0,0,0,$mtotqty,"TRANSMUTASI",$mket);
}

if ($mTransaksixx=='jurnallp')
{
	$msqql="delete from bkbesar where nid='$mnid' and trans='LUNASPIUTANG'";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,tgl,nid,kredit,trans,nid2,tgl2,ket)
	SELECT 
	'10210',lgnid,tgl,nid,lunasi,'LUNASPIUTANG',jualid,jualtgl,'Pelunasan piutang' from
	translunaspiutang where nid='$mnid'
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,tgl,nid,debet,trans,ket)
	SELECT
	rekid,lgnid,tgl,nid,bank,'LUNASPIUTANG','Pelunasan piutang' from
	translunaspiutang where nid='$mnid' limit 0,1
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,tgl,nid,debet,trans,ket)
	SELECT
	'10010',lgnid,tgl,nid,kas,'LUNASPIUTANG','Pelunasan piutang' from
	translunaspiutang where nid='$mnid' limit 0,1
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,tgl,nid,debet,trans,nid2,tgl2,ket)
	SELECT 
	'10220',tgl,nid,jumlah,'LUNASPIUTANG',giroid,girotgl,'Pelunasan piutang' from
	transgiro where nid='$mnid'
	";
	execute($msqql);
}

if ($mTransaksixx=='jurnallh')
{
	$msqql="delete from bkbesar where nid='$mnid' and trans='TRANSLUNASHUTANG'";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,tgl,nid,debet,trans,nid2,tgl2,ket)
	SELECT 
	'20010',supid,tgl,nid,lunasi,'TRANSLUNASHUTANG',beliid,belitgl,'Pelunasan hutang' from
	translunashutang where nid='$mnid' and lunasi<>0
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,tgl,nid,kredit,trans,ket)
	SELECT
	rekid,supid,tgl,nid,bank,'TRANSLUNASHUTANG','Pelunasan hutang' from
	translunashutang where nid='$mnid' limit 0,1
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,tgl,nid,kredit,trans,ket)
	SELECT
	'10010',supid,tgl,nid,kas,'TRANSLUNASHUTANG','Pelunasan hutang' from
	translunashutang where nid='$mnid' limit 0,1
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,tgl,nid,kredit,trans,nid2,tgl2,ket)
	SELECT 
	'20110',tgl,nid,jumlah,'TRANSLUNASHUTANG',giroid,girotgl,'Pelunasan hutang' from
	transgiro where nid='$mnid'
	";
	execute($msqql);
}

if ($mTransaksixx=='jurnalreturjual')
{
	$msqql="delete from bkbesar where nid='$mnid' and trans='TRANSRETURJUAL'";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,debet ,qtyin ,trans ,ket)
	SELECT 
	'10310',stoid,lokid ,tgl,nid,sum(jmlhrg),sum(coba3+coba4),'TRANSRETURJUAL','Retur Penjualan' from
	(select 
	nid,tgl,a.stoid,a.lokid,stonama,hrgsat,jmlhrg,qty,extra,a.satid,
	qty*a.isi coba3,
	a.isi*extra coba4
	FROM `TRANSRETURJUAL2` a 
	left join setstok b on a.stoid=b.stoid
	where nid='$mnid'
	) a group by nid,tgl,stoid,lokid,stonama
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,kredit ,qtyout ,trans ,ket)
	SELECT 
	'31010',stoid,lokid ,tgl,nid,sum(jmlhrg),sum(coba3+coba4),'TRANSRETURJUAL','Retur Penjualan' from
	(select 
	nid,tgl,a.stoid,a.lokid,stonama,hrgsat,jmlhrg,qty,extra,a.satid,
	qty*a.isi coba3,
	a.isi*extra coba4
	FROM `TRANSRETURJUAL2` a 
	left join setstok b on a.stoid=b.stoid
	where nid='$mnid'
	) a group by nid,tgl,stoid,lokid,stonama
	";
	execute($msqql);

	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,kredit ,qtyin ,trans ,ket)
	SELECT 
	'10210',lgnid,'',tgl,nid,total,0,'TRANSRETURJUAL','Penjualan' from TRANSRETURJUAL1 where nid='$mnid' and total<>0
	";
	$query541=executerow($msqql);
	$mrow=mysql_fetch_assoc ($query541);
	
	$msqql="
	insert into bkbesar
	(rekid ,bpid ,bpid2 ,tgl,nid,debet ,qtyin ,trans ,ket)
	SELECT 
	'30010',lgnid,'',tgl,nid,total,0,'TRANSRETURJUAL','Penjualan' from TRANSRETURJUAL1 where nid='$mnid' and total<>0
	";
	$query550=executerow($msqql);
	$mrow=mysql_fetch_assoc ($query550);
}

if ($mTransaksixx=='cqtyx')
{
	$maa=cqty3($mtothrg,$mstoid);
	echo $maa;
}

if ($mTransaksixx=='hitungpromo')
{
	$mssql="select tunaikredit from transjual1 where nid='$mnid'";
	$query563=executerow($mssql);
	$mr11=mysql_fetch_assoc ($query563);
	
	/////////////// HITUNG DISKON PROMO

	$mssql="select a.* from setdiskonpromo a where a.promoid in (select promoid from transjual2 where nid='$mnid')";
	$mr=executerow($mssql);

	while ($row=mysql_fetch_assoc($mr))
	{
		$mpromoid=$row[promoid];
		$mkqty=$row[mkqty];
		$msyarat=$row[msyarat];

		//echo($mpromoid);

		if ($mkqty==2)
		{
			/// yang total stok
			//echo("lulus1");

			$mssql="select sum(qty*isi) totqty,sum(qty*hrgsat) tothrg from transjual2 where nid='$mnid' and promoid='$mpromoid'";
			$query585=executerow($mssql);
			$mrr=mysql_fetch_assoc ($query585);
			
			if ($msyarat==1) /// yang pakai value
			{
				//echo("lulus2");
				//echo($mrr[tothrg]);

				if ( ($mrr[tothrg]) >= ($row[mv1]) and ($mrr[tothrg]) <= ($row[mv2]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mvk1]." where nid='$mnid' and promoid='$mpromoid'";
					$query596=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query596);
					
					$mssql="update transjual2 set diskonp4=".$row[mvk2]." where nid='$mnid' and promoid='$mpromoid'";
					$query600=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query600);
					
					$mssql="update transjual2 set diskonrp2=".$row[mvk3]." where nid='$mnid' and promoid='$mpromoid'";
					$query604=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query604);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mvt1]." where nid='$mnid' and promoid='$mpromoid'";
						$query610=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query610);
						
						$mssql="update transjual2 set diskonrp2=".($row[mvk3]+$row[mvt2])." where nid='$mnid' and promoid='$mpromoid'";
						$query614=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query614);
					}
				}

				if ( ($mrr[tothrg]) >= ($row[mv3]) and ($mrr[tothrg]) <= ($row[mv4]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mvk4]." where nid='$mnid' and promoid='$mpromoid'";
					$query622=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query622);
					
					$mssql="update transjual2 set diskonp4=".$row[mvk5]." where nid='$mnid' and promoid='$mpromoid'";
					$query626=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query626);
					
					$mssql="update transjual2 set diskonrp2=".$row[mvk6]." where nid='$mnid' and promoid='$mpromoid'";
					$query630=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query630);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mvt3]." where nid='$mnid' and promoid='$mpromoid'";
						$query636=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query636);
						
						$mssql="update transjual2 set diskonrp2=".($row[mvk6]+$row[mvt4])." where nid='$mnid' and promoid='$mpromoid'";
						$query640=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query640);
					}
				}

				if ( ($mrr[tothrg]) >= ($row[mv5]) and ($mrr[tothrg]) <= ($row[mv6]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mvk7]." where nid='$mnid' and promoid='$mpromoid'";
					$query648=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query648);
					
					$mssql="update transjual2 set diskonp4=".$row[mvk8]." where nid='$mnid' and promoid='$mpromoid'";
					$query652=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query652);
					
					$mssql="update transjual2 set diskonrp2=".$row[mvk9]." where nid='$mnid' and promoid='$mpromoid'";
					$query656=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query656);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mvt5]." where nid='$mnid' and promoid='$mpromoid'";
						$query662=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query662);
						
						$mssql="update transjual2 set diskonrp2=".($row[mvk9]+$row[mvt6])." where nid='$mnid' and promoid='$mpromoid'";
						$query666=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query666);
					}
				}

				if ( ($mrr[tothrg]) >= ($row[mv7]) and ($mrr[tothrg]) <= ($row[mv8]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mvk10]." where nid='$mnid' and promoid='$mpromoid'";
					$query674=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query674);
					
					$mssql="update transjual2 set diskonp4=".$row[mvk11]." where nid='$mnid' and promoid='$mpromoid'";
					$query678=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query678);
					
					$mssql="update transjual2 set diskonrp2=".$row[mvk12]." where nid='$mnid' and promoid='$mpromoid'";
					$query682=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query682);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mvt7]." where nid='$mnid' and promoid='$mpromoid'";
						$query688=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query688);
						
						$mssql="update transjual2 set diskonrp2=".($row[mvk12]+$row[mvt8])." where nid='$mnid' and promoid='$mpromoid'";
						$query692=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query692);
					}
				}
			}

			if ($msyarat==2) /// yang pakai qty
			{
				//echo("lulus2");
				//echo($mrr[tothrg]);

				if ( ($mrr[totqty]) >= ($row[mq1]) and ($mrr[totqty]) <= ($row[mq2]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mqk1]." where nid='$mnid' and promoid='$mpromoid'";
					$query706=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query706);
					
					$mssql="update transjual2 set diskonp4=".$row[mqk2]." where nid='$mnid' and promoid='$mpromoid'";
					$query710=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query710);
					
					$mssql="update transjual2 set diskonrp2=".$row[mqk3]." where nid='$mnid' and promoid='$mpromoid'";
					$query714=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query714);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mqt1]." where nid='$mnid' and promoid='$mpromoid'";
						$query720=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query720);
						
						$mssql="update transjual2 set diskonrp2=".($row[mqk3]+$row[mqt2])." where nid='$mnid' and promoid='$mpromoid'";
						$query724=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query724);
					}
				}

				if ( ($mrr[totqty]) >= ($row[mq3]) and ($mrr[totqty]) <= ($row[mq4]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mqk4]." where nid='$mnid' and promoid='$mpromoid'";
					$query732=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query732);
					
					$mssql="update transjual2 set diskonp4=".$row[mqk5]." where nid='$mnid' and promoid='$mpromoid'";
					$query736=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query736);
					
					$mssql="update transjual2 set diskonrp2=".$row[mqk6]." where nid='$mnid' and promoid='$mpromoid'";
					$query740=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query740);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mqt3]." where nid='$mnid' and promoid='$mpromoid'";
						$query746=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query746);
						
						$mssql="update transjual2 set diskonrp2=".($row[mqk6]+$row[mqt4])." where nid='$mnid' and promoid='$mpromoid'";
						$query750=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query750);
					}
				}

				if ( ($mrr[totqty]) >= ($row[mq5]) and ($mrr[totqty]) <= ($row[mq6]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mqk7]." where nid='$mnid' and promoid='$mpromoid'";
					$query758=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query758);
					
					$mssql="update transjual2 set diskonp4=".$row[mqk8]." where nid='$mnid' and promoid='$mpromoid'";
					$query762=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query762);
					
					$mssql="update transjual2 set diskonrp2=".$row[mqk9]." where nid='$mnid' and promoid='$mpromoid'";
					$query766=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query766);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mqt5]." where nid='$mnid' and promoid='$mpromoid'";
						$query772=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query772);
						
						$mssql="update transjual2 set diskonrp2=".($row[mqk9]+$row[mqt6])." where nid='$mnid' and promoid='$mpromoid'";
						$query776=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query776);
					}
				}

				if ( ($mrr[totqty]) >= ($row[mq7]) and ($mrr[totqty]) <= ($row[mq8]))
				{
					$mssql="update transjual2 set diskonp3=".$row[mqk10]." where nid='$mnid' and promoid='$mpromoid'";
					$query784=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query784);
					
					$mssql="update transjual2 set diskonp4=".$row[mqk11]." where nid='$mnid' and promoid='$mpromoid'";
					$query788=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query788);
					
					$mssql="update transjual2 set diskonrp2=".$row[mqk12]." where nid='$mnid' and promoid='$mpromoid'";
					$query792=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query792);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp4=".$row[mqt7]." where nid='$mnid' and promoid='$mpromoid'";
						$query799=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query799);
						
						$mssql="update transjual2 set diskonrp2=".($row[mqk12]+$row[mqt8])." where nid='$mnid' and promoid='$mpromoid'";
						$query802=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query802);
					}
				}
			}
		}
		else
		{
			///yang stoknya satu2
			$mssql="select stoid,sum(qty*isi) totqty,sum(qty*hrgsat) tothrg from transjual2 where nid='$mnid' and promoid='$mpromoid' group by stoid";
			$mrrr=executerow($mssql);
			while ($mrr=mysql_fetch_assoc($mrrr))
			{ //awalputar
				$mstoid=$mrr[stoid];
				if ($msyarat==1) /// yang pakai value
				{
					//echo("lulus2");
					//echo($mrr[tothrg]);

					if ( ($mrr[tothrg]) >= ($row[mv1]) and ($mrr[tothrg]) <= ($row[mv2]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mvk1]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query824=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query824);
						
						$mssql="update transjual2 set diskonp4=".$row[mvk2]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query828=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query828);
						
						$mssql="update transjual2 set diskonrp2=".$row[mvk3]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query832=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query832);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mvt1]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query838=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query838);
							
							$mssql="update transjual2 set diskonrp2=".($row[mvk3]+$row[mvt2])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query842=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query842);
						}
					}

					if ( ($mrr[tothrg]) >= ($row[mv3]) and ($mrr[tothrg]) <= ($row[mv4]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mvk4]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query850=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query850);
						
						$mssql="update transjual2 set diskonp4=".$row[mvk5]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query854=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query854);
						
						$mssql="update transjual2 set diskonrp2=".$row[mvk6]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query858=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query858);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mvt3]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query864=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query864);
							
							$mssql="update transjual2 set diskonrp2=".($row[mvk6]+$row[mvt4])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query868=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query868);
						}
					}

					if ( ($mrr[tothrg]) >= ($row[mv5]) and ($mrr[tothrg]) <= ($row[mv6]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mvk7]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query876=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query876);
						
						$mssql="update transjual2 set diskonp4=".$row[mvk8]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query880=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query880);
						
						$mssql="update transjual2 set diskonrp2=".$row[mvk9]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query884=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query884);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mvt5]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query890=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query890);
							
							$mssql="update transjual2 set diskonrp2=".($row[mvk9]+$row[mvt6])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query894=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query894);
						}
					}

					if ( ($mrr[tothrg]) >= ($row[mv7]) and ($mrr[tothrg]) <= ($row[mv8]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mvk10]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query902=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query902);
						
						$mssql="update transjual2 set diskonp4=".$row[mvk11]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query906=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query906);
						
						$mssql="update transjual2 set diskonrp2=".$row[mvk12]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query910=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query910);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mvt7]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query916=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query916);
							
							$mssql="update transjual2 set diskonrp2=".($row[mvk12]+$row[mvt8])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query920=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query920);
						}
					}
				}

				//yang pakai qty
				if ($msyarat==2) /// yang pakai qty
				{
					//echo("lulus2");
					//echo($mrr[tothrg]);

					if ( ($mrr[totqty]) >= ($row[mq1]) and ($mrr[totqty]) <= ($row[mq2]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mqk1]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query935=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query935);
						
						$mssql="update transjual2 set diskonp4=".$row[mqk2]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query939=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query939);
						
						$mssql="update transjual2 set diskonrp2=".$row[mqk3]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query943=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query943);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mqt1]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query949=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query949);
							
							$mssql="update transjual2 set diskonrp2=".($row[mqk3]+$row[mqt2])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query953=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query953);
						}
					}

					if ( ($mrr[totqty]) >= ($row[mq3]) and ($mrr[totqty]) <= ($row[mq4]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mqk4]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query961=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query961);
						
						$mssql="update transjual2 set diskonp4=".$row[mqk5]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query965=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query965);
						
						$mssql="update transjual2 set diskonrp2=".$row[mqk6]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query969=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query969);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mqt3]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query975=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query975);
							
							$mssql="update transjual2 set diskonrp2=".($row[mqk6]+$row[mqt4])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query979=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query979);
						}
					}

					if ( ($mrr[totqty]) >= ($row[mq5]) and ($mrr[totqty]) <= ($row[mq6]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mqk7]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query987=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query987);
						
						$mssql="update transjual2 set diskonp4=".$row[mqk8]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query991=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query991);
						
						$mssql="update transjual2 set diskonrp2=".$row[mqk9]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query995=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query995);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mqt5]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query1001=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1001);
							
							$mssql="update transjual2 set diskonrp2=".($row[mqk9]+$row[mqt6])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query1005=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1005);
						}
					}

					if ( ($mrr[totqty]) >= ($row[mq7]) and ($mrr[totqty]) <= ($row[mq8]))
					{
						$mssql="update transjual2 set diskonp3=".$row[mqk10]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query1013=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1013);
						
						$mssql="update transjual2 set diskonp4=".$row[mqk11]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query1017=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1017);
						
						$mssql="update transjual2 set diskonrp2=".$row[mqk12]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
						$query1021=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1021);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp4=".$row[mqt7]." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query1027=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1027);
							
							$mssql="update transjual2 set diskonrp2=".($row[mqk12]+$row[mqt8])." where nid='$mnid' and promoid='$mpromoid' and stoid='$mstoid'";
							$query1031=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1031);
						}
					}
				}
				//yang pakai qty
			} //akhirputar
		}
	}

	///////// AKHIR DISKON PROMO

	///////// DISKON REGULER
	$mssql="select a.* from setdiskonpromo a where a.promoid in (select regulerid from transjual2 where nid='$mnid')";
	$mr=executerow($mssql);

	while ($row=mysql_fetch_assoc($mr))
	{
		$mpromoid=$row[promoid];
		$mkqty=$row[mkqty];
		$msyarat=$row[msyarat];
		$msat=$row[msatuan];

		if ($mkqty==2)
		{
			/// yang total stok
			//echo("lulus1");

			if ($msat=='1')
			{
				$mssql="select sum(qty) totqty,sum(qty*hrgsat) tothrg from transjual2 where nid='$mnid' and regulerid='$mpromoid'";
			}
			else
			{
				$mssql="select sum(qty*isi) totqty,sum(qty*hrgsat) tothrg from transjual2 where nid='$mnid' and regulerid='$mpromoid'";
			}
			$query1067=executerow($mssql);
			$mrr=mysql_fetch_assoc ($query1067);
			
			if ($msyarat==1) /// yang pakai value
			{
				//echo("lulus2");
				//echo($mrr[tothrg]);

				if ( ($mrr[tothrg]) >= ($row[mv1]) and ($mrr[tothrg]) <= ($row[mv2]))
				{
					$mssql="update transjual2 set diskonp=".$row[mvk1]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1078=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1078);
					
					$mssql="update transjual2 set diskonp2=".$row[mvk2]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1082=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1082);
					
					$mssql="update transjual2 set diskonrp=".$row[mvk3]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1086=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1086);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mvt1]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1092=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1092);
						
						$mssql="update transjual2 set diskonrp=".($row[mvk3]+$row[mvt2])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1096=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1096);
					}
				}

				if ( ($mrr[tothrg]) >= ($row[mv3]) and ($mrr[tothrg]) <= ($row[mv4]))
				{
					$mssql="update transjual2 set diskonp=".$row[mvk4]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1104=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1104);
					
					$mssql="update transjual2 set diskonp2=".$row[mvk5]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1108=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1108);
					
					$mssql="update transjual2 set diskonrp=".$row[mvk6]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1112=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1112);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mvt3]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1118=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1118);
						
						$mssql="update transjual2 set diskonrp=".($row[mvk6]+$row[mvt4])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1122=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1122);
					}
				}

				if ( ($mrr[tothrg]) >= ($row[mv5]) and ($mrr[tothrg]) <= ($row[mv6]))
				{
					$mssql="update transjual2 set diskonp=".$row[mvk7]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1130=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1130);
					
					$mssql="update transjual2 set diskonp2=".$row[mvk8]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1134=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1134);
					
					$mssql="update transjual2 set diskonrp=".$row[mvk9]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1138=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1138);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mvt5]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1144=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1144);
						
						$mssql="update transjual2 set diskonrp=".($row[mvk9]+$row[mvt6])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1148=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1148);
					}
				}

				if ( ($mrr[tothrg]) >= ($row[mv7]) and ($mrr[tothrg]) <= ($row[mv8]))
				{
					$mssql="update transjual2 set diskonp=".$row[mvk10]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1156=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1156);
					
					$mssql="update transjual2 set diskonp2=".$row[mvk11]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1160=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1160);
					
					$mssql="update transjual2 set diskonrp=".$row[mvk12]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1165=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1165);
					
					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mvt7]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1171=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1171);
						
						$mssql="update transjual2 set diskonrp=".($row[mvk12]+$row[mvt8])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1175=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1175);
					}
				}
			}

			if ($msyarat==2) /// yang pakai qty
			{
				//echo("lulus2");
				//echo($mrr[tothrg]);

				if ( ($mrr[totqty]) >= ($row[mq1]) and ($mrr[totqty]) <= ($row[mq2]))
				{
					$mssql="update transjual2 set diskonp=".$row[mqk1]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1188=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1188);
					
					$mssql="update transjual2 set diskonp2=".$row[mqk2]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1193=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1193);
					
					$mssql="update transjual2 set diskonrp=".$row[mqk3]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1196=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1196);
					
					$mqq=executerow("select * from stokpromo where d1>0 and promoid='$mpromoid' order by stoid");
					while ($roww=mysql_fetch_assoc($mqq))
					{
						$msto=$roww[stoid];
						$mssql="update transjual2 set diskonp=".$roww[d1]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$msto'";
						execute($mssql);
					}

					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mqt1]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1210=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1210);
						
						$mssql="update transjual2 set diskonrp=".($row[mqk3]+$row[mqt2])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1214=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1214);
					}
				}

				if ( ($mrr[totqty]) >= ($row[mq3]) and ($mrr[totqty]) <= ($row[mq4]))
				{
					$mssql="update transjual2 set diskonp=".$row[mqk4]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1222=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1222);
					
					$mssql="update transjual2 set diskonp2=".$row[mqk5]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1226=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1226);
					
					$mssql="update transjual2 set diskonrp=".$row[mqk6]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1230=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1230);
					
					$mqq=executerow("select * from stokpromo where d2>0 and promoid='$mpromoid' order by stoid");
					while ($roww=mysql_fetch_assoc($mqq))
					{
						$msto=$roww[stoid];
						$mssql="update transjual2 set diskonp=".$roww[d2]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$msto'";
						execute($mssql);
					}

					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mqt3]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1244=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1244);
						
						$mssql="update transjual2 set diskonrp=".($row[mqk6]+$row[mqt4])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1248=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1248);
					}
				}

				if ( ($mrr[totqty]) >= ($row[mq5]) and ($mrr[totqty]) <= ($row[mq6]))
				{
					$mssql="update transjual2 set diskonp=".$row[mqk7]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1256=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1256);
					
					$mssql="update transjual2 set diskonp2=".$row[mqk8]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1260=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1260);
					
					$mssql="update transjual2 set diskonrp=".$row[mqk9]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1264=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1264);
					
					$mqq=executerow("select * from stokpromo where d3>0 and promoid='$mpromoid' order by stoid");
					while ($roww=mysql_fetch_assoc($mqq))
					{
						$msto=$roww[stoid];
						$mssql="update transjual2 set diskonp=".$roww[d3]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$msto'";
						execute($mssql);
					}

					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mqt5]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1278=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1278);
						
						$mssql="update transjual2 set diskonrp=".($row[mqk9]+$row[mqt6])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1282=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1282);
					}
				}

				if ( ($mrr[totqty]) >= ($row[mq7]) and ($mrr[totqty]) <= ($row[mq8]))
				{
					$mssql="update transjual2 set diskonp=".$row[mqk10]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1290=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1290);
					
					$mssql="update transjual2 set diskonp2=".$row[mqk11]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1294=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1294);
					
					$mssql="update transjual2 set diskonrp=".$row[mqk12]." where nid='$mnid' and regulerid='$mpromoid'";
					$query1298=executerow($mssql);
					$mrr=mysql_fetch_assoc ($query1298);
					
					$mqq=executerow("select * from stokpromo where d4>0 and promoid='$mpromoid' order by stoid");
					while ($roww=mysql_fetch_assoc($mqq))
					{
						$msto=$roww[stoid];
						$mssql="update transjual2 set diskonp=".$roww[d4]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$msto'";
						execute($mssql);
					}

					if ($mr11[tunaikredit]==2)
					{
						$mssql="update transjual2 set diskonp2=".$row[mqt7]." where nid='$mnid' and regulerid='$mpromoid'";
						$query1312=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1312);
						
						$mssql="update transjual2 set diskonrp=".($row[mqk12]+$row[mqt8])." where nid='$mnid' and regulerid='$mpromoid'";
						$query1316=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1316);
					}
				}
			}
		}
		else
		{
			///yang stoknya satu2
			//echo($mkqty);
			if ($msat=='1')
			{
				$mssql="select stoid,sum(qty) totqty,sum(qty*hrgsat) tothrg from transjual2 where nid='$mnid' and regulerid='$mpromoid' group by stoid";
			}
			else
			{
				$mssql="select stoid,sum(qty*isi) totqty,sum(qty*hrgsat) tothrg from transjual2 where nid='$mnid' and regulerid='$mpromoid' group by stoid";
			}

			$mrrr=executerow($mssql);
			while ($mrr=mysql_fetch_assoc($mrrr))
			{ //awalputar
				//echo("cek33");

				$mstoid=$mrr[stoid];
				if ($msyarat==1) /// yang pakai value
				{
					//echo($mrr[tothrg]);

					if ( ($mrr[tothrg]) >= ($row[mv1]) and ($mrr[tothrg]) <= ($row[mv2]))
					{
						$mssql="update transjual2 set diskonp=".$row[mvk1]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1348=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1348);
						
						$mssql="update transjual2 set diskonp2=".$row[mvk2]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1352=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1352);
						
						$mssql="update transjual2 set diskonrp=".$row[mvk3]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1356=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1356);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mvt1]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1362=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1362);
							
							$mssql="update transjual2 set diskonrp=".($row[mvk3]+$row[mvt2])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1366=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1366);
						}
					}

					if ( ($mrr[tothrg]) >= ($row[mv3]) and ($mrr[tothrg]) <= ($row[mv4]))
					{
						$mssql="update transjual2 set diskonp=".$row[mvk4]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1374=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1374);
						
						$mssql="update transjual2 set diskonp2=".$row[mvk5]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1378=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1378);
						
						$mssql="update transjual2 set diskonrp=".$row[mvk6]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1382=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1382);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mvt3]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1388=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1388);
							
							$mssql="update transjual2 set diskonrp=".($row[mvk6]+$row[mvt4])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1392=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1392);
						}
					}

					if ( ($mrr[tothrg]) >= ($row[mv5]) and ($mrr[tothrg]) <= ($row[mv6]))
					{
						$mssql="update transjual2 set diskonp=".$row[mvk7]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1400=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1400);
						
						$mssql="update transjual2 set diskonp2=".$row[mvk8]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1404=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1404);
						
						$mssql="update transjual2 set diskonrp=".$row[mvk9]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1408=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1408);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mvt5]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1414=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1414);
							
							$mssql="update transjual2 set diskonrp=".($row[mvk9]+$row[mvt6])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1418=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1418);
						}
					}

					if ( ($mrr[tothrg]) >= ($row[mv7]) and ($mrr[tothrg]) <= ($row[mv8]))
					{
						$mssql="update transjual2 set diskonp=".$row[mvk10]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1426=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1426);
						
						$mssql="update transjual2 set diskonp2=".$row[mvk11]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1430=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1430);
						
						$mssql="update transjual2 set diskonrp=".$row[mvk12]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1434=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1434);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mvt7]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1440=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1440);
							
							$mssql="update transjual2 set diskonrp=".($row[mvk12]+$row[mvt8])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1444=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1444);
						}
					}
				}

				//yang pakai qty
				if ($msyarat==2) /// yang pakai qty
				{
					//echo("lulus2");
					//echo($mrr[tothrg]);

					if ( ($mrr[totqty]) >= ($row[mq1]) and ($mrr[totqty]) <= ($row[mq2]))
					{
						$mssql="update transjual2 set diskonp=".$row[mqk1]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1459=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1459);
						
						$mssql="update transjual2 set diskonp2=".$row[mqk2]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1463=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1463);
						
						$mssql="update transjual2 set diskonrp=".$row[mqk3]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1467=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1467);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mqt1]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1473=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1473);
							
							$mssql="update transjual2 set diskonrp=".($row[mqk3]+$row[mqt2])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1477=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1477);
						}
					}

					if ( ($mrr[totqty]) >= ($row[mq3]) and ($mrr[totqty]) <= ($row[mq4]))
					{
						$mssql="update transjual2 set diskonp=".$row[mqk4]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1485=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1485);
						
						$mssql="update transjual2 set diskonp2=".$row[mqk5]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1489=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1489);
						
						$mssql="update transjual2 set diskonrp=".$row[mqk6]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1493=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1493);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mqt3]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1499=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1499);
							
							$mssql="update transjual2 set diskonrp=".($row[mqk6]+$row[mqt4])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1503=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1503);
						}
					}

					if ( ($mrr[totqty]) >= ($row[mq5]) and ($mrr[totqty]) <= ($row[mq6]))
					{
						$mssql="update transjual2 set diskonp=".$row[mqk7]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1511=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1511);
						
						$mssql="update transjual2 set diskonp2=".$row[mqk8]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1515=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1515);
						
						$mssql="update transjual2 set diskonrp=".$row[mqk9]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1519=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1519);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mqt5]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1525=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1525);
							
							$mssql="update transjual2 set diskonrp=".($row[mqk9]+$row[mqt6])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1529=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1529);
						}
					}

					if ( ($mrr[totqty]) >= ($row[mq7]) and ($mrr[totqty]) <= ($row[mq8]))
					{
						$mssql="update transjual2 set diskonp=".$row[mqk10]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1537=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1537);
						
						$mssql="update transjual2 set diskonp2=".$row[mqk11]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1541=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1541);
						
						$mssql="update transjual2 set diskonrp=".$row[mqk12]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
						$query1545=executerow($mssql);
						$mrr=mysql_fetch_assoc ($query1545);
						
						if ($mr11[tunaikredit]==2)
						{
							$mssql="update transjual2 set diskonp2=".$row[mqt7]." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1551=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1551);
							
							$mssql="update transjual2 set diskonrp=".($row[mqk12]+$row[mqt8])." where nid='$mnid' and regulerid='$mpromoid' and stoid='$mstoid'";
							$query1555=executerow($mssql);
							$mrr=mysql_fetch_assoc ($query1555);
						}
					}
				}
				//yang pakai qty
			} //akhirputar
		}
	}

	///////// AKHIR DISKON REGULER

	execute("update transjual2 set buffer=hrgsat-(hrgsat*diskonp*0.01) where nid='$mnid'");
	execute("update transjual2 set buffer=buffer-(buffer*diskonp2*0.01) where nid='$mnid'");
	execute("update transjual2 set buffer=buffer-diskonrp where nid='$mnid'");
	execute("update transjual2 set buffer=buffer-(buffer*diskonp3*0.01) where nid='$mnid'");
	execute("update transjual2 set buffer=buffer-(buffer*diskonp4*0.01) where nid='$mnid'");
	execute("update transjual2 set buffer=buffer-diskonrp2 where nid='$mnid'");
	execute("update transjual2 set jmlhrg=buffer*qty where nid='$mnid'");
	execute("update transjual1 set total=(select sum(jmlhrg) from transjual2 where nid='$mnid') where nid='$mnid'");

	$query1576=executerow("select supid,total from transjual1 where nid='$mnid'");
	$mqq=mysql_fetch_assoc ($query1576);
	
	$mjml=$mqq[total];
	$msup=$mqq[supid];
	$mssql="select a.* from setdiskonpromo a where a.msupid='$msup' and a.msyarat=3";
	$query1582=executerow($mssql);
	$row=mysql_fetch_assoc ($query1582);
	
	$mdp=0;
	if ($row[msyarat]==3)
	{
		if ( ($mjml) >= ($row[mv1]) and ($mjml) <= ($row[mv2]))
		{
			$mdp=$row[mvk1];
		}

		if ( ($mjml) >= ($row[mv3]) and ($mjml) <= ($row[mv4]))
		{
			$mdp=$row[mvk4];
		}

		if ( ($mjml) >= ($row[mv5]) and ($mjml) <= ($row[mv6]))
		{
			$mdp=$row[mvk7];
		}

		if ( ($mjml) >= ($row[mv7]) and ($mjml) <= ($row[mv8]))
		{
			$mdp=$row[mvk10];
		}
	}
	$mdrp=$mdp*$mjml*0.01;
	$mjml2=$mjml-$mdrp;
	execute("update transjual1 set jumlah=$mjml2,pdiskon=$mdp,diskon=$mdrp where nid='$mnid'");	
	execute("update transjual2 set promoid='' where diskonp3=0 and diskonp4=0 and diskonrp2=0 and nid='$mnid'");
	execute("update transjual2 set regulerid='' where diskonp=0 and diskonp2=0 and diskonrp=0 and nid='$mnid'");

	execute("delete from transjual2 where lokid='L001' and nid='$mnid'");

	$query1618=executerow("
	select a.nid, c.mq1, sum(a.qty*a.isi) totqty
	from transjual2 a
	left join stokpromo b on a.stoid=b.stoid
	left join setdiskonpromo c on b.promoid=c.promoid
	where c.msyarat=4 and a.nid='$mnid'
	group by a.nid, c.mq1
	");
	$mrr=mysql_fetch_assoc ($query1618);
	
	if ($mrr[totqty]<$mrr[mq1])
	{
		return ;
	}

	$mrr2=executerow("select a.nid,a.tgl,a.lokid,a.stoid,a.satid,a.isi,a.qty,c.mq1,c.mqp5,b.stoid,b.stoidb,c.promoid,sum(a.qty*a.isi) totqty 
	from transjual2 a left join stokpromo b on a.stoid=b.stoid left join setdiskonpromo c on b.promoid=c.promoid 
	where c.msyarat=4 and a.nid='$mnid' and a.lokid<>'L001' group by a.nid,a.tgl,a.lokid,a.stoid,a.satid,a.isi,a.qty,c.mq1,c.mqp5,b.stoid,b.stoidb,c.promoid ");

	while ($row=mysql_fetch_assoc($mrr2))
	{
		$mbonus=intval($row[totqty]/($row[mqp5]));

		if ( $mrr[totqty]>=$mrr[mq1] )
		{
			if ($row[stoidb]!='' )
			{
				execute("insert into transjual2(tgl ,nid ,lokid ,stoid ,qty,satid ,unit,extra ,isi ,nomor,promoid ) 
				values('$row[tgl]','$row[nid]','L001','$row[stoidb]',0 ,'Pcs',0 ,$mbonus,1,90 ,'$row[promoid]')
				");
			}
		}
	}
}
?>