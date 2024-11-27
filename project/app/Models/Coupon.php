<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    // Fillable fields for the Coupon model
    protected $fillable = [
        'code',
        'discount',
        'discount_type',
        'expires_at',
        'is_active',
    ];

    /**
     * Check if the coupon is expired
     *
     * @return bool
     */
    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }

    /**
     * Calculate the discount amount
     *
     * @param float $total
     * @return float
     */
    public function calculateDiscount($total)
    {
        if ($this->discount_type == 'percentage') {
            return ($this->discount / 100) * $total;
        }

        if ($this->discount_type == 'fixed') {
            return min($this->discount, $total); // Ensure the discount doesn't exceed the total price
        }

        return 0;
    }

    /**
     * Check if the coupon is valid
     *
     * @return bool
     */
    public function isValid()
    {
        return $this->is_active && !$this->isExpired();
    }
}
