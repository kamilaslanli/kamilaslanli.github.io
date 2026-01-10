<?php
// Compatibility layer for deprecated mysql_* functions using mysqli (PHP 7/8)
$GLOBALS['__MYSQLI_LINK'] = null;

function mysql_connect($host=null, $user=null, $pass=null) {
    $link = mysqli_connect($host, $user, $pass);
    $GLOBALS['__MYSQLI_LINK'] = $link;
    return $link;
}

function mysql_select_db($db, $link=null) {
    $link = $link ?: $GLOBALS['__MYSQLI_LINK'];
    return mysqli_select_db($link, $db);
}

function mysql_query($query, $link=null) {
    $link = $link ?: $GLOBALS['__MYSQLI_LINK'];
    return mysqli_query($link, $query);
}

function mysql_fetch_array($result, $result_type = MYSQLI_BOTH) {
    return mysqli_fetch_array($result, $result_type);
}

function mysql_fetch_assoc($result) {
    return mysqli_fetch_assoc($result);
}

function mysql_fetch_row($result) {
    return mysqli_fetch_row($result);
}

function mysql_num_rows($result) {
    return mysqli_num_rows($result);
}

function mysql_insert_id($link=null) {
    $link = $link ?: $GLOBALS['__MYSQLI_LINK'];
    return mysqli_insert_id($link);
}

function mysql_real_escape_string($str, $link=null) {
    $link = $link ?: $GLOBALS['__MYSQLI_LINK'];
    return mysqli_real_escape_string($link, $str);
}

function mysql_error($link=null) {
    $link = $link ?: $GLOBALS['__MYSQLI_LINK'];
    return mysqli_error($link);
}
?>