<?php 

include("isLoginCheck.php");

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
    <title>创建文章</title>
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
            <div class="w-100" style="height:10px"></div>
            <!-- 标题 -->
            <div class="row">
              <div class="col"><span class="ml-3"><strong>创建文章</strong></span></div>
            </div>
            <!-- 间隔 -->
            <div class="w-100" style="height:20px"></div>
            <!-- 登录表单 -->
            <div class="row">
              <div class="col offset-md-1">
                <form action="newCheck.php" method="POST">
                  <div class="form-group row">
                      <label for="inputTitle" class="col-2 col-form-label-sm">标题</label>
                      <div class="col">
                          <input type="text" name="title" class="col-6 form-control-sm" id="inputTitle" placeholder="请输入标题">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="inputContent" class="col-2 col-form-label-sm">内容</label>
                      <div class="col">
                        <textarea name="content" class="col-6 form-control-sm" id="inputContent" placeholder="请输入内容"></textarea>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col">
                          <button type="submit" class="btn btn-primary">提交</button>
                      </div>
                  </div>
                </form>
              </div>
            </div>
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