<?php

namespace App\Utils;

use App\Transformers\ListTransformer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use Symfony\Component\HttpFoundation\Response;

class ResponseUtility
{
    /**
     * Trả về phản hồi thành công dưới dạng JSON.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function success($data = [], string $message = 'Operation successful', int $status = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Trả về phản hồi lỗi dưới dạng JSON.
     *
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function error(string $message = 'Operation failed', int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $status);
    }

    /**
     * Trả về phản hồi phân trang dưới dạng JSON.
     *
     * @param LengthAwarePaginator $paginator
     * @param callable|null $transformer
     * @return JsonResponse
     */
    public function paginate(LengthAwarePaginator $paginator, callable|object $transformer = null): JsonResponse
    {
        $fractal = new Manager();
        $fractal->setSerializer(new ArraySerializer());

        // Kiểm tra nếu transformer là một object nhưng không phải callable
        if (is_object($transformer) && !is_callable($transformer)) {
            $transformer = function ($item) use ($transformer) {
                return $transformer->transform($item);
            };
        }

        // Chuyển đổi dữ liệu nếu có transformer
        $data = $transformer
            ? $fractal->createData(new Collection($paginator->items(), $transformer))->toArray()['data']
            : $paginator->items();

        // Trả về response JSON trực tiếp
        return response()->json([
            'status' => 'success',
            'message' => 'Operation successful',
            'data' => $data,
            'pagination' => [
                'page' => $paginator->currentPage(),
                'limit' => intval($paginator->perPage()),
                'total' => $paginator->total(),
                'total_pages' => $paginator->lastPage(),
            ],
        ], Response::HTTP_OK);
    }
    /**
     * Trả về phản hồi khi tạo mới thành công.
     *
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    public function created($data = null, string $message = 'Created successfully'): JsonResponse
    {
        return $this->success($data, $message, Response::HTTP_CREATED);
    }

    /**
     * Trả về phản hồi khi cập nhật thành công.
     *
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    public function updated($data = null, string $message = 'Updated successfully'): JsonResponse
    {
        return $this->success($data, $message, Response::HTTP_OK);
    }

    /**
     * Trả về phản hồi khi xóa thành công.
     *
     * @param string $message
     * @return JsonResponse
     */
    public function deleted(string $message = 'Deleted successfully'): JsonResponse
    {
        return $this->success([], $message, Response::HTTP_OK); // Dùng 200 thay vì 204
    }

    /**
     * Trả về dữ liệu kèm transformer
     *
     * @param mixed $data
     * @param mixed|null $transformer
     * @return JsonResponse
     */
    public function data($data, $transformer = null): JsonResponse
    {
        // Xử lý transformer nếu có
        if ($transformer) {
            $fractal = new Manager();
            $fractal->setSerializer(new ArraySerializer());

            // Xác định loại resource
            $resource = is_iterable($data)
                ? new Collection($data, $transformer)
                : new Item($data, $transformer);

            $data = $fractal->createData($resource)->toArray();
        }

        return $this->success($data);
    }
}
