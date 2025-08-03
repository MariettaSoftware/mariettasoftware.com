<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><!-- InstanceBegin template="/Templates/pixelgreen2-base.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>

<?php 
	  $api_root = $_SERVER['DOCUMENT_ROOT'] . "/api/";
	  //$api_root = "/home/users/web/b1314/ipw.montebel/public_html/api/"
	  require_once $api_root . "/schedule_api.php";
	  require_once $api_root . "/location_api.php";
	  require_once $api_root . "/contacts_api.php";
	  //$Location = new CData("locations", "*", "WHERE Id = \"montebello\"");
	  //$montebello = &$Location->Data[0];
	  	
	
		require_once $_SERVER['DOCUMENT_ROOT'] . '/api/parse_ics.php';
		require_once $_SERVER['DOCUMENT_ROOT'] .'/api/calendar_api.php';
		
		$MeetingLists = array();
				
		$MeetingsList = new CEventList($_SERVER['DOCUMENT_ROOT'] . "/calendar/calendars/Meetings");
		$EventsList = new CEventList($_SERVER['DOCUMENT_ROOT'] . "/calendar/calendars/Events");
		$current_tab = -1; //default
function GetTabId($nTab)
{
	global $current_tab;
	//echo "$current_tab=$nTab";
	if($current_tab == $nTab)
		echo "id=\"current\"";
}

 ?>

<meta name="Description" content="Gathering to the Name of the Lord Jesus Christ" />
<meta name="Keywords" content="Church, Christ, Worship, Assembly, Brethren" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="webmaster@graceandtruthchapelmontebello.org" />
<meta name="Robots" content="index,follow" />

<link rel="stylesheet" href="../PixelGreen2.css" type="text/css" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Grace and Truth Montebello</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->

<?php
$current_tab = 5;
?>
<?php
	$current_tab = 5;
	require_once $_SERVER['DOCUMENT_ROOT'] . '/api/audio_api.php';
?>

<!-- InstanceEndEditable -->	
</head>

<body>


<!-- wrap starts here -->
<div id="wrap">

