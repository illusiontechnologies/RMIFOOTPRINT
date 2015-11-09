<?php
			error_reporting(0);
			require_once("connect.php");
			try {
			$sqlq = "SELECT * FROM Room_Type";
			$queryq = sqlsrv_query($conn, $sqlq);
			if ($queryq === false) {  
			throw new Exception("<pre>".print_r(sqlsrv_errors(), true));}
	
			$roomTypes = array();
			while($rowq = sqlsrv_fetch_array($queryq)) {
			$roomTypes[]= $rowq;}


            $filterStr = "property=$property&country$country&roomtype$roomtypes;?>&amp;datepicker1=<?php echo            $datepicker1;?>&amp;datepicker2=<?php echo $datepicker;?>&amp;spent=<?php echo $spent;?>&amp;vip=<?php            echo $vip;?>&amp;to=<?php echo $to; ?>&amp;from=<?php echo $from;?>&amp;postcode=<?php echo $postcode;?>            &amp;city=<?php echo $city;?>&amp;guestname=<?php echo $guestname?>&amp;dtext=<?php echo $dtext;?>";
			} catch(Exception $e) {
			echo "Could not load template. Error details: ".$e->getMessage();
			exit;}
?>
<html>
<head>
<title>Rmi FootPrint</title>
			<link href="css/custom.css" rel="stylesheet">
			<link href="css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
			<script src="js/jquery-1.10.2.js"></script>
			<script src="js/jquery-ui-1.10.4.custom.js"></script>
			<script src="js/fillter.js"></script>
			<script type="text/javascript">
				function ajaxindicatorstart(text) {
				if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
				jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="ajax-loader.gif">		                <div>'+text+'</div></div><div class="bg"></div></div>');}
		
				jQuery('#resultLoading').css({
					'width':'100%',
					'height':'100%',
					'position':'fixed',
					'z-index':'10000000',
					'top':'0',
					'left':'0',
					'right':'0',
					'bottom':'0',
					'margin':'auto'
				});	
		
				jQuery('#resultLoading .bg').css({
					'background':'#000000',
					'opacity':'0.7',
					'width':'100%',
					'height':'100%',
					'position':'absolute',
					'top':'0'
				});
				
				jQuery('#resultLoading>div:first').css({
					'width': '250px',
					'height':'75px',
					'text-align': 'center',
					'position': 'fixed',
					'top':'0',
					'left':'0',
					'right':'0',
					'bottom':'0',
					'margin':'auto',
					'font-size':'16px',
					'z-index':'10',
					'color':'#ffffff'
					
				});

				jQuery('#resultLoading .bg').height('100%');
				jQuery('#resultLoading').fadeIn(300);
				jQuery('body').css('cursor', 'wait'); }
				function ajaxindicatorstop() {
					jQuery('#resultLoading .bg').height('100%');
					jQuery('#resultLoading').fadeOut(300);
					jQuery('body').css('cursor', 'default');
				}
				function calcDaysBetween(startDate, endDate) {
					return (endDate - startDate) / (1000 * 60 * 60 * 24);
				}

				$(document).ready(function() {
				$("#button").click(function() {
				jQuery(document).ajaxStart(function () {
				//show ajax indicator
				ajaxindicatorstart('loading data.. please wait..');
			 	}).ajaxStop(function () {
				//hide ajax indicator
				ajaxindicatorstop();
			 	});

				 $('#exportcsv').show();
				 var datepicker=$("#datepicker").val();
				 var datepicker2=$("#datepicker2").val();
				 var dtext=$("#dtext").val();
				 var roomtype=$("#roomtype").val();
				 var guestname=$("#guestname").val();
				 var xenon=$("#xenon").val();
				 var postcode=$("#postcode").val();
				 var city=$("#city").val();
				 var country=$("#country").val();			 
				 var lfckv = $("#spent").prop('checked');
				 var lfckv1 = document.getElementById("vip").checked;
				 var to=$("#to").val();
			 	 var from=$("#from").val();
				 if(lfckv == true) {
					 var spent='1';
				 } else {
					 var spent='2';
				 }	 
				 if(lfckv1 == true) {
					 var vip='1';
				 } else {
					 var vip='2';
				 }
			 

			 	var postData = {
				 'datepicker':datepicker,
				 'datepicker2':datepicker2,
				 'roomtype':roomtype,
				 'dtext':dtext,
				 'guestname':guestname,
				 'xenon':xenon,
				 'postcode':postcode,
				 'city':city,
				 'spent':spent,
				 'vip':vip,
				 'to':to,
				 'from':from,};
 
			  	 $.ajax({
				 type:"post",
				 url:"showdatas.php",
				 data:postData,
				 success:function(data){
				 $("#info").html(data);
				 document.getElementById("exportcsv1").style.display = "none";
				 $('#exportcsv').show();
				 $('#spinner').hide();}
				 });
				 });

				 $('#datepicker').datepicker();
				 $('#datepicker2').datepicker();

				 $('#demo').change(function(){
				 $('#datepicker').attr('disabled', this.checked);
				 $('#datepicker2').attr('disabled', this.checked);
				 });
				 var $from = $("#datepicker");
				 var $to = $("#datepicker2");
		
				 $('#datepicker').change(function(){
				 var dayFrom = $from.datepicker('getDate');
				 var dayTo = $to.datepicker('getDate');
				 if (dayFrom && dayTo) {
				 var days = calcDaysBetween(dayFrom, dayTo); }
				 });
			});
			</script>
