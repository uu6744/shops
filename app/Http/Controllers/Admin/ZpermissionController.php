<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zpermission;
use App\Models\ZpermissionZmenu;

class ZpermissionController extends Controller
{
    public function add(Request $req)
    {
        $this->useValidator($req,[
            'name' => [0,1,101,225],
            'slug' => [0,1,101,225],
            'data'=>[0,1,101],
            'data.*.menu_id'=>[0,1,102],
        ]);

        try {
            return DB::transaction(function () use($req){

                $data = new Zpermission;
                $data->name = $req->name;
                $data->slug = $req->slug;

                if(false == ($data->save())){
                    throw new \Exception('权限保存失败', 3001);
                }

                if(false == empty($req->data)){
                    $menu = [];
                    $time = date('Y-m-d H:i:s');
                    $arr = json_decode($req->data,true);

                    foreach($arr as $k => $v){
                        array_push($menu,['permission_id' => $data->id,'menu_id' => $v['menu_id'],'created_at' => $time,'updated_at' => $time]);
                    }
                    if(false == (ZpermissionZmenu::insert($arr))){
                        throw new \Exception('菜单关联失败', 3002);
                    }
                    return $this->returnJson(0,'成功',['permission_id'=>(int)$data->id]);
                }
            });
        } catch (\Exception $e) {
            return $this->returnJson($e->getCode(),$e->getMessage());
        }
        
    }

    public function list(Request $req)
    {

    }
    public function update(Request $req)
    {

    }

    public function details(Request $req)
    {

    }

    public function del(Request $req)
    {

    }
}
