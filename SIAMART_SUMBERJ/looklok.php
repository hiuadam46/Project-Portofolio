<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Lookup Lokasi</title>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript">
    var $Pcs2 = jQuery.noConflict();
	var mwh=window.innerWidth-2
	var mht=window.innerHeight-32

	$Pcs2(document).ready(function(){

	$Pcs2(document).keydown(function(){
			var mmv=event.keyCode
			mmf=tableGrid1.keys.thefocus;
			mmf2=event.element(event).id
			
			//alert(mmf)

			//alert(mmv);
			
			if (mmv==27){
			
			parent.cdialog.click();
			mobj=obj.value;
			parent.$Pcs("#"+mobj).focus();
			parent.$Pcs("#"+mobj).select();

			}

			if (mmv==13 && mmf2!='mfilter'){
		//alert(mmf)
			mm=tableGrid1.keys._yCurrentPos;
			isi=tableGrid1.getValueAt(1,mm);
			isi2=tableGrid1.getValueAt(2,mm);
			mfilt=isi+'-'+isi2;
			mobj=obj.value;
			
			if (mobj=='tcari')
			{
			parent.$Pcs("#"+mobj).val(mfilt);
			parent.cdialog.click();
			parent.$Pcs("#"+mobj).focus();
			parent.$Pcs("#"+mobj).select();
			return;
			}

			if (mobj=='setstok1')
			{
			opener.fsetstok.mlokid.value=isi;
			self.close();
			opener.focus();
			opener.fsetstok.mlokid.focus();
			opener.fsetstok.mlokid.blur();
			opener.fsetstok.mlokid.select();
			return;
			}

			if (mobj=='looklokbeli')
			{
			parent.tableGrid1.setValueAt(isi,parent.tableGrid1.keys._xCurrentPos,parent.tableGrid1.keys._yCurrentPos);
			parent.tableGrid1.setValueAt(isi2,parent.tableGrid1.keys._xCurrentPos+1,parent.tableGrid1.keys._yCurrentPos);
			parent.focustogrid(0,parent.tableGrid1.keys._yCurrentPos+1)
			parent.$Pcs2("#kotakdialog2").dialog("close");
			
			return;
			}

			if (mobj=='looksupbeli')
			{
			parent.fform.msupid.value=isi;
			parent.fform.msupnama.value=isi2;
			parent.fform.mtunaikredit.focus();
			parent.$Pcs2("#kotakdialog2").dialog("close");			
			return;
			}
			
			}
			
		});

		$Pcs2("#mfilter").keyup(function(){
		mCari=$Pcs2("#mfilter").val()
		tableGrid1.request="msql=select * from setlok where concat(lokid,loknama) like '!!"+mCari+"!!'";
		tableGrid1.refresh(0,0,false);
		});

		$Pcs2("#mfilter").keydown(function(){
		if (event.keyCode==13)
		{
			$Pcs2("#mfilter").blur()
			tableGrid1.refresh(0,0,false);
		}
		});
		
		$Pcs2("#mytable1").css({
		'position':'relative',
		'width': mwh+'px',
		'height': mht+'px',
		'background-color':'white',
		'font-size':'12',
		});
		
	});
	</script>
    <link type="text/css" href="css/main.css" rel="stylesheet">
    <link type="text/css" href="css/mytablegrid.css" rel="stylesheet">
    <link type="text/css" href="css/shCore.css" rel="stylesheet">
    <link type="text/css" href="css/shThemeRDark.css" rel="stylesheet" id="shTheme">
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js"></script>
	<script type="text/javascript" src="js/builder.js"></script>
	<script type="text/javascript" src="js/effects.js"></script>
	<script type="text/javascript" src="js/dragdrop.js"></script>
	<script type="text/javascript" src="js/controls.js"></script>
	<script type="text/javascript" src="js/slider.js"></script>
	<script type="text/javascript" src="js/sound.js"></script>
    <script type="text/javascript" src="js/mytablegrid.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<script type="text/javascript" src="js/format.js"></script>
	<script type="text/javascript" src="js/tablegrid.js"></script>
	<script type="text/javascript" src="js/keytable.js"></script>
	<script type="text/javascript" src="js/controls_002.js"></script>
    <script type="text/javascript" src="js/shCore.js"></script>
    <script type="text/javascript" src="js/shBrushJScript.js"></script>
    <script type="text/javascript" src="js/shBrushXml.js"></script>
    <script type="text/javascript" src="js/shBrushPlain.js"></script>
    <script type="text/javascript">

    function toggleSampleCode(id, element) {
        if ($(id).getStyle('display') == 'none') {
            Effect.BlindDown(id);
            element.innerHTML = 'Hide sample code';
        } else {
            Effect.BlindUp(id);
            element.innerHTML = 'See sample code';
        }
    }

    var countryList = [
        {value: 'UK', text: 'United Kingdon'},
        {value: 'US', text: 'United States'},
        {value: 'CL', text: 'Chile'}
    ];


    var tableModel = {
        options : {
            width: mwh+'px',
            height: mht+'px',
            title: 'Daftar Lokasi',
            rowClass : function(rowIdx) {
                var className = '';
                if (rowIdx % 2 == 0) {
                    className = 'hightlight';
                }
                return className;
            },
			
			pager: {
                total: 100,
                pages: 1,
                currentPage: 1,
                from: 1,
                to: 100
            },

        },
        columnModel : [
            {
                id : 'nomor',
                title : 'No.',
                type: 'number',				
                width : 40,
                editable: false,
            },
            {
                id : 'lokid',
                title : 'Kode',
                width : 80,
                editable: false,
            },
            {
                id : 'loknama',
                title : 'Nama',
                width : 200,
                editable: false,
            },
            {
                id : 'ket',
                title : 'Keterangan',
                width : 300,
                editable: false,
            },
        ],
	url: "item.php",

<?php
	echo("request:".'"msql=select * from setlok where concat(lokid,loknama) like'."'!!".$mCari."!!'".'"');
?>	
    };

    var tableGrid1 = null;
    window.onload = function() {
		$Pcs2("#mfilter").focus()
        tableGrid1 = new MyTableGrid(tableModel);
        tableGrid1.render('mytable1',false,0,0);
        $('contactLink').onclick = function() {
            if ($('contact').getStyle('display') == 'none') {
                Effect.BlindDown('contact');
            } else {
                Effect.BlindUp('contact');
            }
        };
    };

	function focustogrid(xx,yy){
		cell = tableGrid1.keys.getCellFromCoords(xx,yy);
		tableGrid1.keys.setFocus(cell);
		tableGrid1.keys.captureKeys();
		tableGrid1.keys.eventFire("action", tableGrid1.keys._nCurrentFocus);
	}
	
</script></head>

<body bgcolor='#285c00'>
			<font color=white size=3>Filter <input type=text id=mfilter size=50> <i>(Kode,Nama Lokasi)</i> </font> 
            <center><div id="mytable1"></div></center>
			<?php
			echo("<input type='hidden' id='obj' value='$mobj'>");
			?>

</body>
</html>