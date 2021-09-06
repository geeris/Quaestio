<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Navigation extends Model
{
    use HasFactory;

    function getLinks($type){
        try {
            return DB::table('link')
                ->select('link.name as name', 'route as route', 'icon as icon')
                ->join('menutype_link', 'link.id', '=', 'link_id')
                ->join('menuType', 'menutype_id', '=', 'menutype.id')
                ->where('menutype.name', '=', $type)
                ->orderBy('priority', 'ASC')
                ->get();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
    }

}
