<?php

namespace App\Admin\Controllers;
use App\TypeMentenance;
use App\TypeInterventions;
use App\DeviceTypes;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TypeInterventionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TypeInterventions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TypeInterventions());

        $grid->column('id', __('Id'));

      
        $grid->column('type_mentenance', 'Type mentenance')->display(function ($mentenance_type) {
            return "{$mentenance_type['name']}";
        });
      
        $grid->column('device_type', 'Type device')->display(function ($device_type) {
            return "{$device_type['name']}";
        });
        $grid->column('name', __('Name'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(TypeInterventions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('id_type', __('Id type'));
        $show->column('id_device', __('Id device'));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TypeInterventions());

        $form->select('id_type','Type mentenance')->options(TypeMentenance::all()->pluck('name','id'));
        $form->select('id_device','Type machine')->options(DeviceTypes::all()->pluck('name','id'));
      
        $form->text('name', __('Name'));

        return $form;
    }
}
