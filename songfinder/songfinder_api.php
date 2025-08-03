<?php
require_once "login.php";

class SongDB
{
	var $connection;
	function __construct()
	{
		global $mysql_server;
		global $mysql_username;
		global $mysql_password;
		global $mysql_database;
		//$server = "montebel.ipowermysql.com";
		if($_SERVER["DOCUMENT_ROOT"][0] != '/')
			$mysql_server = "localhost";
			
		//echo "goober=$mysql_server";
		$this->connection = mysql_connect($mysql_server, $mysql_username, $mysql_password) or die(/*mysql_error()*/"<p>There was an error connecting to the Audio Database Server.</p>");
		//$connection = mysql_connect("montebel.ipowermysql.com", "montebel_media", "bretheren");
		mysql_select_db($mysql_database) or die(mysql_error());
	}
	
	function __destruct()
	{
		mysql_close($this->connection);
	}
	
	
	function GetQuery($querystring)	
	{
		$result = array();
		
		$answer = mysql_query($querystring) or die (mysql_error());
		
		while ($line = mysql_fetch_array($answer, MYSQL_ASSOC)) {
			$result[] = $line;
		}
		mysql_free_result($answer);
		
		return $result;
		
	}
	
	function GetYearList($view, $speaker, $meeting)
	{
		$query = "SELECT DISTINCT `Year` from audio";
		if(strlen($speaker))
			$query .= " WHERE Speaker = '$speaker'";
		if(!$view || $view == "")
			return $this->GetQuery($query);	
		else
		{
		/*	$query .= " WHERE ";
			if($speaker)
			{
				$query .= "`Speaker` = `$speaker`";
			}
			echo $query;*/
			return $this->GetQuery($query);
		}
		
	}
	
	function PrintYearList($view = NULL, $speaker = NULL, $meeting = NULL, $device = NULL)
	{
		//future change, limit year list to what is needed.
		$yearlist = $this->GetYearList($view, $speaker, $meeting);
		
		echo "<p>Select Year: ";
		
		$count = count($yearlist);
		for($i = 0; $i < $count; ++$i)
		{
			echo "<a href=\"" . $this->BuildHref($view, $yearlist[$i]["Year"], $speaker, $device) . "\">";
			echo $yearlist[$i]["Year"];
			echo "</a>";
			if($i != ($count -1))
				echo ", ";
		}
		
		echo "</p>";		
	}
	function BuildQuery($search, $view, $year, $other)
	{
		
	}
	function BuildHref($view, $year = NULL, $speaker = NULL, $device = NULL)
	{
		if(!$view || $view == "") $view = "all";
		
		$file = ($device == "mobile") ? "mobile.php" : "index.php";
		
		$url = "/audio/$file?view=$view";
		
		if($speaker || $speaker != 0)
			$url .= "&speaker=$speaker";
		
		if($year && $year != "")
			$url .= "&year=$year";
			
		return $url;
	}
	//
	// returns a href linking to the results or false on failure
	//
	function FindMeeting($name, $year)
	{
		$results = GetQuery("SELECT * from audio WHERE `Meeting` = $name and `Year` = $year");
		if(count($results))
		{
			return "/audio/index.php?view=meeting&meeting=$name&year=$year";
		}
		return false;				
	}
	
	
	function DisplayBrowse($mode)
	{
		?>
		
		<h3>Browse by Song Book</h3>
		<ul>
		<?php
		$booklist = $this->GetQuery("SELECT DISTINCT BookName from songs ORDER BY BookName");
		
		//var_dump($meetinglist);
		foreach($booklist as $book)
		{
			$thisbook = $book['BookName'];
			?>
			<li>
				<a href="<?php echo "$file";?>?view=book&amp;book=<?php echo $thisbook; ?>">
				<?php echo $thisbook; ?></a>
			</li>
			<?php
		}
		
		
		
		?>
		</ul>
		<h3>Browse by Author</h3>
		<ul>
		<?php
		//$speakerlist = $this->GetQuery("SELECT DISTINCT Speaker from audio ORDER BY Speaker");
		
		
//		foreach($speakerlist as $speaker)
		{
			//$thisspeaker = $speaker['Speaker'];
			
			?>
			<li>
				<a href="/audio/<?php echo "$file";?>?view=speaker&amp;speaker=<?php echo $thisspeaker; ?>">
				<?php echo $thisspeaker; ?></a>
			</li>
			<?php
		}
	}
	    function DisplayTable($querystring, $view)
         {
			
		 	 $answer = mysql_query($querystring);
    		 
    			 while ($line = mysql_fetch_array($answer, MYSQL_ASSOC)) {
    				$array[] = $line;
    		 	}
    			$intable = false;
    			$currentyear = "";
    			$currentmeeting = "";
    			if(!count($array))
				{
					die(mysql_error());
				}
    			if(count($array))
    			{
					$tablebegin = "
					<table>
                <tr><th width=\"5%\">#</th>
				<th>Song</th>";
				
				//echo $tablebegin;
    			?>
                
                
				<?php
				if($view != "book")
				{
						
					$tablebegin .= "<th>Book</th>";
					
				}
				$tablebegin .= "<th>Actions</th></tr>";
				?>
				
                
                <?php
		    		//echo $tablebegin;
    			}
    		 
    			 foreach($array as $item)
    			 {
					 
    			 ?>
                 
                 <?php
    			 	//var_dump($item);
  
    				
    				if($currentbook != $item["BookName"] && $view == "organized")
    				{
    					$currentbook = $item["BookName"];
						if($intable == true)
						{
							echo "</table>";
							$intable = false;
						}
    					echo "<h3>$currentbook</h3>";
    				}
    				//echo "<li>";
					
					if($intable == false)
					{
						echo $tablebegin;
						$intable = true;
					}
					?>
                    
                    <tr>
    				<td>
                    <!--a href="<?php echo $item["FileName"]; ?>">
                    	<img src="../images/audio.png" alt="download mp3" class="normal"/>
                    </a-->
                    ?
                    </td>
                    <td>
                    	<!--a href="/audio/index.php?view=speaker&speaker=<?php echo $item["Speaker"]; ?>"-->
    	                <?php echo $item["SongName"]; ?>
                        <!--/a-->
                    </td>
                    <!--td-->
                    	<?php 
    						if($view != "" && $view != "book")
    						{
								echo "<td>";
    							echo $item["BookName"];
								echo "</td>";
    						}
    					?>
                    <!--/td-->
                    <td>
					    <a href="/mariettaonline/song.php?name=<?php echo basename($item["FileName"]); ?>&book=<?php echo $item["BookName"]; ?>&ref=finder">
    	                View
                        </a> | <a href="<?php echo $item["FileName"]; ?>">
    	                Download
                        </a>
                        
                    </td>
    					
    				
    			 
                 </tr>
                 <?php
    			 }
    			 			if(count($array))
    			{
    			?>
                </table>
                     
                <?php
    		
    			}
    
    		 
    			 mysql_free_result($answer);
    		}
} //end AudioDB
?>