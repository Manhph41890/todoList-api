<?php

namespace App\Http\Controllers;

use App\Models\todolist;
use App\Http\Requests\StoretodolistRequest;
use App\Http\Requests\UpdatetodolistRequest;
use App\Services\TodolistService;
use App\Transformers\DetailTransformer;
use App\Transformers\ListTransformer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;

class TodolistController extends Controller
{
    /**
     * @var TodolistService
     */
    protected $TodolistService;
    protected $todolist;

    /**
     * ArticleController constructor.
     * @param TodolistService $TodolistService
     */
    public function __construct(TodolistService $TodolistService, todolist $todolist)
    {
        $this->TodolistService = $TodolistService;
        $this->todolist = $todolist;
    }
    /**
     * @return JsonResponse
     */

    public function index(): JsonResponse
    {
        $todolists = $this->TodolistService->getList();
        return responder()->paginate($todolists, new ListTransformer);
    }

    // public function create()
    // {
    //     return response()->json(['message' => 'Create new todolist']);
    // }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @param StoretodolistRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoretodolistRequest $request)
    {
        $params = $request->all();
        $this->TodolistService->create($params);
        return responder()->created();
    }

    /**
     * @param todolist $todolist
     * @return JsonResponse
     */
    public function show(todolist $todolist)
    {
        return responder()->data($todolist, new DetailTransformer());
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(todolist $todolist)
    // {
    //     return response()->json($todolist);
    // }

    /**
     * @param todolist $todolist
     * @param UpdatetodolistRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(UpdatetodolistRequest $request, todolist $todolist)
    {
        $params = $request->all();
        $this->TodolistService->update($todolist, $params);
        return responder()->updated();
    }

    /**
     * @param todolist $todolist
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(todolist $todolist): JsonResponse
    {
        $this->TodolistService->delete($todolist);
        Log::info($this->TodolistService->delete($todolist));
        return responder()->deleted();
    }

}
