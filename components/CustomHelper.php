<?php
namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
 
class CustomHelper extends Component
{
    /*
     * @param string $text
     * @param int $maxlength
     * @return string 
    */
    public static function truncateText($text, $maxLength=10)
    {
       $len = strlen($text);
       if ($len <= $maxLength)
         return $text;
       else
         return substr($text, 0, $maxLength - 1) . '...';
     }
     
     /* get well formated json*/
     public static function prettyPrint( $json )
     {
         $result = '';
         $level = 0;
         $in_quotes = false;
         $in_escape = false;
         $ends_line_level = NULL;
         $json_length = strlen( $json );

         for( $i = 0; $i < $json_length; $i++ ) {
             $char = $json[$i];
             $new_line_level = NULL;
             $post = "";
             if( $ends_line_level !== NULL ) {
                 $new_line_level = $ends_line_level;
                 $ends_line_level = NULL;
             }
             if ( $in_escape ) {
                 $in_escape = false;
             } else if( $char === '"' ) {
                 $in_quotes = !$in_quotes;
             } else if( ! $in_quotes ) {
                 switch( $char ) {
                     case '}': case ']':
                         $level--;
                         $ends_line_level = NULL;
                         $new_line_level = $level;
                         break;

                     case '{': case '[':
                         $level++;
                     case ',':
                         $ends_line_level = $level;
                         break;

                     case ':':
                         $post = " ";
                         break;

                     case " ": case "\t": case "\n": case "\r":
                         $char = "";
                         $ends_line_level = $new_line_level;
                         $new_line_level = NULL;
                         break;
                 }
             } else if ( $char === '\\' ) {
                 $in_escape = true;
             }
             if( $new_line_level !== NULL ) {
                 $result .= "\n".str_repeat( "\t", $new_line_level );
             }
             $result .= $char.$post;
         }

         return $result;
     }
     
    /*
     * get date value
     */ 
    public static function getDatetimeFormat()
    {
        return 'Y-m-d H:i:s';
    }
     /*
     * get date format
     */ 
    public static function getDateFormat()
    {
        return 'Y-m-d';
    }
     /*
     * get date value
     */ 
    public static function getDisplayDateFormat()
    { 
        return 'Y-m-d h:i A';
    }
      
    
    /*
     * get Random String
     */
    public static function generateRandomString($length = 10) 
    {
         return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
    /*
     * Get browser info
     */
    public function getBrowser() 
    { 
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return [
            'userAgent' => $u_agent,
            'browser'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        ];
    } 
    /*
     * get request variables
     */
    public static function getRequestParams($method='get')
    {
        $requestParams=[];
        $request=Yii::$app->request;
        if($method=='get'){
           $requestParams=$request->get();
        }else if($method=='post'){
             $requestParams=$request->post();
        }
        return array_change_key_case($requestParams, CASE_UPPER);
    }
    
     /*
     * get string from array for error
     * @return string $error
     */
    public static function errorFromErrorlog($errArr)
    {
        $str='';
        foreach ($errArr as $key=> $error)
        {
          $keyIndex=key($error);
          $str=$error[$keyIndex];
          break;
        }
       return $str;
    }

    
    
}