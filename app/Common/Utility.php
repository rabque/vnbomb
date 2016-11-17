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
        $regex =
            '/(<link[^>]+rel="[^"]*stylesheet"[^>]*>)|' .
            '<script[^>]*>.*?<\/script>|' .
            '<style[^>]*>.*?<\/style>|' .
            '<!--.*?-->/is';
        return preg_replace($regex, '', $str);
    }


    public static function generateRandomString($length = 5) {
        return substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }


    public static function calcNextPoint($stake = 0,$percent = 0){
        //$value = bcdiv(bcmul($stake,$percent),100);
        //$value = rtrim($value,0);
        $value =  ($stake*$percent)/100;
        return $value;
    }

    public static function formatNumber($number){
        $number = rtrim($number,0);
        //$number = floor($number);
        $number = doubleval($number);
        $number = round($number,strlen($number)-1);
        return $number;
    }
    public static function bcdiv_cust( $first, $second, $scale = 0 )
    {
        $res = $first / $second;
        return round( $res, $scale );
    }

}