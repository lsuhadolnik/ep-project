<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Login extends Model
{
    protected $fillable = ['user_id', 'type', 'ip_address', 'user_agent', ];
    protected $states = ['login', 'logout', 'api_request'];

    public static function note($attrs)
    {
        
        if(!isset($attrs['user_id'])){
            if(Auth::user()->role_id >= 3)
            {
                // Zapiši samo, če je uporabnik prodajalec ali administrator
                return;
            }
        }

        $attrs = Login::fillDefaults($attrs, [
            'user_id' => Auth::user()->id,
            'ip_address' => Login::getClientIP(),
            'user_agent' => Login::getUserAgent(),
        ]);

        

        return Login::create($attrs);
    }

    public static function fillDefaults($attrs, $defaults){
        foreach($defaults as $key => $val){
            if(!isset($attrs[$key]))
            {
                $attrs[$key] = $val;
            }
        }
        return $attrs;
    }

    public static function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public static function getClientIP() 
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
