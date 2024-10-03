<?php

namespace App\Models;

use App\ModelService\Auditable;
use App\Observers\CustomerObserver;
use Helper;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

// #[ObservedBy([CustomerObserver::class])]
class Customer extends Model
{
    use HasFactory,
        Notifiable,
        /**
         * this trait use for cache remove 
         * at create, update & delete
         */
        Auditable;


    protected $fillable = ['name', 'email', 'phone', 'address'];

    public static function cacheForget(): void
    {
        Cache::forget('customers');
    }
}
