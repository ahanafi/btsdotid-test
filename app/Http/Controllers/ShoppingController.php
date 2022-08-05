<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShoppingRequest;
use App\Models\Shopping;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $shoppings = Shopping::paginate(10);
        return response()->json([
            'success' => true,
            'data' => $shoppings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(StoreShoppingRequest $request)
    {
        $shoppingRequest = $request->get('shopping');
        $shopping = Shopping::create([
            'name' => $shoppingRequest['name'],
            'createddate' => $shoppingRequest['createddate']
        ]);

        if (!$shopping) {
            return response()->json([
                'success' => false,
                'message' => 'Error while creating new shopping data.'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $shopping
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param Shopping $shopping
     * @return JsonResponse
     */
    public function show(Shopping $shopping)
    {
        return response()->json([
            'success' => true,
            'data' => $shopping
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Shopping $shopping
     * @return JsonResponse
     */
    public function update(Request $request, Shopping $shopping)
    {
        $shoppingRequest = $request->get('shopping');
        $shoppingData = [
            'name' => $shoppingRequest['name'],
            'createddate' => $shoppingRequest['createddate']
        ];

        if (!$shopping->update($shoppingData)) {
            return response()->json([
                'success' => false,
                'message' => 'Error while updating the shopping data.'
            ]);
        }

        return response()->json($shopping);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shopping $shopping
     * @return JsonResponse
     */
    public function destroy(Shopping $shopping)
    {
        if (!$shopping->delete()) {
            return response()->json([
                'success' => false,
                'message' => 'Error while deleting the shopping data.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shopping data was successfully deleted.'
        ]);
    }
}
