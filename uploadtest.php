<?php include "header.php";?>
<body ondrop="drop(event)" ondragover="allowDrop(event)">
<?php include "navbar.php" ?>
<button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>

<!-- Small modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>

  <div class="container">
	  <div class="col-sm-2"></div>
	  <div class="col-sm-8">
		<h2>中鍋人壽沒聊天軟體很可憐</h2>
		<input class="form-control" type="text" id="nameInput" placeholder="Name">
		<input class="form-control" type="text" id="messageInput" placeholder="Message">  
		<div id="chatText"></div>
		<div class="form-group">
		
		</div>		
		<button class="btn btn-danger" type="button" id="readMore">讀更多訊息</button>
	  </div>
	  <div class="col-sm-2"></div>
  </div>
  
  
  </body>
  <script type="text/template" id="chatTemplate">
		<div class="chatItem">
			<span class="userName"><%= userName_data %>:</span>
			<b class="caption" style="word-break: break-all;"><%= caption_data %></b>
			<p class="chatTimestsamp"><%= chatTimestsamp_data%></p>
		</div>
   </script>
   <script src="./js/chat.js"></script>  
</html>