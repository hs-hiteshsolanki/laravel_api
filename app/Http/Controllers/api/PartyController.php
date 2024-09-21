<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\userslogin;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    public function partyList(Request $request)
    {
        // Retrieve the api_token from the request headers
        // $apiToken = str_replace('Bearer ', '', $request->header('Authorization'));

        // Retrieve the api_token from the request parameters
        $apiToken = $request->input('api_token');

        // Check if the api_token was provided
        if (!$apiToken) {
            return response()->json([
                'status' => 0,
                'message' => 'Authorization token not provided',
            ], 200); // Bad Request
        }

        // Find the user associated with the api_token
        $user = userslogin::whereRaw('LOWER(api_token) = ?', [strtolower($apiToken)])->first();

        if (!$user) {
            return response()->json([
                'status' => 0,
                // 'message' => 'User not authenticated',
                'message' => 'Token is invalid',
            ], 200); // Unauthorized
        }

        // Fetch the party list associated with the authenticated user
        $parties = Transaction::where('user_id', $user->id)
            ->join('parties', 'transactions.party_id', '=', 'parties.id') // Join with the parties table
            ->select('parties.id', 'parties.party_name') // Select relevant fields from the parties table
            ->distinct() // Ensure unique party names are returned
            ->get();

        if ($parties->isEmpty()) {
            return response()->json([
                'status' => 1,
                'message' => 'No parties found for the user',
            ], 200); // Not Found
        }

        return response()->json([
            'status' => 1,
            'message' => 'Success',
            'records' => [
                'data' => $parties,
            ],
        ], 200);
    }
}
