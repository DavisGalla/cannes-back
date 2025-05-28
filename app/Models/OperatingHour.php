<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OperatingHour extends Model
{
    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }
}
