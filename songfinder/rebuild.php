<?php



echo "Rebuilding Song Database...";

function GetName($file)
{
			$result = "";
			
			$count = strlen($file);
			
			if(!$count)
				return $result;
			
			$endname = strstr($file, ".msong");
			if($endname !== false)
			{
				$result = substr($file, 0, strlen($file)-6);
			}
			
			//$result = $file[0];	
			
			/*for($i = 1; $i < $count; $i++)
			{
				if(ctype_space($file[$i]))
				  continue; 
			
			
				if(!(ctype_alpha($file[$i]) || ctype_punct($file[$i])))
				{
					$digitcount = 0;
					$j = $i;
					while(ctype_digit($file[$j])) 
					{
						$j++;
						$digitcount++;
						//echo $j;
					}
					if($digitcount == 0 || $digitcount > 3)
						return $result;
				}
					
				if(ctype_upper($file[$i]))
				{
					$ch = $result[strlen($result)-1];
					if(!(ctype_space($ch) || ctype_punct($ch)))
	 					$result .= " ";
				}
				$result .= $file[$i];
			}*/
			
			return $result;
		}
		
		function FindDate($file)
		{
			$index = 0;
			$count = strlen($file);
			
			//echo $file ."<br>";
			
			if(!$count)
				return -1;
				
			$i = 0;
			$foundit = false;
			do {
			
				while(!ctype_digit($file[$i]))
					++$i;
					
				$numbercount = 0;
				$index = $i;
				
				while(ctype_digit($file[$i]))
				{
					$numbercount++;
					$i++;
				}	
				if($numbercount == 8)
					$foundit = true;
				else $i = $index + 1;
			
			} while(!$foundit && $i < $count);
			
				
			return $index;
		}
		
		function MyGetDate($file, &$end)
		{
			$result = "";
			
			$count = strlen($file);
			
			if(!$count)
				return $result;
				
			$i = FindDate($file);
			//while(!ctype_digit($file[$i]))
			//	++$i;
			
			$year = substr($file, $i, 4);
			$month = substr($file, $i + 4, 2);
			$day = substr($file, $i+ 6, 2);
			
			$end = $i + 8;
			
			//echo "$file: s=$i, e=$end<br/>";
			
			return  $year . "-" . $month . "-" . $day;
			
		}
		function MyGetDateEx($file, &$year, &$month, &$day)
		{
			$result = "";
			
			$count = strlen($file);
			
			if(!$count)
				return $result;
				
			$i = 0;
			while(!ctype_digit($file[$i]))
				++$i;
			
			$year = substr($file, $i, 4);
			$month = substr($file, $i + 4, 2);
			$day = substr($file, $i+ 6, 2);
			
			return $month . "/" . $day . "/" . $year;
			
		}
		function MyGetTopic($file, $begin)
		{
			$result = "";
			
			$count = strlen($file);
			
			if(!$count)
				return $result;
				
			$result = //strrchr($file, "-");
					substr($file, $begin);
			
			$count = strlen($result);
			
//			$result = substr($result, 1, $count-5);
			$result = substr($result, 1, $count-5);
			
			if(strlen($result) == 1)
				$result = "";
			
			return $result;
		}
		
		function ReadFolder($folder)
		{
			//echo "reading $folder<br/>";
			$mp3files = opendir($_SERVER['DOCUMENT_ROOT'] . $folder);
			if(mp3files)
			{		
				echo "<ul>";
				$file = "";
				   while (false !== ($file = readdir($mp3files))) {
				     if(is_dir($_SERVER['DOCUMENT_ROOT'] . $folder . "/" . $file))
					 {
					 	if($file != "." && $file != "..")
						{
							echo "<li>";
							echo "<b>$file</b>";
							ReadFolder($folder . "/" . $file);
						}
					 }
				     else
					 {
	       				echo "<li><a href=\"$folder/$file\">";
						
						echo GetName($file);
						echo "</a>\n";
						echo "(";
						$end = 0;
						$thedate = MyGetDate($file, $end);
						echo substr($thedate, 0, strlen($thedate)-5);
						echo ")";
						$topic = MyGetTopic($file, $end);	
						
						if(strlen($topic))
						{
							echo " - ";
							echo $topic;
						}					
					 }
				   }
				echo "</ul>";
				closedir($mp3files);
			}
			
		}
		class SongData
		{
	//		var $Speaker;
			//var $DateString;
			//var $Month, $Day, $Year;
//			var $Meeting;
			//var $Topic;
			var $BookName;
			var $FileName;

			
			function SongData($bookname, $filename)
			{
				$BookName = $bookname;
				$FileName = $filename;
			}
		}
		
		function CompareSongFiles($file1, $file2)
		{
			//if($file1->Year < $file2->Year)
			//	return -1;
			//else if($file1->Year > $file2->Year)
			//	return 1;
			//else 
			{
				//sort by meeting name
				
				//sort by date
				
				//sort by Name
			}
			return 1;
		}
		
		//$SongFiles =  array();
