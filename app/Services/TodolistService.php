<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\todolist;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class TodolistService
 * @package App\Services
 */
class TodolistService extends BaseService
{
    /**
     * TodolistService constructor.
     * @param todolist $todolist
     */
    public function __construct(todolist $todolist)
    {
        $this->model = $todolist;
    }

    /**
     * @param $params
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator
    {
        $limit = request()->get('limit', 50);
        $search = request()->get('search', '');

        $query = Todolist::select(['id', 'title', 'description', 'due_date', 'priority']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        return $query->paginate($limit);
    }

    /**
     * @param $params
     * @return todolist
     * @throws Throwable
     */
    public function create($params): todolist
    {
        DB::beginTransaction();
        try {
            $todolist = $this->model->create($params);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $todolist;
    }

    /**
     * @param todolist $todolist
     * @param $params
     * @return todolist
     * @throws Throwable
     */
    public function update(todolist $todolist, $params): todolist
    {
        DB::beginTransaction();
        try {
            $todolist->fill($params)->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();

        return $todolist;
    }
    /**
     * @param todolist $todolist
     * @return bool|null
     * @throws Exception
     */
    public function delete(todolist $todolist): ?bool
    {
        Log::info("Deleting", $todolist->toArray());
        return $todolist->delete();
    }
}
