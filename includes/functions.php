<?php
  function check_password($password){
    if(trim($password) != ""){
      return true;
    }else{
      return false;
    }
  }

?>
