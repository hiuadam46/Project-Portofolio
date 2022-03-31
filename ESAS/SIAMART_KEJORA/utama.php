<?php
date_default_timezone_set('Asia/Jakarta');

$mhi=date('Ymd');
if ($mhi>='20900213')
{
	echo "Maaf , Masa Pakai Program Sudah Habis !";
	return;
}

$datab='';
$linki=open_connection();

function open_connection()
{
	$links=mysql_connect('localhost','esae1797_admin','+FeBJfl6&G]u') or die ("Database tidak dapat dihubungkan!");
	mysql_select_db('esae1797_kejora',$links);

	return $links;
}

function transform($mcoba)
{
	$mpan=strlen($mcoba);
	$mdig=intval($mpan/3)*3;
	$mhas1=substr($mcoba,0,$mpan-$mdig);
	$mhas2=substr($mcoba,$mpan-$mdig,$mdig);
	if (!empty($mhas1))
	{
		$mteng='.';
	}
	else
	{
		$mteng='';
	};
	$mhasil=$mhas1.$mteng.substr(chunk_split($mhas2,3,'.'), 0, -1) ;
	return $mhasil;
}

function execute($mStrSql)
{
	$links=open_connection();
	$mStrSql = str_replace("!!","%",$mStrSql);
	$mStrSql = str_replace("\'","'",$mStrSql);

	$result = mysql_query ($mStrSql,$links) or die ("Kesalahan pada perintah $mStrSql");

	if ($result!=1)
	{
		$rrw=mysql_fetch_assoc ($result);
	}
	return $rrw;
}

function executerow($mStrSql)
{
	$links=open_connection();
	$mStrSql = str_replace("!!","%",$mStrSql);
	$mStrSql = str_replace("\'","'",$mStrSql);

	$result = mysql_query ($mStrSql,$links) or die ("Kesalahan pada perintah $mStrSql");
	return $result;
}

function jurnal($mTrans,$mNid)
{
	if ($mTrans='JUAL')
	{
		$mNid=$mNid;
		savstok($mStoid,'JUAL',$mNid);
	}
}

function cqty($mqty,$misi,$misi2,$msatuan1,$msatuan2,$msatuan3)
{
	$mmsaldoqty=number_format(doubleval($mqty),0,',','.');
	if ($mqty=='0')
	{
		$mmsaldoqty="";
		$msatuan1="";
	}
	$mjadi=$mmsaldoqty.'<font size=1>'.$msatuan1;
	$mjadi=trim($mjadi);
	
	if ($msatuan1!='' and $msatuan2!='' and $msatuan3!='')
	{
		$mmsaldoqty=intval($mqty/($misi*$misi2));
		$mmsaldounita=($mqty)-($mmsaldoqty*$misi*$misi2);
		$mmsaldounit2=intval($mmsaldounita/($misi2));
		$mmsaldounit3=($mmsaldounita)-($mmsaldounit2*$misi2);
	}

	if ($msatuan1!='' and $msatuan2!='' and $msatuan3=='')
	{
		$mmsaldoqty=intval($mqty/($misi*$misi2));
		$mmsaldounita=($mqty)-($mmsaldoqty*$misi*$misi2);
		$mmsaldounit2=intval($mmsaldounita/($misi2));
		$mmsaldounit3=0;
	}

	if ($msatuan1!='' and $msatuan2=='' and $msatuan3=='')
	{
		$mmsaldoqty=intval($mqty/($misi*$misi2));
		$mmsaldounit2=0;
		$mmsaldounit3=0;
	}

	$mmsaldoqty=number_format(doubleval($mmsaldoqty),0,',','.');
	if ($mmsaldoqty=='0')
	{
		$mmsaldoqty="";
		$msatuan1="";
	}

	$mmsaldounit2=number_format(doubleval($mmsaldounit2),0,',','.');
	if ($mmsaldounit2=='0')
	{
		$mmsaldounit2="";
		$msatuan2="";
	}

	$mmsaldounit3=number_format(doubleval($mmsaldounit3),0,',','.');
	if ($mmsaldounit3=='0')
	{
		$mmsaldounit3="";
		$msatuan3="";
	}

	$mjadi=$mmsaldoqty.'<font size=1>'.$msatuan1.' </font>'.$mmsaldounit2.'<font size=1>'.$msatuan2.' </font>'.$mmsaldounit3.'<font size=1>'.$msatuan3.'</font>&nbsp;';
	$mjadi=trim($mjadi);
	return $mjadi;
}

