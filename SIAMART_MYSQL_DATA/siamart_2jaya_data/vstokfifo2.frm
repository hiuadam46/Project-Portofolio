TYPE=VIEW
query=select `a`.`bpid` AS `stoid`,`a`.`bpid2` AS `lokid`,`a`.`nid` AS `nid`,`a`.`tgl` AS `tgl`,(sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) AS `saldoqty`,round((sum(`a`.`debet`) / sum(`a`.`qtyin`)),0) AS `hpp` from (`siamart_2jaya_data`.`bkbesar` `a` left join `siamart_2jaya_data`.`bkbesar` `b` on(((`a`.`bpid` = `b`.`bpid`) and (`a`.`nid` = `b`.`nid2`) and (`b`.`qtyout` <> 0)))) where ((`a`.`rekid` like \'103%\') and (`a`.`qtyin` <> 0)) group by `a`.`bpid`,`a`.`bpid2`,`a`.`nid`,`a`.`tgl`,`a`.`qtyin` having ((sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) > 0)
md5=f85e4c82f6fe8e3e0fcb64c9b879621b
updatable=0
algorithm=0
definer_user=root
definer_host=localhost
suid=1
with_check_option=0
timestamp=2017-03-08 03:44:49
create-version=1
source=select\n  `a`.`bpid`  AS `stoid`,\n  `a`.`bpid2` AS `lokid`,\n  `a`.`nid`   AS `nid`,\n  `a`.`tgl`   AS `tgl`,\n  (sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) AS `saldoqty`,\n  round((sum(`a`.`debet`) / sum(`a`.`qtyin`)),0) AS `hpp`\nfrom (`bkbesar` `a`\n   left join `bkbesar` `b`\n     on (((`a`.`bpid` = `b`.`bpid`)\n          and (`a`.`nid` = `b`.`nid2`)\n          and (`b`.`qtyout` <> 0))))\nwhere ((`a`.`rekid` like \'103%\')\n       and (`a`.`qtyin` <> 0))\ngroup by `a`.`bpid`,`a`.`bpid2`,`a`.`nid`,`a`.`tgl`,`a`.`qtyin`\nhaving ((sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) > 0)
client_cs_name=utf8
connection_cl_name=utf8_general_ci
view_body_utf8=select `a`.`bpid` AS `stoid`,`a`.`bpid2` AS `lokid`,`a`.`nid` AS `nid`,`a`.`tgl` AS `tgl`,(sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) AS `saldoqty`,round((sum(`a`.`debet`) / sum(`a`.`qtyin`)),0) AS `hpp` from (`siamart_2jaya_data`.`bkbesar` `a` left join `siamart_2jaya_data`.`bkbesar` `b` on(((`a`.`bpid` = `b`.`bpid`) and (`a`.`nid` = `b`.`nid2`) and (`b`.`qtyout` <> 0)))) where ((`a`.`rekid` like \'103%\') and (`a`.`qtyin` <> 0)) group by `a`.`bpid`,`a`.`bpid2`,`a`.`nid`,`a`.`tgl`,`a`.`qtyin` having ((sum(`a`.`qtyin`) - sum(ifnull(`b`.`qtyout`,0))) > 0)
