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
        Event::create($event);
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