function cqty2($mqty,$misi,$misi2,$msatuan1,$msatuan2,$msatuan3)
{
	if ($msatuan1!='' and $msatuan2!='' and $msatuan3!='')
	{
		$mmsaldoqty=intval($mqty/($misi*$misi2));
		$mmsaldounita=($mqty)-($mmsaldoqty*$misi*$misi2);
		$mmsaldounit2=intval($mmsaldounita/($misi2));
		$mmsaldounit3=($mmsaldounita)-($mmsaldounit2*$misi2);
	}

	if ($msatuan1=='' and $msatuan2!='' and $msatuan3!='')
	{
		$mmsaldoqty=0;
		$mmsaldounit2=intval($mqty/($misi2));
		$mmsaldounit3=($mqty)-($mmsaldounit2*$misi2);
	}

	if ($msatuan1=='' and $msatuan2=='' and $msatuan3!='')
	{
		$mmsaldoqty=0;
		$mmsaldounit2=0;
		$mmsaldounit3=$mqty;
	}

	$mmsaldoqty=number_format(doubleval($mmsaldoqty),0,',','.');
	if ($mmsaldoqty=='0')
	{
		$mmsaldoqty="";
		$msatuan1="";
	}

	$mmsaldounit2=number_format(doubleval($mmsaldounit2),0,',','.');
	if ($mmsaldounit2=='0')
	{
		$mmsaldounit2="";
		$msatuan2="";
	}

	$mmsaldounit3=number_format(doubleval($mmsaldounit3),0,',','.');
	if ($mmsaldounit3=='0')
	{
		$mmsaldounit3="";
		$msatuan3="";
	}

	$mjadi=$mmsaldoqty.' '.$msatuan1.' '.$mmsaldounit2.' '.$msatuan2.' '.$mmsaldounit3.' '.$msatuan3.' ';
	$mjadi=trim($mjadi);
	if ($mjadi=='')
	{
		$mjadi='0';
	}
	return $mjadi;
}

function savstok($mlokid,$mstoid,$mnid,$mtgl,$mdebet,$mkredit,$mqtyin,$mqtyout,$mtrans,$mket)
{
	$sqr=execute("select rekid,hrgbeli,isi*isi2 isi from setstok a left join setgrp b on a.grpid=b.grpid where a.stoid='$mstoid'");
	$mrekid='10310';
	$mhbel=$sqr[hrgbeli]/$sqr[isi];
	if ($mqtyout>0)
	{
		$mjumlah=$mqtyout;
		$mkredit=0;
		while ($mjumlah>0)
		{
			$sqlstr="
			select
			a.bpid AS stoid,
			a.bpid2 AS lokid,
			a.nid AS nid,
			a.tgl AS tgl,
			(sum(a.qtyin) - sum(ifnull(b.qtyout,0))) AS saldoqty,
			round(a.debet/a.qtyin,0) AS hpp
			from (bkbesar a left join (select nid2,bpid,sum(qtyout) qtyout from bkbesar where bpid='$mstoid' and bpid2='$mlokid' group by nid2,bpid) b on(((a.bpid = b.bpid) and (a.nid = b.nid2) and (b.qtyout <> 0))))
			where ((a.rekid like '103%') and (a.qtyin <> 0) and (a.bpid='$mstoid') and (a.bpid2='$mlokid') )
			group by a.bpid,a.bpid2,a.nid,a.tgl,a.qtyin
			having ((sum(a.qtyin) - sum(ifnull(b.qtyout,0))) > 0)
			limit 0,1";

			$sqlstr="
			select
			a.nid AS nid,
			a.tgl AS tgl,a.debet/a.qtyin hpp,
			a.qtyin-ifnull(b.qtyout,0) AS saldoqty,a.qtyin,b.qtyout
			from (select nid,tgl,qtyin,debet from bkbesar a where a.rekid like '103%' and a.qtyin > 0 and a.bpid='$mstoid' and a.bpid2='$mlokid' ) a
			left join (select nid2,bpid,sum(qtyout) qtyout from bkbesar where bpid='$mstoid' and bpid2='$mlokid' group by nid2,bpid) b on a.nid=b.nid2
			where a.qtyin-ifnull(b.qtyout,0)>0
			limit 0,1";

			$maa=execute($sqlstr);
			//$mstoid=$maa[stoid];
			$mnid2=$maa[nid];
			$mtgl2=$maa[tgl];
			$msaldo=$maa[saldoqty];
			$mhpp=$maa[hpp];
			$mkredits=0;

			if ($mjumlah>$msaldo)
			{
				$mqtyouts=$msaldo;
				$mkredits=$mhpp*$msaldo;
			}
			else
			{
				$mqtyouts=$mjumlah;
				$mkredits=$mhpp*$mjumlah;
			}

			if ($mqtyouts=='')
			{
				$mqtyouts=$mjumlah;
				$mkredits=$mhbel*$mjumlah;
			}

			$sqlstr="insert into bkbesar(rekid,bpid,bpid2,tgl,nid,kredit,qtyout,trans,tgl2,nid2,ket)
			values('$mrekid','$mstoid','$mlokid','$mtgl','$mnid',$mkredits,$mqtyouts,'$mtrans','$mtgl2','$mnid2','$mket')";

			execute($sqlstr);

			$mjumlah=$mjumlah-$mqtyouts;
			$mkredit=$mkredit+$mkredits;
		}
		echo $mkredit;
	}

	if ($mqtyin>0)
	{
		if ($mdebet<=0)
		{
			$mdebet=$mhbel*$mqtyin;
		}

		$sqlstr="insert into bkbesar(rekid,bpid,bpid2,tgl,nid,debet,qtyin,trans,ket)
		values('$mrekid','$mstoid','$mlokid','$mtgl','$mnid',$mdebet,$mqtyin,'$mtrans','$mket')";
		execute($sqlstr);
		echo $mdebet;
	}
}

