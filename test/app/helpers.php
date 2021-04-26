<?php 
function changeDateFormat($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}


function getSocialAvatar($file, $imageid, $path){
    $fileContents = file_get_contents($file);
    return File::put(public_path() . $path . $imageid . ".jpg", $fileContents);
}