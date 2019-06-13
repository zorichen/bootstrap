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
$title = "";
$content = "";
$uid = $_SESSION['id'];

// 检查表单

if (empty($_POST["title"])) {
    die( "标题不能为空" );
} else {
    $title = check_input($_POST["title"]);
}

if (empty($_POST["content"])) {
    die( "内容不能为空" );
} else {
    $content = check_input($_POST["content"]);
}

if (empty($uid)) {
    echo "<script>alert('请先登录!');window.location.href='user_login.php';</script>";

} else {
    $title = check_input($_POST["title"]);
}



// 用户登录
try {

    // 连接数据库
    $con = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_username, $db_password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 检查账号是否正确
    $sql = "SELECT title FROM comment WHERE title = :title";
    $sth = $con->prepare($sql);
    $sth->bindParam(':title', $title);
    $sth->execute();
    $row = $sth->fetch(PDO::FETCH_BOTH);

    if ($row[0]) {
        die( "标题重复" );
    } else {
        $sql = "INSERT INTO comment ( title, content, uid) VALUES ( :title, :content, :uid )";
        $sth = $con->prepare($sql);
        $sth->bindParam(':title', $title);
        $sth->bindParam(':content', $content);        
        $sth->bindParam(':uid', $uid);        
        $sth->execute();
        echo "<script>alert('创建文章成功!');window.location.href='index.php';</script>";
    }   

} catch (PDOException $e) {
    print "Error!:" . $e->getMessage(). "</br>";
    die();

} finally {
    $dbh = null;
}

?>