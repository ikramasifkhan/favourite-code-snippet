<?php

namespace App\Observers\Seller;

use App\Models\Admin\Admin;
use App\Models\Seller\Feature;
use App\Models\Seller\Product;
use App\Models\Seller\RatingReview;
use App\Models\Seller\Service;
use App\Notifications\Seller\ProductNotification;
use Illuminate\Support\Facades\Notification;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Seller\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $admin = Admin::all();
        Notification::send($admin, new ProductNotification($product));
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Seller\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Seller\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $features = Feature::where(['featurable_id'=>$product->id, 'featurable_type'=>Product::class])->get();
        foreach ($features as $feature){
            $feature->delete();
        }
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Seller\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        $features = Feature::withTrashed()->where(['featurable_id'=>$product->id, 'featurable_type'=>Product::class])->get();
        foreach ($features as $feature){
            $feature->restore();
        }
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Seller\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        $features = Feature::withTrashed()->where(['featurable_id'=>$product->id, 'featurable_type'=>Product::class])->get();
        foreach ($features as $feature){
            $feature->forceDelete();
        }
        $reviews = RatingReview::where(['rateable_id'=>$product->id, 'rateable_type'=>Product::class])->get();
        foreach ($reviews as $review){
            $review->delete();
        }
    }
}
