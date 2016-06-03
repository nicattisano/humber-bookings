<?php
	include_once('includes/config.php');

if (isset($_POST['book'])) {
	
//	echo '<pre>';
//	print_r( $_POST );
//	echo '</pre>';
	
	$checkin = $_POST['checkin'];
//	echo $checkin;
	$checkout = $_POST['checkout'];
//	echo $checkout;
	
				$room = $_GET['room'];
//				$room = intval($room);
				$day = $_GET['day'];
				$month = $_GET['month'];
				$year = $_GET['year'];
				$date = $year.'-'.$month.'-'.$day;
				$firstname = $_GET['firstname'];
				$lastname = $_GET['lastname'];
				$name = $firstname . ' ' . $lastname;
				$email = $_GET['email'];
				$num = $_GET['num'];
	
	
	$query = 'SELECT * from bookings WHERE rooms_id = "' . $_GET['room'] . '" AND date = 
	"' . $_GET['year'] . '-'. 
		$_GET['month'] . '-' . 
		$_GET['day'] . '"';
    
    
//	$query = 'SELECT * from bookings WHERE rooms_id = "' . $_GET['room'] . '" AND date = 
//	' . $_GET['year'] . '-'. 
//		$_GET['month'] . '-' . 
//		$_GET['day'].' AND starttime <= "'.$checkout.'" AND endtime > "'.$checkin.'" ' ;
//	
	//echo '<br>'.$query.'<br>';
//	die();
//    echo("\$query==$query");
   
	$result = mysqli_query($connect, $query) or die(mysqli_error($connect));
       //var_dump($result);        
     //die("...");


            $conflicts = array();
	
            if($result->num_rows > 0) {
                $someMSG = "";
                while($row = $result->fetch_assoc()) {
                    
                    //what are the possible kinds of time conflict?
                    //oldBookine, is the row
                    //newPotentialBooking (npb) is the thing we want to check
                    //if npb starts before row, but ends somttime after row starts
                    //if npb starts after row stars, but ends before row ends
                    
                    //circumstance A - where npb starts before row, adn ends after row starts
                    if ($row['starttime'] == 8) {
                       //ok lets try this
                        echo 'yes';
                        array_push($conflicts, $row);
                    }
                   
                    //circumstance B- where npb starts after row start, adn ends before row end
                    //circumstance C - where npb starts after row start, adn ends after row ends
                    
                }
                
                
            }
            if (count($conflicts) > 0) {
                //conflict message
//                var_dump($conflicts);
//                echo 'Conflict';
            } else {
                //insert
                $query = "
					INSERT INTO 
					bookings 
					(date, starttime, endtime, rooms_id, name, email, num) 
					VALUES
					('{$date}',
					'{$checkin}', 
					'{$checkout}', 
					'{$room}', 
					'{$name}', 
					'{$email}', 
					'{$num}'
					)
				";	

				$result = mysqli_query($connect, $query) or die(mysqli_error($connect));

            }
			
		}
	//HEADER LOCATION = SAME PAGE WITH ALL THE GET VARS & ADD A ERROR VAR
	//ELSE
	//INSERT THEIR BOOKING TO TABLE AND REDIRECT TO CONFIRMATION PAGE
	// PASS A BOOKING ID
	// USE MYSQL_INSERT_ID()
	

// If form submitted
// Use same query to count how many events overlap
/*
$query = 'SELECT * from bookings WHERE rooms_id = ' . $_GET['room'] . ' AND date = "' . $_GET['year'] . '-'. $_GET['month'] . '-' . $_GET['day'].'" AND starttime <= "'.START FROM POST.'" AND endtime > "'.floor($i/4).':'.($i % 4 * 15).'" ' ;

*/
//SWITCH LOGIC TO START FROM DATABASE IS BEFORE THE $_POST END AND THE DATABASE END IS AFTER THE $_POST START
// IF NUM ROWS > 0 DISPLAY ERROR BECASUE BOOKING ALREADY EXISTS

    if ($_SESSION['STATUS'] === 'LOGGED_OUT'){
        header("Location: index.php");
    }
	include_once('includes/head.php');

$room = $_GET['room'];
$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];

//echo $room .'<br>';
//echo $day .'<br>';
//echo $month .'<br>';
//echo $year .'<br>';

?>

	<section class="theday">
		<div class="container">
			<div class="row">
				<h1 class="bookRoom margDay">Book Time on <?php
