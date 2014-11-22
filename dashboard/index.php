<?php session_start(); ?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>NerdSquad</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom styles for this templates -->
		<link rel="stylesheet" type="text/css" href="../css/style_one.css">
		<link rel="stylesheet" type="text/css" href="../css/style_two.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" type="text/css" href="../css/panel.css">
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,600,700' rel='stylesheet' type='text/css'>
		<!--<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.min.css">-->


        <script>
            var radiusValue;
            function something(){
                var answer =  prompt("Please enter your thoughts!");
                return answer;
            }

            function showValue(newValue){
                document.getElementById("rangeValue").innerHTML=newValue + " km";
                var radius = document.getElementById("range").value;
                radiusValue = radius;
            }



        </script>
        <?php

        if((strlen($_SESSION['lat']) < 1)){
            include("getLoc.php");
        }
         ?>
	</head>
	<body>
		<!----------------Creating the navigation panel--------------------->
		<header>
			<div class="navbar navbar-inverse navbar-fixed-top " role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<p id="profile">MindFree</p>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right" id="mainmenu">
							<li ><a href="" onclick="something()"><span class="glyphicon glyphicon-question-sign"></span> How're you feeling</a></li>
							
							<li ><a style="" href=""><span class="glyphicon glyphicon-user" ></span> Thoughts</a></li>	
							
							<li ><a href=""><span class="glyphicon glyphicon-envelope" ></span> Contact a specialist</a></li>


						</ul>
					</div>
				</div>
			</div>
		</header>
		<!------------------------------------------------------------------->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar" id="ex3">
          <div class="sidebar-module sidebar-module-inset" id="right-panel">
            <h1>ThoughtSpot Resources</h1>
			<!--Create 'search' element -->
				<form action="">
					  <input id="search" type="search"  name="googlesearch">
					  <input type="image" src="../images/loupe1.png" alt="Submit" style="width:15px; height:15px;"><br><span id="rangeValue">5 km</span><br>
                    <input name ="references" type="range" min="1" max="100" value="5" id="range" onChange="showValue(this.value)"/>
				</form>
			<br>
			<p class="show">Show me:  </p>

			<div class="dropdown dropdown-left">
                <p class=" dropdown-show" data-toggle="dropdown"><var id="resourcename">all resources</var><span class="glyphicon glyphicon-collapse-down" ></span></p>

				<ul class="dropdown-menu" role="menu">
                  <li><a href="#" onClick="recp('Family')" > Family and Friends </a></li>
                  <li><a href="#" onClick="recp('Health')" > Health and Social Services </a></li>
                  <li><a href="#" onClick="recp('Legal')" > Legal and Financial  </a></li>
				  <li><a href="#" onClick="recp('Recreation')" > Recreation and Culture </a></li>
				  <li><a href="#" onClick="recp('Spirituality')" > Spirituality and Wellbeing </a></li>
                  <li><a href="#" onClick="recp('Work')" > Work and School </a></li>
                  <li><a href="#" onClick="recp('Sex')" > Sex and Relationships </a></li>
                </ul>
			</div>

			<div id="list">
			</div>
          </div>
        </div><!-- /.blog-sidebar -->

		<div id="bodycontainer">
            <?php include("../maps/index_2.php"); ?>
		</div> <!-- /container -->

	<footer class="footer">
       <p id="footer">MindFree &copy;</p>
    </footer>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../js/ie10-viewport-bug-workaround.js"></script>
		<script src="../js/ie-emulation-modes-warning.js"></script>

        <script type="text/javascript">
            function recp(cate) {
                $('#list').load('data.php?cate=' + cate + "&radius=" + document.getElementById("range").value);
                //alert(radiusValue);
                //alert("data.php?cate=" + cate + "&radius=" + showValue());
                if(cate == "Family"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Family and Friends";
                     

                }else if(cate == "Health"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Health and Social Services";

                }else if(cate == "Legal"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Legal and Financial";

                }else if(cate == "Recreation"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Recreation and Culture";

                }else if(cate == "Spirituality"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Spirituality and Wellbeing";

                }else if(cate == "Work"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Work and School";

                }else if(cate == "Sex"){
                    var element = document.getElementById("resourcename");
                    element.innerHTML = "Sex and Relationships";

                }

            }
        </script>
	</body>
</html>