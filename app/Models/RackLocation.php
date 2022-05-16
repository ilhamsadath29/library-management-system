<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RackLocation extends Model
{
    use HasFactory;

    protected $fillable = ['site_id', 'name', 'status'];

    /**
     * Get the setting that owns the RackLocation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function setting(): BelongsTo
    {
        return $this->belongsTo(Setting::class, 'site_id', 'id');
    }
}
