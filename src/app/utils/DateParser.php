<?php
class DateParser {
    public function dateTimeToString($datetime) {
        $dateTimeObj = new DateTime($datetime);
        return $dateTimeObj->format('d M Y');
    }
}