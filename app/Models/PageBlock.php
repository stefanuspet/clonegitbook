<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageBlock extends Model
{
    protected $fillable = [
        'page_id',
        'content_type',
        'content',
        'order',
    ];

    /**
     * Get the page that owns the block.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the list items for the block.
     */
    public function listItems(): HasMany
    {
        return $this->hasMany(ListItem::class);
    }
}
