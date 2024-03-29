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
        // $grid->column('id_type', __('Id type'));

        $grid->column('device_type', 'Device type')->display(function ($devices_type) {
           
            return "{$devices_type['name']}";
        });

        $grid->column('number', __('Number'));
        $grid->column('serial_number', __('Serial number'));
        $grid->column('inventory_number', __('Inventory number'));
        $grid->column('maker', __('Maker'));
        $grid->column('project', __('Project'));
        $grid->column('ordin_nmb', __('Storage cell'));
        $grid->column('model', __('Model'));
        $grid->column('push_back', __('Push back'));
        $grid->column('status', __('Status'));
        $grid->column('note', __('Note'));
        $grid->column('start_date', __('Start date'));
        $grid->column('prev_valid_date', __('Prev valid date'));
        $grid->column('next_valid_date', __('Next valid date'));
        $grid->column('info_img', __('Info imeage'));
        $grid->column('data_sheet_path', __('Data sheet'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->filter(function($filter){
            $filter->where(function ($query) {
                $query->where('inventory_number', 'like', "%{$this->input}%");
            }, 'Inventoru number');
        });
        $grid->filter(function($filter){
            $filter->where(function ($query) {
                $query->whereHas('device_type', function ($query) {
                    $query->where('name','=', "{$this->input}");
                });
            }, 'Type machine');
        });
        $grid->filter(function($filter){
            $filter->where(function ($query) {
                $query->where('status', 'like', "%{$this->input}%");
            }, 'Status');
        });
        $grid->filter(function($filter){
            $filter->where(function ($query) {
                $query->where('model', 'like', "%{$this->input}%");
            }, 'Model');
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
        $show = new Show(Devices::findOrFail($id));
      
        $show->field('id', __('Id'));
        $show->field('id_type', __('Id type'));
        $show->field('number', __('Number'));
        $show->field('serial_number', __('Serial number'));
        $show->field('inventory_number', __('Inventory number'));
        $show->field('maker', __('Maker'));
        $show->field('project', __('Project'));
        $show->field('ordin_nmb', __('Storage cell'));
        $show->field('model', __('Model'));
        $show->field('push_back', __('Push back'));
        $show->field('status', __('Status'));
        $show->field('note', __('Note'));
        $show->field('info_img', __('Info'));
        $show->fiels('data_sheet_path', __('Data sheet'));
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
        $form->text('project', __('Project'));
        $form->text('ordin_nmb', __('Storage cell'));
        $form->text('model', __('Model'));
        $form->radio('push_back',__('Push back'))->options(['1' => 'Yes', '0'=> 'No'])->default('0');
        $form->image('info_img')->move('info_img');
        $form->file('data_sheet_path')->move('data_sheet');
        $form->select('status','Status')->options(['Production' => 'Production', 'Reserve' => 'Reserve','Send' => 'Send',]);
        $form->text('note', __('Note'));
        $form->date('start_date', __('Start date'))->default(date('Y-m-d'));
        $form->date('prev_valid_date', __('Prev valid date'))->default(date('Y-m-d'));
        $form->date('next_valid_date', __('Next valid date'))->default(date('Y-m-d'));
        // $form->saving(function (Form $form) {

        //     dump($form->number);

        // });
        return $form;
    }
}
