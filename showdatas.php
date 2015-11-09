<?php
			try {
			error_reporting(0);
			require_once("connect.php"); 
			$where 				=  '';
			$qsrting 			=  '';
			if($_POST)
			{
			$datepicker1		=  $_POST["datepicker"];
			$datepicker2		=  $_POST["datepicker2"];
			$dtext				=  $_POST["dtext"];
			$roomtypes			=  $_POST["roomtype"];
			$guestname			=  $_POST["guestname"];
			$xenon				=  $_POST["xenon"];
			$postcode			=  $_POST["postcode"];
			$city				=  $_POST["city"];
			$spent				=  $_POST["spent"];
			$vip				=  $_POST["vip"];
			$to					=  $_POST["to"];
			$from				=  $_POST["from"];

			$date=date_create($datepicker1);
			$date2=date_create($datepicker2);
			$datear=date_format($date,"Y-m-d");
			$datear2=date_format($date2,"Y-m-d");

			$sqlq = "SELECT * FROM Room_Type where Description ='".$roomtypes."'";
			$queryq = sqlsrv_query($conn, $sqlq);
			$rowq = sqlsrv_fetch_array($queryq);
			$roomtype=$rowq[Room_Type];

			if($roomtypes == '0') {
			$where .= "    rm.Room_type !='".$roomtype."'";
			$qsrting .= "&roomtype=" . $roomtype; } else {
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
			
			if($guestname !='')
			{$where .= "  and  rm.Guest_Name LIKE  '%".$guestname."%'";
			$qsrting .= "&guestname=" . $guestname;}

			$sqlcity = "SELECT * FROM RmifootPrintnew where State='".$city."'";
			$querycity = sqlsrv_query($conn, $sqlcity);
			$rowcity = sqlsrv_fetch_array($querycity);
			$rc=$rowcity['State'];

			if($city != ''){
			if($city==$rc){
			$where .= "  and  rm.State LIKE '%".$city."%'";
			$qsrting .= "&city=" . $city;}
			else{
			$where .= "  and  rm.Country LIKE '%".$city."%'";
			$qsrting .= "&city=" . $city;}}

			if($postcode !=''){
			$where .= "  and  rm.Postal_Code LIKE '%".$postcode."%'";
			$qsrting .= "&postcode=" . $postcode;}

			if($datepicker1 != '' && $datepicker2 != '' ){
			$where .= "  and  rm.Arrival_Date  between  '".$datear."' and '".$datear2."'";
			$qsrting .= "&arrivaldate=" . $datear." between arrivaldate=".$datear2; }
			
			if($to !='' && $from !=''){
			$where .= "  and  rm.Total_Room_Revenue between  '".$to."' and '".$from."'";
			$qsrting .= "&Total_Room_Revenue=" . $to." between Total_Room_Revenue=".$from;}
			
			if($dtext != '') {
			$where .= " and rm.No_Of_Nights = '".$dtext."'";
			$qsrting .= "&No_Of_Nights=" . $dtext;}



			if($datepicker1 != '' && $datepicker2 != ''){
			$sql = "SELECT *FROM RmifootPrintnew rm JOIN Room_Type ON rm.Room_Type=Room_Type.Room_Type where ".$where            ." ORDER BY rm.Arrival_Date DESC";} else if($to != '' && $from != '') {
			$sql = "SELECT *FROM RmifootPrintnew rm JOIN Room_Type ON rm.Room_Type=Room_Type.Room_Type where ".$where            ." ORDER BY rm.Total_Room_Revenue ASC"; } else {
			$sql = "SELECT *FROM RmifootPrintnew rm JOIN Room_Type ON rm.Room_Type=Room_Type.Room_Type where ".$where            ." ORDER BY rm.Total_Room_Revenue ASC ,rm.Arrival_Date DESC,rm.Guest_Name DESC";}

			$query = sqlsrv_query($conn, $sql);
			if ($query === false){ 
			throw new Exception("<pre>".print_r(sqlsrv_errors(), true)); }}
			if(!$query){ throw new Exception("sorry there was an error");}
 
			if($roomtypes !=""){?>

			<a href="export.php?&amp;roomtype=<?php echo $roomtypes;?>&amp;datepicker1=<?php echo $datepicker1;?>            &amp;datepicker2=<?php echo $datepicker2;?>&amp;spent=<?php echo $spent;?>&amp;vip=<?php echo $vip;?>
			&amp;to=<?php echo $to; ?>&amp;from=<?php echo $from;?>&amp;postcode=<?php echo $postcode;?>&amp;city=            <?php echo $city;?>&amp;guestname=<?php echo $guestname?>&amp;dtext=<?php echo $dtext;?>&amp;xenon=<?php             echo $xenon;?>" class="export-csv btn-class" id="exportcsv1">Export CSV</a>
			<?php }?>
			<br/>
<table border="1" cellpadding="0" cellspacing="0" class="rmi_table" id="test1">
<tr class="headingt">
  <td colspan="4" class="rmi_tabletd">
  <?php if($datepicker1==""){}else{?>Arravial Date Range: <?php echo $datepicker1; ?> - <?php echo $datepicker2;} ?>  <BR/><?php if($dtext==""){}else{?> Number Of Nights: <?php echo $dtext; } ?> <BR/> <?php if($roomtypes==""){}else{  ?> Room Type: <?php echo $roomtypes; } ?> <BR/> <?php if($postcode==""){}else{?> Postcode : <?php echo $postcode; }  ?> <BR/> <?php if($city==""){}else{?> City and Country: <?php echo $city;}?> </td>
  <td colspan="13" align="center" style="font-size:22px;">RMI FOOTPRINT </td>
  <td colspan="6" valign="top" style="font-size:12px;font:bold;">Created :
  <?php $dt = new DateTime(); echo $dt->format('Y-m-d H:i:s');?></td>
</tr>
<tr class="headingt">
  <td>Id</td>
  <td>Guest Name</td>
  <td>Room Type</td>
  <td>Description</td>
  <td>Xenon</td>
  <td>Arrival Date</td>
  <td>Number Of Nights</td>
  <td>Home Address</td>
  <td>City</td>
  <td>Postal Code</td>
  <td>Country</td>
  <td>State</td>
  <td>Email Address</td>
  <td>Phone Number</td>
  <td>Fax Number</td>
  <td>Membership Number</td>
  <td>Vip Level</td>
  <td>Rate Code On Last Visit</td>
  <td>No Of Arrivals</td>
  <td>Total Room Revenue</td>
  <td>Total Fb Revenue</td>
  <td>Total Extra Revenue</td>
  <td>Total Non Revenue</td>
</tr>
<?php 
   $counter = 0; 
   while ($row = sqlsrv_fetch_array($query)){
?>
<tr class="headingt1" style="color:#000000;">
  <td><?php echo(++$counter);?></td>
  <td><?php echo $row[Guest_Name];?></td>
  <td><?php echo $row[Room_Type];?></td>
  <td><?php echo $row[Description];?></td>
  <td><?php
		$sqlq1 = "SELECT serid as BookingID FROM [".CENTRIUM_LINKED_SERVER."].[rmi].[dbo].[xenonbookings] where        xenonid='".$row[Xenon_ID]."'";
		$queryq1 = sqlsrv_query($conn, $sqlq1);
		$rowq1 = sqlsrv_fetch_array($queryq1);
		$bookinid=$rowq1[BookingID];
		if($bookinid==""){ echo $row[Xenon_ID]; }else{
?>
<a target="_blank" href="http://centriumres.com/Secure/CallCentre/BookingDetails.aspx?NewBooking=0&BookingID=    <?php echo $rowq1[BookingID];?>"> <?php echo $row[Xenon_ID];?></a><?php } ?></td>
  <td><?php  echo $row[Arrival_Date]->format("d M Y");?></td>
  <td><?php  echo $row[No_Of_Nights];?></td>
  <td><?php  echo $row[Home_Address_1];if($row[Home_Address_2] != ""){echo ",".$row[Home_Address_2];}else{}
  if($row[Home_Address_3] != ""){echo ",".$row[Home_Address_3];}else{}
  ?></td>
  <td><?php  echo $row[State];?></td>
  <td><?php  echo $row[Postal_Code];?></td>
  <td><?php  echo $row[Country];?></td>
  <td><?php  echo $row[City];?></td>
  <td><?php  echo $row[Email_Address];?></td>
  <td><?php  echo $row[Phone_Number];?></td>
  <td><?php  echo $row[Fax_Number];?></td>
  <td><?php  echo $row[Membership_Number];?></td>
  <td><?php  echo $row[Vip_Level];?></td>
  <td><?php  echo $row[Rate_Code_On_Last_Visit];?></td>
  <td><?php  echo $row[No_Of_Arrivals];?></td>
  <td>$<?php echo $row[Total_Room_Revenue];?></td>
  <td>$<?php echo $row[Total_Fb_Revenue];?></td>
  <td>$<?php echo $row[Total_Extra_Revenue];?></td>
  <td>$<?php echo $row[Total_Non_Revenue];?></td>
</tr>
<?php } sqlsrv_free_stmt($query);} catch(Exception $e) {
	file_put_contents("error.log", $e->getMessage(), FILE_APPEND);
	echo "Sorry there was an error creating your report. Please try again. Technical details: <pre>".$e->getMessage()    ."</pre>";}

?>


