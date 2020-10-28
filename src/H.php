<?php
namespace Cloudonaut\Lib;

# Helper functions
class H
{
    /*
     * Empty strings / even spaces are set to null
     *
    */
    public static function emptyToNull(&$value, $trim=true)
    {
        $value = $value ?? "";
        if ($trim) {
            $value=trim($value);
        }
        if ($value=="") {
            $value = null;
        }
        return $value;
    }
}