<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\OrderService;
use App\Services\PosterService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public Order $order
    ) {
        $this->order = $order->withoutRelations();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Fetch all order items and their product, if product has type poster generate png of poster
        foreach($this->order->orderItems as $item) {
            
            if($item->product->type == 'poster') {

                //Create and add PNG file to orderItem if poster
                $item->file = (new PosterService())->generatePNG($item->product->poster); 
                $item->save(); 
            }
            
        }; 

        (new OrderService($this->order))->sendOrderToPrintful();

        //Update order status
        $this->order->status = 'fulfilling'; 
        $this->order->save();

        return; 
    }
}
