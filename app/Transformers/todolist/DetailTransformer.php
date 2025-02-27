<?php

namespace App\Transformers\todolist;

use App\Models\todolist;
use App\Transformers\TodolistTransformer;

class DetailTransformer extends TodolistTransformer
{
    /**
     * @param todolist $todolist
     * @return array
     */
    public function transform(todolist $todolist)
    {
        return [
            'id' => $todolist->id,
            'title' => $todolist->title,
            'description' => $todolist->description,
            'due_date' => $todolist->due_date,
            'priority' => $todolist->priority,
            'titletask_id' => $todolist->titletask_id,
            'user_id' => $todolist->user_id
        ];
    }
}
