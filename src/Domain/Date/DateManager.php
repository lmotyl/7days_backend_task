<?php

namespace Domain\Date;

use App\Helper\DatetimeHelper;

class DateManager
{
    private \DateTime $dateTime;

    private \DateTimeZone $dateTimeZone;

    public function __construct(string $date, string $dateTimeZone)
    {
        $time = strtotime($date);
        $this->dateTime = new \DateTime();
        $this->dateTime->setTimestamp($time);

        $this->dateTimeZone = new \DateTimeZone($dateTimeZone);
        $this->dateTime->setTimezone($this->dateTimeZone);
    }

    public function daysLongOfFebruary()
    {
        return DatetimeHelper::getDaysInMonth((int) $this->dateTime->format('Y'), 2);
    }

    public function minsToUtc()
    {
        return DatetimeHelper::getMinutesOffsetUTC($this->dateTime);
    }

    public function monthName()
    {
        return $this->dateTime->format('F');
    }

    public function daysInMonth()
    {
        return DatetimeHelper::getDaysInMonth(
            (int)$this->dateTime->format('Y'),
            (int)$this->dateTime->format('m')
        );
    }

}