<?php

namespace App\Ai\Tools;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class ListOrderToolForUser implements Tool
{
   
    public function __construct(public User $user) {}
    
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'List order for the user. You need to provide user Id.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $orders = Order::where('user_id', $this->user->id)->get();
        return $orders;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            
        ];
    }
}
