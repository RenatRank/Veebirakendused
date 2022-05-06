<?php 

  session_start();
  
  //kas on sisse loginud
  if(!isset($_SESSION["user_id"])){
	//jأµuga suunatakse sisselogimise lehele
	header("Location: page.php");
	exit();
  }
  
  //logime vأ¤lja
  if(isset($_GET["logout"])){
	//lأµpetame sessiooni
	session_destroy();
	//jأµuga suunatakse sisselogimise lehele
	header("Location: page.php");
	exit();
  }