</head>
<body>
<div id="spinner" class="spinner" style="display:none;"><img id="img-spinner" src="ajax-loader.gif" alt="Loading"/> </div>
<p id="showdata"></p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  align="left" height="70%" class="indextable" >
<tr class="headingt1">
<td align="left" valign="middle">
<img src="FootPrint_v1.png" id="logo" alt="Footprint - Reservation and Guest Data"/>
</td>
</tr>
<tr class="headingt1">
<td align="left" valign="middle">
<table width="80%" border="0" cellpadding="2" cellspacing="1" style="margin:30px auto 0 auto;">
<tr class="headingt1">
	<td width="25%" align="left" valign="top">Country : -</td>
    <td width="25%" align="left" valign="top">Resort : -</td>
    <td width="25%" align="left" valign="top"></td>
    <td width="25%" align="left" valign="top"></td>
</tr>
<tr class="headingt1">
	<td width="25%" align="left" valign="top">
	<select class="countrysel">
	<option>Saint Lucia</option>
	</select>
	</td>
    <td width="25%" align="left" valign="top">
	<select class="stjames">
    <option>St. James's Club Morgan Bay</option>
    </select>
    </td>
    <td width="25%" align="left" valign="top">
	<input type="checkbox" name="spent" value="yes" <?php if ($spent == 'yes') echo 'checked'; ?> id="spent">
    Spent $ in Resort
	</td>
    <td width="25%" align="left" valign="top">
	<input type="checkbox" name="vip"  <?php if ($vip == 'on') echo 'checked'; ?> id="vip">
    Vip Level
	</td>
</tr>
<tr class="headingt1">
    <td width="25%" align="left" valign="top"></td>
    <td width="25%" align="left" valign="top"></td>
    <td width="25%" align="left" valign="top"></td>
    <td width="25%" align="left" valign="top"></td>
</tr>
<tr class="headingt1">
    <td width="25%" align="left" valign="top">Arrival Date :-
    <input name="checkbox" type="checkbox" id="demo" checked="checked">
    All Dates </td>
    <td width="25%" align="left" valign="top"><p>Number Of Nights :- </p></td>
    <td width="25%" align="left" valign="top">Room Type : - </td>
    <td width="25%" align="left" valign="top">Guest Name  :-</td>
