<?php
require("../utama.php");

$mjogs=$mjog;
$mjogs2=$mjog*2;
$msty="style='background-color:transparent;border:0;text-align:center;fore-color:black'";

$mst=" and status=$mk";
if ($mk=='3')
{$mst='';}


$query="select nid,tgl from bkbesar where nid='$mnid' and kredit>0";
$mqwee=execute($query);
if ($mqwee[nid]=='')
{

	$query="select nid,date_format(tgl,'%d-%m-%Y') tgl,
	format(debet ,0) debet,format(ifnull(b.kredit,0),0) lunas,format(ifnull(c.kredit,0),0) retur,format(ifnull(d.kredit,0),0) bayar,
	format(debet-ifnull(b.kredit,0)-ifnull(c.kredit,0)-ifnull(d.kredit,0),0) saldo
	from bkbesar a 
	left join (select nid2,sum(kredit) kredit from bkbesar where rekid='10210' and trans<>'TRANSRETURJUAL' and nid<'$mnid' and bpid='$mlgnid' group by nid2) b on a.nid=b.nid2 
	left join (select nid2,sum(kredit) kredit from bkbesar where rekid='10210' and trans='TRANSRETURJUAL'  and bpid='$mlgnid' group by nid2) c on a.nid=c.nid2
	left join (select nid2,sum(kredit) kredit from bkbesar where rekid='10210' and trans<>'TRANSRETURJUAL' and nid='$mnid'  and bpid='$mlgnid' group by nid2) d on a.nid=d.nid2 
	where rekid='10210' and a.debet>0 and a.bpid='$mlgnid' and
	(a.debet-ifnull(b.kredit,0)-ifnull(c.kredit,0)-ifnull(d.kredit,0)) >0
";

}
else
{

$query="select nid,date_format(tgl,'%d-%m-%Y') tgl,
format(debet ,0) debet,format(ifnull(b.kredit,0),0) lunas,format(ifnull(c.kredit,0),0) retur,format(ifnull(d.kredit,0),0) bayar,
format(debet-ifnull(b.kredit,0)-ifnull(c.kredit,0),0) saldo,
format(debet-ifnull(b.kredit,0)-ifnull(c.kredit,0)-ifnull(d.kredit,0),0) sisa
from bkbesar a 
left join (select nid2,sum(kredit) kredit from bkbesar where rekid='10210' and trans<>'TRANSRETURJUAL' and nid<'$mnid' and bpid='$mlgnid' group by nid2) b on a.nid=b.nid2 
left join (select nid2,sum(kredit) kredit from bkbesar where rekid='10210' and trans='TRANSRETURJUAL'  and bpid='$mlgnid' group by nid2) c on a.nid=c.nid2
left join (select nid2,sum(kredit) kredit from bkbesar where rekid='10210' and trans<>'TRANSRETURJUAL' and nid='$mnid'  and bpid='$mlgnid' group by nid2) d on a.nid=d.nid2 
where rekid='10210' and a.debet>0 and a.bpid='$mlgnid' and a.nid in (select nid2 from bkbesar where nid='$mnid') 
";

}
/*$query="select * from temporer limit 0,100";*/

$rrw=executerow($query);

$mnom=1;


while ($rows=mysql_fetch_assoc($rrw))
	{	
		$mgj=execute("select date_format(tgljt,'%d-%m-%Y') tgljt from transjual1 where nid='$rows[nid]'");
		echo "".$mgj[tgljt]." ";

		$mnom++;
	}

	$mjum=$mnom-1;

	
?>