<?php include "header.php";?>
<body>
<?php include "navbar.php" ?>
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<h2 align="center">算出你的賣身契Q︿Q</h2>
			<p>開始日期(yyyy-mm-dd)</p>
			<input class="form-control" type="text" id="StartDate" value="2016-03-14"> </input><br />	
			<p>結束日期(yyyy-mm-dd)</p>
			<input class="form-control" type="text" id="EndDate"> </input><br />	
			<p>已領獎金</p>
			<input class="form-control" type="text" id="Money" Disabled> </input><br />	
		</div>
		<div class="col-md-4"></div>
	</div>
<p class ="text-center">	
	<button class="btn btn-danger" type="button" onclick="CalculateGGMoney()">＄＄＄＄</button>
</p>

<p id="LosingMoney" align="center"></p>

</div>

</body>

<script>

function CalculateGGMoney() {
var StartDate = new Date($("#StartDate").val());
var EndDate = new Date($("#EndDate").val());
var now = new Date();
var ServingDateSecond=EndDate.getTime() - StartDate.getTime();
var ServingDays=Math.floor(ServingDateSecond/(24*3600*1000));
var TotalYears=EndDate.getYear()-StartDate.getYear();
var TotalMonths = EndDate.getMonth() - StartDate.getMonth() + 12 * TotalYears;

if(TotalMonths < 6)
	var GetMoney = 0;
else
	var GetMoney = 15000 * Math.floor((TotalMonths-3)/3);

var GetLosingMoney = Math.floor((1095 - ServingDays) / 1095 * 80000);
var TotalLosingMoney = Math.floor((1095 - ServingDays) / 1095 * 80000 + GetMoney);

$("#Money").val(GetMoney);
//$("#EndDate").val(now.getFullYear()+ " 年 " + (now.getMonth()+1) + " 月 " + now.getDate());
//$("#EndDate").val(123);
if(ServingDays <= 90)
	$("#LosingMoney").text("40000");
else if(ServingDays > 1095)
	$("#LosingMoney").text("畢業了 好棒棒喔!");
else
	$("#LosingMoney").text(GetLosingMoney + "+" + GetMoney + "=" + TotalLosingMoney);

if(ServingDays<0)
	$("#LosingMoney").text("賣亂 乾");
	
if(GetMoney > 165000)
	$("#Money").val("165000");
	

}
</script>
</html>












