<?php

namespace App\Http\Controllers;

use App\Models\titletask;
use App\Http\Requests\StoretitletaskRequest;
use App\Http\Requests\UpdatetitletaskRequest;
use App\Services\TitletaskService;
use App\Models\todolist;
use App\Transformers\titletask\DetailTransformer;
use App\Transformers\titletask\ListTransformer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;

class TitletaskController extends Controller
{
    /**
     * @var TitletaskService
     */
    protected $TitletaskService;
    protected $titletask;

    /**
     * @param TitletaskService $TitletaskService
     */
    public function __construct(TitletaskService $TitletaskService,  titletask $titletask)
    {
        $this->TitletaskService = $TitletaskService;
        $this->titletask = $titletask;
    }
    /**
     * @return JsonResponse
     */

    public function index()
    {
        $titletask = $this->TitletaskService->getList();
        return responder()->paginate($titletask, new ListTransformer);
    }

    /**
     * @param StoretitletaskRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoretitletaskRequest $request)
    {
        $params = $request->all();
        $this->TitletaskService->create($params);
        return responder()->created();
    }

    /**
     * Display the specified resource.
     */
    public function show(titletask $titletask)
    {
        return responder()->data($titletask, new DetailTransformer());
    }


    /**
     * @param todolist $todolist
     * @param UpdatetitletaskRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdatetitletaskRequest $request, titletask $titletask)
    {
        $params = $request->all();
        $this->TitletaskService->update($titletask, $params);
        return responder()->updated();
    }

    /**
     * @param todolist $todolist
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(titletask $titletask)
    {
        $this->TitletaskService->delete($titletask);
        Log::info($this->TitletaskService->delete($titletask));
        return responder()->deleted();
    }
}
