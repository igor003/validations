<?php

namespace App\Admin\Controllers;
use App\Devices;
use App\Validations;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ValidationsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Validations';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Validations());

        $grid->column('id', __('Id'));
        $grid->column('id_device', __('Id device'));
        $grid->column('executor', __('Executor'));
        $grid->column('start_date', __('Start date'));
        $grid->column('validation_path', __('Validation path'));
        $grid->column('decision', __('Decision'));
        $grid->column('id_user', __('Id user'));
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
        $show = new Show(Validations::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('id_device', __('Id device'));
        $show->field('executor', __('Executor'));
        $show->field('start_date', __('Start date'));
        $show->field('validation_path', __('Validation path'));
        $show->field('decision', __('Decision'));
        $show->field('id_user', __('Id user'));
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
         $devicess = Devices::with('device_type')->get();
    
        $data = array();
        $cnt = 0;
        foreach($devicess as $device){
                  
               $data[$cnt][] = $device->id;
               $data[$cnt][]= $device->device_type->name . $device->number;
               $cnt++;
        } 

        
        $form = new Form(new Validations());

        $form->number('id_device', __('Id device'));
         $form->select('id_type')->options($data);
        $form->text('executor', __('Executor'));
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->text('validation_path', __('Validation path'));
        $form->text('decision', __('Decision'));
        $form->number('id_user', __('Id user'));

        return $form;
    }
}
