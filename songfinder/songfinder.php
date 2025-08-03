<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../themes/garland/style.css" />
<title>Marietta Song Finder</title>
</head>
<?php
	
	require_once 'songfinder_api.php';
?>
<body>
<h1>Marietta Song Finder</h1>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="songfinder.php?view=browse">Browse</a> | <a href="songfinder.php?view=all">Show All</a><!-- -->
              | <a href="songfinder.php?view=organized">Organized</a>  </td>
          </tr>
          <tr>
            <td><form action="songfinder.php" method="get" id="form1">
              <strong>Search:</strong>
              <input name="search" type="text" id="search" size="50" value="<?php echo $search; ?>"/>
                  <input type="submit" name="Submit" value="Submit" />
                  <input type="hidden" name="view" value="search" />
              
            </form></td>
          </tr>
        </table>
        

		<?php 
		

		$songDB = new SongDB();
		
	    /* $server = "montebel.ipowermysql.com";
         if($_SERVER["DOCUMENT_ROOT"][0] != '/')
            $server = "localhost";
		 $connection = mysql_connect($server, "montebel_media", "bretheren") or die(mysql_error());
		 //$connection = mysql_connect("montebel.ipowermysql.com", "montebel_media", "bretheren");
		 mysql_select_db("montebel_media") or die(mysql_error());
		 */
		 if(!$view)
         {
            $view = $_GET["view"];
            $book = $_GET["book"];
            
         }
		 
		 //$querystring = "select * from audio ORDER BY Year, Meeting, Date";
		 $query = "";
		 $columns = "*";
		 //"SELECT * from audio";
		 $orderby = "ORDER BY BookName, SongName";
		 
		 if($view=="")
		 	$view = "browse";
		 
		 if($view=="book")
		 {
		 	if(strlen($query))
			{

			  $query = $query . " AND ";
			 
			  }
			  else $query = "WHERE ";
		 	$query = $query . "BookName = '$book'";
			echo "<h2>Songs in $book</h2>";
		}
		 
		else if($view=="search")
		{
			$query = "WHERE Match(SongName) AGAINST('$search')";
		}
		$querystring = "SELECT " . $columns . " from songs " . $query . " " . $orderby;
		
		 if($view=="browse")
		 	$querystring = "";
		 if($view == "")
		 	echo "<h3>All Song Books</h3>";
			
		 $answer = NULL;
		 
		// echo "Query = $querystring<br>";
		 echo $year;

	
 
		 if($querystring !== "")
	       $songDB->DisplayTable($querystring, $view);	 	 
    //else
		 
		 
	 if($view == "browse")
		  $songDB->DisplayBrowse("desktop");

		 //mysql_close($connection);
		?>
		</ul>
</body>
</html>