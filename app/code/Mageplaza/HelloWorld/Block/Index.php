<?php
namespace Mageplaza\HelloWorld\Block;
class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

	 //Lay IP cua User
     function getUserIP() {
        //whether ip is from share internet
      if (!empty($_SERVER['HTTP_CLIENT_IP']))   
      {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
      }
      //whether ip is from proxy
      elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
      {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
      }
      //whether ip is from remote address
      else
      {
        $ip_address = $_SERVER['REMOTE_ADDR'];
      }
      if($ip_address != '::1') {
          return  $ip_address;
      }
      else {
          return '27.79.161.65';
      }
      }
       
      //Lay chuoi Json tu server IP Stack
      function sendJsontoServer() {
          $userIP = $this->getUserIP();
          $access_key = "?access_key=13f175ca2e9b6327b4e9c3266e889aa2";
          $array_json = "http://api.ipstack.com/27.79.161.65". $access_key;
          $json = file_get_contents($array_json);
          $obj = json_decode($json);
       
          return $obj;
      }
      //Lay chuoi JSON thoi tiet hien tai cua Vi tri User
function getCurrentData($region, $coutry_name, $access_key) {
    $location = $region . "," . $coutry_name;
    $array_json = "http://api.openweathermap.org/data/2.5/weather?q=" . $location . $access_key;
    $json = file_get_contents($array_json);
    $obj = json_decode($json);
   
    return $obj;
}
 
//Lay chuoi JSON chua du lieu du bao thoi tiet trong 5 ngay
function getForcast($city_id, $access_key) {
    $array_json = "http://api.openweathermap.org/data/2.5/forecast?id=" . $city_id . "&units=metric" . $access_key;
    $json = file_get_contents($array_json);
    $obj = json_decode($json);
   
    return $obj;
}
}