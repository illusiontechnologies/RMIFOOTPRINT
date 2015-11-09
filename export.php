<?php
		require_once("connect.php"); 
		$where          =  '';
		$qsrting        =  '';
		$arrivaldate    =  $_GET['datepicker1'];
		$arrivaldateto  =  $_GET['datepicker2'];
		$dtext          =  $_GET['dtext'];
		$roomtypes      =  $_GET['roomtype'];
		$guestname      =  $_GET['guestname'];
		$xenon          =  $_GET['xenon'];
		$postcode       =  $_GET['postcode']; 
		$city           =  $_GET['city'];
		$spent          =  $_GET['spent'];
		$vip            =  $_GET['vip'];
		$to             =  $_GET['to'];
		$from           =  $_GET['from'];
		$property       =  $_GET['property'];

		$date=date_create($arrivaldate);
		$date2=date_create($arrivaldateto);
		$datear=date_format($date,"Y-m-d");
		$datear2=date_format($date2,"Y-m-d");
		
		$sqlq = "SELECT * FROM Room_Type where Description ='".$roomtypes."'";
		$queryq = sqlsrv_query($conn, $sqlq);
		$rowq = sqlsrv_fetch_array($queryq);
		$roomtype=$rowq[Room_Type];

		if($roomtypes == '0'){
		$where .= "    rm.Room_type !='".$roomtype."'";
		$qsrting .= "&roomtype=" . $roomtype;}
		else{
		$where .= "    rm.Room_type ='".$roomtype."'";
		$qsrting .= "&roomtype=" . $roomtype;}
		
		if($vip == '1') {
		$where .= " and rm.Vip_Level != ''";
		$qsrting .= "&vip=" . $vip;}					
					  
		if($xenon != '') {
		$where .= " and rm.Xenon_ID = '".$xenon."'";
		$qsrting .= "&xenon_id=" . $xenon;}
					  
					  
		if($spent =='1'){
		$where .= "  and rm.Total_Fb_Revenue >'0.00'";
		$qsrting .= "&spent=" . $spent;}

		if($postcode !=''){
		$where .= "  and  rm.Postal_Code = '".$postcode."'";
		$qsrting .= "&postcode=" . $postcode;	}

		if($guestname !=''){
		$where .= "  and  rm.Guest_Name = '".$guestname."'";
		$qsrting .= "&guestname=" . $guestname;}
		
		$sqlcity = "SELECT * FROM RmifootPrintnew where State='".$city."'";
		$querycity = sqlsrv_query($conn, $sqlcity);
		$rowcity = sqlsrv_fetch_array($querycity);
		$rc=$rowcity[State];

		if($city != ''){
			if($city==$rc){
			$where .= "  and  rm.State LIKE '%".$city."%'";
			$qsrting .= "&city=" . $city;}
			else{
			$where .= "  and  rm.Country LIKE '%".$city."%'";
			$qsrting .= "&city=" . $city; } 
		}
		
		if($arrivaldate != '' && $arrivaldateto != '' ){
		$where .= "  and  rm.Arrival_Date between  '".$datear."' and '".$datear2."'";
		$qsrting .= "&arrivaldate=" . $datear." between arrivaldate=".$datear2;
		}

		if($to !='' && $from !=''){
		$where .= "  and  rm.Total_Room_Revenue between  '".$to."' and '".$from."'";
		$qsrting .= "&Total_Room_Revenue=" . $to." between Total_Room_Revenue=".$from;}

		if($dtext != '') {
		$where .= " and rm.No_Of_Nights = '".$dtext."'";
		$qsrting .= "&No_Of_Nights=" . $dtext;}
 	
		if($arrivaldate != '' && $arrivaldateto != ''){
		$tsql = "SELECT *FROM RmifootPrintnew rm JOIN Room_Type ON rm.Room_Type=Room_Type.Room_Type where ".$where."        ORDER BY rm.Arrival_Date DESC"; }
		else if($to != '' && $from != ''){
		$tsql = "SELECT *FROM RmifootPrintnew rm JOIN Room_Type ON rm.Room_Type=Room_Type.Room_Type where ".$where."        ORDER BY rm.Total_Room_Revenue ASC";}
		else{
		$tsql = "SELECT *FROM RmifootPrintnew rm JOIN Room_Type ON rm.Room_Type=Room_Type.Room_Type  where ".$where."        ORDER BY  rm.Total_Room_Revenue ASC ,rm.Arrival_Date DESC,rm.Guest_Name DESC";}

		$result = sqlsrv_query( $conn, $tsql);
		if (!$result) {
		die("Query to show fields from table failed");
		}

		$csv_header .= '"Tour Operator",';
		$csv_header .= '"Xenon ID",';
		$csv_header .= '"Room Type",';
		$csv_header .= '"Description",';
		$csv_header .= '"Guest Name",';
		$csv_header .= '"Home Address 1",';
		$csv_header .= '"Home Address 2",';
		$csv_header .= '"Home Address 3",';
		$csv_header .= '"City",';
		$csv_header .= '"Postal Code",';
		$csv_header .= '"Country",';
		$csv_header .= '"State",';
		$csv_header .= '"Email Address",';
		$csv_header .= '"Phone Number",';
		$csv_header .= '"Fax Number",';
		$csv_header .= '"Membership Number",';
		$csv_header .= '"Vip Level",';
		$csv_header .= '"Rate Code On Last Visit",';
		$csv_header .= '"No Of Arrivals",';
		$csv_header .= '"No Of Nights",';
		$csv_header .= '"Total Room Revenue",';
		$csv_header .= '"Total Fb Revenue",';
		$csv_header .= '"Total Extra Revenue",';
		$csv_header .= '"Total Non Revenue",';
		$csv_header .= '"Arrival Date",';
		$csv_header .= "\n";
		$csv_header .= "\n";
		while($row = sqlsrv_fetch_array($result)){
		$csv_row .= '"' . $row['Tour_Operator'] . '",';
		$csv_row .= '"' . $row['Xenon_ID'] . '",';
		$csv_row .= '"' . $row['Room_Type'] . '",';
		$csv_row .= '"' . $row['Description'] . '",';
		$csv_row .= '"' . $row['Guest_Name'] . '",';
		$csv_row .= '"' . $row['Home_Address_1'] . '",';
		$csv_row .= '"' . $row['Home_Address_2'] . '",';
		$csv_row .= '"' . $row['Home_Address_3'] . '",';
		$csv_row .= '"' . $row['State'] . '",';
		$csv_row .= '"' . $row['Postal_Code'] . '",';
		$csv_row .= '"' . $row['Country'] . '",';
		$csv_row .= '"' . $row['City'] . '",';
		$csv_row .= '"' . $row['Email_Address'] . '",';
		$csv_row .= '"' . $row['Phone_Number'] . '",';
		$csv_row .= '"' . $row['Fax_Number'] . '",';
		$csv_row .= '"' . $row['Membership_Number'] . '",';
		$csv_row .= '"' . $row['Vip_Level'] . '",';
		$csv_row .= '"' . $row['Rate_Code_On_Last_Visit'] . '",';
		$csv_row .= '"' . $row['No_Of_Arrivals'] . '",';
		$csv_row .= '"' . $row['No_Of_Nights'] . '",';
		$csv_row .= '"' .'$'.$row['Total_Room_Revenue'] . '",';
		$csv_row .= '"' .'$'.$row['Total_Fb_Revenue'] . '",';
		$csv_row .= '"' .'$'.$row['Total_Extra_Revenue'] . '",';
		$csv_row .= '"' .'$'.$row['Total_Non_Revenue'] . '",';
		$csv_row .= '"' . $row['Arrival_Date']->format("Y-m-d H:i:s").'",';
		$csv_row .= "\n"; }

		/* Download as CSV File */
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename=rmi_footprint.csv');
		echo $csv_header . $csv_row;
		exit;
		sqlsrv_free_stmt($query);
?>
