<?php
 require_once ('model/user.php');
 $user=new user();
 function insert_user(){
  $user->name=$_GET["name"];
  $user->email=$_GET["email"];
  $user->gender=$_GET["gender"];
  $user->gender=$_GET["gender"];
 }