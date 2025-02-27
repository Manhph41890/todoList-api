<?php

namespace App\Transformers\titletask;

use App\Models\titletask;
use App\Transformers\titletask\TodolistTransformer;

class DetailTransformer extends TitletaskTransformer
{
    /**
     * @param titletask $titletask
     * @return array
     */
    public function transform(titletask $titletask)
    {
        return [
            'id' => $titletask->id,
            'title' => $titletask->title,
            'todolists' => $titletask->todolists->map(function ($todo) {
                return [
                    'id' => $todo->id,
                    'title' => $todo->title,
                    'description' => $todo->description,
                    'due_date' => $todo->due_date,
                    'priority' => $todo->priority,
                ];
            }),
        ];
    }
}
