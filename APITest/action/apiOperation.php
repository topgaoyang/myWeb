<?php
/**
 * <b>名称：</b>测试API有效性的后台调用函数
 *
 * <b>功能：</b>测试API链接的有效性
 *
 * <b>简要说明：</b>返回api的请求
 *
 * <b>页面输入参数：</b>API头及参数
 * 
 * <b>请求方式：</b>POST

 *  <b>输出参数：</b>json格式数据
 * 
 */
 /**
 *
 */ 
$urlHeader=$_POST["urlHeader"];
$parameters=$_POST["parameter"];
$result=_https_curl_post($urlHeader,$parameters);
echo $result;
	
/**
 * 发送https请求函数
 * 函数参数
 * $url:API调用的链接
 * $vars:传递过来的参数
 */
function _https_curl_post($url, $vars)
{
	$fields_string="";
    foreach($vars as $key=>$value)
    {
        $fields_string .= $key.'='.$value.'&' ;
    }
    $fields_string = substr($fields_string,0,(strlen($fields_string)-1)) ;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // this line makes it work under https
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POST, count($vars));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    $data = curl_exec($ch);       
    curl_close($ch); 
    if ($data){
        return $data;
    }
    else{
        return false;
    }
}
?>
