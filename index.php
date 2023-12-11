<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.plot.ly/plotly-2.26.0.min.js" charset="utf-8"></script>
	<!-- <link rel="stylesheet" href="style.css">
	<link href="page2.html"> -->
	<style>
		body {
    font-family: cursive;
    text-align: left;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 90vh;
    position: relative; /* Ensure the ::before pseudo-element is positioned relative to the body */
}

body::before {
    content: "";
    background-image: url('8L0A6440.jpg'); /* Replace 'your-image-path.jpg' with the actual path to your image */
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center center ;
    filter: blur(3px); /* Adjust the blur value as needed */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1; /* Place the pseudo-element behind the content */
}
@media screen and (max-width: 2069px) {
    body {
        font-size: 14px;
    }

    .col-md-11 {
        max-width: 100%;
        padding: 10px;
    }

    .question-title h3 {
        font-size: 14px;
    }

    .ans {
        font-size: 12px;
    }

    .btn-primary {
        font-size: 14px;
    }
    
}

/* Additional media queries as needed */
@media screen and (max-width: 1168px) {
    body {
        font-size: 12px;
    }
    .container mt-5
    {
        
    }
    .col-md-11 {
        max-width: 100%;
        padding: 5px;
    }

    .question-title h3 {
        font-size: 12px;
    }

    .ans {
        font-size: 10px;
    }

    .btn-primary {
        font-size: 12px;
    }
}
	</style>
</head>
<body>
<div>
    <canvas id="myChart"></canvas>
  </div>
