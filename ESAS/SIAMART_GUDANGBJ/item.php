<?php
	require("utama.php");

    header('Content-type: application/json');
	
	
	$mabc="$_POST[msql]";
	if ($mabc!='')
	{
	$query = "$_POST[msql]";
	}
	$query = str_replace("!!","%",$query);

	if ($mTparam=='trlhhh001')
	{
 
	$query="
	select 0 nomor,a.nid,a.tgl,a.supid,a.returid,a.beliid,date_format(a.belitgl,'%d-%m-%Y') belitgl,a.hutang,a.retur,a.jumlah,a.bayar,a.sisa,a.kredit,a.lunasi from translunashutang a where a.nid='$mnnnid'";
	
	}

	if ($mTparam=='trlhhh002')
	{
$query=	
"
select * from 
(select a.nid AS nid,a.nid as beliid,a.tgl AS tgl,date_format(a.tgl,'%d-%m-%Y') belitgl,a.bpid AS bpid,a.kredit AS kredit,ifnull(b.bayar,0) AS bayar,ifnull(c.retur,0) AS retur,ifnull(c.nid2,'') AS returid,a.kredit-ifnull(b.bayar,0)-ifnull(c.retur,0) AS sisahutang,000000000000000 as lunasi,a.kredit-ifnull(b.bayar,0)-ifnull(c.retur,0) as sisa from (bkbesar a left join 
(select bkbesar.nid2 AS nid2,bkbesar.tgl2 AS tgl2,bkbesar.bpid AS bpid,sum(bkbesar.debet) AS bayar from bkbesar where (bkbesar.rekid = '20010' and bpid='$msuppp' and trans<>'TRANSRETURBELI') group by bkbesar.nid2,bkbesar.tgl2,bkbesar.bpid) b 
on(((a.nid = b.nid2) and (a.bpid = b.bpid)))) left join 
(select nid2,sum(debet) retur from bkbesar where rekid='20010' and bpid='$msuppp' and trans='TRANSRETURBELI' group by nid2) c on a.nid=c.nid2
where ((a.rekid = '20010') and (a.kredit-ifnull(b.bayar,0)-ifnull(c.retur,0) <> 0)) and a.bpid='$msuppp' order by a.tgl
) a
union
select a,a,a,a,a,a,a,a,a,a,a,a from temporer 
";

	}

	if ($mTparam=='trlppp001')
	{

	$query="select 0 nomor,a.nid,a.tgl,a.lgnid,a.jualid,date_format(a.jualtgl,'%d-%m-%Y') jualtgl,a.piutang,a.debet,a.retur,a.jumlah,a.bayar,a.sisa,a.lunasi from translunaspiutang a where a.nid='$mnnnid'";
	
	}
	
	if ($mTparam=='trlppp002')
	{
$query=	
"
select * from 
(
select a.nid AS nid,a.nid as jualid,a.tgl AS tgl,date_format(a.tgl,'%d-%m-%Y') jualtgl,a.bpid AS bpid,a.debet AS debet,ifnull(b.bayar,0) AS bayar,ifnull(c.retur,0) AS retur,a.debet-ifnull(b.bayar,0)-ifnull(c.retur,0) AS sisapiutang,000000000000000 as lunasi,a.debet-ifnull(b.bayar,0)-ifnull(c.retur,0) as sisa from (bkbesar a left join 
(select bkbesar.nid2 AS nid2,bkbesar.tgl2 AS tgl2,bkbesar.bpid AS bpid,sum(bkbesar.kredit) AS bayar from bkbesar where (bkbesar.rekid = '10210' and bpid='$mlgnpp' and trans<>'TRANSRETURJUAL') group by bkbesar.nid2,bkbesar.tgl2,bkbesar.bpid) b 
on(((a.nid = b.nid2) and (a.bpid = b.bpid)))) left join 
(select nid2,sum(kredit) retur from bkbesar where rekid='10210' and bpid='$mlgnpp' and trans='TRANSRETURJUAL' group by nid2) c on a.nid=c.nid2
where ((a.rekid = '10210') and (a.debet-ifnull(b.bayar,0)-ifnull(c.retur,0) <> 0)) and a.bpid='$mlgnpp' order by a.tgl
) a
union
select a ,a ,a , a,a ,a ,a,a,a ,a,a from temporer 
";

	}
	
	if ($mTparam=='trrtbbl')
	{

	$query="
	select * from 
	(
	select a.nomor,'  ' nomors,a.lokid,c.loknama,a.stoid,b.stonama,a.satid,
	FORMAT(a.qty, 0) qty,
	FORMAT(a.extra, 0) extra,
	FORMAT(a.diskonp, 2) diskonp,
	FORMAT(a.diskonrp, 2) diskonrp,
	FORMAT(a.hrgsat, 4) hrgsat,
	FORMAT(a.jmlhrg, 0) jmlhrg,a.isi 
	from transreturbeli2 a left join setstok b on a.stoid=b.stoid left join setlok c on a.lokid=c.lokid where a.nid='$mnnnid'
	) a union
	select * from 
	(
	select @rownum:=@rownum+1 nomor,'  ' nomors,a lokid,a loknama,a stoid,a stonama,a satid,d qty,d extra,d hrgsat,d diskonp,d diskonrp,d jmlhrg,d isi from temporer a,(SELECT @rownum:=0) r limit 50 
	) b	
	";

	}
	
	if ($mTparam=='stolkp001')
	{
	$query="select a.stoid,a.stonama,concat(b.satuan,b.satuan2,b.satuan3) as kemasans,concat(a.grpid,'-',c.grpnama) AS grup,
	b.satuan as kemasan,
	FORMAT(a.hrgbeli,0) hrgbeli,	
	FORMAT(a.hrgjual,0) hrgjual,	
	FORMAT(a.hrgjual2,0) hrgjual2,	
	FORMAT(a.hrgjual3,0) hrgjual3,	
	FORMAT(a.hrgjual4,0) hrgjual4
	from setstok a left join setsatuan b on a.satuan=b.satuanid 
	left join setgrp c on a.grpid=c.grpid
	where a.grpid like '%$mgrpid%' and concat(stoid,stonama,barcode) like '%$mgp%' and aktif>0
	order by a.stonama,a.stoid limit 0,500";
	}

	if ($mTparam=='sgpp001')
	{
	$query="select a.*,ifnull(concat(a.supid,' - ',b.supnama),'-') as suplier,concat(a.rekid,' - ',c.reknama) as rekening  
	from setgrp a left join setsup b on a.supid=b.supid 
	left join setrek c on a.rekid=c.rekid
	where concat(a.grpid,a.grpnama,a.rekid,a.supid,ifnull(b.supnama,''),ifnull(c.reknama,'')) like '%$mfilt%'	
	order by a.grpid";
	}

	if ($mTparam=='smkk001')
	{
	$query="select a.*,concat(a.grpid,' - ',b.grpnama) as grup
	from setmerk a left join setgrp b on a.grpid=b.grpid 
	where concat(a.merkid,a.merknama,a.grpid,b.grpnama) like '%$mfilt%'	
	order by a.merkid";
	}

	if ($mTparam=='smsp001')
	{
	$query="select a.* from setsup a where concat(a.supid,a.supnama,a.alamat,a.telp) like '%$mfilt%'	
	order by a.supid";
	}

	if ($mTparam=='smlgg001')
	{
	$query="select a.* from setlgn a where concat(a.lgnid,a.lgnnama,a.alamat,a.telp) like '%$mfilt%'	
	order by a.lgnid";
	}

	if ($mTparam=='sshgl001')
	{
	$query="select a.lgnid,b.supid,a.golongan,FORMAT(a.plafon,0) plafon,a.kredit,a.ppn,a.top,b.supnama,a.proteksi 
	from sethrglgn a right join setsup b on a.supid=b.supid 
	and a.lgnid='$mlggnid'
	order by b.supid";
	}

	if ($mTparam=='sslggn001')
	{
	$query="
	select * from 
	(
	select @rownum:=@rownum+1 num,@rownum2:=@rownum2+1 nomors,nid,date_format(tgl,'%d-%m-%Y') tgl,debet  from bkbesar p, (SELECT @rownum:=0) r, (SELECT @rownum2:=0) q where trans='SA' and rekid='10210' and bpid='$mlggn' order by tgl
	) a
	union
	select * from 
	(
	select @rownum:=@rownum+1 num,0 nomors,a nid,a tgl,c debet  from temporer p, (SELECT @rownum:=count(*)+1 from bkbesar where trans='SA') r limit 50
	) b
	";
	}

	if ($mTparam=='ssspps001')
	{
	$query="
	select * from 
	(
	select @rownum:=@rownum+1 num,@rownum2:=@rownum2+1 nomors,nid,date_format(tgl,'%d-%m-%Y') tgl,kredit  from bkbesar p, (SELECT @rownum:=0) r, (SELECT @rownum2:=0) q where trans='SA' and rekid='20010' and bpid='$msuuup' order by tgl
	) a
	union
	select * from 
	(
	select @rownum:=@rownum+1 num,0 nomors,a nid,a tgl,c kredit  from temporer p, (SELECT @rownum:=count(*)+1 from bkbesar where trans='SA') r limit 50
	) b
	";
	}

	if ($mTparam=='trbll000')
	{

	$query="
	select * from 
	(
	select a.nomor,'  ' nomors,a.lokid,c.loknama,a.stoid,b.stonama,a.satid,
	FORMAT(a.qty, 0) qty,
	FORMAT(a.extra, 0) extra,
	FORMAT(a.diskonp, 2) diskonp,
	FORMAT(a.diskonp2, 2) diskonp2,
	FORMAT(a.diskonp3, 2) diskonp3,
	FORMAT(a.diskonrp, 2) diskonrp,
	FORMAT(a.hrgsat, 4) hrgsat,
	FORMAT(a.jmlhrg, 0) jmlhrg,a.isi	
	from transbeli2 a left join setstok b on a.stoid=b.stoid left join setlok c on a.lokid=c.lokid where a.nid='$mnnnid' order by nomor
	) a union
	select * from 
	(
	select @rownum:=@rownum+1 nomor,'  ' nomors,a lokid,a loknama,a stoid,a stonama,a satid,d qty,d extra,d hrgsat,d diskonp,d diskonp2,d diskonp3,d diskonrp,d jmlhrg,d isi from temporer a,(SELECT @rownum:=0) r limit 50 
	) b	
	";
	}	

	if ($mTparam=='trjll020')
	{

	$query="
	select * from 
	(
	select a.nomor,'  ' nomors,a.lokid,c.loknama,a.stoid,b.stonama,a.golongan,a.satid,
	FORMAT(a.qty,0) qty,
	FORMAT(a.extra,0) extra,
	FORMAT(a.diskonp,2) diskonp,
	FORMAT(a.diskonp2,2) diskonp2,
	FORMAT(a.diskonp3,2) diskonp3,
	FORMAT(a.diskonp4,2) diskonp4,
	FORMAT(a.diskonrp,0) diskonrp,
	FORMAT(a.diskonrp2,0) diskonrp2,
	FORMAT(a.hrgsat,4) hrgsat,
	FORMAT(a.jmlhrg,0) jmlhrg,
	a.isi,a.promoid,a.regulerid from transjual2 a left join setstok b on a.stoid=b.stoid left join setlok c on a.lokid=c.lokid where a.nid='$mnnnid' order by nomor
	) a union
	select * from 
	(
	select @rownum:=@rownum+1 nomor,'  ' nomors,a lokid,a loknama,a stoid,a stonama,a golongan,a satid,d qty,d extra,d hrgsat,d diskonp,d diskonp2,d diskonp3,d diskonp4,d diskonrp,d diskonrp2,d jmlhrg,d isi,a promoid,a regulerid from temporer a,(SELECT @rownum:=0) r limit 50 
	) b	
	";
	}	

	if ($mTparam=='trrrtjll020')
	{

	$query="
	select * from 
	(
	select a.nomor,'  ' nomors,a.lokid,c.loknama,a.stoid,b.stonama,a.golongan,a.satid,a.qty,a.extra,a.diskonp,a.diskonp2,a.diskonp3,a.diskonp4,a.diskonrp,a.diskonrp2,a.hrgsat,a.jmlhrg,a.isi from transreturjual2 a left join setstok b on a.stoid=b.stoid left join setlok c on a.lokid=c.lokid where a.nid='$mnnnid'
	) a union
	select * from 
	(
	select @rownum:=@rownum+1 nomor,'  ' nomors,a lokid,a loknama,a stoid,a stonama,a golongan,a satid,d qty,d extra,d hrgsat,d diskonp,d diskonp2,d diskonp3,d diskonp4,d diskonrp,d diskonrp2,d jmlhrg,d isi from temporer a,(SELECT @rownum:=0) r limit 50 
	) b	
	";
	}	
	
	if ($mTparam=='ss001dsk')
	{	
		$query="select a.diskonid,a.ket,a.supid,b.supnama   from setdiskon  a left join setsup b on a.supid=b.supid where jenis='Reguler'
		group by a.ket,a.supid,b.supnama order by a.diskonid";
	}

	if ($mTparam=='ss001dsk2')
	{	
		$query="select a.ket,a.supid,b.supnama,date_format(a.tgl1,'%d-%m-%Y') tgl1,date_format(a.tgl2,'%d-%m-%Y') tgl2   from setdiskon  a left join setsup b on a.supid=b.supid where jenis='Promo'
		group by a.ket,a.supid,b.supnama,a.tgl1,a.tgl2 order by a.diskonid";
	}
	
	if ($mTparam=='ss001dsksto')
	{	
		$query="select a.stoid,b.stonama,c.grpnama,d.merknama,a.persen1,a.persen2,a.rupiah,a.barang,a.unitcapaian1,a.unitcapaian2 
		from setdiskon a left join setstok b on a.stoid=b.stoid 
		left join setgrp c on b.grpid=c.grpid left join setmerk d on b.merkid=d.merkid
		where a.supid='$msupidd' and jenis='$mjeniss' and concat(b.stonama,c.grpnama,d.merknama) like '%$mfiltdisk%'" ;
	}

	if ($mTparam=='lstkjlll')
	{	
		$query="select a.stoid,a.stonama,b.golongan,a.satuan,a.satuan1,a.satuan2 from setstok a left join sethrglgn b on a.supid=b.supid where lgnid like '!!$mlggn!!' and a.supid like '!!$msupid!!'";
	}

	if ($mTparam=='ssaatj23')
	{	
		$mhjg='hrgjual';
		if ($mgol=='A')
		{$mhjg='hrgjual';}
		if ($mgol=='B')
		{$mhjg='hrgjual2';}
		if ($mgol=='C')
		{$mhjg='hrgjual3';}
		if ($mgol=='D')
		{$mhjg='hrgjual4';}
		if ($mgol=='E')
		{$mhjg='hrgjual5';}
		if ($mgol=='F')
		{$mhjg='hrgjual6';}
		if ($mgol=='G')
		{$mhjg='hrgjual7';}
		
		$query="
		select * from (
		select satuan1 satuan,$mhjg hrgjual,isi*isi2 isi from setstok where stoid='$mstoid' and satuan1<>''
union
		select satuan2 satuan,round($mhjg/isi,0) hrgjual,isi2 from setstok where stoid='$mstoid' and satuan2<>''
union
		select satuan3 satuan,round($mhjg/(isi*isi2),0) hrgjual,1 isi from setstok where stoid='$mstoid' and satuan3<>''
		) a where satuan not in (select satid from transjual2 where nid='$mnidd' and stoid='$mstoid')	
		";
	}

	if ($mTparam=='snrrrc')
	{
		$query="select a.*,b.clnama from setneraca a left join setklas b on a.clid=b.clid order by nrcid";
	}	

	if ($mTparam=='rrrkkk')
	{
		$query="select a.*,b.nrcnama from setrek a left join setneraca b on a.nrcid=b.nrcid order by rekid";
	}	
	
	if ($mTparam=='sncll')
	{
		$query="select a.*,if(dork='D','Debet','Kredit') dk,if(posisi='A','Aktiva',if(posisi='P','Pasiva',if(posisi='D','Pendapatan','Beban'))) neraca from setklas a order by clid";
	}	

	if ($mTparam=='lkbbbl')
	{
		$query="select *,date_format(tgl,'%d-%m-%Y') tglc from transbeli1 where supid='$msupidd'";
	}	

	
	if ($mTparam=='lkjjjjl')
	{
		$query="select *,date_format(tgl,'%d-%m-%Y') tglc from transjual1 where lgnid='$mlgnidd'";
	}	

	if ($mTparam=='lunhtt0908')
	{
	$query="

	select * from 
	(
		select nomor,giroid,trans,date_format(girotgl,'%d-%m-%Y') girotgl,rekid,reknama,jumlah,jatuhtempo,lunas,tgllunas,ket from transgiro where nid='$mnidd' and trans='LH'
	) a union
	select * from 
	(
		select @rownum:=@rownum+1 nomor,a giroid,a trans,a girotgl,a rekid,a reknama,d jumlah,c jatuhtempo,c lunas,b  tgllunas,a ket from temporer a,(SELECT @rownum:=0) r limit 50 
	) b	

	";
	}	

	if ($mTparam=='lunptt0907')
	{
	$query="

	select * from 
	(
		select nomor,giroid,trans,date_format(girotgl,'%d-%m-%Y') girotgl,rekid,reknama,jumlah,jatuhtempo,lunas,tgllunas,ket from transgiro where nid='$mnidd' and trans='LP'
	) a union
	select * from 
	(
		select @rownum:=@rownum+1 nomor,a giroid,a trans,a girotgl,a rekid,a reknama,d jumlah,c jatuhtempo,c lunas,b  tgllunas,a ket from temporer a,(SELECT @rownum:=0) r limit 50 
	) b	

	";
	}	

	if ($mTparam=='setkun')
	{
	
$query="
select a.lgnid,a.lgnnama,
if(b.hari is null,0,1) sen,
if(c.hari is null,0,1) sel,
if(d.hari is null,0,1) rab,
if(e.hari is null,0,1) kam,
if(f.hari is null,0,1) jum,
if(g.hari is null,0,1) sab,
if(h.hari is null,0,1) min
from setlgn a 
left join (select * from setkunjungan where hari=1 and salesid='$msalesid') b  on a.lgnid=b.lgnid
left join (select * from setkunjungan where hari=2 and salesid='$msalesid') c  on a.lgnid=c.lgnid
left join (select * from setkunjungan where hari=3 and salesid='$msalesid') d  on a.lgnid=d.lgnid
left join (select * from setkunjungan where hari=4 and salesid='$msalesid') e  on a.lgnid=e.lgnid
left join (select * from setkunjungan where hari=5 and salesid='$msalesid') f  on a.lgnid=f.lgnid
left join (select * from setkunjungan where hari=6 and salesid='$msalesid') g  on a.lgnid=g.lgnid
left join (select * from setkunjungan where hari=7 and salesid='$msalesid') h  on a.lgnid=h.lgnid
where concat(a.lgnnama,a.kecamatan) like '%$mfilt%'
order by a.lgnid
";
}
    $result = executerow($query);
    $rows = array();
    $idx = 0;
    $idx2 = 0;

    while($row = mysql_fetch_array($result)) {
            $rows[$idx++] = $row;
			$rows[$idx2]['nomor']= $idx2+1;
			$idx2=$idx2+1;
	}
	
	?>
{
    rows : <?php print json_encode($rows); ?>
}    
