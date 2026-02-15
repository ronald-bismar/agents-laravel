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
        $limit = $request['limit'] ?? 5;
        // Ensure limit is not excessive
        $limit = min((int)$limit, 10);

        $orders = Order::where('user_id', $this->user->id)->latest()->take($limit)->get();
        return $orders;
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'limit' => $schema->integer()->nullable()->description('The number of orders to return (default: 5, max: 10)'),
        ];
    }
}
