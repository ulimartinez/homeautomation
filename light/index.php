<?php
header('Content-Type: application/json');
if(isset($_GET['on'])){
  if(readStatus() != 1)
    $gpio_on = exec("gpio write 1 1");
  echo json_encode(array('status'=>"on"));

}
else if(isset($_GET['off'])){
  if(readStatus() != 0)
    $gpio_off = exec("gpio write 1 0");
    echo json_encode(array('status'=>"off"));
}
else if(isset($_GET['read'])){
  $state = readStatus();
  echo json_encode(array('lightStatus'=>($state == 1? "on" : "off")));
}
else {
  echo json_encode(array('lightStatus'=>($state == 1? "on" : "off")));
}
function readStatus(){
  return intval(exec("gpio read 1"));
}
