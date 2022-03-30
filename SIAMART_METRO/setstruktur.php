<?php

require("utama.php");

execute("ALTER TABLE bkbesar CHANGE debet debet DOUBLE( 15, 0 ) NOT NULL DEFAULT '0'");

execute("ALTER TABLE bkbesar CHANGE kredit kredit DOUBLE( 15, 0 ) NOT NULL DEFAULT '0'");

execute("delete from setmenu where menuid='ME076'");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME076',' ','Tagihan Sales','transfakturtagihan.php'      ,'settings.png','ME033'       ,'2'  ,'1'  ,'ME076')");
	     

execute("alter table transjual1 add tagihanid char(20) default '' ");

execute("delete from setmenu where menuid like '%ME001%' or menuinduk like '%ME001%' ");
execute("delete from setmenu where menuid like '%ME004%' or menuinduk like '%ME004%' ");
execute("delete from setmenu where menuid like '%ME010%' or menuinduk like '%ME010%' ");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME001','topmenu','Master',''      ,'settings.png',''       ,'1'  ,'1'  ,'ME001')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME002',' ','Suplier','setsup.php'      ,'settings.png','ME001'       ,'1'  ,'1'  ,'ME002')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME003',' ','Pelanggan','setlgn.php'      ,'settings.png','ME001'       ,'2'  ,'1'  ,'ME003')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME004',' ','Persediaan',' '      ,'settings.png','ME001'       ,'3'  ,'0'  ,'ME004')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME005',' ','Lokasi','setlok.php'      ,'settings.png','ME001'       ,'4'  ,'1'  ,'ME005')");
	     
execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME006',' ','Grup','setgrup.php'      ,'settings.png','ME001'       ,'5'  ,'1'  ,'ME00306')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME007',' ','Satuan','setsatuan.php'      ,'settings.png','ME001'       ,'6'  ,'1'  ,'ME007')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME008',' ','Stok','setstok.php'      ,'settings.png','ME001'       ,'7'  ,'1'  ,'ME008')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME009',' ','Saldo Awal','setsaldostok2.php'      ,'settings.png','ME001'       ,'8'  ,'1'  ,'ME009')");
	     	     
execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME010',' ','Akuntansi',' '      ,'settings.png','ME001'       ,'9'  ,'1'  ,'ME010')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME011',' ','Klasifikasi','setklas.php'      ,'settings.png','ME010'       ,'1'  ,'1'  ,'ME011')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME012',' ','Neraca','setnrc.php'      ,'settings.png','ME010'       ,'2'  ,'1'  ,'ME012')");
	     
execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME013',' ','Rekening','setrek.php'      ,'settings.png','ME010'       ,'3'  ,'1'  ,'ME013')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME014',' ','Promo','setpromo.php'      ,'settings.png','ME001'       ,'10'  ,'1'  ,'ME014')");

execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME015',' ','Sales','setkaryawan.php'      ,'settings.png','ME001'       ,'11'  ,'1'  ,'ME015')");
	     
execute("insert into setmenu(menuid ,menupos  ,menucapt,menufile,menupict      ,menuinduk,nomor,aktif,ids) 
             values('ME015',' ','Sales','setkaryawan.php'      ,'settings.png','ME001'       ,'11'  ,'1'  ,'ME015')");

	     ?>