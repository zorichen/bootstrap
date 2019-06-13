<?php 

error_reporting( E_ALL & ~E_NOTICE );

// 接管session
include("session.php");
session_start();

// 导入数据库配置
include("connect.php");

// 导入自定义函数
include("defined_function.php");

// 预定义参数
$username = "";
$password = "";

// 检查表单

if (empty($_POST["username"])) {
    die( "登录失败：手机号不能为空" );
} else {
    $username = check_input($_POST["username"]);
}

if (empty($_POST["password"])) {
    die( "登录失败：密码不能为空" );
} else {
    $password = check_input($_POST["password"]);
}

// 密码加密
$password = md5_salt($password);

// 用户登录
try {

    // 连接数据库
    $con = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_username, $db_password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 检查账号是否正确
    $sql = "SELECT id, username, password FROM user WHERE username = :username AND password = :password";
    $sth = $con->prepare($sql);
    $sth->bindParam(':username', $username);
    $sth->bindParam(':password', $password); 
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_BOTH);

    if ($row[0]) {
        
        //  当验证通过后，存储session。session.php 将自动调用sessionWrite()方法写入数据库
        // 
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        // 自动跳转到默认页面
        echo "<script>alert('登录成功!');window.location.href='index.php';</script>";
      
    } else {
        die ("登录失败：账号或密码输入有误");
    }

} catch (PDOException $e) {
    print "Error!:" . $e->getMessage(). "</br>";
    die();

} finally {
    $dbh = null;
}

?>