<html>

<?php include 'garden_cal_functions.php';?>


<head>

	<title>
		Urban Vine Gardening Help
	</title>

</head>


<div class = "garden_cal_body">

	<h3> <?php echo "<b>Profile</b>: Zone ".$_POST["zone"].", ".ucwords($_POST["plant_type"]).", ".ucwords($_POST["garden_type"])." Garden </br>" ?> </h3>

	<br>

	I can't believe it is <?php echo the_season();?>! What a great time to start thinking about a garden! Here are some dates to keep in mind:

	<ul>
		<li>
			The last frost date in Zone <?php echo $_POST["zone"]?> is <?php echo display_date(zone_last_frost($_POST["zone"]));?>
		</li>
		<li>
			Plant your seeds indoors between <?php echo plant_date(zone_last_frost($_POST["zone"]), '-56 days')." and ".plant_date(zone_last_frost($_POST["zone"]), '-42 days');?>
		</li>
		<li>
			If you have decided to plant seedlings, get them started between <?php echo plant_date(zone_last_frost($_POST["zone"]), '-30 days')." and ".plant_date(zone_last_frost($_POST["zone"]), '-20 days');?>
		</li>
		<li>
			Remember that you will need to apply the first fertilizer around <?php echo plant_date(zone_last_frost($_POST["zone"]), '+45 days')?>
		</li>
	</ul>

</div>

</html>