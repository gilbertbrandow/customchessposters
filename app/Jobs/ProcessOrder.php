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

                //Get dimensions of posters to generate width value for file creation. Height is an arbitrary number to ensure high enough DPI on all sizes
                $width = intval($item->product->variant->posterSize->width / $item->product->variant->posterSize->height * $height = 8550);
                
                //Create and add PNG file to orderItem if poster
                $item->file = (new PosterService())->generatePNG($item->product->poster, $width, $height);
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
