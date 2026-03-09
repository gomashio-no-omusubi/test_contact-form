<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getGenderTextAttribute()
    {
        return match ((int)$this->gender) {
            1 => '男性',
            2 => '女性',
            default => 'その他',
        };
    }

    public function getCategoryContentAttribute()
    {
        return $this->category->content ?? '不明';
    }

    public function scopeKeywordSearch($query, $keyword, $mode)
    {
        if (!empty($keyword)) {
            $operator = ($mode === 'exact') ? '=' : 'like';
            $search = ($mode === 'exact') ? $keyword : '%' . $keyword . '%';

            $query->where(function ($q) use ($operator, $search) {
                $q->where('first_name', $operator, $search)
                    ->orWhere('last_name', $operator, $search)
                    ->orWhere('email', $operator, $search)
                    ->orWhereRaw('CONCAT(last_name, first_name) ' . $operator . ' ?', [$search]);
            });
        }
        return $query;
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) && $gender !== 'all') {
            $query->where('gender', $gender);
        }
        return $query;
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
        return $query;
    }
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
        return $query;
    }
}
