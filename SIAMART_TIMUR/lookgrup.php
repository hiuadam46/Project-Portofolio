<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Lookup Grup</title>
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript">
    var $Pcs2 = jQuery.noConflict();
	$Pcs2(document).ready(function(){

		$Pcs2(document).keydown(function(){
			var mmv=event.keyCode
			//alert(mmv);
			if (mmv==27){
			
			parent.cdialog.click();
			mobj=obj.value;
			parent.$Pcs("#"+mobj).focus();
			parent.$Pcs("#"+mobj).select();

			}

			if (mmv==13){

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
			opener.fsetstok.mgrpid.value=isi;
			self.close();
			opener.focus();
			opener.fsetstok.mgrpid.focus();
			opener.fsetstok.mgrpid.blur();
			opener.fsetstok.mgrpid.select();
			return;
			}
			
			}
			
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
            width: '685px',
            height: '500px',
            title: 'Daftar Grup',
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
                id : 'grpid',
                title : 'Kode',
                width : 80,
                editable: false,
            },
            {
                id : 'grpnama',
                title : 'Nama Grup',
                width : 530,
                editable: false,
            },
			
        ],
	url: "item.php",

<?php
	echo("request:".'"msql=select grpid,grpnama from setgrp where concat(grpid,grpnama) like'."'!!".$mCari."!!'".'order by grpid"');
?>	
    };

    var tableGrid1 = null;
    window.onload = function() {
        tableGrid1 = new MyTableGrid(tableModel);
        tableGrid1.render('mytable1',true);
        $('contactLink').onclick = function() {
            if ($('contact').getStyle('display') == 'none') {
                Effect.BlindDown('contact');
            } else {
                Effect.BlindUp('contact');
            }
        };
    };

	
</script></head>

<body onblur='opener.focus();this.focus()' bgcolor='#285c00'>
            <div id="mytable1" style="position:relative; width: 685px; height: 500px; background-color:white"></div>
			<?php
			echo("<input type='hidden' id='obj' value='$mobj'>");
			?>

</body>
</html>