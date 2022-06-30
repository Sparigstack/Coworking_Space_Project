<?php

namespace App\Admin\Controllers;

use App\Area;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Admin;
class LocalityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Area';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */

    public function __construct(){
        Admin::js('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js');
        Admin::css('https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css');
    }


    protected function grid()
    {
        $grid = new Grid(new Area());

        // $grid->column('id', __('Id'));
        // $grid->column('city_id', __('City id'));
        $grid->column('name', __('Name'));
        // $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('deleted_at', __('Deleted at'));
        $grid->quickSearch('name');

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
        $show = new Show(Area::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('city_id', __('City id'));
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Area());

        // $form->number('city_id', __('City id'));
        $form->text('name', __('Name'));
        $form->editor('locality_details', __('Locality details'));
        return $form;
    }
}
