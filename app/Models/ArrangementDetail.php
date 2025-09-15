<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArrangementDetail extends Model
{
    public function images(): HasMany
    {
        return $this->HasMany(DetailImage::class, 'arrangement_id', 'id');
    }
}
