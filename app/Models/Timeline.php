<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Timeline extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'start_date', 'end_date', 'status', 'category'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    protected static function boot() {
        parent::boot();
        static::creating(fn($m) => $m->slug = Str::slug($m->title).'-'.Str::random(5));
    }

    public function stages() {
        return $this->hasMany(TimelineStage::class)->orderBy('order');
    }

    // Accessor: Hitung progres keseluruhan (%)
    public function getProgressPercentageAttribute() {
        $total = $this->stages()->count();
        if ($total == 0) return 0;
        $completed = $this->stages()->where('is_completed', true)->count();
        return round(($completed / $total) * 100);
    }
}
