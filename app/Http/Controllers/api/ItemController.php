<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Party;
use App\Models\userslogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function itemList(Request $request)
    {
        // Retrieve the api_token from the request parameters
        $apiToken = $request->input('api_token');

        // Check if the api_token was provided
        if (!$apiToken) {
            return response()->json([
                'status' => 0,
                'message' => 'Authorization token not provided',
            ], 400); // Bad Request
        }

        // Find the user associated with the api_token
        $user = Userslogin::whereRaw('LOWER(api_token) = ?', [strtolower($apiToken)])->first();

        if (!$user) {
            return response()->json([
                'status' => 0,
                'message' => 'Token is invalid',
            ], 401); // Unauthorized
        }

        // Fetch items created by the authenticated user
        $items = Item::where('created_by', $user->id)
            ->select('id', 'item_name')
            ->get();

        // Return the response in the desired format
        return response()->json([
            'status' => 1,
            'message' => 'Success',
            'records' => [
                'data' => $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'item_name' => $item->item_name,
                    ];
                }),
            ],
        ]);
    }
}
