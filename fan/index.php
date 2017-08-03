<?php
header('Content-Type: application/json');
$setmode17 = shell_exec("gpio mode 4 out");
if(isset($_GET['on'])){
  if(readStatus() != 1)
    $gpio_on = exec("gpio write 4 1");
  echo json_encode(new Array('status'=>"on"));

}
else if(isset($_GET['off'])){
  if(readStatus() != 0)
    $gpio_off = exec("gpio write 4 0");
    echo json_encode(new Array('status'=>"off"));
}
else if(isset($_GET['read'])){
  $state = readStatus();
  echo json_encode(new Array('status'=>$state));
}
function readStatus(){
  return intval(exec("gpio read 4"));
}
