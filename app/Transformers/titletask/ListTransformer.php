<?php

namespace App\Transformers\titletask;

use App\Models\titletask;
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
     * @param titletask $titletask
     * @return array
     */
    public function transform(titletask $titletask): array
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