<div class="container mt-5">
	<div class="d-flex justify-content-center row">
		<div class="col-md-11 col-lg-11">
			<center><span style="font-size:30px;font-weight:bolder">What's Your Strategy? </span></center>
			<!-- <div class="d-flex justify-content-between mt-3">
				<button class="btn btn-primary btn-lg strategybutton" name="strategybutton" onclick="passvalue('banking')">Banking</button>
				<button class="btn btn-primary btn-lg strategybutton" name="strategybutton" onclick="passvalue('housing')">Housing</button>
				<button class="btn btn-primary btn-lg strategybutton"  name="strategybutton" onclick="passvalue('retail')">Retail</button>
			</div> -->
			
			<div class="dropdown text-center">
			
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Select Sector
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item strategybutton" href="#" onclick="updateButtonText('Banking')">banking</a>
				<a class="dropdown-item strategybutton" href="#" onclick="updateButtonText('Housing')">housing</a>
				<a class="dropdown-item strategybutton" href="#" onclick="updateButtonText('Retail')">retail</a>
			</div>
			</div>
		<script>
        function updateButtonText(selectedSector) {
            document.getElementById('dropdownMenuButton').textContent = selectedSector;
        }
		
    	</script>
		<?php 
		session_start();
		$total_corpus = 1000000; 
		?>
		<script>
		var total_corpus = <?php echo $total_corpus; ?>; // Pass the PHP value to JavaScript
		</script>

        <?php
        session_start();
        include "db_conn.php";
        
        if (!isset($_SESSION['user_name'])) {
            header("Location: login.php");
            exit();
        }
        
        // Query to retrieve usernames, distances, and quarters
        $sql = "SELECT email, distance, quarter,profit FROM users"; // Update 'username' to 'email' if needed
        
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            echo "<div id='leaderboard' style='position: fixed; top: 20px; left: 20px; background-color: #f0f0f0; padding: 10px; border: 1px solid #ccc; max-width: 350px;font-size: 12px;'>";
            echo "<table>
                    <tr>
                        <th colspan='3' style='text-align: center;'>Leaderboard</th> <!-- colspan='3' font-size: 10px;' spans the heading across all three columns -->
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>Distance</th>
                        <th>Quarter</th>
                        <th>Profit</th>
                    </tr>";
        
            while ($row = mysqli_fetch_assoc($result)) {
                $email = $row['email']; // Update to 'email'
                $distance = $row['distance'];
                $quarter = $row['quarter'];
                $profit = $row['profit'];
                
        
                echo "<tr>
                        <td>$email</td>
                        <td>$distance</td>
                        <td>$quarter</td>
                        <td>$profit</td>
                    </tr>";
            }
        
            echo "</table>";
            echo "</div>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);
			function randomEvent() {
				return mt_rand(1, 40);
			}
			
			function array_events() 
			{
				$max_events = mt_rand(10, 20);
				// print_r($max_events);
				$quarter_events = array();
			
				for ($i = 0; $i < $max_events; $i++) {
					$quarter_events[] = randomEvent();
				}
			
				rsort($quarter_events);
				// $quarter_events = array_unique($quarter_events);  // finding unique array elements
				// $unique_size = print_r(count($quarter_events));	  // array size of unique array
				return $quarter_events;
			}
			
			$quarter_events = array_events();
			// echo "Quarter Events Array: ";
			// print_r($quarter_events);

			for ($i = 1; $i <= 40; $i++) 
			{
				?>
				<div class="border" id="div<?php echo $i; ?>" style="<?php if ($i != 1) echo 'display: none;'; ?>">
					<div class="question bg-white p-3 border-bottom">
						<div class="d-flex flex-row justify-content-between align-items-center mcq">
						<span id="tc<?php echo $i; ?>" style="font-size:16px;font-weight:bold;margin-top:0px;"><?php echo number_format($total_corpus); ?></span>

							<span style="font-size:16px;font-weight:bold;margin-left:-100px;">Quarter <span
										id="q"><?php echo $i; ?></span> out of 40</span>
							Alloted: <span id="qp<?php echo $i; ?>"  style="font-size:16px;font-weight:bold;">25000</span>
							Used: <span id="qq<?php echo $i; ?>" style="font-size:16px;font-weight:bold;">0</span>
						</div>
					</div>
					<?php
					$arr = array(
						"d1" => "Reduce general operating expenses",
						"d2" => "Meet industry regulatory requirements",
						"d3" => "Prevent cyber attacks and data breaches",
						"d4" => "Mitigate operational risks such as poor access controls and data losses",
				// 		"d5" => "Improve IT infrastructure and reduce data-related costs",
				// 		"d6" => "Streamline back-office systems and processes",
				// 		"d7" => "Improve data quality (completeness, accuracy, timeliness)",
				// 		"d8" => "Rationalize multiple sources of data and information (consolidate and eliminate redundancy)",
						"o1" => "Improve revenue through cross-selling, strategic pricing, and customer acquisition",
						"o2" => "Create new products and services",
						"o3" => "Respond rapidly to competitors and market changes",
						"o4" => "Use sophisticated customer analytics to drive business results",
				// 		"o5" => "Leverage new sources of internal and external data",
				// 		"o6" => "Monetize company data (sell as a product or a service)",
				// 		"o7" => "Optimize existing strong bench of analysts and data scientists",
				// 		"o8" => "Generate return on investments in big data and analytics infrastructure"
					);
					$keys = array_keys($arr);
					shuffle($keys);
					?>
					<div class="question bg-white p-10 border-bottom">
						<div class="d-flex flex-row align-items-center question-title" style="width: 300px; padding: 10px;">
							<h3 class="text-danger" style="font-size: 18px;"></h3>
						</div>
						<?php
						foreach ($keys as $key) {
							?>
							<div class="ans col-md-12  style="font-size: 14px;"">
								<div class="row">
									<div class="col-md-8">
										<label class="checkbox">
											<input type="checkbox" name="s<?php echo $i; ?>" value="<?php echo $key; ?>"
												   onclick="enab_rng(this, <?php echo $i; ?>);">
											<span class="col-md-12"><?php echo $arr[$key]; ?></span>
										</label>
									</div>
									<div class="col-md-4">
										<input type="range" class="form-range" disabled="true" min="1000" max="25000"
											   step="1000" value="5000" oninput="get(this, <?php echo $i; ?>);">
										<span style="font-size:12px;margin-top:-20px;background-color:lightgray;padding:3px 5px;">5000</span>
									</div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
					<div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
					<button class="btn btn-primary d-flex align-items-center btn-primary" type="button" onclick="fun(<?php echo $i; ?>,<?php echo json_encode($quarter_events); ?>)">Next<button>
					<button id="logoutButton" class="btn btn-primary" onclick="logout(<?php echo $i; ?>)">End the game</button>
				</div>
					<!-- <script>
						function callFun() {
							// Replace these values with appropriate JavaScript values
							var i = <?php echo $i; ?>;
							var quarter_events = <?php echo json_encode($quarter_events); ?>;
							var value = '<?php echo $value; ?>';

							// Call the JavaScript function with the PHP variables
							fun(i, quarter_events, value);
						}
					</script> -->
				</div>
			

				
				<?php
			}
			?>

			

		<?php
		
			// Function to set the distance value in a session variable
			// function setDistanceInSession($distance) {
			// 	$_SESSION['distance'] = $distance;
			// }
			
			// // Calling the function to set the distance value
			// $distance = 42; // Replace 42 with your actual distance value
			// setDistanceInSession($distance);
		?> 
		
		</div>
		<div id="showans">

		</div>
	</div>
</div>

<div id="tester" style="width:600px;height:250px;"></div>
<script>
function createBarChart(sectorval, totalTLTD) {
    TESTER = document.getElementById('tester');

    // Define the updates for x and y axis ranges
    var update = {
        title: 'Data Strategy',
        'xaxis.range': [40, 160],   // updates the x-axis range
        'yaxis.range': [5,16]    // updates the y-axis range
    }

    // Create the initial Plotly chart with markers mode
    Plotly.newPlot(TESTER, [{
        x: [sectorval.offValue, totalTLTD.TO],
        y: [sectorval.diffValue, totalTLTD.TD],
        mode: 'markers', // Set the mode to 'markers' for scatter plot with markers
		marker: {
            size: 8, // Adjust the marker size as needed
            color: ['red', 'blue'] // Marker color
        },
        legendgroup: 'markers',
        showlegend: false
    }],  {
        margin: { t: 40 },
        xaxis: {
            title: 'Offensive', // Title for the x-axis
        },
        yaxis: {
            title: 'Defensive', // Title for the y-axis
        }
    });
Plotly.addTraces(TESTER, [
        {
            type: 'scatter',
            mode: 'text',
            x: [sectorval.offValue],
            y: [sectorval.diffValue],
            text: ['Initial'],
            textposition: 'bottom center',
            showlegend: false,
            textfont: {
                family: 'Arial',
                size: 10,
                color: 'black'
            }
        },
        {
            type: 'scatter',
            mode: 'text',
            x: [totalTLTD.TO],
            y: [totalTLTD.TD],
            text: ['current'],
            textposition: 'bottom center',
            showlegend: false,
            textfont: {
                family: 'Arial',
                size: 10,
                color: 'black'
            }
        }
    ]);
    
    // Update the chart with the specified axis ranges
    Plotly.update(TESTER, update);
}


	

</script>


   
<script>
	window.onbeforeunload = function (event) 
	{
		return "";
	};
</script>

<script type="text/javascript">
 function logout(quarter) {
     var xhr = new XMLHttpRequest();
      xhr.open("POST", "your_server_script.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
         if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server if needed
            console.log(xhr.responseText);
         }
      };
      xhr.send("quarter=" + quarter);
     
            // You can add any additional logout actions here, like ending the session
            // or clearing user data, if necessary.

            // Redirect to the logout page (logout.php)
            window.location.href = `logout.php`;
        }

