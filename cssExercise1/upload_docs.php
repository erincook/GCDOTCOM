<?php
if($_FILES['file_uploads']['name'][0] != ''){
	$t = time(); 
	if(file_exists('uploaded_files/' . $t)){
		echo '<script> alert("This file already exists on the server"); </script>'; 
		return;
	} else {   
		$x = 0;
		foreach($_FILES["file_uploads"]["name"] as $file_name)
		{
			if($file_name != '')
			{
				$name = $_FILES["file_uploads"]["name"][$x];
				$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				$allowedExt = array('pdf', 'jpg', 'jpeg', 'pjpeg', 'tiff', 'tif'); 
				
				if(in_array($ext, $allowedExt) < -1) 
				{
					echo '<script> alert("File type not allowed"); </script>';
					return;
				}
				$dotCount = substr_count($name, '.');
				//we want the largest occurance... 
				$nameArray = explode('.', $name);
				$name = $nameArray[$dotCount - 1];
				$name = clean($name);
				$name = $name . '.' .  $nameArray[$dotCount];
				if($_FILES["file_uploads"]["error"][$x] != '')
				{
					echo '<script> alert("We apologize, there appears to be an unforeseen error in uploading your file."); </script>';
					return;
				}
				$mimeType = $_FILES["file_uploads"]["type"][$x]; 
				$allowedMime = array(
					'"application/pdf"', 
					'application/pdf', 
					'"image/jpeg"', 
					'image/jpeg', 
					'"image/pjpeg"', 
					'image/pjpeg', 
					'"image/tiff"', 
					'image/tiff');   //Need both quoted and unquoted to support IE vs other browsers.
					
				if(in_array($mimeType, $allowedMime) < -1)
				{
					echo '<script> alert("Disallowed file type"); </script>';
					return;
				}
				
				//Otherwise, let's take the file.. 
				move_uploaded_file($_FILES["file_uploads"]["tmp_name"][$x], 'uploaded_files/' . $name);
				$filePath = 'uploaded_files/' . $name; 
				echo '<img src="' . $filePath . '" alt="uploaded file" height="140" width="140"/>'; 
				$x++;
			} else {
				echo '<script> alert("Please select a file..."); </script>'; 
				return;
			}
		}
	}
} else {
	echo '<script> alert("Please select a file"); </script>'; 
	return;
}
function clean($string) 
{
   $string = str_replace('', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>