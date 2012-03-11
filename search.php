<?php
// this script will be used in order to connect to the database
// Place db host name. Sometimes "localhost" but 
// sometimes looks like this: >>      ???mysql??.someserver.net
$db_host = "XXXXXXXXXXX";
$db_username = "XXXXXXXXX"; 
$db_pass = "XXXXXX"; 
$db_name = "XXXXXXXXX";

// Run the connection here 
@mysql_connect("$db_host","$db_username","$db_pass") or die ();
@mysql_select_db("$db_name") or die ("<h1>Cohen, has trashed the mainframe!!!!!!</h1>");
?>
<?php
// get the users post from the previous page
if($_GET['beds']){
	$bedrooms=$_GET['beds'];
	$area=$_GET['location'];
	$min=$_GET['minrangeinput'];
	$max=$_GET['maxrangeinput'];

	echo"	<h2>Your Results</h2>";
	echo"<ul style='list-style:none;'>";
	// search the database
	 $search= mysql_query("SELECT * FROM property WHERE bedrooms='$bedrooms' AND price<='$max' AND price>='$min'");
	 $count_search = mysql_num_rows($search);
	if($count_search<1){
	echo"<h3>No results could be found.</h3>";
	}
	while($row = mysql_fetch_array($search))
	{ 
		$id = $row["id"];
		$address = $row["address"];
		$postCode = $row["postCode"];
		//$site = $row["site"];
		$photoLink = $row["photoLink"];
		$webLink = $row["webLink"];
		$bedrooms = $row["bedrooms"];
		$area = $row["area"];
		$price = $row["price"];
		$description = $row["description"];
		
		// echo this out in a list
		echo'<div><li class="ourClass">
				<div class="resultSearch">
			
							<div class="captionHolder">
							<h5>
								<a href="' . $webLink . '">' . $address . '</a></h5>
								<p>' . $description . '</p><p><b>Bedroom: ' . $bedrooms . '&nbsp;&nbsp;&nbsp;&nbsp;
							Price Per Month: &pound;' . $price . '</b></p>
							</div>
				</div>
			</li></div>';
	}
	echo"</ul>";
}

?>