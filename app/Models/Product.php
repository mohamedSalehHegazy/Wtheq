<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use  SoftDeletes;
    public $uploadDirectory = 'products';
    public $fileRelationName = 'file';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function file()
    {
        return $this->morphOne(File::class, 'fileable')
        ->select('id','file_name','order', 'notes','label','path');
    }

    public function getIsActiveAttribute($value)
    {
        return $value == 1 ? true : false;
    }

    public function getPriceAttribute($value)
    {
        // unAuth user
        if(auth('api')->user() == null){
            return $value;
        }

        // check if user is a sliver or golden
        if((auth('api')->user()->type == 2) || (auth('api')->user()->type == 3)){
            $price = $this->productPrices()
            ->whereUserType(auth('api')->user()->type)
            ->first();

            if($price){
                return $price->price;
            }
        }

        // normal user
        return $value;
    }

    public function productPrices(): HasMany
    {
        return $this->hasMany(ProductPrice::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name, '-');
        });

        static::updating(function ($product) {
            if($product->isDirty('name')){
                $product->slug = Str::slug($product->name, '-');
            }
        });
    }
}
