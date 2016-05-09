<?php
	include_once('includes/config.php');

    if ($_SESSION['STATUS'] === 'LOGGED_OUT'){
        header("Location: index.php");
    }

$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$email = $_GET['email'];
$num = $_GET['num'];

	include_once('includes/head.php');
?>

<section class="rooms">
	<div class="container">
	<div class="row">
		<h1 class="bookRoom margbot">Choose A Room</h1>
	</div>
		<div class="row">

<div class="col-sm-8 col-sm-offset-2">
			<?php        
$query = "SELECT id, room, room_num from rooms";

            $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
            while($row = mysqli_fetch_assoc($result)) {
				

echo "<div class='col-xs-6'>";
	echo "<a href='calendar.php?room=".$row['id']."&firstname=".$firstname."&lastname=".$lastname."&email=".$email."&num=".$num."' class='room_box'>";
		echo "<h3>{$row['room']} {$row['room_num']}</h3>";
	echo "</a>";
echo "</div>";


				}
            ?>
</div>

		</div>
	</div>
</section>
<img src="images/we-are-humber.png" id="weAreHumber">

<?php
	include_once('includes/scripts.php');
?>
