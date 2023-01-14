<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //for tag filtering
    public function scopeFilter($query, array $filters) {
        //if there is no tag, move on
        if($filters['tag'] ?? false) {
            //look in database column tags, display all entries that are like the request tag
            $query->where('tags', 'like', '%' . request('tag') . '%'); //% -> anything can be in front or behind tag in url
        }
    }
}
