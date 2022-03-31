<?php
$mkomn=gethostbyaddr($_SERVER['REMOTE_ADDR']);
if ($mkomn!='MUHTAR-PC')
{
return;
}

    $src="d:/xampp/mysql/data/siamart_2jaya_data/";
    $dir = opendir($src);
    $dst="e:/dropbox/data_sumberj/";
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
				if ( files_are_equal($src . '/' . $file,$dst . '/' . $file) !=1  )
				{
				echo files_are_equal($src . '/' . $file,$dst . '/' . $file);
				echo '<br> '.$file;
                copy($src . '/' . $file,$dst . '/' . $file); 
				}
            } 
        } 
    } 
    closedir($dir); 


function files_are_equal($a, $b)
{
  // Check if filesize is different
  if(filesize($a) !== filesize($b))
      return false;

  // Check if content is different
  $ah = fopen($a, 'rb');
  $bh = fopen($b, 'rb');

  $result = true;
  while(!feof($ah))
  {
    if(fread($ah, 8192) != fread($bh, 8192))
    {
      $result = false;
      break;
    }
  }

  fclose($ah);
  fclose($bh);

  return $result;
}
	
?>