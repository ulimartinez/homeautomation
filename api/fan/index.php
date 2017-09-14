<?php
require("../definitions.php");
header('Content-Type: application/json');
if(isset($_GET['on'])){
  if(readStatus() != 1)
    $gpio_on = exec("gpio write ".FAN_GPIO." 1");
  echo json_encode(array('status'=>"on"));

}
else if(isset($_GET['off'])){
  if(readStatus() != 0)
    $gpio_off = exec("gpio write ".FAN_GPIO." 0");
    echo json_encode(array('status'=>"off"));
}
else if(isset($_GET['toggle']){
  $state = readStatus();
  if($state)
    $state = 0;
  else
    $state = 1;
  exec("gpio write ".FAN_GPIO." $state");
}
else if(isset($_GET['read'])){
  $state = readStatus();
  echo json_encode(array('fanstatus'=>($state == 1? "on" : "off")));
}
else{
  $state = readStatus();
  echo json_encode(array('fanstatus'=>($state == 1? "on" : "off")));
}
function readStatus(){
  return intval(exec("gpio read ".FAN_GPIO));
}
