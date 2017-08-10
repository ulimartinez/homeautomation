<?php
header('Content-Type: application/json');
if(isset($_GET['on'])){
  if(readStatus(1) != 1)
    $gpio_on = exec("gpio write 1 1");
  if(readStatus(4) != 1)
    $gpio_on = exec("gpio write 4 1");
  echo json_encode(array('status'=>"on"));
}
else if(isset($_GET['off'])){
  if(readStatus(1) != 0)
    $gpio_off = exec("gpio write 1 0");
  if(readStatus(4) != 0)
    $gpio_off = exec("gpio write 4 0");
    echo json_encode(array('status'=>"off"));
}
else if(isset($_GET['read'])){
  echo json_encode(readallStatus());
}
else {
  echo json_encode(readallStatus());
}
function readallStatus(){
  $lightStatus = intval(exec("gpio read 1"));
  $fanStatus = intval(exec("gpio read 4"));
  return array('lightStatus'=>$lightStatus, 'fanStatus'=>$fanStatus);
}
function readStatus($pin){
  return intval(exec("gpio read $pin"));
}
