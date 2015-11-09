<?php
				require_once("connect.php");
 
		    	if(isset($_POST['city'])) {
				$city = $_POST['city'];
				$sqlq = "SELECT DISTINCT Country FROM RmifootPrintnew WHERE Country LIKE '%$city%'  UNION SELECT 	                DISTINCT State FROM RmifootPrintnew WHERE State LIKE '%$city%' OR 1=1";
				$queryq = sqlsrv_query($conn, $sqlq);
				if ($queryq === false) { 
				exit("<pre>".print_r(sqlsrv_errors(), true)); }
				echo "<ul style='margin-left: -39px;position:absolute;'>";
				while ($rowq = sqlsrv_fetch_array($queryq)) { ?>
				<li onclick='fill("<?php echo $rowq['Country']; ?>")'><?php echo $rowq['Country']; ?></li>
				<?php } } ?> </ul>
				<?php
			    if(isset($_POST['postcode'])) {
				$postcode = $_POST['postcode'];
				$sqlq = "SELECT DISTINCT Postal_Code FROM RmifootPrintnew WHERE Postal_Code LIKE '%$postcode%'";
				$queryq = sqlsrv_query($conn, $sqlq);
				if ($queryq === false){ 
				exit("<pre>".print_r(sqlsrv_errors(), true)); }
				echo "<ul class='postcd'>";
				while ($rowq = sqlsrv_fetch_array($queryq)){ ?>
				<li onclick='fillp("<?php echo $rowq[Postal_Code]; ?>")'><?php echo $rowq[Postal_Code]; ?></li>
				<?php } } ?> </ul>	
				<?php
				if(isset($_POST['country'])) {
				$country = $_POST['country'];
				$sqlq = "SELECT DISTINCT Country  FROM RmifootPrintnew WHERE Country LIKE '%$country%'";
				$queryq = sqlsrv_query($conn, $sqlq);
				if ($queryq === false){ 
				exit("<pre>".print_r(sqlsrv_errors(), true)); }
				echo "<ul class='countrycd'>";
				while ($rowq = sqlsrv_fetch_array($queryq)){ ?>
				<li onclick='fillc("<?php echo $rowq[Country]; ?>")'><?php echo $rowq[Country]; ?></li>
				<?php } } ?> </ul>
				<?php
				if(isset($_POST['guestname'])) {
				$guestname = $_POST['guestname'];
				$sqlq = "SELECT DISTINCT Guest_Name FROM RmifootPrintnew WHERE Guest_Name LIKE '%$guestname%' ORDER 		                BY Guest_Name ASC";
				$queryq = sqlsrv_query($conn, $sqlq);
				if ($queryq === false){ 
				exit("<pre>".print_r(sqlsrv_errors(), true));}
				echo "<ul style='margin-left: -39px;position:absolute;'>";
				while ($rowq = sqlsrv_fetch_array($queryq)){ ?>
				<li onclick='fillg("<?php echo $rowq[Guest_Name]; ?>")'><?php echo $rowq[Guest_Name]; ?></li>
				<?php } } ?> </ul>
				<?php
				if(isset($_POST['dtext'])) {
				$dtext = $_POST['dtext'];
				$sqlq = "SELECT DISTINCT No_Of_Nights FROM RmifootPrintnew WHERE No_Of_Nights LIKE '%$dtext%' ORDER 		                BY No_Of_Nights ASC";
				$queryq = sqlsrv_query($conn, $sqlq);
				if ($queryq === false){ 
				exit("<pre>".print_r(sqlsrv_errors(), true));}
				echo "<ul style='margin-left: -39px;position:absolute;'>";
				while ($rowq = sqlsrv_fetch_array($queryq)){ ?>
				<li onclick='fillrn("<?php echo $rowq[No_Of_Nights]; ?>")'><?php echo $rowq[No_Of_Nights]; ?></li>
				<?php } } ?> </ul>
				