<div id="header"><div id="header-content">	
		
		<h1 id="logo"><a href="/" title="">Grace and Truth Chapel </a><a href="/" title=""><span class="gray">Montebello</span></a></h1>	
	  <h2 id="slogan">Saints gathering unto the Name of the Lord Jesus Christ.</h2>		
		
		<!-- Menu Tabs -->
		
        <ul>
          <li><a href="/" <?php GetTabId(0);?>>Home</a></li>
          <li><a href="../beliefs.php" <?php GetTabId(1);?>>Our Beliefs</a></li>
          <li><a href="../howwemeet.php" <?php GetTabId(2);?>>How We Meet</a></li>
          <li><a href="../ministry.php" <?php GetTabId(3);?>>Ministry</a></li>
          <li><a href="../directions.php?id=montebello" <?php GetTabId(4);?>>Directions</a></li>
          <li><a href="index.php" <?php GetTabId(5);?>>Audio</a></li>
        </ul>
		</div>
  </div>
	
	<div class="headerphoto"></div>
				
	<!-- content-wrap starts here -->
	<div id="content-wrap"><div id="content">		
		
		<div id="sidebar" >
		  <div class="sidebox">
		    <h1 class="clear">This Week</h1>
		    <?php CreateScheduleEx2("sidebar"); ?>
		    <p><b><a href="/weeklymeetings.php">All Meetings</a></b><br/>
	        </p>
	    </div>
		
		<div class="sidebox">
		  <h1 class="clear">Upcoming Events</h1>
		  <?php CreateEventListEx2("sidebar2"); ?>
		  <p><b><a href="/calendar/month.php">Calendar</a></b><br/>
		    <b><a href="/events/events.php">Past Events</a></b><br/>
		    <b><a href="/subscribe.php">Subscribe</a></b><br/>
	      </p>
		  </div>
		  
		  <div class="sidebox">
		    <h1><a href="/forum">Forum</a></h1>
		    </div>
		 
		  <div class="sidebox">	
            
            <h1>Verse of the Day</h1>
              <p><script src="http://www.verseoftheday.com/kjvverse.js"></script></p>
			<!--
				<h1>Sponsors</h1>
                <ul class="sidemenu">
                    <li><a href="http://www.dreamtemplate.com" title="Website Templates" class="top">DreamTemplate</a></li>
                    <li><a href="http://www.themelayouts.com" title="WordPress Themes">ThemeLayouts</a></li>
                    <li><a href="http://www.imhosted.com" title="Website Hosting">ImHosted.com</a></li>
                    <li><a href="http://www.dreamstock.com" title="Stock Photos">DreamStock</a></li>
                    <li><a href="http://www.evrsoft.com" title="Website Builder">Evrsoft</a></li>
                    <li><a href="http://www.seostation.com" title="SEO">SEOStation</a></li>
                </ul>
				-->
			</div>
			<!--
			<div class="sidebox">	
			
				<h1>Wise Words</h1>
				<p>&quot;No man can live happily who regards himself alone; 
				who turns everything to his own advantage. You must live for
				others if you wish to live for yourself.&quot;</p>					
				<p class="align-right">- Seneca</p>
					
			</div>		
			
			<div class="sidebox">
			
				<h1>Support Styleshout</h1>
				<p>If you are interested in supporting my work and would like to contribute, you are
				welcome to make a small donation through the 
				<a href="http://www.styleshout.com/">donate link</a> on my website - it will 
				be a great help and will surely be appreciated.</p>			
				
			</div>
			
			<div class="sidebox">	
						
				<h1>Search Box</h1>	
				<form action="#" class="searchform">
					<p>
					<input name="search_query" class="textbox" type="text" />
  					<input name="search" class="button" value="Search" type="submit" />
					</p>			
				</form>			
				
			</div>
            <div class="sidebox">
			
				<h1>Short About</h1>
				
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
				Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
				posuere nunc justo tempus leo.</p>	
						
			</div>		
				-->	
		</div>	
	
		<div id="main">		
		
			<div class="post">
			
				<a name="TemplateInfo"></a>	
				<!-- InstanceBeginEditable name="PageContent" -->
      
        <h1>Audio <img src="../images/mp3 (5).png" width="32" height="32" align="texttop" class="normal"/></h1>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><a href="index.php?view=browse">Browse</a> | <a href="index.php?view=all">Show All</a><!-- -->
              | <a href="index.php?view=organized">Organized</a> | <a href="audio.rss"><img src="../images/RSS-16.png" alt="RSS Feed" width="16" height="16" border="0" align="top" class="normal"/> RSS Feed</a> (Since Jan 1, 2009, <a href="../subscribe.php">more info</a>) </td>
          </tr>
          <tr>
            <td><form action="index.php" method="get" id="form1">
              <strong><img src="../images/searchbig.png" width="32" height="32" align="absmiddle" / class="normal" />Search:</strong>
                  <input name="search" type="text" id="search" size="50" value="<?php echo $search; ?>"/>
                  <input type="submit" name="Submit" value="Submit" />
                  <input type="hidden" name="view" value="search" />
              
            </form></td>
          </tr>
        </table>
        

		<?php 
		

		$audioDB = new AudioDB();
		
	    /* $server = "montebel.ipowermysql.com";
         if($_SERVER["DOCUMENT_ROOT"][0] != '/')
            $server = "localhost";
		 $connection = mysql_connect($server, "montebel_media", "bretheren") or die(mysql_error());
		 //$connection = mysql_connect("montebel.ipowermysql.com", "montebel_media", "bretheren");
		 mysql_select_db("montebel_media") or die(mysql_error());
		 */
		 if(!$view)
         {
          //  $view = $_GET["view"];
            //$speaker = $_GET["speaker"];
            
         }
		 
		 //$querystring = "select * from audio ORDER BY Year, Meeting, Date";
		 $query = "";
		 $columns = "*";
		 //"SELECT * from audio";
		 $orderby = "ORDER BY Date, Speaker";
		 
		 if($view=="")
		 	$view = "browse";
		 
		 if($view=="year")
		 {
		 	if($year == "")
				$year = date("Y"); // use this year
		 	echo "<h3>Ministry from $year</h3>";
		 }
		 if(strlen($year))
		 {	
		 	//echo "checking the year";
		 	$query = "WHERE Year = $year";
			//echo $query;
		 }
		 if($view=="meeting")
		 {
		 	if(strlen($query))
			{

			  $query = $query . " AND ";
			 
			  }
			  else $query = "WHERE ";
		 	$query = $query . "Meeting = '$meeting'";
			echo "<h2>Ministry spoken during $meeting</h2>";
		}
		 else if($view =="speaker")
		 {
 		 	if(strlen($query))
			  $query = $query . " AND ";
			else $query = "WHERE ";
		
		 	$query = $query . "Speaker = '$speaker'";
			echo "<h2>Ministry spoken by $speaker</h2>";
			$audioDB->PrintYearList("speaker", $speaker);
											
		}
		else if($view=="search")
		{
			$query = "WHERE Match(Speaker, Topic, Meeting) AGAINST('$search')";
		}
		$querystring = "SELECT " . $columns . " from audio " . $query . " " . $orderby;
		
		 if($view=="browse")
		 	$querystring = "";
		 if($view == "")
		 	echo "<h3>All Ministries</h3>";
			
		 $answer = NULL;
		 
		// echo "Query = $querystring<br>";
		 echo $year;

	
 
		 if($querystring !== "")
	       $audioDB->DisplayTable($querystring, $view);	 	 
    //else
		 
		 
	 if($view == "browse")
		  $audioDB->DisplayBrowse("desktop");

		 //mysql_close($connection);
		?>
		</ul>
		<!-- InstanceEndEditable -->
			  
              <!--
			  <p>Posted by <a href="pixelgreen.dwt.php">ealigam</a></p>

                <p><strong>PixelGreen</strong> is a free, W3C-compliant, CSS-based website template
                by <a href="http://www.styleshout.com/">styleshout.com</a>. This work is
                distributed under the <a rel="license" href="http://creativecommons.org/licenses/by/2.5/">
                Creative Commons Attribution 2.5  License</a>, which means that you are free to
                use and modify it for any purpose. All I ask is that you give me credit by including a <strong>link back</strong> to
                <a href="http://www.styleshout.com/">my website</a>.
                </p>

                <p>
                You can find more of my free template designs at <a href="http://www.styleshout.com/">my website</a>.
                For premium commercial designs, you can check out
                <a href="http://www.dreamtemplate.com" title="Website Templates">DreamTemplate.com</a>.
                </p>
				
				<p class="post-footer align-right">					
					<a href="pixelgreen.dwt.php" class="readmore">Read more</a>
					<a href="pixelgreen.dwt.php" class="comments">Comments (7)</a>
					<span class="date">Nov 11, 2006</span>	
				</p>
				
			</div>
			
    <a name="SampleTags"></a>
				<h1>Sample Tags</h1>
				
				<h3>Code</h3>				
				<p><code>
				code-sample { <br />
				font-weight: bold;<br />
				font-style: italic;<br />				
				}
				</code></p>	
			
				<h3>Example Lists</h3>
			
				<ol>
					<li>Here is an example</li>
					<li>of an ordered list</li>							
				</ol>	
						
				<ul>					
					<li>Here is an example</li>
					<li>of an unordered list</li>							
				</ul>				
				
				<h3>Blockquote</h3>			
				<blockquote><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy 
				nibh euismod tincidunt ut laoreet dolore magna aliquam erat....</p></blockquote>
			
				<h3>Image and text</h3>
				<p>
				<a href="http://getfirefox.com/"><img src="../images/pixelgreen/firefox-gray.jpg" width="100" height="121" alt="firefox-gray"  class="float-left" /></a>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 
				Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 
				posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 
				odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra 
				condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. 
				In tristique orci porttitor ipsum. Aliquam ornare diam iaculis nibh.  								
				</p>
				
				<h3>Table Styling</h3>
							
					<table>
					<tr>
						<th class="first"><strong>post</strong> date</th>
						<th>title</th>
						<th>description</th>
					</tr>
					<tr class="row-a">
						<td class="first">05.31.2006</td>
						<td><a href="pixelgreen.dwt.php">Augue non nibh</a></td>
						<td><a href="pixelgreen.dwt.php">Lobortis commodo metus vestibulum</a></td>
					</tr>
					<tr class="row-b">
						<td class="first">05.31.2006</td>
						<td><a href="pixelgreen.dwt.php">Fusce ut diam bibendum</a></td>
						<td><a href="pixelgreen.dwt.php">Purus in eget odio in sapien</a></td>
					</tr>
					<tr class="row-a">
						<td class="first">05.31.2006</td>
						<td><a href="pixelgreen.dwt.php">Maecenas et ipsum</a></td>
						<td><a href="pixelgreen.dwt.php">Adipiscing blandit quisque eros</a></td>
					</tr>
					<tr class="row-b">
						<td class="first">05.31.2006</td>
						<td><a href="pixelgreen.dwt.php">Sed vestibulum blandit</a></td>
						<td><a href="pixelgreen.dwt.php">Cras lobortis commodo metus lorem</a></td>
					</tr>
					</table>
			
				<h3>Example Form</h3>
				<form action="#">			
					<p>			
					<label>Name</label>
					<input name="dname" value="Your Name" type="text" size="30" />
					<label>Email</label>
					<input name="demail" value="Your Email" type="text" size="30" />
					<label>Your Comments</label>
					<textarea rows="5" cols="5"></textarea>
					<br />	
					<input class="button" type="submit" />		
					</p>		
				</form>				
				
				<br />				
					-->					
		</div>					
		
	<!-- content-wrap ends here -->		
	</div></div>

