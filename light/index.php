<?php
$setmode17 = shell_exec("gpio mode 1 out");
if(isset($_GET['on'])){
$gpio_on = shell_exec("gpio write 1 1");
}
else if(isset($_GET['off'])){
$gpio_off = shell_exec("gpio write 1 0");
}
