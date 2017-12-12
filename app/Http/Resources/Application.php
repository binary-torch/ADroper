<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Application extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "course" => $this->course->name,
            "section" => $this->section->number,
            "lecturer" => $this->section->lecturer->name,
            "type" => $this->type->name,
            "status" => $this->status->name,
            "percentage" => $this->percentage(),
            "message" => $this->message,
        ];
    }
}