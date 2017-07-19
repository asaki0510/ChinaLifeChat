


<script>
 $(document).ready(function () {
        var url = window.location;   	 
	    $(".nav li").removeClass('active');	
        $('ul.nav a[href="' + url + '"]').parent().addClass('active');
        $('ul.nav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');			
    });
</script>
	 

<nav class="navbar  navbar-default  container"> 
    <div class="container">
		<div class="navbar-header ">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <!--<a class="navbar-brand" href=""><img alt="Brand" src="./file/fish.jpg"></a>-->
			  <a class="navbar-brand" >中鍋人壽便民外部網路</a>	
		</div>
		 
		<div id="navbar" class="collapse navbar-collapse ">
			<ul class="nav navbar-nav">
				<li class="active"><a href="./">首頁</a></li>
				<li><a href="chat.php">聊天室</a></li>   
				<li><a href="CobolMoneyCount.php">缺錢QQ</a></li>
				<li><a href="we-share-we-link.php">記憶不好</a></li>
			</ul>	  
		</div>
	</div>
</nav>