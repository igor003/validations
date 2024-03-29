<?php

namespace App\Admin\Controllers;

use App\DeviceTypes;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DeviceTypesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DeviceTypes';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DeviceTypes());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('periodicity', __('Periodicity'));
        $grid->column('img_path', __('Image path'));
        $grid->column('instruction_path', __('Instruction path'));
        $grid->column('valid_instruction_path', __('Validation instruction path'));  
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
        $show = new Show(DeviceTypes::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('img_path', __('Image path'));
        $show->field('instruction_path', __('Instruction path'));
        $show->field('', __('Validation instruction path'));
        $show->field('periodicity', __('Periodicity'));
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
        $form = new Form(new DeviceTypes());

        $form->textarea('name', __('Name'));
        $form->number('periodicity', __('Periodicity'));
        $form->file('instruction_path');
        $form->file('valid_instruction_path');
        $form->image('img_path');

        return $form;
    }
}
