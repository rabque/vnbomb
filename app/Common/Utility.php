<?php
/**
 * Created by PhpStorm.
 * User: hungln
 * Date: 10/31/16
 * Time: 12:48 AM
 */

namespace App\Common;

use Illuminate\Support\Facades\Input;

class Utility {

    public static function stripXSS()
    {
        $sanitized = static::cleanArray(Input::get());
        Input::merge($sanitized);
    }

    public static function cleanArray($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $key = strip_tags($key);
            if (is_array($value)) {
                $result[$key] = static::cleanArray($value);
            } else {
                $result[$key] = trim(strip_tags($value)); // Remove trim() if you want to.
            }
        }
        return $result;
    }

    /**
     * Get int from request, with min, max and check validate
     * @example Utility::getInt('page', 1, 100);
     * @return int
     */
    public static function getInt($name, $min = null, $max = null)
    {
        $value = filter_var($name, FILTER_VALIDATE_INT);
        if ($value !== false) {
            if ($min !== null && $min > $value) {
                throw new \InvalidArgumentException("Invalid argument, $name too small", 500);
            }
            if ($max !== null && $max < $value) {
                throw new \InvalidArgumentException("Invalid argument, $name too large", 500);
            }
            return $value;
        } else {
            throw new \InvalidArgumentException("Invalid argument $name", 500);
        }
    }

    /**
     * Get int from Array data
     * @author Hungln <hungln@ai-t.vn>
     * @since 2015/08/14
     * @example Utility::getIntArr('type',[1,2,3,4]);
     * @param string $name
     * $param array $data
     * @return $name
     */
    public static function getIntArr($name, $data)
    {
        $name = self::getInt($name);
        if (!isset($data) || empty($data)) {
            throw new \InvalidArgumentException("Invalid argument $data", 500);
        }
        if (!in_array($name, $data)) {
            throw new \ErrorException("Invalid argument, $name not in $data", 500);
        }
        return $name;
    }


    public static function rercusive(array $objects, array &$result=array(), $parent=1, $level=0)
    {
        foreach ($objects as $key => $object) {
            if ($object['parent_id'] == $parent) {
                $object['level'] = $level;
                array_push($result, $object);
                unset($objects[$key]);
                self::rercusive($objects, $result, $object['id'], $level + 1);
            }
        }
        return $result;
    }

    /**
     * Check number is float
     *
     * @author hungln <hungln@ai-t.vn>
     * @date 2015-06-25
     * @param int $number
     * @params integer $number,
     * @throws  \Exception
     * @return true or false
     *
     */

    public static function checkFloat($number = 0, $isSendExceptions = true)
    {
        $flag = true;
        if (empty($number)) {
            return false;
        }
        if (filter_var($number, FILTER_VALIDATE_FLOAT) === 0 || filter_var($number, FILTER_VALIDATE_FLOAT) === false) {
            if ($isSendExceptions == true) {
                throw new \Exception("$number not float", 500);
            } else {
                $flag = false;
            }
        }
        return $flag;
    }


    public static function checkInt($number = 0, $isSendExceptions = true)
    {
        $flag = true;
        if (empty($number)) {
            return false;
        }
        if (filter_var($number, FILTER_VALIDATE_INT) === 0 || filter_var($number, FILTER_VALIDATE_INT) === false) {
            if ($isSendExceptions == true) {
                throw new \Exception("$number not int", 500);
            } else {
                $flag = false;
            }
        }
        return $flag;
    }


    public static function removeSpacesString($string)
    {
        if (empty($string)) {
            return false;
        }
        $string = trim(preg_replace('/\s+/', ' ', $string));
        $string = preg_replace("/[\\n\\r]+/", " ", $string);
        return $string;
    }


    // Function to get the client IP address
    public static function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']) & !empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) & !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED']) & !empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR']) & !empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED']) & !empty($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR']) & !empty($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }


    /**
     * Push Message to socket
     *
     * @author hungln <hungln@ai-t.vn>
     * @date 2015-07-07
     * @param message $message
     * @return null
     *
     */

    public static function pushSocket($message)
    {
        if (empty($message)) {
            return false;
        }
        $loop = \React\EventLoop\Factory::create();

        $context = new \React\ZMQ\Context($loop);

        $push = $context->getSocket(\ZMQ::SOCKET_PUSH);
        $push->connect(RATCHET_SERVER_ZMQ);

        $push->on('error', function ($e) {
            throw new $e->getMessage();
        });
        $push->send($message);
        $loop->run();
    }

    /**
     * Pull Message to socket
     *
     * @author hungln <hungln@ai-t.vn>
     * @date 2015-07-07
     * @return null
     *
     */
    public static function pullSocket()
    {
        $loop = \React\EventLoop\Factory::create();

        $context = new \React\ZMQ\Context($loop);

        $pull = $context->getSocket(\ZMQ::SOCKET_PUSH);
        $pull->bind(RATCHET_SERVER_ZMQ);

        $pull->on('error', function ($e) {
            var_dump($e->getMessage());
        });
        $text = "";
        $pull->on('message', function ($msg) {
            echo "Received: $msg\n";
            $text = @$text.$msg;
        });

        $loop->run();
        return $text;
    }

    public static function is_serialized($data)
    {
        // if it isn't a string, it isn't serialized
        if (!is_string($data)) {
            return false;
        }
        $data = trim($data);
        if ('N;' == $data) {
            return true;
        }
        if (!preg_match('/^([adObis]):/', $data, $badions)) {
            return false;
        }
        switch ($badions[1]) {
            case 'a' :
            case 'O' :
            case 's' :
                if (preg_match("/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data)) {
                    return true;
                }
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if (preg_match("/^{$badions[1]}:[0-9.E-]+;\$/", $data)) {
                    return true;
                }
                break;
        }
        return false;
    }

    public static function removeScripts($str) {
        $str = trim($str);
        $str = strip_tags($str);
        $regex =
            '/(<link[^>]+rel="[^"]*stylesheet"[^>]*>)|' .
            '<script[^>]*>.*?<\/script>|' .
            '<style[^>]*>.*?<\/style>|' .
            '<!--.*?-->/is';
        return preg_replace($regex, '', $str);
    }


    public static function generateRandomString($length = 5) {
        return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', ceil($length/strlen($x)) )),1,$length);
    }


    public static function calcNextPoint($stake = 0,$percent = 0){
        $percent = $percent/100;
        $value =  $stake*$percent;
        return $value;
    }

    public static function exp2dec($number) {
        $number = rtrim($number,0);
        preg_match('/(.*)E-(.*)/', str_replace(".", "", $number), $matches);
        $num = "0.";
        if(!empty($matches[2])){
            while ($matches[2] > 0) {
                $num .= "0";
                $matches[2]--;
            }
            return $num . $matches[1];
        }else{
            return $number;
        }

    }

    public static function convertToBTCFromSatoshi($value){
        if($value != 0){
            $value =  bcdiv(intval($value), 1000000, 6 );
        }

        return $value;
    }

    public static function convertToSatoshifromBTC($value){
        $value =  $value*1000000;
        return $value;
    }



    public static function formatBTC($value) {
        $value = sprintf('%.8f', $value);
        $value = rtrim($value, '0');
        $value = round($value, 6);
        return $value;
    }

    public static function formatNumber($number,$isconvert = true){

        $number = ($isconvert == true)?self::formatBTC(self::convertToSatoshifromBTC($number)):$number;
        $number = ($number > 0)?ceil($number):0;
        $numberFormat = new \NumberFormatter("it-IT", \NumberFormatter::DECIMAL);
        $number = $numberFormat->format($number);
        return $number;
    }
    public static function bcdiv_cust( $first, $second, $scale = 0 )
    {
        $res = $first / $second;
        return round( $res, $scale );
    }

    public static  function builHtmlClick($click){
        $html = "";
        if(!empty($click)){
            $html .= "<ul class='match_history'>";
            foreach($click as $key=>$value){
                $class = "";
                if($value == 1){
                    $class = "m_click";
                }
                if($value == 2){
                    $class = "m_bomb";
                }

                $html .= "<li class='$class'></li>";
            }
        }
        return $html;
    }

    public static function GetCurrentWeekDates()
    {
        if (date('D') != 'Mon') {
            $startdate = date('Y-m-d', strtotime('last Monday'));
        } else {
            $startdate = date('Y-m-d');
        }

//always next saturday
        if (date('D') != 'Sat') {
            $enddate = date('Y-m-d', strtotime('next Saturday'));
        } else {
            $enddate = date('Y-m-d');
        }

        $DateArray = array();
        $timestamp = strtotime($startdate);
        while ($startdate <= $enddate) {
            $startdate = date('Y-m-d', $timestamp);
            $DateArray[] = $startdate;
            $timestamp = strtotime('+1 days', strtotime($startdate));
        }
        return $DateArray;
    }


    /**
     * Remove slashes from strings, arrays and objects
     *
     * @param    mixed   input data
     * @return   mixed   cleaned input data
     */
    public static function stripslashesFull($input)
    {
        if (is_array($input)) {
            $input = array_map('Utils::stripslashesFull', $input);
        } elseif (is_object($input)) {
            $vars = get_object_vars($input);
            foreach ($vars as $k=>$v) {
                $input->{$k} = Utils::stripslashesFull($v);
            }
        } else {
            $input = stripslashes($input);
        }
        return $input;
    }


    public static function ip_visitor_country()
    {

        $ip = self::get_ip_address();
        //$ip = '66.249.65.185';
        //$ip = '113.160.56.102';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $ip_data_in = curl_exec($ch); // string
        curl_close($ch);

        $ip_data = json_decode($ip_data_in,true);
        $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/
        return $ip_data;
    }

    public static function get_ip_address() {
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    // trim for safety measures
                    $ip = trim($ip);
                    // attempt to validate IP
                    if (self::validate_ip($ip)) {
                        return $ip;
                    }
                }
            }
        }

        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : false;
    }

    /**
     * Ensures an ip address is both a valid IP and does not fall within
     * a private network range.
     */
    public static function validate_ip($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
        return true;
    }

    public static function printTypePlayerAmount($type){
        //1: bitcoin, 2: new_game, 3 : win game, 4: cash out, 5 : affiliate, 6 : withdraw
        $value = "";
        switch($type){
            case 1:
                $value = "<span class='label label-danger'>Bitcoin</span>";
                break;
            case 2:
                $value = "<span class='label label-primary'>New Game</span>";
                break;
            case 3:
                $value = "<span class='label label-success'>Win Game</span>";
                break;
            case 4:
                $value = "<span class='label label-warning'>CashOut</span>";
                break;
            case 5:
                $value = "<span class='label label-default'>Affiliate</span>";
                break;
            case 6:
                $value = "<span class='label label-default'>withdraw</span>";
                break;
        }
        return $value;
    }

}