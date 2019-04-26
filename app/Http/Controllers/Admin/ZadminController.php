<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Zadmin;

class ZadminController extends Controller
{
    public function add(Request $req)
    {
        $this->useValidator($req,[
            'name' => [0,1,101,220],
            'password' => [0,1,101,206,202],
            'mobile' => [0,1,101,301],
            'status' => [0,1,100]
        ]);
        
        if(Zadmin::where(function($query)use($req){$query->where('name',$req->name)->orWhere('mobile',$req->mobile);})->count()){
            return $this->returnJson(1001,'管理员用户名或电话已经存在');
        }else{
            $data = new Zadmin();

            $data->name = $req->name;
            $data->password = md5($req->password);
            $data->mobile = $req->mobile;
            $data->status = $req->status;
            return $data->save() ? $this->returnJson(0,'成功',['admin_id' => $data->id]) : $this->returnJson(1002,'管理员存储失败');
        }
    }
    
    public function update(Request $req)
    {

    }

    public function list(Request $req)
    {

    }

    public function del(Request $req)
    {

    }

    public function details(Request $req)
    {

    }
}
