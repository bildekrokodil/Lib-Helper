<?php
namespace Cloudonaut\Lib;

#DEBUG FUNCTIONS
class Debug
{
    public static function var_dump($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    public static function getSQL($string, $data)
    {
        $indexed=$data==array_values($data);
        foreach ($data as $k=>$v) {
            if (is_string($v)) {
                $v="'$v'";
            }
            if ($indexed) {
                $string=preg_replace('/\?/', $v, $string, 1);
            } else {
                $string=str_replace(":$k", $v, $string);
            }
        }
        return $string;
    }
}
