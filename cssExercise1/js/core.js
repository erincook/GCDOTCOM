$(function() {
	$("#frm_upload_docs").submit(function(){
		document.getElementById('frm_upload_docs').target = 'file_downloader';
	}); 
}); 
function showImg(filePath){
	
	var imageFrame = $("#pictureShow"); 
	imageFrame.html(filePath); 
}

