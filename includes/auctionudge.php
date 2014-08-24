<?php
header("Content-Type: text/javascript");
$file = file_get_contents('http://www.auctionnudge.com/feedback_build/js/UserID/upuptriangle/siteid/0/limit/25/type/FeedbackReceived/theme/table');
//echo ($file);
$array=explode("\n",$file);
$chunk=array_chunk($array,10)[0];
print_r(implode("\n",$chunk) )
?>