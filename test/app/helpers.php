<?php 
use Carbon\Carbon;

function changeDateFormat($date,$date_format){
    return Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
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


use Jenssegers\Date\Date;

function diff_date_for_humans(Carbon $date) : string
{
    return (new Date($date->timestamp))->ago();
}
function diff_string_for_humans($stringDate) : string
{
    $date = Date::createFromFormat('Y-m-d H:i:s', $stringDate);
    return (new Date($date))->ago();
}


function scannerTableLabel($stringDate) : string
{
    $now = Date::now();
    $date = Date::createFromFormat('Y-m-d H:i:s', $stringDate);
    $printDate = (new Date($date))->ago();
    $color = $now > $date ? 'info' : 'danger';

    $res = '<span class="badge badge-'.$color.'" style="color:white;">SCANNER: ';
    $res .= $printDate ;
    $res .= '</span>';

    return $res;
}
