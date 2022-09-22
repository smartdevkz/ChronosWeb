<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    function getAll()
    {
        return Event::orderBy('id', 'desc')->paginate(5);
    }

    function get($id)
    {
        return Event::find($id);
    }

    function create($event)
    {
        $event["start_date_int"] = $this->getEventDateIntValue("start_date", $event);
        $event["end_date_int"] = $this->getEventDateIntValue("end_date", $event);
        Event::create($event);
    }

    function getEventDateIntValue($key, $event)
    {
        $k = array_key_exists($key . "_is_before_christ", $event) ? -1 : 1;
        $timeUnit = $event[$key . "_time_unit"];
        if ($timeUnit == 0) return null;
        $strVal = $event[$key . "_str"];
        if ($timeUnit == 3) {
            $time_input = strtotime($strVal);
            $date = getDate($time_input);
            return $k * ((int)$date["year"] * 365 + (int)$date["month"] * 30 + (int)$date["mday"]);
        } else {
            $val = (int)$strVal * $k;
            switch ($timeUnit) {
                case 1:
                    return $val * 100 * 365;
                case 2:
                    return $val * 1000 * 365;
                case 4:
                    return $val * 365;
            }
        }
    }



    function update($posted)
    {
        $old = $this->get($posted["id"]);
        $old->fill($posted)->save();
    }

    function delete($id)
    {
        $event = $this->get($id);
        $event->delete();
    }
}
