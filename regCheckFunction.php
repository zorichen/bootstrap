<?php

error_reporting( E_ALL & ~E_NOTICE );

// 导入数据库配置
include("connect.php");

// 导入自定义函数
include("defined_function.php");

// 预定义参数
$username = "";
$password = "";
$password2 = "";

// 检查表单
if (empty($_POST["username"])) {
    die( "手机号不能为空" );
} else {
    $username = check_input($_POST["username"]);
    if (!(preg_match("/^1[34578]\d{9}$/",$username))) {
        die( "手机号输入有误" );
    }
}

if (empty($_POST["password"])) {
    die( "密码不能为空" );
} else {
    $password = check_input($_POST["password"]);
    if (!(preg_match("/^\w{6,16}$/",$password))) {
        die( "密码位数有误，请输入6-16位密码" );
    }
}
if (empty($_POST["password2"])) {
    die( "重复密码不能为空" );
} else {
    $password2 = check_input($_POST["password2"]);
    if (!(preg_match("/^\w{6,16}$/",$password2))) {
        die( "重复密码位数有误，请输入6-16位密码" );
    }
}
if ( $password != $password2 ) {
    die( "两次输入的密码不一致" );
} 

// 密码加密
$password = md5_salt($password);


// 用户注册
try {
    // 连接数据库
    $con = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_username, $db_password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 检查是否重复注册
    $sql = "SELECT * FROM user WHERE username = :username";
    $sth = $con->prepare($sql);
    $sth->bindParam(':username', $username);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_BOTH);

    if ($row[0]) {
        die( "手机号已经注册，请勿重复注册" );
    } else {
        $sql = "INSERT INTO user ( username, password) VALUES ( :username, :password )";
        $sth = $con->prepare($sql);
        $sth->bindParam(':username', $username);
        $sth->bindParam(':password', $password);        
        $sth->execute();
        echo "<script>alert('注册成功!');window.location.href='login.php';</script>";

    }    

} catch (PDOException $e) {
    echo 'Unable to connect to the db server: '.$e->getMessage();
    die();
} finally {
    $con = null;
}


?>