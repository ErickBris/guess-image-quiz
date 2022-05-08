<?php
@session_start();
if($_SESSION['unm']==NULL){
 header("location:index.php");
}
?>