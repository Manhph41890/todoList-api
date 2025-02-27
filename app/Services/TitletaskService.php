<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\titletask;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Class titletaskService
 * @package App\Services
 */
class TitletaskService extends BaseService
{
    /**
     * TitletaskService constructor.
     * @param titletask $titletask
     */
    public function __construct(titletask $titletask)
    {
        $this->model = $titletask;
    }

    /**
     * @param $params
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator
    {
        $limit = request()->get('limit', 50);
        $search = request()->get('search', '');

        $query = titletask::select(['id', 'title']);
        $query = titletask::with('todolists')->select(['id', 'title']);

        if ($search) {
            $query->where('title', 'like', "%$search%");
        }

        return $query->paginate($limit);
    }

    /**
     * @param $params
     * @return titletask
     * @throws Throwable
     */
    public function create($params): titletask
    {
        DB::beginTransaction();
        try {
            $titletask = $this->model->create($params);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $titletask;
    }

    /**
     * @param titletask $titletask
     * @param $params
     * @return titletask
     * @throws Throwable
     */
    public function update(titletask $titletask, $params): titletask
    {
        DB::beginTransaction();
        try {
            $titletask->fill($params)->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();

        return $titletask;
    }
    /**
     * @param titletask $titletask
     * @return bool|null
     * @throws Exception
     */
    public function delete(titletask $titletask): ?bool
    {
        Log::info("Deleting", $titletask->toArray());
        return $titletask->delete();
    }
}
