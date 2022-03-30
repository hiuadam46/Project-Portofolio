<?php
$mkomn=gethostbyaddr($_SERVER['REMOTE_ADDR']);


date_default_timezone_set('Asia/Jakarta');
    $mdedir=date("dmY-g.ia");
	$maa=date("d-m-Y");
    $mdedir2=date("dmY",strtotime("$maa -5 day"));
	echo $mdedir2;
    $mask="d:/backup/metro".$mdedir2."*.*";

if ($mkomn!='server-PC')
{
return;
}	
    array_map("unlink",glob($mask));
	//return;
    Zip("D:/xampp/mysql/data/siamart_metro_data/","d:/backup/metro".$mdedir.".zip");
/*    $src="d:/xampp/mysql/data/siamart_zigzag_data";
    $dir = opendir($src);
    $dst="e:/backup$mdedir";
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
*/

function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

//echo " <script type='text/javascript'> window.close() </script>";
?>