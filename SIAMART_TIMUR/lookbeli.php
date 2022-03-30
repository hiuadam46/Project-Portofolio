<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Lookup Satuan</title>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript">
    var $Pcs2 = jQuery.noConflict();
	var mwh=window.innerWidth-2
	var mht=window.innerHeight-32
	var mstt="<?php echo($mstoid); ?>"
	var mndd="<?php echo($mnid); ?>"

	$Pcs2(document).ready(function(){

	$Pcs2(document).keydown(function(){
			var mmv=event.keyCode
			mmf=tableGrid1.keys.thefocus;
			mmf2=event.element(event).id
			

			//alert(mmv);
			
			if (mmv==27){
			
			parent.cdialog.click();
			mobj=obj.value;
			parent.$Pcs("#"+mobj).focus();
			parent.$Pcs("#"+mobj).select();

			}

			if (mmv==13){
		//alert(mmf)
			mm=tableGrid1.keys._yCurrentPos;
			isi=tableGrid1.getValueAt(1,mm);
			isi2=tableGrid1.getValueAt(2,mm);
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
			opener.fsetstok.mstoid.value=isi;
			self.close();
			opener.focus();
			opener.fsetstok.mstoid.focus();
			opener.fsetstok.mstoid.blur();
			opener.fsetstok.mstoid.select();
			return;
			}

			if (mobj=='lookbelireturbeli')
			{
			parent.$Pcs2("#mnid2").val(isi);
			parent.$Pcs2("#mtgl2").val(isi2);
			parent.$Pcs2("#mket").focus();
			parent.$Pcs2("#kotakdialog2").dialog("close");			
			return;
			}

			if (mobj=='looksatjual')
			{
			parent.tableGrid1.setValueAt(isi,parent.tableGrid1.keys._xCurrentPos,parent.tableGrid1.keys._yCurrentPos);
			parent.focustogrid(4,parent.tableGrid1.keys._yCurrentPos)
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
 
	msupidd=parent.$Pcs2("#msupid").val();

    var tableModel = {
        options : {
            width: mwh+'px',
            height: mht+'px',
            title: 'Daftar Pembelian',
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
                editable: true,
            },
            {
                id : 'nid',
                title : 'No.',
                width : 80,
                editable: false,
            },
            {
                id : 'tglc',
                title : 'Tgl',
                width : 80,
                editable: false,
            },
		],
	url: "item.php?mTparam=lkbbbl&msupidd="+msupidd,
	request: " ", 

    };

    var tableGrid1 = null;
    window.onload = function() {
        tableGrid1 = new MyTableGrid(tableModel);
        tableGrid1.render('mytable1',true,0,0);
		focustogrid(0,0)
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
            <center><div id="mytable1"></div></center>
			<?php
			echo("<input type='hidden' id='obj' value='$mobj'>");
			?>

</body>
</html>