function bulan($mname)
{
	$maa="onchange= abc=document.getElementById('".$mname."_t').value+'-'+document.getElementById('".$mname."_b').value+'-1';document.getElementById('".$mname."').value=abc;ubahbulan(); ";

	$mbb="onclick= abc=document.getElementById('".$mname."_t').value+'-'+document.getElementById('".$mname."_b').value+'-1';document.getElementById('".$mname."').value=abc;ubahbulan(); ";

	$mcc="onkeyup= abc=document.getElementById('".$mname."_t').value+'-'+document.getElementById('".$mname."_b').value+'-1';document.getElementById('".$mname."').value=abc;ubahbulan(); ";

	echo
	"
	<select id='".$mname."_b' $maa>
	<option value='01'>Januari</option>
	<option value='02'>Februari</option>
	<option value='03'>Maret</option>
	<option value='04'>April</option>
	<option value='05'>Mei</option>
	<option value='06'>Juni</option>
	<option value='07'>Juli</option>
	<option value='08'>Agustus</option>
	<option value='09'>September</option>
	<option value='10'>Oktober</option>
	<option value='11'>November</option>
	<option value='12'>Desember</option>
	</select><input type=number id='".$mname."_t' size=6 maxlength=4 value='".date('Y')."' $mbb $mbb $mcc>
	<input type=text hidden disabled id='".$mname."' value='".date('Y')."-01-01'>
	";
}

function combobox($msql,$mname)
{
	echo "
	<select id='$mname' name='$mname' onchange='ubah$mname()'>
	";

	$rrw=executerow($msql);
	while ($row=mysql_fetch_assoc($rrw))
	{
		$miis=$row[misi];
		$miin=$row[mtampil];
		echo("<option value='$miis'>$miin</option>");
	}
	echo "</select>";
}

function combobox2($msql,$mname)
{
	echo "
	<select $mname onchange='ubah$mname()'>
	";

	$rrw=executerow($msql);
	while ($row=mysql_fetch_assoc($rrw))
	{
		$miis=$row[misi];
		$miin=$row[mtampil];
		echo("<option value='$miis'>$miin</option>");
	}
	echo "</select>";
}

function cqty3($mqty,$mstoid)
{
	$mrww=execute("select * from setstok where stoid='$mstoid'");

	$misi=$mrww[isi];
	$misi2=$mrww[isi2];
	$msatuan1=$mrww[satuan1];
	$msatuan2=$mrww[satuan2];
	$msatuan3=$mrww[satuan3];

	if ($msatuan1!='' and $msatuan2!='' and $msatuan3!='')
	{
		$mmsaldoqty=intval($mqty/($misi*$misi2));
		$mmsaldounita=($mqty)-($mmsaldoqty*$misi*$misi2);
		$mmsaldounit2=intval($mmsaldounita/($misi2));
		$mmsaldounit3=($mmsaldounita)-($mmsaldounit2*$misi2);
	}

	if ($msatuan1=='' and $msatuan2!='' and $msatuan3!='')
	{
		$mmsaldoqty=0;
		$mmsaldounit2=intval($mqty/($misi2));
		$mmsaldounit3=($mqty)-($mmsaldounit2*$misi2);
	}

	if ($msatuan1=='' and $msatuan2=='' and $msatuan3!='')
	{
		$mmsaldoqty=0;
		$mmsaldounit2=0;
		$mmsaldounit3=$mqty;
	}

	$mmsaldoqty=number_format(doubleval($mmsaldoqty),0,',','.');
	if ($mmsaldoqty=='0')
	{
		$mmsaldoqty="";
		$msatuan1="";
	}

	$mmsaldounit2=number_format(doubleval($mmsaldounit2),0,',','.');
	if ($mmsaldounit2=='0')
	{
		$mmsaldounit2="";
		$msatuan2="";
	}

	$mmsaldounit3=number_format(doubleval($mmsaldounit3),0,',','.');
	if ($mmsaldounit3=='0')
	{
		$mmsaldounit3="";
		$msatuan3="";
	}

	$mjadi=$mmsaldoqty.''.$msatuan1.' '.$mmsaldounit2.''.$msatuan2.' '.$mmsaldounit3.''.$msatuan3.'';
	$mjadi=trim($mjadi);
	return $mjadi;
}

function borders($mleft,$mright,$mtop,$mbottom,$mwidth)
{
	$hasil="";

	if ($mleft==1)
	{
		$hasil=$hasil."border-left-style:solid;";
	}

	if ($mright==1)
	{
		$hasil=$hasil."border-right-style:solid;";
	}

	if ($mtop==1)
	{
		$hasil=$hasil."border-top-style:solid;";
	}

	if ($mbottom==1)
	{
		$hasil=$hasil."border-bottom-style:solid;";
	}

	if ($mwidth>0)
	{
		$hasil=$hasil."border-width:".$mwidth."px;";
	}

	return $hasil;
}
?>