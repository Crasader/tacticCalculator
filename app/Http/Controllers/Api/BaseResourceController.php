<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Transformers\Fractal;
use App\Transformers\JsonApiSerializer;
use App\Transformers\ResourceTransformerInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

abstract class BaseResourceController extends Controller
{
    protected $fractal;

    protected $repository;

    const DEFAULT_ADMIN_PAGER_LIMIT = 50;

    public function __construct(Request $request)
    {
        $this->fractal = new Fractal(new JsonApiSerializer());
        $this->fractal->parseIncludes($request->query('include', ''));
        $this->repository = $this->getRepository();
    }

    abstract protected function getTransformer(): ResourceTransformerInterface;

    abstract protected function getRepository(): BaseRepository;

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return null
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getFilterInfo(Request $request)
    {
        return null;
    }

    public function index(Request $request)
    {
        $limit = Input::get('limit') ?? BaseRepository::PAGINATE_DEFAULT_LIMIT;
        $orderBy = Input::get('orderby', 'id');
        $sortOrder = Input::get('sortorder', 'asc');
        $orderInfo = ['order_by' => $orderBy, 'sort_order' => $sortOrder];
        $recipes = $this->repository->getFilteredOrderedPaginated(
            $this->getFilterInfo($request),
            $orderInfo,
            ['limit' => $limit]
        );
        return $this->getPaginatedResponse($recipes);
    }

    public function show($id)
    {
        $resource = $this->repository->getByIdOrFail($id);
        return $this->getItemResponse($resource);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return $this->getNoContentResponse();
    }

    public function getPaginatedResponse($model)
    {
        $transformer = $this->getTransformer();
        $resource = $this->fractal->pagination($model, $transformer, $transformer::getResourceKey());
        return response()->json($resource);
    }

    public function getCollectionResponse($model)
    {
        $transformer = $this->getTransformer();
        $resource = $this->fractal->collection($model, $transformer, $transformer::getResourceKey());
        return response()->json($resource);
    }

    public function getCollectionUpdateResponse($model)
    {
        $transformer = $this->getTransformer();
        $resource = $this->fractal->collection($model, $transformer, $transformer::getResourceKey());

        foreach ($resource['data'] as &$item) {
            unset($item['attributes']);
        }

        return response()->json($resource);
    }

    public function getItemResponse($model, $responseCode = Response::HTTP_OK)
    {
        $transformer = $this->getTransformer();
        $resource = $this->fractal->item($model, $transformer, $transformer::getResourceKey());
        return response()->json($resource, $responseCode);
    }

    public function getUpdateResponse($model, $responseCode = Response::HTTP_OK)
    {
        $transformer = $this->getTransformer();
        $resource = $this->fractal->item($model, $transformer, $transformer::getResourceKey());

        return response()->json($resource, $responseCode);
    }

    public function getNoContentResponse()
    {
        return response()->json($this->fractal->null(), Response::HTTP_NO_CONTENT);
    }

    public function getPaginationInfo(Request $request)
    {
        return [
            'limit' => $request->query('limit') ?? static::DEFAULT_ADMIN_PAGER_LIMIT,
        ];
    }

    public function getOrderInfo(Request $request)
    {
        return [
            'order_by' => $request->query('orderby', 'id'),
            'sort_order' => $request->query('sortorder', 'asc'),
        ];
    }

    public function notImplemented()
    {
        return response()->json([
            'errors' => 'Not implemented',
        ], Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Validate additional fields
     *
     * Validate fields that are not compatible with Laravel's simple validation
     * method. Eg. in rules array: 'email' => 'unique:users' has to look for email
     * field in the database to check if its value is unique. In case of json api
     * we usually use field names like 'data.attributes.email'. In this case it
     * would not work.
     */
    public function validateAdditional(array $data, array $rules, array $messages = [])
    {
        Validator::make($data, $rules, $messages)->validate();
    }
}
