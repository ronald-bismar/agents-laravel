<?php

namespace App\Http\Controllers;

use App\Ai\Agents\SalesAssistant;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function callAgent(Request $request)
    {
        try {
            $validated = $request->validate([
                'message' => ['required']
            ]);

            $user = auth()->user() ?? auth()->guard('sanctum')->user();
            
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $response = (new SalesAssistant($user))->forUser($user)
                        ->prompt($validated['message']);

            return response()->json([
                'message' => (string) $response,
                'success' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
