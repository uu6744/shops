<?php

namespace App\Admin\Controllers;

use App\Models\ProductSpecValue;
use App\Models\Product;
use App\Models\SpecValue;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class ProductSpecValueController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('规格列表')
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
            ->header('商品规格详细')
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
            ->header('商品规格编辑')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content,$id)
    {
        return $content
            ->header('商品规格新增')
            ->description('description')
            ->body($this->form($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductSpecValue);

        $grid->id('Id');
        $grid->product_id('Product id');
        $grid->spec_value('Spec value');
        $grid->price('Price');
        $grid->num('Num');
        $grid->sales_volume('Sales volume');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProductSpecValue::findOrFail($id));

        $grid->disableExport();
        $grid->disableRowSelector();

        $show->id('Id');
        $show->product_id('Product id');
        $show->spec_value('Spec value');
        $show->price('Price');
        $show->num('Num');
        $show->sales_volume('Sales volume');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id)
    {
        $form = new Form(new ProductSpecValue);
        
        $form->hidden('product_id');
        
        $form->hasMany('specvalues','规格值', function (Form\NestedForm $form) use ($id){
            $spec = Product::where('id',$id)->value('spec_group');
            
            $form->embeds('spec_value', '规格信息', function ($form) use ($spec) {
                foreach($spec as $k => $v){
                    $form->radio('spec_value['.$k.']','规格值选择')->options(SpecValue::where('spec_id',$v)->pluck('name','id'));                
                }
            });
            $form->number('store', '商品库存');
            $form->decimal('price', '商品价格');
        });
        $form->saving(function (Form $form){
            dd(111);
            // dd($form->spec_value);
            // $form->spec_group = array_filter($form->spec_group);
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
