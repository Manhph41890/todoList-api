<?php

namespace App\Transformers;

use App\Models\todolist;

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
            'priority' => $todolist->priority
        ];
    }
}
