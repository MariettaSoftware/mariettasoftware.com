<?php 
if($_GET["mobile"]==true)
{
	//header('Location: http://detectmobilebrowser.com/mobile');
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<?php
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
}
?>

<html>
<head><title>Marietta Online 1.4 Alpha</title></head>
<body>
<?php
	$entry = $_GET["name"];
	$book = $_GET["book"];
	$ref = $_GET["ref"];
	$index = strpos($entry, ".msong");			
	$title = substr($entry, 0, $index);
	
	$songfilepath = $_SERVER['DOCUMENT_ROOT'] . "/mariettasoftware/songfinder/Bookshelf/" . $book. "/" . $entry;
?>
<a href="bookindex.php?name=<?php echo name; ?>">Index</a>
<h2>
<?php


	
	$file = fopen($songfilepath, "r");
	
	$headerline = fgets($file);
	//echo "header line: \'$headerline\'<br/>";
	if(strpos($headerline, "Song:") ===false)
	{
		echo "Invalid Song file: $entry";
		die;
	}
	
	$titleline = fgets($file);//, "%d.  %s", $number, $title2);
	
	$point = strpos($titleline, ".");
	$number = substr($titleline, 0, $point);
	$title2 = substr($titleline, $point);
	trim($title2);
	
	
	echo $number . " " . $title2;
	$currentverse = 1;
	$i = 0;
	$lastline = "";
	define("CHORDS_LINE", 1);
	define("VERSE_LINE", 2);
	$lastlinetype = 0;
	echo "<pre style=\"font-size: 10pt\">";
	while( ($currentline = fgets($file)) !== false)
	{
		$patterns = array();
		if(preg_match("#Words:.*#", $currentline) || preg_match("#Melody:#", $currentline)||
			preg_match("#Words and Music:#", $currentline) ||
			preg_match("#Copyright:#", $currentline) ||
			preg_match("#Source:#", $currentline) ||
			preg_match("#CCLI:#", $currentline))
		{
		  continue;
		}
		else if(preg_match("#V:#i", $currentline) || preg_match("#Verse:#i", $currentline))
		{
			$currentverse++;
			echo "<hr/>";
			continue;		
		}
		else if(preg_match("#Chorus:#", $currentline))
		{
			echo "<hr/>";

		}
//		if(preg_match("/^[ ]*[A-G][b\#]?[ A-Gsum\+24679Mb#°ø\[\]\(\)]*/", $currentline))
		
//		if(preg_match("/^[ ]*[A-G][sum\+24679Mb#°ø\[\]\(\)]?[b\#]?/", $currentline, $patterns))
		/*else if(preg_match("/^[ ]*[^acdefghijklnopqrtvwxyz123456789H-LN-Z]*$/", $currentline, $patterns))
		{
			if($lastlinetype != CHORDS_LINE)
			{
				echo "[Chords line found]";
			}
			$lastlinetype = CHORDS_LINE;
			print_r($patterns);
//			continue;						
		}
		*/
		else $lastlinetype = 0;
		/*if(strlen($currentline) == 2 && $currentline == $lastline)
		{
			
			
		}	
		else*/ //echo "[$i]". "'$currentline'". "";
		echo $currentline;
		++$i;
		$lastline = $currentline;
	}
	echo "</pre>";
	
	//$contents = fread($file, filesize($songfilepath));
	
	//echo "<pre>$contents</pre>";
	
	fclose($file);
	
	
?>
</h2>
</body>
</html>