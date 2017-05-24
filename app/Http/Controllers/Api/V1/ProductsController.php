<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ProductsRequest;
use App\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ProductsController
 * @package App\Http\Controllers\Api\V1
 */
class ProductsController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return response()->json($product, 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(
                'No query results for product ' . $id,
                404
            );
        } catch (\Exception $exception) {
            return response()->json(
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param ProductsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductsRequest $request)
    {
        try {
            $product = new Product();
            $product->fill($request->all());
            $product->save();
            return response()->json(
                [$product],
                201
            );
        } catch (\Exception $exception) {
            return response()->json(
                [$exception->getMessage()],
                500
            );
        }
    }

    /**
     * @param ProductsRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductsRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update($request->all());
            return response()->json($product, 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(
                'No query results for product ' . $id,
                404
            );
        } catch (\Exception $exception) {
            return response()->json(
                $exception->getMessage(),
                500
            );
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(null, 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json(
                'No query results for product ' . $id,
                404
            );
        } catch (\Exception $exception) {
            return response()->json(
                $exception->getMessage(),
                500
            );
        }
    }
}
