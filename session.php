<?php 

$con = null;

// 连接数据库
function sessionBegin()
{
    // 数据库配置信息
    $db_host = 'mysql';
    $db_username = 'root';
    $db_password = '123456';
    $db_name = 'test';
    $db_charset = 'utf8';

    // 连接数据库
    global $con;
    $con = new PDO("mysql:host=$db_host;dbname=$db_name;charset=$db_charset", $db_username, $db_password);

    // 返回值
    if ($con) {
        return true;
    } else {
        return false;
    }
}

// 关闭数据库
function sessionEnd()
{
    global $con;
    $con = null;
    
    // 返回值
    return true;
}


// 读取session_id
function sessionRead($session_id)
{
    global $con;

    // 获取当前时间
    $session_time = time();

    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    // 只查询未过期的session
    $sql = "SELECT session_data FROM session WHERE session_id = :session_id AND session_time > :session_time";
    $sth = $con->prepare($sql);
    $sth->bindParam(':session_id', $session_id);
    $sth->bindParam(':session_time', $session_time);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_BOTH);

    // 返回值
    if ($row[0]) {
        return $row['session_data'];
    } else {
        return "";
    }     
}


// 写入session_id, session_data
function sessionWrite($session_id, $session_data)
{
    global $con;

    // 设计session有效时间
    $expire_time = 3600*24;
    $session_time = time() + $expire_time;

    // 检查是否存在session_id， 如果有，就更新；如果没有，就插入
    $sql = "SELECT * FROM session WHERE session_id = :session_id";
    $sth = $con->prepare($sql);
    $sth->bindParam(':session_id', $session_id);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_BOTH);

    if ($row[0]) {
        // 更新session
        $sql = "UPDATE session SET session_data = :session_data, session_time = :session_time WHERE session_id = :session_id";
        $sth = $con->prepare($sql);
        $sth->bindParam(':session_id', $session_id);
        $sth->bindParam(':session_data', $session_data);
        $sth->bindParam(':session_time', $session_time);
        $sth->execute();    

    } else {
        // 插入session
        $sql = "INSERT INTO session (session_id, session_data, session_time) VALUES (:session_id, :session_data, :session_time)";
        $sth = $con->prepare($sql);
        $sth->bindParam(':session_id', $session_id);
        $sth->bindParam(':session_data', $session_data);
        $sth->bindParam(':session_time', $session_time);
        $sth->execute();     
    } 

    // 返回值
    if ($sth->rowCount()) {
        return true;
    } else {
        return false;
    } 
}


// 删除session_id
function sessionDelete($session_id)
{
    global $con;

    $sql = "DELETE FROM session WHERE session_id = :session_id";
    $sth = $con->prepare($sql);
    $sth->bindParam(':session_id', $session_id);
    $sth->execute(); 

    // 返回值
    if ($sth->rowCount()) {
        return true;
    } else {
        return false;
    }   
}


// 回收垃圾数据，清除过期的session
function sessionGC($expire_time)
{
    global $con;
    
    // 获取当前时间
    $session_time = time();

    $sql = "DELETE FROM session WHERE session_time < :session_time";
    $sth = $con->prepare($sql);
    $sth->bindParam(':session_time', $session_time);
    $sth->execute(); 

    // 返回值
    if ($sth->rowCount()) {
        return true;
    } else {
        return false;
    }   
}



session_set_save_handler(
    'sessionBegin',
    'sessionEnd',
    'sessionRead',
    'sessionWrite',
    'sessionDelete',
    'sessionGC'
);

// ini_set('session.save_handler','user');

?>