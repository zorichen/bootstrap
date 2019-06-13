<?php 

function check_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function md5_salt($key)
{
  $salt = 'em9yaWNoZW4=';
  return md5($key.$salt);
}


?>