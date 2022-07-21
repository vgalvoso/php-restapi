<?php
//get uri
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .
"://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($url, PHP_URL_PATH);
//remove string from last "/" to first character
$path = trim(ltrim(strchr($path,"/"),"/"));
$path = ltrim(substr($path,strposX($path,"/",1)),"/");

$sql = new Sql();

function strposX($haystack, $needle, $number = 0)
{
    return strpos($haystack, $needle,
        $number > 1 ?
        strposX($haystack, $needle, $number - 1) + strlen($needle) : 0
    );
}

function api($api=null){
    global $path;
    if($api!=null) $path = $api;
    if(isset($_POST)) extract($_POST);
    if(isset($_GET)) extract($_GET);
    if(!file_exists("api/$path.php")){
        if(!file_exists("api/$path/index.php")){   
            header("HTTP/1.1 404 Not Found");
            exit("URL not found");
        }
        $path = $path."/index";
    }
    global $sql;
    header('Cache-Control: max-age=86400');
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=utf-8");
    include "api/$path.php";
}

function route($routeName,$api){
    global $path;
    if($routeName==$path){
      api($api);
      exit();
    }
  }


