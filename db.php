<?php
$con=mysqli_connect("localhost","root","","vespers_ledger");
if(!$con){
    echo "MI6 Connection Error: Connection to HQ failed.";
}
else{
    echo "MI6 HQ Connection Successful.";
}
?>
