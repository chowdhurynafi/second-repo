<?php session_start();
if(!isset($_SESSION["username"]))
{
    	header("Location:blocked.php");
   		$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
}
?>

<!DOCTYPE html>

<html lang="en">
	
	<!-- HEAD TAG STARTS -->

	<head>
	
  		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
		<title>Flight Search | Tour&Travel</title>
    
    	<link href="css/main.css" rel="stylesheet">
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    	<script src="js/jquery-3.2.1.min.js"></script>
    	<script src="js/main.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	
	</head>
	
	<!-- HEAD TAG ENDS -->
	
	<!-- BODY TAG STARTS -->
	
	<body>
		
		<?php include("common/headerLoggedIn.php"); ?>
		
		<?php
		
			$type=$_POST["flightType"];
			$class=$_POST["flightClass"];
			$origin=$_POST["origin"];
			$destination=$_POST["destination"];
			$date=preg_split('/\//',$_POST['date']);
			$month = $date[0];
			$day = $date[1];
			$year = $date[2];
			$date = $year.'-'.$day.'-'.$month;
			if($type=="Return Trip") {	//let's store the return value only if the flightType is a Return Trip
				$return=$_POST["return"];
			}
			$adults=$_POST["adults"];
			$children=$_POST["children"];
			$noOfPassengers=(int)$adults+(int)$children;
		
			if($class=="Economy Class")
				$className="Economy";
			else
				$className="Business";
		
		?>
		
		<div class="spacer">a</div>
		
		<div class="searchFlights">
					
			<div class="query">
						
				<?php echo $type; ?> <?php echo $className; ?> Flights from <?php echo $origin; ?> to <?php echo $destination; ?>		
						
			</div>
			

		<?php
		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "tourntravel";
			
			// Creating a connection to MySQL database
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			// Checking if we've successfully connected to the database
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		//flight search query
			$sql = "SELECT * FROM flights WHERE origin='$origin' AND destination='$destination' AND class='$className' AND date='$date' ORDER BY seats_available DESC";
			$rowcount = mysqli_num_rows(mysqli_query($conn,$sql));
			
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				
		?>
			<div class="noOfFlights">
				<?php echo $rowcount ." flights found.";?>
			</div>
					
			<div class="listItemMenuContainer">
			
				<div class="col-sm-2 text-center">
	
					<div class="headings">
		
						Operator
			
					</div>
		
				</div>
			
				<div class="col-sm-2 text-center">
	
					<div class="headings">
		
						Departs
			
					</div>
		
				</div>
			
				<div class="col-sm-2 text-center">
	
					<div class="headings">
		
						Arrives
			
					</div>
		
				</div>
			
				<div class="col-sm-2 text-center">
	
					<div class="headings">
		
						Fare
			
					</div>
		
				</div>
			
				<div class="col-sm-2 text-center">
	
					<div class="headings">
		
						Ticket Type
			
					</div>
		
				</div>
			
				<div class="col-sm-2 text-center">
	
					<div class="headings">
		
						Seats Available
			
					</div>
		
				</div>
		
			</div> <!-- listItemMenuContainer -->
			
			<div class="spacerLarge">.</div> <!-- just a dummy class for creating some space -->
			
		</div> <!-- searchFlights -->
		
		<?php
				while($row = $result->fetch_assoc()) {
        			
		?>
		
		<div class="searchFlights">
					
			<div class="listItem">
													
				<!-- FLIGHT INFO STARTS -->
				
				<form action="booking.php" method="POST">

				<div class="col-sm-2 text-center">
									
					<div class="col-sm-4 text-center">
		
						<div class="operatorLogo text-center">
						
							<?php if(strtoupper($row["operator"])=="BIMAN"): ?>
				
							<img src="images/flights/operatorLogos/BIMAN.jpg">
							
							<?php elseif(strtoupper($row["operator"])=="NOVOAIR"): ?>
							
							<img src="images/flights/operatorLogos/NOVOAIR.jpg">
							
							<?php elseif(strtoupper($row["operator"])=="REGENT AIRWAYS"): ?>
							
							<img src="images/flights/operatorLogos/REGENTAIRWAYS.jpg">
							
							<?php elseif(strtoupper($row["operator"])=="US BANGLA"): ?>
							
							<img src="images/flights/operatorLogos/usbangla.jpg">
							
							<?php elseif(strtoupper($row["operator"])=="AIR ASTRA"): ?>
							
							<img src="images/flights/operatorLogos/AIRASTRA.jpg">
							
							<?php endif; ?>
							
							<!-- ADD OTHER OPERATORS HERE -->
				
						</div>
										
					</div>
									
					<div class="col-sm-8 text-center">
		
						<div class="values flightOperator">
			
							<?php if(strtoupper($row["operator"])=="BIMAN"): ?>
				
								Biman Bangladesh Airlines
							
							<?php elseif(strtoupper($row["operator"])=="NOVOAIR"): ?>
							
								NOVOAIR
							
							<?php elseif(strtoupper($row["operator"])=="REGENT AIRWAYS"): ?>
							
								Regent Airways
							
							<?php elseif(strtoupper($row["operator"])=="US BANGLA"): ?>
							
								US-Bangla Airlines
							
							<?php elseif(strtoupper($row["operator"])=="AIR ASTRA"): ?>
							
								Air Astra
							
							<?php endif; ?>
							
							<!-- ADD OTHER OPERATORS HERE -->
				
						</div>
			
						<div class="flightNoSubscript">
			
							<?php echo $row["flight_no"]; ?>
				
						</div>
									
					</div>
		
				</div>
	
				<!-- FLIGHT INFO ENDS -->
	
	
				<!-- DEPARTS STARTS -->

				<div class="col-sm-2 text-center">
		
					<div class="values departs">
		
						<?php echo $row["date"]; ?>
			
					</div>
		
					<div class="departsSubscript">
		
						<?php echo $row["origin"]; ?> - <?php echo $row["departs"]?>
			
					</div>
		
				</div>
	
				<!-- DEPARTS ENDS -->
	
	
				<!-- DESTINATION STARTS -->
	
				<div class="col-sm-2 text-center">
				
					<div class="values arrives">
		
						<?php echo $row["arrives"]; ?>
			
					</div>
		
					<div class="arrivesSubscript">
		
						<?php echo $row["destination"]; ?>
			
					</div>
		
				</div>
	
				<!-- DESTINATION ENDS -->
	
	
				<!-- FARE STARTS -->
	
				<div class="col-sm-2 text-center">
	
					<div class="values fare">
		
						 <?php echo $row["fare"]; ?>
			
					</div>
		
					<div class="fareSubscript">
		
						incl. of VAT
			
					</div>
		
				</div>
	
				<!-- FARE ENDS -->
									
									
				<!-- TYPE STARTS -->
	
				<div class="col-sm-2 text-center">
				
					<div class="values type">
		
						<?php echo $row["refundable"]; ?>
			
					</div>
		
					<div class="typeSubscript">
		
						<?php echo $row["class"]; ?>
			
					</div>
		
				</div>
	
				<!-- TYPE ENDS -->
	
	
				<!-- SEATS AVAILABLE STARTS -->
				
				<?php
				
				$flightNo = $row["flight_no"];
					
				$getSeatsAvailableSQL = "SELECT seats_available FROM `flights` WHERE flight_no='$flightNo'";
				$getSeatsAvailableQuery = $conn->query($getSeatsAvailableSQL);
				$SeatsAvailableGet = $getSeatsAvailableQuery ->fetch_array(MYSQLI_NUM);
			
				$seatsAvailable = $SeatsAvailableGet[0];
				
				?>
				
				<!-- allowing only those flights to be booked which have enough seats -->
				
				<?php if($seatsAvailable>=$noOfPassengers): ?>
					
				<div class="col-sm-2 text-center" style="border-right: none;"> 
	
					<div class="values availabilityGreen">
		
						<?php echo $row["seats_available"]; ?>
			
					</div>
		
					<div class="availabilitySubscript">
		
						<input type="submit" class="availabilityBookingButton" value="Book Now">
			
					</div>
		
				</div>
				
				<?php else:  ?>
				
				<div class="col-sm-2 text-center" style="border-right: none;"> 

					<div class="values availabilityRed">

						Unavailable
	
					</div>

					<div class="unavailabilitySubscript">

						Sold Out
	
					</div>

				</div>
				
				<?php endif;?>
	
				<!-- SEATS AVAILABLE ENDS -->
				
				<!-- Passing the $_POST values to the next page using hidden text boxes -->
		
				<input type="hidden" name="typeHidden" value="<?php echo $type; ?>">
				<input type="hidden" name="classHidden" value="<?php echo $class; ?>">
				<input type="hidden" name="originHidden" value="<?php echo $origin; ?>">
				<input type="hidden" name="destinationHidden" value="<?php echo $destination; ?>">
				<input type="hidden" name="departHidden" value="<?php echo $date; ?>">
				<input type="hidden" name="returnHidden" value="<?php echo $return; ?>">
				<input type="hidden" name="adultsHidden" value="<?php echo $adults; ?>">
				<input type="hidden" name="childrenHidden" value="<?php echo $children; ?>">
				<input type="hidden" name="flightNoOutboundHidden" value="<?php echo $row["flight_no"]; ?>">
				<input type="hidden" name="modeHidden" value="<?php echo "OneWayFlight" ?>">
				
				</form>
				
			</div> <!-- listItem 1 -->
		
		</div>

   		<?php
    			
				}
			
			} else {
    			
		?>
		
		<div class="searchFlights">
		
			<div class="noFlights">
			
				No flights found.
			
			</div>
		
		</div>
		
		<?php
			
			}
		
		?>
		
		<?php $conn->close(); //closing the connection to the database ?>
			
		<div class="spacerLarge">.</div> <!-- just a dummy class for creating some space -->
			
		<?php include("common/footer.php"); ?>
				
	</body>
	
	<!-- BODY TAG ENDS -->
	
</html>