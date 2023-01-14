<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //contains everything that we want to allow mass assignment
    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];
    //however: not needed if you add Model::unguard() to app/Provider/AppServiceProvider.php

    //for tag filtering
    public function scopeFilter($query, array $filters) {
        //if there is no tag, move on
        if($filters['tag'] ?? false) {
            //look in database column tags, display all entries that are like the request tag
            $query->where('tags', 'like', '%' . request('tag') . '%'); //% -> anything can be in front or behind tag in url
        }
        //if there is no search request, move on
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' .  request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }

    }
}
