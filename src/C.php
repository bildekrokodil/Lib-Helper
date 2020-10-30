<?php
namespace Cloudonaut\Lib;

# Calculate functions
class C
{
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::                                                                         :*/
/*::  this routine calculates the distance between two points (long/lat)     :*/
/*::                                                                         :*/
/*::  definitions:                                                           :*/
/*::    south latitudes are negative, east longitudes are positive           :*/
/*::                                                                         :*/
/*::  passed to function:                                                    :*/
/*::    lat1, lon1 = latitude and longitude of point 1 (in decimal degrees)  :*/
/*::    lat2, lon2 = latitude and longitude of point 2 (in decimal degrees)  :*/
/*::    unit = the unit you desire for results                               :*/
/*::           where: 'M' is statute miles                                   :*/
/*::                  'K' is kilometers (default)                            :*/
/*::                  'N' is nautical miles                                  :*/
/*::  Thanks to Hexa software development center                             :*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    public static function distance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } elseif ($unit == "N") {
            return ($miles * 0.868976242);
        } else {
            return $miles;
        }
    }
    /* long lat Degree Minute second to Decimal */
    public static function convertLatLongDMSToDecimal($value)
    {
        $value = $value ?? "";
        $value = str_replace(" ", "", $value);
        $value = str_replace("N", "", $value);
        $value = str_replace("E", "", $value);

        $degree = 0;
        $minute = 0;
        $second = 0;
        if (strpos($value, "°") !== false) {
            $degreePieces = explode("°", $value);
            $degree = $degreePieces[0];
            if (strpos($value, "'") !== false) {
                $minutePiece = explode("'", $degreePieces[1]);
                $minute = $minutePiece[0];
                if (strpos($value, '"') !== false) {
                    $second = str_replace('"', '', $minutePiece[1]);
                }
            }
        }
        if ($degree == 0 && $minute == 0 && $second == 0) {
            //maybe it is already decimal
            return $value;
        }
        return $degree + ($minute / 60) + ($second / 3600);
    }
}
