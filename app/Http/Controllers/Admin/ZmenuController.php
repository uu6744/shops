<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zmenu;
use DB;

class ZmenuController extends Controller
{
    /**
     * 菜单添加
     *
     * @param Request $req
     * @return void
     */
    public function add(Request $req)
    {
        $this->useValidator($req,[
            'name' => [0,1,101,250],
            'pid' => [0,1,102,200],
            'uri' => [0,1,101,255],
            'icon' => [0,1,101,250],
            'sort' => [0,1,102],
        ]);
        
        $data = new Zmenu;
        $data->name = $req->name; 
        $data->pid = $req->pid;        
        $data->uri = $req->uri;
        $data->icon = $req->icon;
        $data->sort = $req->sort;

        return $data->save() ? $this->returnJson(0,'成功',['menu_id' => $data->id]) : $this->returnJson(2001,'菜单添加失败');
    }

    /**
     * 菜单列表
     *
     * @return void
     */
    public function list(Request $req)
    {
        $this->useValidator($req,[
            'page'=>[0,1,102],
            'pagesize'=>[0,1,102]
        ]);

        $data = new Zmenu;
        $count = $data->count();
        if(!$count){
            return $this->returnJson(2005,'无数据');
        } 

        $data = $data->where('pid',0)
            ->with('getChildMenu')
            ->orderBy('sort','desc')
            ->orderBy('created_at','desc')
            ->offset(($req->page-1)*$req->pagesize)
            ->limit($req->pagesize)
            ->get();
        return $this->returnJson(0,'成功',['data'=>$data,'current_page'=>(int)$req->page,'total_page'=>ceil($count/$req->pagesize),'count'=>$count]);
    }

    /**
     * 菜单修改
     *
     * @param Request $req
     * @return void
     */
    public function update(Request $req)
    {
        $this->useValidator($req,[
            'menu_id' => [0,1,102],
            'name' => [0,1,101,250],
            'pid' => [0,1,102,200],
            'uri' => [0,1,101,255],
            'icon' => [0,1,101,250],
            'sort' => [0,1,102],
        ]);

        $data = Zmenu::find($req->menu_id);

        if(false == $data){
            return $this->returnJson(2002,'菜单不存在');
        }
        
        $data->name = $req->name;
        $data->pid = $req->pid;
        $data->uri = $req->uri;
        $data->icon = $req->icon;
        $data->sort = $req->sort;

        return $data->save() ? $this->returnJson(0,'成功') : $this->returnJson(2003,'菜单修改失败');
    }

    /**
     * 菜单删除
     *
     * @param Request $req
     * @return void
     */
    public function del(Request $req)
    {
        $this->useValidator($req,[
            'menu_id' => [0,1,102,200],
        ]);

        $data = Zmenu::find($req->menu_id);
        if(false == $data){
            return $this->returnJson(2002,'菜单不存在');
        }
        try {
            return DB::transaction(function() use($req,$data) {
                if(false == ($data->delete())){
                    throw new \Exception('菜单删除失败', 1401);
                }
                Zmenu::where('pid',$req->menu_id)->delete();
                return $this->returnJson(0,'成功',['menu_id'=>(int)$req->menu_id]);
            });
        } catch (\Exception $e) {
            return $this->returnJson($e->getCode(),$e->getMessage());
        }
        // return $data->delete() ? $this->returnJson(0,'成功') : $this->returnJson(2004,'菜单删除成功');
    }

    /**
     * 菜单详情
     *
     * @param Request $req
     * @return void
     */
    public function details(Request $req)
    {
        $this->useValidator($req,[
            'menu_id' => [0,1,102,200],
        ]);

        $data = Zmenu::find($req->menu_id);

        return $data ? $this->returnJson(0,'成功',$data) : $this->returnJson(2002,'此菜单不存在');
    }

    /**
     * 获取子菜单
     *
     * @param Request $req
     * @return void
     */
    public function getchildren(Request $req)
    {
        $this->useValidator($req,[
            'menu_id' => [0,1,102,200],
        ]);

        $data = Zmenu::where('pid',$req->menu_id)->get();

        return $data->count() != false ? $this->returnJson(0,'成功',$data) : $this->returnJson(2006,'无数据');
    }
}