// ////    offensive diffensive selected  ////
// 	var OffValue = 0; // Variable of offensive value
// 	var DiffValue = 0;

function selectSector(sector) {
		var OffValue = 0; // Variable of offensive value
		var DiffValue = 0;
		sessionStorage.setItem("sector",sector)
	if (sector === "banking") {
		OffValue=1;
		DiffValue=5;
	}
	else if (sector === 'housing'){
		OffValue=3;
		DiffValue=3;
	}
	else if (sector ==='retail')
	{
		OffValue=5;
		DiffValue=1;
	}
	
	var sectorValues = {
            offValue: OffValue,
            diffValue: DiffValue
        };
		return sectorValues;
}
function passvalue(value)
{
	
	sessionStorage.setItem("sector",sector)
 	return clickedValue = value;
}
function displayValues(sector)
{
	    // var clickedValue = value;
        var  sectorValues= selectSector(sector);
        alert("Selected Sector: " + sector + "\nOffValue: " + sectorValues.offValue + "\nDiffValue: " + sectorValues.diffValue);
	return sectorValues;
}

//////////////////////////

// Generating random event array for hurdles //

	// var quarter_events = array_events(); 

	// function randomEvent() {
	// 	return Math.floor(Math.random() * 40) + 1;
	// }

	// function array_events() {
	// 	var max_events = Math.floor(Math.random() * (30 - 10)) + 10;
	// 	var quarter_events = [];

	// 	for (var i = 0; i < max_events; i++) {
	// 		quarter_events.push(randomEvent());
	// 	}

	// 	quarter_events.sort(function (a, b) {
	// 		return a - b;
	// 	});

	// 	return quarter_events;   //this contains randomly generated events array from 40 values
	// }

