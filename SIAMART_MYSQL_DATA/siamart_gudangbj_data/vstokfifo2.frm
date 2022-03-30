TYPE=VIEW
query=select `a`.`bpid` AS `stoid`,`a`.`bpid2` AS `lokid`,`a`.`nid` AS `nid`,`a`.`tgl` AS `tgl`,(sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) AS `saldoqty`,round((sum(`a`.`debet`) / sum(`a`.`qtyin`)),0) AS `hpp` from (`siamart`.`bkbesar` `a` left join `siamart`.`bkbesar` `b` on(((`a`.`bpid` = `b`.`bpid`) and (`a`.`nid` = `b`.`nid2`) and (`b`.`qtyout` <> 0)))) where ((`a`.`rekid` like \'103%\') and (`a`.`qtyin` <> 0)) group by `a`.`bpid`,`a`.`bpid2`,`a`.`nid`,`a`.`tgl`,`a`.`qtyin` having ((sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) > 0)
md5=966b2e60ca4962a74e16ab5f416922ab
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=1
with_check_option=0
timestamp=2012-10-24 09:34:57
create-version=1
source=select  `a`.`bpid`  AS  `stoid` ,\n `a`.`bpid2`  AS  `lokid` ,\n `a`.`nid`  AS  `nid` ,\n `a`.`tgl`  AS  `tgl` ,\n( sum(  `a`.`qtyin`  )  - sum( ifnull(  `b`.`qtyout` , 0  )  )  ) AS  `saldoqty` ,\nround( ( sum(  `a`.`debet`  )  / sum(  `a`.`qtyin`  )  ) ,\n0 ) AS  `hpp`  from (  `siamart`.`bkbesar`  `a`  left  join  `siamart`.`bkbesar`  `b`  on ( ( (  `a`.`bpid`  =  `b`.`bpid`  ) and (  `a`.`nid`  =  `b`.`nid2`  ) and (  `b`.`qtyout`  <>0 ) )  ) ) where ( (  `a`.`rekid`  like  \'103%\' ) and (  `a`.`qtyin`  <>0 ) ) group  by  `a`.`bpid` ,\n `a`.`bpid2` ,\n `a`.`nid` ,\n `a`.`tgl` ,\n `a`.`qtyin`  having ( ( sum(  `a`.`qtyin`  )  - sum( ifnull(  `b`.`qtyout` , 0  )  )  ) >0 )
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `a`.`bpid` AS `stoid`,`a`.`bpid2` AS `lokid`,`a`.`nid` AS `nid`,`a`.`tgl` AS `tgl`,(sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) AS `saldoqty`,round((sum(`a`.`debet`) / sum(`a`.`qtyin`)),0) AS `hpp` from (`siamart`.`bkbesar` `a` left join `siamart`.`bkbesar` `b` on(((`a`.`bpid` = `b`.`bpid`) and (`a`.`nid` = `b`.`nid2`) and (`b`.`qtyout` <> 0)))) where ((`a`.`rekid` like \'103%\') and (`a`.`qtyin` <> 0)) group by `a`.`bpid`,`a`.`bpid2`,`a`.`nid`,`a`.`tgl`,`a`.`qtyin` having ((sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) > 0)
