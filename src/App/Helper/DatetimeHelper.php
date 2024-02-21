<?php

namespace App\Helper;

class DatetimeHelper
{
    public static function getDaysInMonth(int $year, int $month):int
    {
        $date = new \DateTime();
        $date->setDate($year, $month, 1);
        return $date->format('t');
    }

    public static function getMinutesOffsetUTC(\DateTime $dateTime)
    {
        $offsetSeconds = $dateTime->getOffset();
        return $offsetSeconds / 60;
    }

}