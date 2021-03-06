<?php
	session_start();
	if(!isset($_SESSION['userId'])){
		header('Location: index.php');
	}
	require "getNotificationsAndRequests.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Mini-Facebook</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/datepicker.css" rel="stylesheet">
	<style type="text/css">
	body, html {
                height: 100%;
				padding-right:0;
				margin-right:0;
            }
	.scrollable{
		max-height: 90%;
		overflow: hidden;
	}
	.scrollable:hover{
		overflow-y:scroll;
	}
	#top {
		/*background-color: #4c66a4;
		color: #ffffff;*/
	}
	#panelGuest{
		overflow-y:auto;
		overflow-x:hidden;
		margin-top:6%;
	}

	#left-menu{
		width:75%;
	}
	#ticker{
		padding-left:0;
		margin-left:0;
		height:300px;
	}
	#ticker-item{
		background-color: #dff0d8;
	}
	#line{
		height:2px;
	}
	#right-bar{
		border-left:4px solid #007AA3;	
		padding-left:5px;
	  margin-left: 82%;
	  *margin-left: 81.5%;
	}
	.navbar-inner, .brand
	{
	   background: rgb(0,136,204); /* Old browsers */
	    /* remove the gradient */
	   background-image: none;
	    /* set font color to white */
	    color: white ! important;
	}

	.populate-messages li{
		width:100%
	}

	.sendersMessage{
		border-left:5px solid rgb(238,238,238);
		padding-top:5px;
		padding-bottom:5px;
		padding-left:15px;
		width:70%;
	}

	.receiversMessage{
		border-right:5px solid rgb(238,238,238);
		padding-top:5px;
		padding-bottom:5px;
		padding-right:15px;
		text-align:right;
		margin-left:27%;
		width:70%;
	}
	.slimScrollDiv1{
		float:left;
	}
	.slimScrollDiv2{

	}

	</style>
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/bootstrap-datepicker.js" type="text/javascript" charset="utf-8"></script>
   	<script src="js/bootstrap.min.js" type="text/javascript"></script>
   	<script src="js/jquery.slimscroll.js" type="text/javascript"></script>
   	

	<script>
		function onLoadFunction(){
			var x = $('#messageUsers').height();
			var y = $('#messageUsers').width();
      		$('#messageUsers').slimScroll({
	      	 height: x,
	      	 width: y,
	      	 wrapperClass:'slimScrollDiv1'
	      	});

	      	var x = $('#messageArea').height();
			var y = $('#messageArea').width();
      		$('#messageArea').slimScroll({
	      	 height: x,
	      	 width: y,
	      	 start:'bottom',
	      	 wrapperClass:'slimScrollDiv2'

	      	});

	      	var x = $('#online-friends').height();
			var y = $('#online-friends').width();
      		$('#online-friends').slimScroll({
	      	 height: x,
	      	 width: y,
	      	 wrapperClass:'slimScrollDiv3'
	      	});	
		}
	</script>
  </head>
  <body onload="onLoadFunction()">
  <div class="container-fluid max-height no-overflow">
	<div class="row-fluid" id="top">
		<div class="span10">
			<div class="row-fluid  navbar-fixed-top span10" id="top" >
				<div >
					<div class="navbar">
					<div class="navbar-inner">
						<a class="brand offset1" href="#">Mini-Facebook</a>
					<ul class="nav">
					  <li>
					       <form class="navbar-search pull-left">
						    	<input type="text" class="search-query" placeholder="Search">
						    </form>
					  </li>
					  <li><a href="feed.php" style="color:white;">Home</a></li>
					  <li><a href="profile.php" style="color:white;">Profile</a></li>
					  <li class="dropdown">
						<a class="dropdown-toggle"
						   data-toggle="dropdown"
						   href="#" style="color:white;">
							Notifications
							<b class="caret"></b>
						  </a>
						<ul class="dropdown-menu">
							<?php
							$count = 0;
							  foreach($_SESSION['notifications'] as $noti){
								if($count > 6) break;
								if($noti[0]==='post')echo "<li><a href=\"#\">New post by ".$noti[1]."<br/>".$noti[2]."</a></li>";
								else if($noti[0]==='comment')echo "<li><a href=\"#\">".$noti[1]." commented on a post.<br/>".$noti[2]."</a></li>";
								else echo "<li><a href=\"#\">".$noti[1]." created an event.<br/>".$noti[2]."</a></li>";
								$count++;
							  }
							?>
						</ul>
					  </li>
					  
					  <li class="dropdown">
						<a class="dropdown-toggle"
						   data-toggle="dropdown"
						   href="#" style="color:white;">
							Requests
							<b class="caret"></b>
						  </a>
						<ul class="dropdown-menu">
							<?php
							  foreach($_SESSION['requests'] as $req){
							  	echo "<li><a href=\"#\">".$req[0]." sent you a request.<br/>".$req[1]."</a></li>";
							  }
							?>
						</ul>
					  </li>
					  
					  <li><a href="messages.php?receiver=empty" style="color:white;">Messages</a></li>
					  <li class="active"><a href="settings.php">Settings</a></li>
					</ul>
					</div>
					</div>
				</div>
			</div>

			<br>
			<br>
			<br>

				<dl class="dl-horizontal">
				<h4> Personal Details : </h4>
				<dt> First Name : </dt> <dd> <input type='text'> </dd>
				<dt> Middle Name : </dt> <dd> <input type='text'> </dd>
				<dt> Last Name : </dt> <dd> <input type='text'> </dd>
				<dt> Date of Birth : </dt> <dd> <input type="text" class="datepicker" placeholder="mm/dd/yyyy"> </dd>
				<dt> Gender : </dt> 
				<dd>
					<input type="radio" name="sex" value="male"><span> Male</span><br>
					<input type="radio" name="sex" value="female"><span> Female</span><br><br>
				</dd>
				<dt> Language : </dt> <dd> <input type='text'> </dd>

				<h4> Contact Details : </h4>
				<dt> Tel no : </dt> <dd> <input type='number'> </dd>
				<dt> Email : </dt> <dd> <input type='text'> </dd>
				<dt> Residential address :- </dt> 
				<br><br>
				<dt> House number : </dt> <dd> <input type='text'> </dd>
				<dt> Street : </dt> <dd> <input type='text'> </dd>
				<dt> City : </dt> <dd> <input type='text'> </dd>
				<dt> State : </dt> <dd> <input type='text'> </dd>
				<dt> Country : </dt> <dd> <input type='text'> </dd>
				<dt> PIN code : </dt> <dd> <input type='number'> </dd>

		</div>
		<div class="span2" id="right-bar" style="position:fixed; height:100%;">
			<div id="ticker" style="height:40%;">
			<ul class="nav nav-list" id="left-menu" >
				<li class="nav-header">Activities</li>
				<li id="ticker-item"><a href="#">Rahul Singhal is now friends with Aditya Raj</a></li><div id="line"></div>
				<li id="ticker-item"><a href="#">Aditya Raj likes your status "yo"</a></li><div id="line"></div>
				<li id="ticker-item"><a href="#">Nishit Bhandari poked you.</a></li><div id="line"></div>
			</ul>
			</div>
			<hr>
			<div id="online" style="height:60%;">
			<div id = "online-friends" class="scrollable" style="height:80%; width:90%;">
				<ul class="nav nav-list" id="left-menu"  >
					<li class="nav-header">Online Friends</li>
					<li><a href="#">Rahul Singhal</a></li>
					<li><a href="#">Aditya Raj</a></li>
					<li><a href="#">Nishit Bhandari</a></li>
					<li><a href="#">Nishit Bhandari</a></li>
					<li><a href="#">User1</a></li>
					<li><a href="#">User2</a></li>
					<li><a href="#">User3</a></li>
					<li><a href="#">User4</a></li>
					<li><a href="#">User5</a></li>
					<li><a href="#">User6</a></li>
					<li><a href="#">User7</a></li>
					<li><a href="#">User8</a></li>
					<li><a href="#">User9</a></li>
				</ul>
			</div>
			<input style="width:90%; margin-top:3%; margin-left:5%;" placeholder="Search Friend.." />
	  </div>

	</div>
  </div>
  <script>
        $(document).ready(function() {
    		$('.datepicker').datepicker();
		  });
		  
		  function online(){
			//Send an XMLHttpRequest to the 'show-message.php' file
			if(window.XMLHttpRequest){
				xmlhttp = new XMLHttpRequest();
				xmlhttp.open("GET","online.php",false);
				xmlhttp.send(null);
			}
			else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.open("GET","online.php",false);
				xmlhttp.send();
			}
			//Replace the content of the messages with the response from the 'show-messages.php' file
			document.getElementById('online-friends').innerHTML = xmlhttp.responseText;
			//Repeat the function each 10 seconds
			setTimeout('online()',3000);
		}

		online();
      </script>
   
  </body>
</html>