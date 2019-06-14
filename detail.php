<?php 

error_reporting( E_ALL & ~E_NOTICE );

// 接管session
include("session.php");
session_start();

// 导入数据库配置
include("connect.php");

// 获取文章id
$id = $_GET['id'];

if (!isset($id)) {
  
  die ;
} 



try {
  // 连接数据库
  $con = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_username, $db_password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // 获取文章明细
  $sql = "SELECT comment.id, comment.title, comment.content, comment.create_data, user.username FROM comment INNER JOIN user ON user.id = comment.uid AND comment.id = $id ";
  //   $sth->bindParam(':id', $id);
  $sth = $con->prepare($sql);
  $sth->execute();
  $sth->setFetchMode(PDO::FETCH_ASSOC); 
  $article = $sth->fetch();


  if ($article) {
    
  } else {
    die ("文章不存在");
  }
  

} catch (PDOException $e) {
  die ("连接数据库失败:" . $e->getMessage(). "</br>");
} 

?>


<!doctype html>
<html lang="zh-CN">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app.css">
    <title>黑皮Blog</title>
  </head>
  <body>
    <!-- 状态栏 -->
    <div class="container">
        <?php include('header.php'); ?>
    </div>
    <!-- 内容区域 -->
    <div class="container">

      <!-- 顶部间隔 -->
      <div class="w-100" style="height:20px"></div>

      <!-- 主内容区域 -->
      <div class="row justify-content-between">
        <!-- 左边内容区域 -->
        <div class="col-8">
          <div class="left bg-white">
            <!-- 间隔 -->
            <div class="w-100" style="height:20px"></div>
            <!-- 标题 -->
            <div class="row">
              <div class="col">
                <span class="offset-5"><strong><?=$article['title']?></strong></span>
              </div>
            </div>
            <!-- 间隔 -->
            <div class="w-100" style="height:5px"></div>
            <div class="row">
              <div class="col offset-3">
                &nbsp&nbsp&nbsp
                <span class="article-author">作者：<?=$article['username']?></span>
                &nbsp&nbsp&nbsp
                <span class="article-create_data">创建时间：<?=$article['create_data']?></span>
              </div>
            </div>
            <!-- 间隔 -->
            <div class="w-100" style="height:20px"></div>
            <div class="row">
              <div class="col offset-1"><p><?=$article['content']?></p></div>
            </div>
            <!-- 间隔 -->
            <div class="w-100" style="height:20px"></div>
          </div>
        </div>
        <!-- 右边内容区域 -->
        <div class="col-4">
          <div class="right bg-white">
            <?php include("rightbar-1.php"); ?>
          </div>
        </div>
      </div>

      <!-- 底部间隔 -->
      <div class="w-100" style="height:20px"></div>
    </div>

    <!-- 底部栏 -->
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="content bg-white">
            底部栏
          </div>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <!-- <script src="main.js"></script> -->
  </body>
</html>