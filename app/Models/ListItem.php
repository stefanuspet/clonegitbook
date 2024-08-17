<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListItem extends Model
{
    protected $fillable = [
        'page_block_id',
        'list_type',
        'content',
        'completed',
        'order',
    ];

    /**
     * Get the page block that owns the list item.
     */
    public function pageBlock(): BelongsTo
    {
        return $this->belongsTo(PageBlock::class);
    }
}