///////////////////////////////////////////////


//// random event occurence ////

function getRandomValueInRow1(events) {

		console.log("Entered getRandom function 1")
		const row1 = events[0];
		const randomIndex = Math.floor(Math.random() * row1.length);
		var randomValueInRow1 = row1[randomIndex];
		console.log(`randomValueInRow1 : ${randomValueInRow1}`)
		return randomValueInRow1;
	}

	function getRandomValueInRow2(events) {
		console.log("Entered getRandom function 2")
		
		const row2 = events[1];
		
		const randomIndex = Math.floor(Math.random() * row2.length);
		var randomValueInRow2 = row2[randomIndex];
		console.log(`randomValueInRow2 : ${randomValueInRow2}`)
		return randomValueInRow2;
	}

	function getRandomValueInRow3(events) {
		console.log("Entered getRandom function 3")
		const row3 = events[2];
		
		const randomIndex = Math.floor(Math.random() * row3.length);
		var randomValueInRow3 = row3[randomIndex];
		console.log(`randomValueInRow3 : ${randomValueInRow3}`)
		return randomValueInRow3;
	}

	

	function event_occurence(quarter, quarterEventsArray) {
		console.log("Entered event_occureance funciton")
		console.log(`quarter : ${quarter}\nquarterEventsArray : ${quarterEventsArray}`);
		var events = [
			[1000000,500000,250000,1000000,500000,250000,1000000,500000,250000,1000000],
			[1000000, 0,500000, 0,250000, 0, 250000, 0, 500000, 150000],
			[500000, 0, 0, 250000, 0, 0,150000, 0, 0,500000 ]
		];
		
		var amt = quarter * 25000;
		if (amt < 3300000) {
			return getRandomValueInRow1(events);

		} else if (amt >= 3300000 && amt <= 6600000) {
			var rd1 = getRandomValueInRow1(events);
			var rd2 = getRandomValueInRow2(events);
			console.log(`returning rand : ${rand(rd1, rd2)}`)
			return rand(rd1,rd2);
		} else {
			return getRandomValueInRow3(events);
		}

}

var totalProfit = 0;


function calculateDeviation(totalsec,Totalcounts,value_of_initial_corpus,Type_of_event,quarter) 
{
	console.log("Entered deviation function")
	console.log(`totalsec : ${JSON.stringify(totalsec)}`);
	console.log(`Totalcounts : ${JSON.stringify(Totalcounts)}`);
	console.log(`value_of_initial_corpus : ${value_of_initial_corpus}`);

  const x1 = totalsec["offValue"]; // x (latitude) component of the first coordinate
  const y1 = totalsec["diffValue"]; // y (longitude) component of the first coordinate
  const x2 = Totalcounts["TO"]; // x (latitude) component of the second coordinate
  const y2 = Totalcounts["TD"]; // y (longitude) component of the second coordinate
  var distance = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
  console.log(`distance : ${distance}`);
  sessionStorage.setItem("distance", distance)
if (distance<2.5)
{
	var profit=Math.floor(-(25000*(1.414-distance)))
	 totalProfit += profit;
	if(profit < 0)
	{
	    profit=-(profit)
	}
	updateProfitInDatabase(totalProfit);
	alert("Profit has been credited " + profit )
}
else{
	profit=0;
}
//    total_corpus += profit;

//     // // Display the updated total corpus value on the HTML page
//     var changingC = document.getElementById('tc' + quarter);
//     changingC.innerText = number_format(total_corpus)


    // Add profit to the total_corpus
    total_corpus += profit;

    // Update the total corpus value displayed on the HTML page
    var changingC = document.getElementById('tc' + quarter);
	console.log(`Debug Latest: \ntotal corpus value : ${number_format(total_corpus)}\nQuarter number : $${quarter}\n Inside getelebyid : ${'tc' + quarter}`);
    changingC.innerText = number_format(total_corpus);

console.log(Math.floor(profit))
  if (Type_of_event==="favourable")
  {
	console.log("entered favourable")
	return -(value_of_initial_corpus*(1-distance));
  }
  else
  {
	console.log("entered adversial")
	return (value_of_initial_corpus*distance);
  }
}

