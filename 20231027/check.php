<?php
if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
    header("location:member.php?login=1");
    // echo "登入成功";
}else{
        header("location:login.php?m=登入失敗");
// echo "登入失敗";}
  
    } 
?>
