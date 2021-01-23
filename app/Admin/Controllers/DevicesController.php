<?php

namespace App\Admin\Controllers;

use App\Devices;
use App\DeviceTypes;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DevicesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Devices';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Devices());

        $grid->column('id', __('Id'));
        $grid->column('id_type', __('Id type'));
        $grid->column('number', __('Number'));
        $grid->column('serial_number', __('Serial number'));
        $grid->column('inventory_number', __('Inventory number'));
        $grid->column('maker', __('Maker'));
        $grid->column('model', __('Model'));
        $grid->column('status', __('Status'));
        $grid->column('start_date', __('Start date'));
        $grid->column('prev_valid_date', __('Prev valid date'));
        $grid->column('next_valid_date', __('Next valid date'));
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
        $show = new Show(Devices::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('id_type', __('Id type'));
        $show->field('number', __('Number'));
        $show->field('serial_number', __('Serial number'));
        $show->field('inventory_number', __('Inventory number'));
        $show->field('maker', __('Maker'));
        $show->field('model', __('Model'));
        $show->field('status', __('Status'));
        $show->field('start_date', __('Start date'));
        $show->field('prev_valid_date', __('Prev valid date'));
        $show->field('next_valid_date', __('Next valid date'));
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
     

        $form = new Form(new Devices());
        $form->select('id_type')->options(DeviceTypes::all()->pluck('name', 'id'));
        $form->text('number', __('Number'));
        $form->text('serial_number', __('Serial number'));
        $form->text('inventory_number', __('Inventory number'));
        $form->text('maker', __('Maker'));
        $form->text('model', __('Model'));
        $form->text('status', __('Status'));
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->date('prev_valid_date', __('Prev valid date'))->default(date('Y-m-d'));
        $form->date('next_valid_date', __('Next valid date'))->default(date('Y-m-d'));

        return $form;
    }
}
