var roomName = 'room1';
var messageSeq = 0;

var readRowDataFlag = 50;
var changedTitle = "您有新的訊息";
var beforeChangeTitle = "中鍋人壽便民外部網路";
var lastSeq;
var pushSwitch = true;
var filePath = dateFilePathNameConverter(Date.now()) + '/';

$(document).ready(function(){		
	
	readRoomData();
	readLastChatData();	
	
	//onChatDataAdd();		
	onRoomInfoChange();	
	
});

$('#messageInput').keypress(function (e) {		
		if (e.which == 13) {
			var messageInput = $('#messageInput').val();
			var nameInput = $('#nameInput').val();
			if (messageInput.trim() != '' && nameInput.trim() != '')
			{
				addChatData('');
				updateRoomData('');			
				$('#messageInput').val('');
				$('#errorMessage').text("");
			}		
		}			
});

$('#readMore').click(function() {
	readMoreChatData(readRowDataFlag);		
});

$('#uploadData').click(function() {	
	 flFile.click();   
});

$("#flFile").change(function() {
	var nameInput = $('#nameInput').val();	
	if(nameInput.trim() != '')	
	{		
		UploadFile(this.files);  
	}	
	else
	{
		$('#errorMessage').text("請輸入姓名");
	}
});

$(window).focus(function() {
  document.title=(beforeChangeTitle);
});

$(window).blur(function() {
  document.title=(beforeChangeTitle);
});

$('#pushSwitch').click(function() {	
	switch(pushSwitch) {
    case true:
        pushSwitch = false;
		$('#pushSwitch').text("關閉通知");
        break;
    case false:
        pushSwitch = true;
		$('#pushSwitch').text("開啟通知");
        break;
    default:
        pushSwitch = true;
		$('#pushSwitch').text("開啟通知");		
	}
});

function allowDrop(e) {
    e.preventDefault();
}
function drop(e) {
    e.preventDefault(); 	
	var files = e.dataTransfer.files;
	var nameInput = $('#nameInput').val();	
	if(nameInput.trim() != '')	
	{		
		UploadFile(files);
	}	
	else
	{
		$('#errorMessage').text("請輸入姓名");
	}
}

function readRoomData()
{
	var fireBaseReadRef = firebase.database().ref("/Message/chatrooms/" + roomName).orderByChild('timestamp');
	fireBaseReadRef.once('value', function(snapshot) {	
	messageSeq = snapshot.val().messageSeq;		
	$("#testText").text(snapshot.val().lastMessage);
	});
}	

function readLastChatData()
{
	NProgress.start();
	var fireBaseReadRef = firebase.database().ref("/Message/" + roomName).orderByChild('timestamp').limitToLast(readRowDataFlag);
	fireBaseReadRef.once('value', function(snapshot) {
		var data = [];
		snapshot.forEach(function (child) {		    
		    data.push(child.val());
		}.bind(this));
		if (data.length == 0) { NProgress.done(); $(".chatRoom").css({ "visibility": "visible" }); return; }
		    for(i=0;i<data.length;i++)
		    {		
			    displayChatTemplate(data[i].username,data[i].message,timeConverter(data[i].timestamp),data[i].fileSrc);				
			
		    }
		    lastSeq = data[0].messageSeq;
		    NProgress.done();
		    $(".chatRoom").css({ "visibility": "visible" });
	});		
	
}

function readMoreChatData()
{
    lastSeq = lastSeq - 1; //需少讀一條
    var endSeq = lastSeq - 50;   
    var fireBaseReadRef = firebase.database().ref("/Message/" + roomName).orderByChild('messageSeq').startAt(endSeq).endAt(lastSeq); //orderByChild('timestamp').startAt('2016/12/26 07:00:00').endAt('2017/04/26 16:00:00');
    fireBaseReadRef.once('value', function(snapshot) {
    var data = [];
    snapshot.forEach(function(child) {
    data.push(child.val());
    }.bind(this));	    
    for (i = data.length - 1; i >= 0; i--)
    {
    //displayChatMessage(data[i].username,data[i].message,data[i].timestamp);
    displayMoreTemplate(data[i].username, data[i].message, timeConverter(data[i].timestamp));
    console.log(data[i].messageSeq);
    }
	 
    });
    lastSeq = endSeq;
    //alert("還沒作ㄏㄏ");
}

function addChatData(fileSrc)
{
	var name = $('#nameInput').val();
	var content = $('#messageInput').val();
	var timeStamp = Date.now();
	var tempSeq;
	fileSrc = fileSrc;
	messageSeq = messageSeq + 1;
	tempSeq = messageSeq;
	if (messageSeq < 10) { tempSeq = '0' + tempSeq }
	firebase.database().ref('Message/' + roomName + '/' + tempSeq + '-' + timeStamp).set({
	username: name,
	message: content,
	timestamp: timeStamp,
	messageSeq: messageSeq,
	fileSrc: fileSrc
	});   
}

