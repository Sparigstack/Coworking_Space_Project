<?php

namespace App\Admin\Controllers;

use App\City;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Admin;
class CityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'City';

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
        $grid = new Grid(new City());
        $grid->column('id', __('Id'));
        $grid->column('country_id', __('Country id'));
        $grid->column('name', __('Name'));
        $grid->column('created_at', __('Created at'));
   
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
        $show = new Show(City::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('country_id', __('Country id'));
        $show->field('name', __('Name'));
        $show->field('city_image', __('City image'));
        $show->field('related_city_id', __('Related city id'));
        $show->field('city_details', __('City details'));
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
        $form = new Form(new City());

        // $form->number('country_id', __('Country id'));
        $form->text('name', __('Name'));
        // $form->text('city_image', __('City image'));
        $form->editor('city_details', __('City details'));
        $form->textarea('city_description', __('City Description'));
        $form->textarea('city_cowork_details', __('City Cowork Details'));
        // $form->editor('city_details', __('City details'));

        return $form;
    }
}
