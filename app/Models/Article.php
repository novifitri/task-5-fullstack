<?php

namespace App\Models;


use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;
    //relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     //relasi ke category
     public function category()
     {
         return $this->belongsTo(Category::class);
     }
     //cek path gambar ada di folder public atau tidak
     public static function checkFile($name)
     {
        $path = public_path('image/'.$name);
        $isExists = File::exists($path);
        return $isExists;
     }

     //untuk fungsi search
     public function scopeFilter($query, array $filters)
     {
        // if(isset($filters['search']) ? $filters['search'] : false)
        // {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%');
        // }
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('title', 'like', '%' . $search . '%');
        }); 
     }
}
