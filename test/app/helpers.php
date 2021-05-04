<?php 
function changeDateFormat($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}


function getSocialAvatar($file, $imageid, $path){
    $fileContents = file_get_contents($file);
    return File::put(public_path() . $path . $imageid . ".jpg", $fileContents);
}

function parameterize_array($array) {
    $out = array();
    foreach($array as $key => $value)
        $out[] = "Id-"."$key:$value";
    return $out;
}

