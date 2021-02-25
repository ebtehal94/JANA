<?php

namespace App\Jobs;

use App\Models\Product;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $product;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($product)
    {
      $this->product  = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

      $prod                   = $this->product;

      $newProduct             = Product::create($prod);
      if ($newProduct){
        $newProduct->images()->create(['link' => $prod['images']]);
        if (isset($prod['price_qtr']) && $prod['price_qtr'] > 0){
          $newProduct->countries()->attach(1, ['price' => $prod['price_qtr'], 'stock' => '100']);
        }
        if (isset($prod['price_bhn']) && $prod['price_bhn'] > 0){
          $newProduct->countries()->attach(2, ['price' => $prod['price_bhn'], 'stock' => '100']);
        }
        if (isset($prod['price_omn']) && $prod['price_omn'] > 0){
          $newProduct->countries()->attach(3, ['price' => $prod['price_omn'], 'stock' => '100']);
        }
        if (isset($prod['price_kwt']) && $prod['price_kwt'] > 0){
          $newProduct->countries()->attach(4, ['price' => $prod['price_kwt'], 'stock' => '100']);
        }
        if (isset($prod['price_jod']) && $prod['price_jod'] > 0){
          $newProduct->countries()->attach(5, ['price' => $prod['price_jod'], 'stock' => '100']);
        }
        if (isset($prod['price_ksa']) && $prod['price_ksa'] > 0){
          $newProduct->countries()->attach(6, ['price' => $prod['price_ksa'], 'stock' => '100']);
        }
      }

    }

}
