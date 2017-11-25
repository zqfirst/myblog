<?php

namespace common\libs\helpers;
/**
 * @method encrypt AES加密算法 其中padding为pkcs5padding算法
 * @method decrypt AES解密算法
 * @method substr 字符串截取
 */
class AesHelper
{

    /**
     * @TODO AES加密
     * @param $string the string to encrypt
     * @param $key the key for encrypt 128位加密 传16为key 256位加密传32位key
     * @param $iv the iv for encrypt 128位加密 传16为iv 256位加密传32位iv
     * @param $algorithm AES length mode(MCRYPT_RIJNDAEL_128,MCRYPT_RIJNDAEL_192,MCRYPT_RIJNDAEL_256)
     * @param $mode AES encrypt (such as MCRYPT_MODE_CBC,MCRYPT_MODE_ECB..)
     * @param $padding need or not to padding
     * @return string
     */
    static public function encrypt($string, $key=null, $iv = null , $algorithm = MCRYPT_RIJNDAEL_128, $mode = MCRYPT_MODE_CBC, $padding = true, $base64 = true)
    {
        if(!is_string($string) or empty($string)) return '';
        if(!extension_loaded('mcrypt')) throw new \Exception('AesEncrypt requires PHP mcrypt extension to be loaded in order to use data encryption feature.');

        //mcrypt init
        $module = mcrypt_module_open($algorithm, '', $mode, '');

        if(is_null($iv)){
            //偏移量为0
            $iv = str_repeat("\0", 16);
        }

        mcrypt_generic_init($module, $key, $iv);

        if($padding){
            $block = mcrypt_get_block_size($algorithm, $mode);
            $pad = $block - (strlen($string) % $block); //Compute how many characters need to pad
            $string .= str_repeat(chr($pad), $pad);  // After pad, the str length must be equal to block or its integer multiples
        }

        //encrypt
        $encrypted = mcrypt_generic($module, $string);

        //Close
        mcrypt_generic_deinit($module);
        mcrypt_module_close($module);
        return $base64 ? base64_encode($encrypted) : $encrypted;
    }

    /**
     * @TODO AES解密
     * @param $string the string to decrypt
     * @param $key the key for decrypt 128位加密 传16为key 256位加密传32位key
     * @param $iv the iv for decrypt 128位加密 传16为iv 256位加密传32位iv
     * @param $algorithm AES length mode(MCRYPT_RIJNDAEL_128,MCRYPT_RIJNDAEL_192,MCRYPT_RIJNDAEL_256)
     * @param $mode AES decrypt (such as MCRYPT_MODE_CBC,MCRYPT_MODE_ECB..)
     * @param $padding need or not to padding
     * @return string
     */
    static public function decrypt($encryptString, $key = null, $iv = null, $algorithm = MCRYPT_RIJNDAEL_128, $mode = MCRYPT_MODE_CBC)
    {

        if(!is_string($encryptString) or empty($encryptString)) return '';

        $encryptString = base64_decode($encryptString);

        if(!extension_loaded('mcrypt')) throw new \Exception('AesEncrypt requires PHP mcrypt extension to be loaded in order to use data encryption feature.');

        $module = mcrypt_module_open($algorithm, '', $mode, '');

        if(is_null($iv))
        {
            $iv = str_repeat("\0",16);
        }
        mcrypt_generic_init($module, $key, $iv);

        /* Decrypt encrypted string */
        $decrypted = mdecrypt_generic($module, $encryptString);

        /* Terminate decryption handle and close module */
        mcrypt_generic_deinit($module);
        mcrypt_module_close($module);
	    return substr($decrypted, 0, strlen($decrypted) - ord($decrypted[($len = strlen($decrypted)) - 1]));
//        return rtrim($decrypted, "\0");
    }
}