<!-- footer starts here -->	
<div id="footer"><div id="footer-content">
	
		<div class="col float-left space-sep">
			<h1>Nearby Assemblies</h1>
			<ul class="flist">
	            <li><a href="http://oakvillagospelhall.org">Oak Villa Gospel Hall</a></li>
                <li><a href="" title="">Grace and Truth (Orange County)</a></li>
                <li><a href="" title="">San Diego</a></li>
                <li><a href="" title="">Brawley</a></li>
                <li><a href="" title="">Oakland</a></li>
                <!--li><a href="http://www.evrsoft.com" title="Website Builder">Evrsoft</a></li>
                <li><a href="http://www.seostation.com" title="SEO">SEOStation</a></li-->
			</ul>			
		</div>
		
		<div class="col float-left">
			<h1><a href="../links.php">Links</a></h1>
	  <ul class="flist">
                 <li><a href="http://bbusa.org">Believer's Bookshelf (USA)</a></li>
         
          <li><a href="http://www.searchtheword.net/">Search The Word</a></li>
          <li><a href="http://www.fcsusa.org/">Fund for Christian Service</a></li>
				<!--li><a href="pixelgreen.dwt.php">Link Two</a></li>
				<li><a href="pixelgreen.dwt.php">Link Three</a></li>
				<li><a href="pixelgreen.dwt.php">Link Four</a></li>
				<li><a href="pixelgreen.dwt.php">Link Five</a></li-->
                <li><a href="../links.php">More Links</a></li>
		  </ul>			
		</div>		
	
		<div class="col2 float-right">
            <h1>Site Links</h1>
			<ul class="flist">
				<li class="top"><a href="/">Home</a></li>
                <li><a href="../kidscorner.php">Kid's Corner</a></li>
		    <!--li><a href="pixelgreen.dwt.php">Sitemap</a></li-->
				<li><a href="audio.rss">RSS Feed (Audio) </a></li>
		  </ul>

            <p>
			&copy; 2010 Grace and Truth Chapel, Montebello<br />
			<a href="http://www.stylishtemplate.com/" title="Website Templates">website templates</a> by <a href="http://www.styleshout.com/">styleshout</a> <br />

			Valid <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> |
		   	      <a href="http://validator.w3.org/check/referer">XHTML</a>
			</p>
		</div>
	
</div></div>
<!-- footer ends here -->
	
<!-- wrap ends here -->
</div>

</body>
<!-- InstanceEnd --></html>
