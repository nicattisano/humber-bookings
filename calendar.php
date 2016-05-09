<?php
	include_once('includes/config.php');

    if ($_SESSION['STATUS'] === 'LOGGED_OUT'){
        header("Location: index.php");
    }
	include_once('includes/head.php');
?>
	<style>
		#myCarousel .nav a small {
			display: block;
		}
		
		#myCarousel .nav {
			background: #eee;
		}
		
		#myCarousel .nav a {
			border-radius: 0px;
		}
		
		.carousel-inner {
			margin-bottom: 12px;
		}
		
	.nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
    color: #fff;
    background-color: #333333;
}
		
	</style>
	<section class="rooms">
		<div class="container">
			<div class="row">
				<h1 class="bookRoom">Choose a date</h1>
			</div>
			<div class="row">


				<?php

$month = date("n"); 
//echo $month;
$year = date("Y"); 
//echo $year;
$monthName = jdmonthname($month, 1); 

//NEXT MONTH
$dateNext1 = date('Y-n-d', strtotime('+1 month'));
//echo '<br>'.$dateNext1 . '<br>';

$dateValue1 = $dateNext1;
$yearNext1 = date('Y',strtotime($dateNext1));
//echo $yearNext1 .'<br>';
$monthNext1 = date('n',strtotime($dateNext1));
//echo $monthNext1;
$monthName1 = jdmonthname($monthNext1, 1); 

//2 MONTHS
$dateNext2 = date('Y-n-d', strtotime('+2 month'));
//echo '<br>'.$dateNext2 . '<br>';

$dateValue2 = $dateNext2;
$yearNext2 = date('Y',strtotime($dateNext1));
//echo $yearNext1 .'<br>';
$monthNext2 = date('n',strtotime($dateNext2));
//echo $monthNext2;
$monthName2 = jdmonthname($monthNext2, 1); 

//3 MONTHS
$dateNext3 = date('Y-n-d', strtotime('+3 month'));
//echo '<br>'.$dateNext3 . '<br>';

$dateValue3 = $dateNext3;
$yearNext3 = date('Y',strtotime($dateNext3));
//echo $yearNext3 .'<br>';
$monthNext3 = date('n',strtotime($dateNext3));
//echo $monthNext3;
$monthName3 = jdmonthname($monthNext3, 1); 

//4 MONTHS
$dateNext4 = date('Y-n-d', strtotime('+4 month'));
//echo '<br>'.$dateNext4 . '<br>';

$dateValue4 = $dateNext4;
$yearNext4 = date('Y',strtotime($dateNext4));
//echo $yearNext4 .'<br>';
$monthNext4 = date('n',strtotime($dateNext4));
//echo $monthNext4;
$monthName4 = jdmonthname($monthNext4, 1); 

function draw_calendar($month,$year){
	
$room = $_GET['room'];
//echo $room;
	
	
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];
$num = $_GET['num'];
	
	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day"><a href="theday.php?room='.$room.'&firstname='.$firstname.'&lastname='.$lastname.'&email='.$email.'&num='.$num.'&day='.$list_day.'&month='.$month.'&year='.$year.'" class="numa">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div></a>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

/* sample usages */



?>




					<div id="myCarousel" class="carousel slide" data-ride="carousel">

						<!-- Wrapper for slides -->
						<div class="carousel-inner">

							<div class="item active">
								<?php
//echo '<h2>'.$month . ', ' . $year.'</h2>';
echo draw_calendar($month,$year);
?>
							</div>
							<!-- End Item -->

							<div class="item">
								<!--          <img src="http://placehold.it/1200x440/999999/cccccc">-->
								<?php
//echo '<h2>M: '.$monthNext1. ' Y: ' . $yearNext1.'</h2>';
echo draw_calendar($monthNext1,$yearNext1);

?>

							</div>
							<!-- End Item -->

							<div class="item">
								<?php
//echo '<h2>M: '.$monthNext2. ' Y: ' . $yearNext2.'</h2>';
echo draw_calendar($monthNext2,$yearNext2);

?>
							</div>
							<!-- End Item -->

							<div class="item">
								<?php
//echo '<h2>M: '.$monthNext3. ' Y: ' . $yearNext3.'</h2>';
echo draw_calendar($monthNext3,$yearNext3);

?>
							</div>
							<!-- End Item -->

						</div>
						<!-- End Carousel Inner -->


						<ul class="nav nav-pills nav-justified">
							<li data-target="#myCarousel" data-slide-to="0" class="active">
								<a href="#">
									<?php echo $month; ?><small><?php echo $year; ?></small></a>
							</li>
							<li data-target="#myCarousel" data-slide-to="1">
								<a href="#">
									<?php echo $monthNext1; ?><small><?php echo $yearNext1; ?></small></a>
							</li>
							<li data-target="#myCarousel" data-slide-to="2">
								<a href="#">
									<?php echo $monthNext2; ?><small><?php echo $yearNext3; ?></small></a>
							</li>
							<li data-target="#myCarousel" data-slide-to="3">
								<a href="#">
									<?php echo $monthNext3; ?><small><?php echo $yearNext3; ?></small></a>
							</li>
						</ul>


					</div>
					<!-- End Carousel -->








					<!--
<?php
echo '<h2>M: '.$month. ' Y: ' . $year.'</h2>';
echo draw_calendar($month,$year);

?>
-->

			</div>
		</div>
	</section>
<img src="images/we-are-humber.png" id="weAreHumber">

	<?php
	include_once('includes/scripts.php');
?>