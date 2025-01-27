<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\LikeQuantity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        try {
            Log::info($request->all());
            // Validate request
            $validatedResult = $request->validate([
                'entityId' => ['required', 'integer'],
                'entityTypeId' => ['required', 'integer'],
            ]);

            // Insert into 'likes' table
            $like = Like::create([
                'user_id' => Auth::user()->id,
                'entity_id' => $validatedResult['entityId'],
                'entity_type_id' => $validatedResult['entityTypeId']
            ]);

            // Update or create like quantity
            LikeQuantity::updateOrCreate([
                'entity_id' => $validatedResult['entityId'],
                'entity_type_id' => $validatedResult['entityTypeId']
            ], ['quantity' => DB::raw('quantity + 1')]);

            return response()->json(['liked' => true]);
        } catch (Exception $e) {
            Log::error('Like error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