echo  $month . ' ' . $day . ', ' . $year ;?></h1>
			</div>
			
			<div class="row">

				<div class="col-xs-8">
				
				
					<?php


			for($i = 32; $i <84; $i++) {
				
				$query = 'SELECT * from bookings WHERE rooms_id = ' . $_GET['room'] . ' AND date = "' . $_GET['year'] . '-' . $_GET['month'] . '-' . $_GET['day'] . '" AND starttime <= "'.floor($i/4).':'.($i % 4 * 15).'" AND endtime > "'.floor($i/4).':'.($i % 4 * 15).'" ' ;
	                $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
				
//				echo $query;
				
				
				echo "<div class='";
				
				if(mysqli_num_rows($result)) {
						echo 'unavailable';
				}else {
						echo 'available';
					}
				
				echo "'>";
				
				
				$hour = floor($i/4) % 12;
				
//				echo $hour;
				
				echo $hour ? $hour : 12;
				
			
				
				
				$mins = ($i % 4 * 15);
				
		if (strlen($mins) === 1) {
			echo ':'.$mins. '0';
		} else {
			echo ':'.$mins;
		}
				

				
				
				
				echo "</div>";
			}

			?>

				</div>
				<div class="col-xs-4">
				
				
<?php
				$firstname = $_GET['firstname'];
				$lastname = $_GET['lastname'];
				$name = $firstname . ' ' . $lastname;
				$email = $_GET['email'];
				$num = $_GET['num'];
?>
				
					<form action="<?php echo $_SERVER['PHP_SELF'] . '?room='.$room.'&day='.$day.'&month='.$month.'&year='.$year.'&firstname='.$firstname.'&lastname='.$lastname.'&email='.$email.'&num='.$num; ?>" method="post">
						<div class="form-group">
							<label for="checkin">Check In Time</label>
							<select class="form-control" id="checkin" name="checkin">
								
			<option disabled selected>Select Check In Time</option>

								<!-- SAME LLOP FROM ABOVE TO GENERATE OPTIONS -->
								<?php		

			for($i = 32; $i <84; $i++) {
				$query = 'SELECT * from bookings WHERE rooms_id = ' . $_GET['room'] . ' AND date = "
				' . $_GET['year'] . '-
				' . $_GET['month'] . '-
				' . $_GET['day'].'" AND starttime <= "'.floor($i/4).':'.($i % 4 * 15).'" AND endtime > "'.floor($i/4).':'.($i % 4 * 15).'" ' ;
	                $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
//				echo $query;
				
				$milHour = $i/4;
//				echo '<br>'.$milHour.'<br>';
				$justHr = explode('.',$milHour);
				echo $justHr[0];
				
				// Generate well formatted time
				$checkinHour = floor($i/4) % 12;
				
				$time = $checkinHour ? $checkinHour : 12;
				
				$checkinMins = ($i % 4 * 15);
				
				if (strlen($checkinMins) === 1) {
					$time .= ':'.$checkinMins. '0';
				}else {
					$time .= ':'.$checkinMins. '';
				}
				
				echo '<option value="'.$justHr[0].':'.$checkinMins.'">'.$time.'</option>';
				
			}
echo "</select>";

?>
							</select>
						</div>


						<div class="form-group">
							<label for="checkout">Check Out Time</label>
							<select class="form-control" id="checkout" name="checkout">

							
		<option disabled selected>Select Check Out Time</option>
								<!-- SAME LLOP FROM ABOVE TO GENERATE OPTIONS -->
								<?php		

			for($i = 32; $i <84; $i++) {
				$query = 'SELECT * from bookings WHERE rooms_id ='. $_GET['room'] . ' AND date = "' . $_GET['year'] . '-'. $_GET['month'] . '-' . $_GET['day'].'" AND starttime <= "'.floor($i/4).':'.($i % 4 * 15).'" AND endtime > "'.floor($i/4).':'.($i % 4 * 15).'" ' ;
	                $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
//				echo $query;
				
				$milHour = $i/4;
//				echo '<br>'.$milHour.'<br>';
				$justHr = explode('.',$milHour);
				echo $justHr[0];
				
				
				// Generate well formatted time
				$checkOutHour = floor($i/4) % 12;
				
				$time = $checkOutHour ? $checkOutHour : 12;
				
				$checkOutMins = ($i % 4 * 15);
				
				if (strlen($checkOutMins) === 1) {
					$time .= ':'.$checkOutMins. '0';
				}else {
					$time .= ':'.$checkOutMins. '';
				}
				
				echo '<option value="'.$justHr[0].':'.$checkOutMins.'">'.$time.'</option>';		
			}
?>
							</select>
							</div>

						<div class="form-group">
							<input type="submit" value="Book" class="form-control" id="book" name="book">
						</div>
					</form>
				</div>

			</div>
		</div>
	</section>
		
<img src="images/we-are-humber.png" id="weAreHumber">

	<?php
	include_once('includes/scripts.php');
?>