//		$currentyear = 1900;
		$currentbook = "book not found!";
		$currentindex = 101;
		
		function ReadFolderEx($folder, $level)
		{
			//echo "reading $folder<br/>";
			
			global $currentindex;
			global $connection;
			global $currentbook;
			//global $connection;
			
			echo "ReadFolderEx($folder, $level)<br>";
			
			if($level == "msongbook")
			{
				$info = pathinfo($folder);
				$currentbook = $info["basename"];		
			}
			
			$songfiles = opendir($_SERVER['DOCUMENT_ROOT'] . $folder);
			if($songfiles)
			{		
				echo "<ul>";
				$file = "";
				   while (false !== ($file = readdir($songfiles))) {
				     if(is_dir($_SERVER['DOCUMENT_ROOT'] . $folder . "/" . $file))
					 {
					 	if($file != "." && $file != ".." && $file != "_notes")
						{
							//echo "<li>";
//							echo "<b>$file</b>";
							$nextlevel = "msong";
							switch($level)
							{
								case "root": 	$nextlevel = "msongbook"; break;
								case "msongbook": $currentbook = $file; echo "songbook folder"; break;
							}
								
							ReadFolderEx($folder . "/" . $file, $nextlevel);
						}
					 }
				     else if(strstr($file, ".msong") != FALSE)
					 {
	       				//echo "<li><a href=\"$folder/$file\">";
						
						$name = GetName($file);
	//					echo "</a>\n";
		//				echo "(";
//						$end = 0;
						//$month = $day = $year = 0;
	//					$thedate = MyGetDate($file, $end);
//						echo $thedate; //substr($thedate, 0, strlen($thedate)-5);
	//					echo ")";
		//				$topic = MyGetTopic($file, $end);	
						
						//echo $file . "-date:" . $thedate; 
						
			//			if(strlen($topic))
				//		{
					//		echo " - ";
						//	echo $topic;
						//}				
						echo "<br>";
						
						//$n = new AudioData(GetName($file), $month, $day,  $year, $thedate,  $currentmeeting, $topic, $file);
							//					$AudioFiles[]  = $n;
							//$year = substr($thedate, 0, 4);
							$path = pathinfo($folder);
							$filename = mysql_real_escape_string($folder . "/" . $file, $connection);
							$pubdate = filectime($_SERVER['DOCUMENT_ROOT'] . $filename);
							//echo "$filename: $pubdate<br/>";
							
							if(strlen($pubdate) == 0)
							{
								$pubdate = strtotime($thedate);
							}
							
							
							$query = "Insert into songs (id, `SongName`, `BookName`, `FileName`, `PublishedDate`) VALUES (
							$currentindex, '" . mysql_real_escape_string($name, $connection) ."','" . mysql_real_escape_string($currentbook, $connection) ."', '" .$filename . "', $pubdate )";
							//echo "$query<br/>";
						$result = mysql_query($query, $connection);
						
						
						if(!$result)
							echo "<p>" . $currentindex . ": ". $query ."<br>".mysql_error();
						//var_dump($n);
						$currentindex++;
					 }
				   }
				echo "</ul>";
				closedir($mp3files);
			}
		}

		/*global $mysql_server;
		global $mysql_user;
		global $mysql_password;
		global $mysql_database;
		*/
		include_once "login.php";
        //$server = "montebel.ipowermysql.com";
		// echo "$mysql_server, $mysql_user, $mysql_password";
        if($_SERVER["DOCUMENT_ROOT"][0] == 'D')
            $mysql_server = "localhost";
		 //echo "$mysql_server, $mysql_user, $mysql_password";
		 $connection = mysql_connect($mysql_server, $mysql_username, $mysql_password);
		 if(!mysql_select_db($mysql_database, $connection))
		 {
		 	die("rebuild.php: " . mysql_error());
		 }
	if( mysql_num_rows( mysql_query("SHOW TABLES LIKE 'songs'")))
	{
		mysql_query("DROP TABLE songs") or die("drop - " . mysql_error());
	}
			 
	
		 mysql_query("CREATE TABLE `songs` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	`SongName` TEXT NOT NULL,
	`BookName` TEXT NOT NULL,
  `FileName` TEXT NOT NULL,
  `PublishedDate` INTEGER, 
  PRIMARY KEY(`id`),
  FULLTEXT(SongName, BookName))") or die(mysql_error());
  
		 ReadFolderEx("/songfinder/Bookshelf", "root");
		 
		 	mysql_close($connection);
			
			//include "audio_rss.php"
?>