function updateRoomData(fileSrc)
{
	var name = $('#nameInput').val();
	var content = $('#messageInput').val();
	var timeStamp = Date.now();		
  
	firebase.database().ref('Message/chatrooms/' + roomName).set({			  
	lastMessage: content,
	timestamp: timeStamp,
	title: roomName,
	username: name,
	messageSeq: messageSeq,
	fileSrc: fileSrc
	}); 
}

function onChatDataAdd()
{
	var fireBaseRef = firebase.database().ref("/Message/" + roomName);
	fireBaseRef.on("child_added", function(data, prevChildKey) {
	var newMessage = data.val();
	//console.log(data);
	//console.log(prevChildKey);
	console.log(newMessage.username);
	console.log(newMessage.message);
	console.log(newMessage.messageSeq);
	messageSeq = newMessage.messageSeq;
	//$("#testText").text(newMessage.message);
	});
}

function onRoomInfoChange()
{
	var fireBaseChangedRef = firebase.database().ref("/Message/chatrooms/");
	fireBaseChangedRef.on("child_changed", function(data, prevChildKey) {
		var newMessage = data.val();		
		messageSeq = newMessage.messageSeq;				
		displayChatTemplate(newMessage.username,newMessage.lastMessage,timeConverter(newMessage.timestamp),newMessage.fileSrc);
		document.title=(changedTitle);
		if(pushSwitch)
		{
			// Detail in push.js
			Push.create(newMessage.username, {
			body: newMessage.lastMessage,
			icon: './favicon.ico',
			timeout: 4000
			});	
		}		
	});	
}

function displayChatMessage(name,content,timestamp) 
{		
	//$('<div/>').text(content).prepend($('<em/>').text(name+': ')).prependTo($('#chatText'));
	$('<div/>')
	.text(timeConverter(timestamp))
	.prepend($('<b/>').text(content))
	.prepend($('<em/>').text(name+': '))
	.prependTo($('#chatText'));
	
}

function timeConverter(timestamp){
  var a = new Date(timestamp);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
  return time;
}

function dateFilePathNameConverter(timestamp){
  var a = new Date(timestamp); 
  var year = a.getFullYear();
  var month = a.getMonth() + 1;
  var date = a.getDate(); 
  var time = year + '-' + month + '-' + date;
  return time;
}

function displayChatTemplate(name,content,timestamp,fileSrc)
{	
	var chatTemplate = _.template($('#chatTemplate').html());
	var imgTemplate = _.template($('#imgTemplate').html());
	if(fileSrc=="" || typeof fileSrc=="undefined")
	{
		$("#chatText").prepend(chatTemplate({
		userName_data: name,
		caption_data: content,
		chatTimestsamp_data: timestamp		
		}));
	}
	else
	{
		$("#chatText").prepend(imgTemplate({
		userName_data: name,
		caption_data: content,
		chatTimestsamp_data: timestamp,
		fileSrc : fileSrc
		}));
	}
}
function displayMoreTemplate(name, content, timestamp, fileSrc)
{
    var chatTemplate = _.template($('#chatTemplate').html());
    var imgTemplate = _.template($('#imgTemplate').html());
    if (fileSrc == "" || typeof fileSrc == "undefined") {
        $("#chatText").append(chatTemplate({
            userName_data: name,
            caption_data: content,
            chatTimestsamp_data: timestamp
        }));
    }
    else {
        $("#chatText").append(imgTemplate({
            userName_data: name,
            caption_data: content,
            chatTimestsamp_data: timestamp,
            fileSrc: fileSrc
        }));
    }
   
}

function UploadFile(files)
{
	NProgress.start();
	var storageRef = firebase.storage().ref(filePath + '/');  
	for (var i=0, file; file=files[i]; i++) {
		var fileName = files[i].name;
		if(isImage(fileName))
		{
			var tempFileRef = storageRef.child(fileName);		
			tempFileRef.put(file).then(function(snapshot) {		
			getFirebaseUrlandUploadImgSrc(filePath + '/' +fileName)
		    console.log('Uploaded a blob or file!');
			$('#errorMessage').text("");
			});	
		}			
	}
	NProgress.done();
}

//檔案上傳後取得真實url並上傳資料
function getFirebaseUrlandUploadImgSrc(fileSrc)
{	
	var timeStamp = timeConverter(Date.now());		
	var storageRef = firebase.storage().ref();    
	// Create a reference to the file we want to download
	var starsRef = storageRef.child(fileSrc);

	starsRef.getDownloadURL().then(function (url) {		
		console.log(url);
		addChatData(url);
		updateRoomData(url);
	  	return url;
	})
	.catch(function(error) {
	  switch (error.code) {
		case 'storage/object_not_found':		
		  break;
		case 'storage/unauthorized':
		  break;
		case 'storage/canceled':
		  break;
		case 'storage/unknown':		
		  break;		
	  }
	});
}

//檢查檔案型態////////////////////
function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'jpg':
    case 'gif':
    case 'bmp':
    case 'png':
        //etc
        return true;
    }
    return false;
}
///////////////////////////////

 