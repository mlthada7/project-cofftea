<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $with = ['orderItems'];

    protected $guarded = [];
    // protected $fillable = [
    //     'user_id',
    //     'name',
    //     'email',
    //     'phone',
    //     'address',
    //     'city',
    //     'zipcode',
    //     'status',
    //     'tracking_num',
    // ];

    public function setStatusPending()
    {
        $this->attributes['status'] = 'Pending';
        self::save();
    }

    public function setStatusSuccess()
    {
        $this->attributes['status'] = 'Success';
        self::save();
    }

    public function setStatusFailed()
    {
        $this->attributes['status'] = 'Failed';
        self::save();
    }

    public function setStatusExpired()
    {
        $this->attributes['status'] = 'Expired';
        self::save();
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
