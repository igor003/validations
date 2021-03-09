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
        $grid->column('devices', 'Device serial')->display(function ($devices) {
           
            return "{$devices['serial_number']}";
        });
       
        $grid->column('executor', __('Executor'));
        $grid->column('type', __('Type'));
        $grid->column('start_date', __('Start date'));
        $grid->column('validation_path', __('Validation path'));
        $grid->column('decision', __('Decision'));
      
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function($filter){
            $filter->where(function ($query) {
                $query->where('type', 'like', "%{$this->input}%");
            }, 'Type');
        });
         $grid->filter(function($filter){
            $filter->equal('start_date')->date();
        });
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
        $show->field('type', __('Type'));
        $show->field('start_date', __('Start date'));
        $show->field('validation_path', __('Validation path'));
        $show->field('decision', __('Decision'));
       
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
         
        $form = new Form(new Validations());
        
        $form->select('id_device','Device serial number')->options(Devices::all()->pluck('serial_number','id'));
        $form->text('executor', __('Executor'));
        
        $form->select('type')->options(['Initial' => 'Initial', 'Ordinary' => 'Ordinary','Extraordinary' => 'Extraordinary',]);
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->file('validation_path');
        $form->select('decision','Decision')->options(['Ok' => 'OK', 'KO' => 'KO',]);
      
       

        return $form;
    }
}
