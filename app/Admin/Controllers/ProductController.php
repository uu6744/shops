<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Spec;
use App\Models\SpecValue;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HasResourceActions;

    protected $states = [
        'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
    ];
    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('商品列表页')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('商品详情')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('商品修改')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('商品新增')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);
        $grid->img('商品首图')->lightbox(['width' => 40, 'height' => 40]);
        $grid->name('商品名称')->editable();
        $grid->price('显示价格')->editable();
        $grid->stock('商品库存')->editable();
        $grid->status('是否下架')->switch($this->states);
        $grid->sales_volume('总销量');

        $grid->disableExport();
        $grid->disableRowSelector();
        $grid->actions(function ($actions) {
            // $actions->append('&nbsp;<a href="/admin/specValue/create/' . $actions->getKey() . '"><span class="badge label-info">设置规格组</span></a>');
            $actions->append('&nbsp;<a href="/admin/product/spec/' . $actions->getKey() . '"><span class="badge label-info">设置规格组</span></a>');
        });
        // $grid->actions(function ($actions) {
        //     $actions->disableDelete();
        //     $actions->disableEdit();
        //     $actions->disableView();
        // });
        return $grid;
    }

    public function productSpec(Request $req,Content $content)
    {
        $id = $req->id;

        $specs = Product::where('id',$id)->value('spec_group');

        $specValues = [];
        foreach ($specs as $k => $v){
            $name = Spec::where('id',$v)->value('name');
            $specValues[$name] = SpecValue::where('spec_id',$v)->pluck('name')->toArray();
        }

        $adminView = view('admin.productSpec',compact('specValues'))->render();
        return $content
            ->header('规格组')
            ->description()
            ->body($adminView);
        return view('admin.productSpec');
    }
    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);
        
        $form->select('category_id', '商品分类')->options(Category::selectOptions())->rules('required');
        $form->text('name', '商品名称');
        $form->text('sfname', '商品简称');
        $form->image('img','商品列表图');
        $form->multipleImage('banner','商品轮播图')->name(function ($file){
                return date('YmdHis').'.'.$file->guessExtension();
            })->removable();
        $form->text('price','商品列表价格')->rules('required');
        $form->number('sort', '分类排序');
        $form->switch('is_sales','是否下架')->states($this->states);
        $form->text('stock','商品库存');
        $form->textarea('detail', '商品介绍');
        $form->multipleSelect('spec_group','商品所需规格')->options(Spec::pluck('name','id'));

        $form->saving(function (Form $form) {
            $form->spec_group = array_filter($form->spec_group);
        });
       
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->footer(function ($footer) {      
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}
