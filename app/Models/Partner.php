<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'logo', 'type', 'description', 'website_url', 'order', 'is_active'];

    protected $casts = [
        'description' => 'array',
    ];

    // Helper untuk view
    public function getDesc($lang = null) {
        $lang = $lang ?? app()->getLocale();
        return $this->description[$lang] ?? ($this->description['id'] ?? '-');
    }
}