// function  moveToNextQuarter(currentQuarter) {
//     if (currentQuarter < 40) {
//         var nextQuarter = currentQuarter + 1;
//         $("#div" + currentQuarter).hide();
//         $("#div" + nextQuarter).show();
        
//         // Update the total corpus for the next quarter
//         total_corpus = parseInt($("#tc" + currentQuarter).text().replace(/,/g, ''));
//         $("#tc" + nextQuarter).text(number_format(total_corpus));
//     }
// }


function updateProfitInDatabase(profit) {
    // AJAX request to update profit in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "profit_script.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define the data to be sent to the server
    var data = "profit=" + encodeURIComponent(profit);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle the response from the server if needed
            console.log(xhr.responseText);
        }
    };

    // Send the request
    xhr.send(data);
}


	/////////////////////////////////
	var enabledSliders = []; // Array to store enabled sliders' values
	var total_corpus = 1000000; // Set the initial total corpus value
	var used_amounts = new Array(41).fill(0); // Array to store used amounts for each quarter
	var totalO = 0; // Variable to store the total count of opportunities
	var totalD = 0; // Variable to store the total count of difficulties

	// Associative arrays to store the counts of "O" and "D" for each quarter
	var selectedOCounts = {};
	var selectedDCounts = {};
	function updateODCounts(quarter) {
    totalO = 0;
    totalD = 0;

    for (var quarter in selectedOCounts) {
        totalO += selectedOCounts[quarter];
    }

    for (var quarter in selectedDCounts) {
        totalD += selectedDCounts[quarter];
    }
	// if (quarter == 0)
	// 	{
	// 		TO: totalO,
	// 		TD: totalD
	// 	}

    var Totalcounts = {

        TO: totalO/(quarter),
        TD: totalD/(quarter)
    };

    console.log(`Totalcounts : ${JSON.stringify(Totalcounts)}`);
    return Totalcounts;
}

function updateSelectedCounts(quarter) {
    selectedOCounts[quarter] = 0;
    selectedDCounts[quarter] = 0;

    $('input:checkbox:checked[name="s' + quarter + '"]').each(function () {
        var value = $(this).val();
        if (value.charAt(0) == 'o') {
            selectedOCounts[quarter]++;
        } else if (value.charAt(0) == 'd') {
            selectedDCounts[quarter]++;
        }
    });

    updateODCounts();
}


	// ///  calculating count of o and d
	// var enabledSliders = []; // Array to store enabled sliders' values
	// var total_corpus = 1000000; // Set the initial total corpus value
	// var used_amounts = new Array(41).fill(0); // Array to store used amounts for each quarter
	// var totalO = 0; // Variable to store the total count of opportunities
	// var totalD = 0; // Variable to store the total count of difficulties

	// // Associative arrays to store the counts of "O" and "D" for each quarter
	// var selectedOCounts = {};
	// var selectedDCounts = {};
	
	// Helper function to update the counts of "O" and "D" for the current quarter
	// function updateSelectedCounts(quarter) {
	// 	// selectedOCounts[quarter] = 0;
	// 	// selectedDCounts[quarter] = 0;
	// 	// $('input:checkbox:checked[name="s' + quarter + '"]').each(function () {
	// 	// 	var value = $(this).val();
	// 	// 	if (value.charAt(0) == 'o') {
	// 	// 		selectedOCounts[quarter]++;
	// 	// 		totalO++;
	// 	// 	} else if (value.charAt(0) == 'd') {
	// 	// 		selectedDCounts[quarter]++;
	// 	// 		totalD++;
	// 	// 	}
	// 	// });
			

	// var selectedOCount = 0;
    // var selectedDCount = 0;

    // // Count the selected "O" and "D" checkboxes
    // $('input:checkbox:checked[name="s' + quarter + '"]').each(function () {
    //     var value = $(this).val();
    //     if (value.charAt(0) == 'o') {
    //         selectedOCount++;
    //     } else if (value.charAt(0) == 'd') {
    //         selectedDCount++;
    //     }
    // });

    // // If there were checkboxes selected before, subtract their counts from totalO and totalD
    // if (selectedOCounts[quarter] !== undefined) {
    //     totalO -= selectedOCounts[quarter];
    //     totalD -= selectedDCounts[quarter];
    // }

    // // Update the selectedOCounts and selectedDCounts arrays
    // selectedOCounts[quarter] = selectedOCount;
    // selectedDCounts[quarter] = selectedDCount;


	// 	var Totalcounts = {
    //         TL: totalO,
    //         TD: totalD
    //     };
	// 	console.log(Totalcounts);
	// 	return Totalcounts;
	// }

