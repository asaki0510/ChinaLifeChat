<?php include "header.php";?>
<body>
<?php include "navbar.php" ?>
<div class="container">
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<h2 align="center">喚起你的回憶小站</h2>
	<input class="form-control" type="text" id="inputPassword"> </input><br />	
	</div>
	<div class="col-md-4"></div>
</div>
<div class="row">
	<div class="col-md-5"></div>
	<div class="col-md-7">
	<button class="btn btn-primary" type="button" onclick="SetPass()">Set Pass</button>
	<button class="btn btn-danger" type="button" onclick="GetPass()">Get Pass</button>
	</div>
	
</div>
<p id="PassWord" align="center"></p>
</body>

<script>
var MaxSize = 62;
var rule = ["A", "B", "C" , "D", "E", "F", "G", "H", "I","J","K","L","M","N",
"O","P","Q","R","S","T","U","V","W","X","Y","Z","a", "b", "c" , "d", "e", "f",
 "g", "h", "i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
 "0","1", "2", "3" , "4", "5", "6", "7", "8","9"];
 
function SetPass() {
var passwordTemp = $("#inputPassword").val();
var splitTemp = passwordTemp.split("");
var temp="";
var ruleCount=0;
for(var i =0;i<=splitTemp.length-1;i++)
{
	for(var j=0;j<=rule.length-1;j++)
	{
		if(splitTemp[i]==rule[j])
		{
		ruleCount = j+i+1;
		if(ruleCount>MaxSize)
		{
		ruleCount = ruleCount - MaxSize;
		}
		temp=temp + rule[ruleCount];
		}
	}
}
$("#PassWord").text(temp);
}

function GetPass() {
var passwordTemp = $("#inputPassword").val();
var splitTemp = passwordTemp.split("");
var temp="";
var ruleCount=0;
for(var i =0;i<=splitTemp.length-1;i++)
{
	for(var j=0;j<=rule.length-1;j++)
	{
		if(splitTemp[i]==rule[j])
		{
		ruleCount = j-i-1;
		if(ruleCount<0)
		{
		ruleCount = ruleCount + MaxSize;
		}
		temp=temp + rule[ruleCount];
		}
	}
}
$("#PassWord").text(temp);
}
</script>
</html>