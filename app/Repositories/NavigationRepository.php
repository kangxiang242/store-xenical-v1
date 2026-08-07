<?php


namespace App\Repositories;


use App\Models\Navigation;
use Illuminate\Support\Facades\Cache;

class NavigationRepository extends Repository
{
    protected $modelClass = Navigation::class;

    public function get($is_cache=true){

        if (Cache::has(config('global.cache.navigation')) && $is_cache){
            $data = Cache::get(config('global.cache.navigation'));
        }else{
            $data = $this->model()->with('sub')->where('parent_id',0)->where('status',1)->orderBy('sort','asc')->get();

            Cache::set(config('global.cache.navigation'),$data);
        }

        return $data;
    }

    public function getNavigation(){
        return $this->get(false);
    }

}
