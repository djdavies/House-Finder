<!DOCTYPE HTML>
<html>
<head>
	<LINK href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<LINK href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
	<LINK href="css/main.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/bootstrap.js">$(".collapse").collapse()</script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap_button.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="favicon.ico" type="image/x-icon"> 
	<title> Hackathon - House Finder</title>
	<script type="text/javascript">
	//Function to validate that the logon form has values inserted 
	function formCheck(){
		var minrange=parseInt(document.forms["search"]["minrangeinput"].value, 10);
		var maxrange=parseInt(document.forms["search"]["maxrangeinput"].value, 10);

		if (minrange  >= maxrange)
			{
			document.getElementById("formerrorslider").innerHTML= "The minimum needs to be less than the maximum";
			//alert('this works here');
		    $("#formerrorslider").fadeIn("slow");

			}
			else
			{
				// display the results now then
				$("#formerrorslider").hide();
				
				//scroll the webpage down :)
				$("#searchResults").show();
				  $('html, body').animate({ 
					scrollTop: $('#searchResults').offset().top 
					}, 500);
					
					var ajaxRequest;  // The variable that makes Ajax possible!
					
					try{
						// Opera 8.0+, Firefox, Safari
						ajaxRequest = new XMLHttpRequest();
					} catch (e){
						// Internet Explorer Browsers
						try{
							ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
						} catch (e) {
							try{
								ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
							} catch (e){
								// Something went wrong
								alert("Your browser broke!");
								return false;
							}
						}
					}
					
					ajaxRequest.onreadystatechange = function(){
						if(ajaxRequest.readyState == 4){
							var ajaxDisplay = document.getElementById('resultbox');
							ajaxDisplay.innerHTML = ajaxRequest.responseText;
						}
					}
					var beds = document.getElementById('select01').value;
					var location = document.getElementById('select02').value;
					var minrangeinput = document.getElementById('minrangeinput').value;
					var maxrangeinput = document.getElementById('maxrangeinput').value;
					var queryString = "?beds=" + beds + "&location=" + location + "&minrangeinput=" + minrangeinput + "&maxrangeinput=" + maxrangeinput;
					ajaxRequest.open("GET", "search.php" + queryString, true);
					ajaxRequest.send(null); 					
			}
			return false;
	}
	
	
	// select area buttons
	$('.btn btn-primary').button('complete')
	</script>
</head>

<body>
    <div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
					<a class="brand" href="index.php">House Finder</a>
					<ul class="nav">
					<li class="active">
					<a href="index.php">Home</a>
					</li>
					</ul>
			</div>
		</div>
    </div>
	<!-- heading area -->
        <div class="hero-unit" style="border-radius: 0px; border-radius: 0px; border-radius: 0px;">
		<div id="logo">
			<!-- logo -->
				
			<!-- end logo -->
		</div>
		<h1 style="padding-left:90px;"> House Finder</h1>
		<p style="padding-left:120px;"> A brand new way to find houses in your local area. 
		<br/>Simply enter your search details below and see the houses appear.</p>
    </div>
	<!-- end heading area -->
	<div>
		<div id="page">
			<form action="/" id = "searchForm" name = "search" class="well form-search" onSubmit = "return formCheck()">
			<h1>Search</h1>
			<br>
			<label class="control-label" for="select01">Bedrooms:</label>
			<br>
              <select id="select01" name = "beds">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
              </select>
			  <br/><br/>
			<label class="control-label">Area:</label>
			  <br/>
              <select id="select02" name = "location">
                <option>Roath</option>
                <option>City Center</option>
                <option>Cardiff Bay</option>
              </select>
			  </br/></br>
				<label class="control-label">Price Range:</label></br>
				Minimum: <input type="range" name = "minrangeinput"  id="minrangeinput" min="0" max="3000" value="250" step="5" onchange="showValue1(this.value)" />
				<script type="text/javascript">
					function showValue1(newValue)
					{
						document.getElementById("minrange").innerHTML= "£" + newValue;
					}	
				</script>
				<span id="minrange">£250</span>
				Maximum: <input type="range" name = "maxrangeinput" id="maxrangeinput" min="0" max="3000" value="600" step="5" onchange="showValue2(this.value)" />
				<script type="text/javascript">
					function showValue2(newValue)
					{
						document.getElementById("maxrange").innerHTML= "£" + newValue;
					}	
				</script>
				<span id="maxrange">£600</span>
				<br>
				<br>
				<div class="alert alert-error" id = "formerrorslider" style = "display:none;">
				</div>
				&nbsp <button type="submit" class="btn-primary">Search</button>
			</form>
			<h2>Latest Houses</h2>
			<ul class = "thumbnails"> 
				<div style="margin-left:auto; margin-right:auto;">
				<?php
					$sqlconnect = mysql_connect ("localhost.blockbe.net","XXXXXXXXX","XXXXXXX");
					mysql_select_db ("blockben_hackteam");
					$selecttable = mysql_query ("SELECT * FROM property ORDER BY id DESC LIMIT 3");

					while ($houses = mysql_fetch_array($selecttable)) {
						echo "<li class = 'span3'>";
						echo "<div class = 'thumbnail'>";
						echo "<img src = '" . $houses[photoLink] . "' alt = 'House Picture' height = '180' width = '260'/>";
						echo "<div class = 'caption'>";
						echo "<a href = '" . $houses[webLink] . "'><h5>" . $houses[address] . "</h5></a>";
						echo "<p>" . $houses[description] . "</p>";
						echo "<b>" . $houses[bedrooms] . "&nbspBedroom(s)</br>";
						echo "Per month it is: £" . $houses[price] . "</b>";
						echo "</div> </div>"; 
						echo "</li>"; 
					}
				
				?>
				</div>
			</ul>
		<!-- Search area -->
		<div id="searchResults" style="display:none;">
			<div class="searchiMainHolder">
			<div id = "resultbox">
			
				</div>
			</div>
		</div>
		<br/><br/>
		<div class="alert alert-info">
			This website has been made possible by 'A Scarf in a Fruit Bowl' a team @ Cardiff University's Computer Science Hackathon.
		</div>
		</div>
	</div> 
</body>
</html>