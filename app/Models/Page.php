<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    protected $fillable = [
        'space_id',
        'title',
        'description',
        'page_cover',
        'parent_id',
        'order',
        'indentation',
    ];

    /**
     * Get the space that owns the page.
     */
    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    /**
     * Get the parent page for the page.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    /**
     * Get the subpages for the page.
     */
    public function subpages(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    /**
     * Get the blocks for the page.
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(PageBlock::class);
    }
}
