		function fill(Value){
		$('#city').val(Value);
		$('#display').hide();}
		$(document).ready(function(){
		$("#city").keyup(function() {
		var city = $('#city').val();
		if(city==""){
		$("#display").html("");}
		else{
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "city="+ city ,
		success: function(html){
		$("#display").html(html).show();}
		});
		}
		});
		});
		////////////////postcode////////////////
		function fillp(Value){
		$('#postcode').val(Value);
		$('#displayp').hide();}
		$(document).ready(function(){
		$("#postcode").keyup(function() {
		var postcode = $('#postcode').val();
		if(postcode==""){
		$("#displayp").html("");}
		else{
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "postcode="+ postcode ,
		success: function(html){
		$("#displayp").html(html).show();}
		});
		}
		});
		});

		////////////////country////////////////
		function fillc(Value){
		$('#country').val(Value);
		$('#displayc').hide();}
		$(document).ready(function(){
		$("#country").keyup(function() {
		var country = $('#country').val();
		if(country==""){
		$("#displayc").html("");}
		else{
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "country="+ country ,
		success: function(html){
		$("#displayc").html(html).show();}
		});
		}
		});
		});
		////////////////country////////////////
		function fillg(Value){
		$('#guestname').val(Value);
		$('#displayg').hide();}
		$(document).ready(function(){
		$("#guestname").keyup(function() {
		var guestname = $('#guestname').val();
		if(guestname==""){
		$("#displayg").html("");}
		else{
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "guestname="+ guestname ,
		success: function(html){
		$("#displayg").html(html).show();}
		});
		}
		});
		});
		////////////////country////////////////
		function fillrn(Value){
		$('#dtext').val(Value);
		$('#displayrn').hide();}
		$(document).ready(function(){
		$("#dtext").keyup(function(e) {
		var dtext = $('#dtext').val();
		if(dtext==""){
		$("#displayrn").html("");}
		else{
		$.ajax({
		type: "POST",
		url: "ajax.php",
		data: "dtext="+ dtext ,
		success: function(html){
		$("#displayrn").html(html).show();}
		});
		}    
		});
		});

		$(document).click(function() { $('#displayg').fadeOut(300);  });
		$(document).click(function() { $('#displayc').fadeOut(300);  });
		$(document).click(function() { $('#display').fadeOut(300);   });
		$(document).click(function() { $('#displayrn').fadeOut(300); });
		$(document).click(function() { $('#displayp').fadeOut(300);  });


		$(function() {
				$( "#datepicker" ).datepicker({  inline: true	});
				$( "#datepicker1" ).datepicker({ inline: true   });
				$( "#datepicker2" ).datepicker({ inline: true   });
				$( "#datepicker3" ).datepicker({ inline: true   });
		});