//////////////////////////////////
function rand(min, max) {
  return Math.random() < 0.5 ? min : max;
}

// function redirectToLogout(quarter) {
//     // Check if it's the 40th quarter (you can replace this condition with your actual condition)
//     if (quarter === 40) {
//         // Redirect to logout.php
//         window.location.href = 'logout1.php';
//     }
// }


const ans = document.getElementById("showans")

function final(quarter,sectorval,totalTLTD)
{
	let content = document.createElement("p")
	content.textContent=`${JSON.stringify(totalTLTD)} : ${JSON.stringify(sectorval)}`
	ans.appendChild(content)
	console.log("reached last")
	console.log(`Totalcounts : ${JSON.stringify(totalTLTD)}`);
	console.log(`sectorval : ${JSON.stringify(sectorval)}`);
}	




let buttonclicked="banking"
const strategybuttons=document.querySelectorAll(".strategybutton");
for(let i=0;i<strategybuttons.length ; i++)
{
	strategybuttons[i].addEventListener("click", (e)=> {buttonclicked=e.target.innerText})
}

	function fun(quarter,quarter_events)
	{
		// console.log(buttonclicked)
		var arr = $('input:checkbox:checked[name="s' + quarter + '"]').map(function () {
			return this.value;
		}).get();

		if (arr.length < 5) {
			alert("Invest more");
			return;
		} else if (arr.length > 5) {
			alert("You cannot invest in more than 5 strategies in a quarter");
			return;
		}
		
	
		
		
		if (quarter_events.indexOf(quarter)!== -1)
		{
			
			var sectorval=selectSector(buttonclicked)
			console.log(sectorval);
			var value_of_initial_corpus = event_occurence(quarter,quarter_events);
			console.log(`value_of_initial_corpus : ${value_of_initial_corpus}`); 
			var totalTLTD = updateODCounts(quarter);
			createBarChart(sectorval, totalTLTD);
			console.log(`totalTLTD returned : ${JSON.stringify(totalTLTD)}`) // error free
			var Type_of_event= rand("favourable", "adversial")
			var final_value=calculateDeviation(sectorval,totalTLTD,value_of_initial_corpus,Type_of_event,quarter);
			if(quarter==40)
			{			

				final(quarter,sectorval,totalTLTD);	
				
				
			}
			console.log(`final_value : ${final_value}`);
			console.log(`Before Popping : ${quarter_events}`)
			quarter_events.pop();
			console.log(`After Popping : ${quarter_events}`)
		}
		else
		{
			console.log("else")
			console.log(buttonclicked)
			var sectorval=selectSector(buttonclicked)
			console.log(sectorval);
			var value_of_initial_corpus = event_occurence(quarter,quarter_events);
			console.log(`value_of_initial_corpus : ${value_of_initial_corpus}`); 
			var totalTLTD = updateODCounts();
			createBarChart(sectorval, totalTLTD);
			console.log(`totalTLTD returned : ${JSON.stringify(totalTLTD)}`) // error free
			var Type_of_event= rand("favourable", "adversial")
			var final_value=calculateDeviation(sectorval,totalTLTD,value_of_initial_corpus,Type_of_event, quarter);
			if(quarter==40)
			{			
				
				final(quarter,sectorval,totalTLTD);	
				
				
			}
			console.log(`final_value : ${final_value}`);
			console.log(`Before Popping : ${quarter_events}`)
			quarter_events.pop();
			console.log(`After Popping : ${quarter_events}`)
		}

		// updateSelectedCounts(quarter);

		calc(quarter); // working fine till here
		var spentAmount = used_amounts[quarter];
		if (spentAmount < 25000 ) {
			alert("You must spend exactly 25000 in this quarter before moving to the next quarter.");
			return;
		}
		
		// var quarter_events = <?php echo json_encode($quarter_events); ?>;

		// if (isQuarterInArray(quarter, quarter_events)) {
		// 	alert("hii");
		// 	// Call event_occurence() only if the quarter is in the quarter_events array
		// 	event_occurence(quarter);
		// }

		if (quarter < 40) {
			var nextQuarter = quarter + 1;
			$("#div" + quarter).hide();
			$("#div" + nextQuarter).show();
			// Update the total corpus for the next quarter
			total_corpus = parseInt($("#tc" + quarter).text().replace(/,/g, '')); // Parse the current total corpus value
			$("#tc" + nextQuarter).text(number_format(total_corpus)); // Update the total corpus for the next quarter
		} 
		
	}


	function disableRest(selectedValues, quarter) {
    // Find checkboxes within the current quarter's section
    var checkboxSelector = '#div' + quarter + ' input:checkbox[name^="s"]';
    
    $(checkboxSelector).each(function () {
        var value = $(this).val();

        // Check if the value is in the selectedValues array
        if (selectedValues.indexOf(value) === -1) {
            $(this).prop('disabled', true); // Disable the checkbox
            // $(this).closest('.ans').find('input[type="range"]').prop('disabled', true); // Disable the slider
        }
    });
}

