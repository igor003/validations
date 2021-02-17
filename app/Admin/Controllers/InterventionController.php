<?php

namespace App\Admin\Controllers;

use App\Interventions;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InterventionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Interventions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Interventions());

        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'));
        $grid->column('id_type_mentenance', __('Id type mentenance'));
        $grid->column('id_machine', __('Id machine'));
        $grid->column('id_type_machine',__('Id type machine'))
        $grid->column('id_type', __('Id type'));
        $grid->column('duration', __('Duration'));
        $grid->column('report_path', __('Report path'));
        $grid->column('note', __('Note'));
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
        $show = new Show(Interventions::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('date', __('Date'));
        $show->field('id_type_mentenance', __('Id type mentenance'));
        $show->field('id_machine', __('Id machine'));
        $show->field('id_type_machine', __('Id type machine'));
        $show->field('id_type', __('Id type'));
        $show->field('duration', __('Duration'));
        $show->field('report_path', __('Report path'));
        $show->field('note', __('Note'));
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
        $form = new Form(new Interventions());

        $form->date('date', __('Date'))->default(date('Y-m-d'));
        $form->number('id_type_mentenance', __('Id type mentenance'));
        $form->number('id_machine', __('Id machine'));
        $form->number('id_type_machine', __('Id type machine'));
        $form->number('id_type', __('Id type'));
        $form->time('duration', __('Duration'))->default(date('H:i:s'));
        $form->text('report_path', __('Report path'));
        $form->text('note', __('Note'));

        return $form;
    }
}
