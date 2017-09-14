<?php
require("../definitions.php");
header('Content-Type: application/json');
if(isset($_GET['on'])){
  if(readStatus(LIGHT_GPIO) != 1)
    $gpio_on = exec("gpio write ".LIGHT_GPIO." 1");
  if(readStatus(FAN_GPIO) != 1)
    $gpio_on = exec("gpio write ".FAN_GPIO." 1");
  echo json_encode(array('status'=>"on"));
}
else if(isset($_GET['off'])){
  if(readStatus(FAN_GPIO) != 0)
    $gpio_off = exec("gpio write ".FAN_GPIO." 0");
  if(readStatus(LIGHT_GPIO) != 0)
    $gpio_off = exec("gpio write ".LIGHT_GPIO." 0");
    echo json_encode(array('status'=>"off"));
}
else if(isset($_GET['read'])){
  echo json_encode(readallStatus());
}
else {
  echo json_encode(readallStatus());
}
function readallStatus(){
  $lightStatus = intval(exec("gpio read ".LIGHT_GPIO));
  $fanStatus = intval(exec("gpio read ".FAN_GPIO));
  return array('lightStatus'=>$lightStatus, 'fanStatus'=>$fanStatus);
}
function readStatus($pin){
  return intval(exec("gpio read $pin"));
}
