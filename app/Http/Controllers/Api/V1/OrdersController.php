<?php

namespace App\Http\Controllers\Api\V1;

use App\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $order = new Order();
            $order->fill($request->all());
            $order->save();
            return response()->json(
                [$order],
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            return response()->json($order, 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update($request->all());
            return response()->json($order, 200);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
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
