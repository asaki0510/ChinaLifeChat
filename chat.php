<?php include "header.php";?>
<body>
<?php include "navbar.php" ?>

<div class="container chatRoom">
  <div class="col-sm-2"></div>
  <div class="col-sm-8">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".versionInfo">版本資訊</button>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".userGuide">使用說明</button>
	<button type="button" class="btn btn-primary" id="pushSwitch">開啟通知</button>
	<button type="button" class="btn btn-primary" id="uploadData">上傳圖片</button>	
	<b id="errorMessage"></b>
	<input type="file" style="display:none" name="flFile" id="flFile">     
	<h2>中鍋人壽沒聊天軟體很可憐</h2>
	<div class="inputArea">
	<input class="form-control" type="text" id="nameInput" placeholder="Name">
	<input class="form-control" type="text" id="messageInput" placeholder="Message">  
	</div>
	<div id="chatText"></div>	
	<button class="btn btn-danger" type="button" id="readMore">讀更多訊息</button>
  </div>
  <div class="col-sm-2"></div>
</div>

<div class="modal fade userGuide" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">使用說明</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			  <div class="modal-body">     
				  1.匿名聊天室，只要打上NAME即可使用<br>
				  2.點上傳圖片或將圖片托拉進頁面內即可上傳<br>
				  3.圖片請勿傳輸有個資檔案可能被鎖<br>
			</div>
		</div>
	  </div>
</div>

<div class="modal fade versionInfo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	  <div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">版本資訊</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			  <div class="modal-body">     
				  0.1beta. 聊天與上傳圖片功能<br>
				  0.2beta. 增加Push Notice功能<br>
				=====================================<br>
				  預計更新:<br>
				  登入功能、Show IP
			</div>
		</div>
	  </div>
</div>
  
</body>
<script type="text/template" id="chatTemplate">
	<div class="chatItem well">
		<b class="userName"><%= userName_data %>:</b>
		<span class="caption" style="word-break: break-all;"><%= caption_data %></span>		
		<p class="chatTimestsamp" style="text-align:right;"><%= chatTimestsamp_data%></p>
	</div>
</script>
<script type="text/template" id="imgTemplate">
	<div class="chatItem well">
		<div class="chatContent">
			<b class="userName"><%= userName_data %>:</b>
			<span class="caption" style="word-break: break-all;"><%= caption_data %></span>
		</div>
		<img class="imgSrc" src="<%= fileSrc %>"><img>
		<p class="chatTimestsamp" style="text-align:right;"><%= chatTimestsamp_data%></p>
	</div>
</script>
<script src="./js/chat.js"></script>  
<script src="./js/push.js"></script>  
</html>