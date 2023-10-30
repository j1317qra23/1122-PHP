<?php
include_once "session.php";
// 上課才一直開，外面不會有資安問題
if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
    $_SESSION['login']=$_POST['acc'];
    header("location:member.php");
    // echo "登入成功";
}else{
    $_SESSION['error']="帳號密碼錯誤，請重新登入";
        header("location:login.php");
// echo "登入失敗";}
  
    } 
?>
