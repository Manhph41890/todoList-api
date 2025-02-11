<?php

namespace App\Transformers;

use App\Models\todolist;
use League\Fractal\TransformerAbstract;

class ListTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = []; // Thêm kiểu array

    /**
     * @param todolist $todolist
     * @return array
     */
    public function transform(todolist $todolist): array
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
