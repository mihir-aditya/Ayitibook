<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Generate slug automatically
    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = static::uniqueSlug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = static::uniqueSlug($category->name, $category->id);
            }
        });
    }

    public static function uniqueSlug($name, $ignoreId = null)
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;
        while (static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '<>', $ignoreId))
            ->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    /**
     * Get the parent category
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get all products in this category
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get active products only
     */
    public function activeProducts()
    {
        return $this->products()->where('is_active', true);
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope for root categories (no parent)
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope for subcategories (has parent)
     */
    public function scopeSubcategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    /**
     * Get all descendant categories
     */
    public function getAllDescendants()
    {
        $descendants = collect();
        
        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getAllDescendants());
        }
        
        return $descendants;
    }

    /**
     * Get all descendant category IDs including self
     */
    public function getAllDescendantIds()
    {
        $ids = [$this->id];
        
        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllDescendantIds());
        }
        
        return $ids;
    }

    /**
     * Check if category has any active products
     */
    public function hasActiveProducts()
    {
        return $this->activeProducts()->exists();
    }

    /**
     * Get the category path (breadcrumb)
     */
    public function getPathAttribute()
    {
        $path = [];
        $category = $this;
        
        while ($category) {
            $path[] = [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
            ];
            $category = $category->parent;
        }
        
        return array_reverse($path);
    }

    /**
     * Get only categories that have products
     */
    public function scopeHasProducts($query)
    {
        return $query->whereHas('products');
    }

    /**
     * Get only categories that have active products
     */
    public function scopeHasActiveProducts($query)
    {
        return $query->whereHas('products', function ($q) {
            $q->where('is_active', true);
        });
    }

    /**
     * Search categories by name or slug
     */
    public function scopeSearch($query, $term)
    {
        if (empty($term)) return $query;
        
        $term = "%{$term}%";
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', $term)
              ->orWhere('slug', 'like', $term);
        });
    }

    /**
     * Get categories with their parent eager loaded
     */
    public function scopeWithParent($query)
    {
        return $query->with('parent');
    }

    /**
     * Get categories with their children eager loaded
     */
    public function scopeWithChildren($query)
    {
        return $query->with('children');
    }

    /**
     * Get categories tree (nested)
     */
    public function scopeTree($query)
    {
        return $query->with(['children' => function ($q) {
            $q->orderBy('name');
        }])->root()->orderBy('name');
    }

    /**
     * Check if category is a child of given category
     */
    public function isChildOf($parentId)
    {
        $category = $this;
        
        while ($category->parent_id) {
            if ($category->parent_id == $parentId) {
                return true;
            }
            $category = $category->parent;
        }
        
        return false;
    }

    /**
     * Get the category's depth level
     */
    public function getDepthAttribute()
    {
        $depth = 0;
        $category = $this;
        
        while ($category->parent) {
            $depth++;
            $category = $category->parent;
        }
        
        return $depth;
    }

    /**
     * Scope for categories with their product count
     */
    public function scopeWithProductCount($query)
    {
        return $query->withCount('products');
    }

    /**
     * Scope for categories with their active product count
     */
    public function scopeWithActiveProductCount($query)
    {
        return $query->withCount(['products' => function ($q) {
            $q->where('is_active', true);
        }]);
    }

    /**
     * Get categories ordered by product count
     */
    public function scopeOrderByProductCount($query, $direction = 'desc')
    {
        return $query->withCount('products')->orderBy('products_count', $direction);
    }

    /**
     * Get categories with no products
     */
    public function scopeNoProducts($query)
    {
        return $query->doesntHave('products');
    }

    /**
     * Check if category has any children
     */
    public function getHasChildrenAttribute()
    {
        return $this->children()->exists();
    }

    /**
     * Get active status as string
     */
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
}