</tr>
<tr class="headingt1">
    <td align="left" valign="top">
    <input id="datepicker" style="display:inline;" disabled="disabled" type="text" name="arrivaldate" value="<?php     echo $arrivaldate;?>" autocomplete="off" placeholder="Enter From Date"/>
    </td>
    <td align="left" valign="top">
	<input name="text"  type="text" id="dtext" placeholder="Enter No.Of Nights" value="<?php echo $text;?>"      			    autocomplete="off" />
	</td>
    <td align="left" valign="top">
	<select name="roomtype" id="roomtype">
    <option value="0" class="roption">All</option>
    <?php foreach($roomTypes as $rowq) {
    $pageid=$rowq['Room_Type']; ?>
    <option value="<?php echo $rowq['Description'];?>" <?php if($pageid==$_POST['roomtypes']) echo "selected"?> 			    style="width:150px;"><?php echo $rowq['Description'];?></option>
    <?php } ?>
    </select>
    &nbsp;</td>
    <td align="left" valign="top">
	<input type="text" name="guestname" value="<?php echo $guestname;?>" placeholder="Enter The Guest Name" id=    "guestname" autocomplete="off" />
	</td>
</tr>
<tr class="headingt1">
    <td align="left" valign="top">
	<input id="datepicker2" style="display:inline;" disabled="disabled" type="text" name="arrivaldate2" value="<?php     echo $arrivaldate2?>" autocomplete="off" placeholder="Enter To Date"/>
	</td>
    <td align="left" valign="top"><div id="displayrn" style="width:10px;"></div></td>
    <td align="left" valign="top"></td>
    <td align="left" valign="top"><div id="displayg" style="width:10px;"></div></td>
</tr>
<tr class="headingt1">
    <td align="left" valign="top"> Xenon :- </td>
    <td align="left" valign="top">Postcode/Zip :-</td>
    <td align="left" valign="top">City &amp; Country:- </td>
    <td align="left" valign="top">Total Revenue Between :-</td>
</tr>
<tr class="headingt1">
    <td align="left" valign="top">
	<input type="text" name="xenon" value="<?php echo $xenon;?>" placeholder="Enter the Xenon ID" autocomplete="off"/		     id="xenon" />
	</td>
    <td align="left" valign="top">
	<input name="postcode" type="text" placeholder="Enter The Postcode" value="<?php echo $postcode;?>" id="postcode"    autocomplete="off" />
	</td>
    <td align="left" valign="top">
	<input name="city" type="text" placeholder="Enter The City & Country " value="<?php echo $city;?>" id="city"    autocomplete="off" />
	</td>
    <td align="left" valign="top">
	<input name="to" type="text" size="15" value="<?php echo $to;?>" autocomplete="off" id="to" style="width:90px;"/>
    & <input name="from" type="text" size="15" value="<?php echo $from;?>" autocomplete="off" id="from" style="width:		    90px;"/>
	</td>
</tr>
<tr class="headingt1">
    <td align="left" valign="top"></td>
    <td align="left" valign="top"><div id="displayp" style="width:10px;"></div></td>
    <td align="left" valign="top"><div id="display" style="width:10px;"></div></td>
    <td align="left" valign="top"><div id="displayc" style="width:10px;"></div></td>
</tr>
<tr class="headingt1">
    <td align="left" valign="top"></td>
    <td align="left" valign="top"></td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" style="width:31% !important;"></td>
</tr>
<tr class="headingt1">
    <td align="left" valign="middle"><label></label></td>
    <td align="left" valign="top">&nbsp;</td>
    <td colspan="4" align="left" valign="top">&nbsp;</td>
</tr>
</table>
</td>
</tr>
</table>
<br/>
<input type="submit" name="submit" value="Run Report" id="button">
<span id="test"/>
	<a href="export.php?property=<?php echo $property;?>&amp;country=<?php echo $country;?>&amp;roomtype=<?php echo    $roomtypes;?>&amp;datepicker1=<?php echo $datepicker1;?>&amp;datepicker2=<?php echo $datepicker;?>&amp;spent=    <?php echo $spent;?>&amp;vip=<?php echo $vip;?>&amp;to=<?php echo $to; ?>&amp;from=<?php echo $from;?>          	    &amp;postcode=<?php echo $postcode;?>&amp;city=<?php echo $city;?>&amp;guestname=<?php echo $guestname?>    &amp;dtext= <?php echo $dtext;?>" class="export-csv btn-class" id="exportcsv1">Export CSV</a>
</span>

<span id="info" />
<ul id="comment"></ul>
<p>&nbsp;</p>
</body>
</html>
