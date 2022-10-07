<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    function getAll()
    {
        return Tag::orderBy('id', 'desc')->paginate(2);
    }

    function get($id)
    {
        return Tag::find($id);
    }

    function create($tag)
    {
        Tag::create($tag);
    }

    function update($postedTag)
    {
        $old = $this->get($postedTag["id"]);
        $old->fill($postedTag)->save();
    }

    function delete($id)
    {
        $tag = $this->get($id);
        $tag->delete();
    }
}