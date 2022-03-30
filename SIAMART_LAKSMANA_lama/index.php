<html>

<head>
</head>

<body style="background-color: #BBCCDD; background-image: url('images/num.jpg')">

<div id="kotak0" class="demo" style="font-family: Arial; font-size: 12pt">
	<span id="pesan3">Silahkan Login :</span> </div>
<div id="kotak" class="demo" style="font-family: Arial; font-size: 12pt">
	<p>ID : <br><input id="username" type="password"> <span id="pesan">
	<label style="font-size: 8pt">Isi lalu tekan enter</label></span></p>
	<p>Password : <br><input id="password" type="password"> <span id="pesan2">
	<label style="font-size: 8pt">Isi lalu tekan enter</label></span></p>
</div>
<!-- <link rel="stylesheet" href="main.css" type="text/css"> -->
<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="js/jquery.corner.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var mws=screen.width
	var mhs=screen.height
	var mw=(screen.width/2)-(360/2)
	var mh=(screen.height/2)-(300/2)
	$("#kotak").corner()
	$("#Header").corner("bottom 20px")

	setInterval(function()
	{
		$('#kotak0').load('phpexec.php','funcg=JAMDINDING');
	}, 1000);

	$('#Header').css(
	{
		'position':'absolute',
		'left':'5px',
		'top':'-5px',
		'width':mws-30+'px',
		'height':'50px',
		'background-color':'Blue',
		'background-image':'url(images/back5.jpg)',
		'padding-left':'10px',
		'padding-top':'10px',
		'padding-bottom':'10px',
		'border-color':'white',
		'border-style':'solid',
		'border-width':'5px'
	})

	$('#kotak0').css(
	{
		'position':'absolute',
		'left':mw+'px',
		'top':mh-30+'px',
		'width':'360px',
		'height':'55px',
	})

	$('#kotak').css(
	{
		'position':'absolute',
		'left':mw+'px',
		'top':mh+'px',
		'width':'360px',
		'height':'120px',
		'background-image':'url(images/backt.png)',
		'padding-left':'10px',
		'padding-top':'10px',
		'padding-bottom':'10px',
		'border-color':'white',
		'border-style':'solid',
		'border-width':'thin'
	})

	$('#username').focus()
	$('#username').select()
	$('#username').keydown(function()
	{
		var kunci=event.keyCode;
		if (kunci==13)
		{
			$('#username').blur()
		}
	})
	$('#password').keydown(function()
	{
		var kunci=event.keyCode;
		if (kunci==13)
		{
			$('#password').blur()
		}
	})
	$("#username").blur(function()
	{
		// tampilkan animasi loading saat pengecekan ke database
		$('#pesan').html("<img src='images/loader.gif' /> checking ...");
		var username = $("#username").val();

		$.ajax(
		{
			type:"POST",
			url:"phpexec.php",
			data: "func=LOGIN1&id="+username,
			success: function(data)
			{
				mnam=data
				if(mnam=='')
				{
					$("#pesan").html('<img src="images/cross.png">');
					$('#username').css('border', '3px #C33 solid');
					$('#username').focus();
					$('#username').select();
				}
				else
				{
					mnam=mnam.trim()
					$("#pesan").html('<img src="images/tick.png"> : '+mnam);
					$('#username').css('border', '3px #090 solid');
					$('#password').focus();
					$('#password').select();
				}
			}
		});
	})

	$("#password").blur(function()
	{
		// tampilkan animasi loading saat pengecekan ke database
		$('#pesan2').html("<img src='images/loader.gif' /> checking ...");
		var username = $("#username").val();
		var password = $("#password").val();
		$.ajax(
		{
			type:"POST",
			url:"phpexec.php",
			data: "func=LOGIN2&id="+username+"&password="+password,
			success: function(data)
			{
				mp=data;
				if(mp=='')
				{
					$("#pesan2").html('<img src="images/cross.png">');
					$('#password').css('border', '3px #C33 solid');
					if ($('#password').val()!='')
					{
						$('#password').focus();
						$('#password').select();
					}
				}
				else
				{
					$("#pesan2").html('<img src="images/tick.png">');
					$('#password').css('border', '3px #090 solid');
					window.location='mainwall.php?';
					//msgWindow=window.open('mainwall.php','windowName','toolbar=no');
					//msgWindow.focus()
					//self.close()
				}
			}
		});
	})
});
</script>

</body>

</html>