var sumOfEnabledSliders = 0;
	function calc(quarter) {
		enabledSliders = [];

		$("#div" + quarter + " input[type='range']:enabled").each(function () {
			var sliderValue = $(this).val();
			enabledSliders.push(sliderValue);
		});

		sumOfEnabledSliders = enabledSliders.reduce((a, b) => parseInt(a) + parseInt(b), 0);
		var x = document.getElementById('qq' + quarter);
		var y=document.getElementById('qp' + quarter);
		var nv = 0 + sumOfEnabledSliders;
		x.innerHTML = nv;
		if(nv>25000)
		{
			alert("Can't invest more that 25000  , Move to next quarter")

		}
		if(x.innerHTML==y.innerHTML && (y.innerHTML > 25000))
		{
			alert("Sum is equal");
		}
		// Subtract used value from the total corpus for this quarter
		total_corpus -= (sumOfEnabledSliders - used_amounts[quarter]);
		console.log("Total corpus:", sumOfEnabledSliders);
	// 	if (nv == 0) {

    //     alert("Total corpus has gone negative. Please adjust your investments.");
	// 	disableRest(enabledSliders, quarter);
	// 	return;

    // }

	

		var t = document.getElementById('tc' + quarter);
		t.innerText = number_format(total_corpus);

		// Update the used amount for this quarter
		used_amounts[quarter] = sumOfEnabledSliders;

		// Update counts of O and D for the current quarter
		updateSelectedCounts(quarter);
	}

	function enab_rng(checkbox, quarter) {
		var slider = $(checkbox).closest(".ans").find("input[type='range']");
		slider.prop("disabled", !checkbox.checked);
		if (!checkbox.checked) {
			slider.val(0);
			slider.next("span").html("0");
		}
		
		calc(quarter);
		// $(checkbox).closest(".ans").find("input[type='range']").prop("disabled", !checkbox.checked);
		// calc(quarter);
	}

	function get(slider, quarter) {
		var sliderValue = $(slider).val();
		$(slider).next("span").html(sliderValue);
		calc(quarter);
	}

	// Helper function to format numbers with commas (e.g., 1,000,000)
	function number_format(number) {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
</script>
</body>
</html>


