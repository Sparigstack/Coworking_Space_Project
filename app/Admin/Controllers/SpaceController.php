<?php

namespace App\Admin\Controllers;

use App\Space;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SpaceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Space';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Space());
        $grid->model()->where('intersted_in_v2', '=', '1');
        $grid->model()->orderBy('updated_at', 'desc');
        $grid->column('id', __('Id'));
    
        $grid->column('User name')->display(function () {
            return $this->user->first_name . ' ' . $this->user->last_name;
        });

        $grid->column('space_name', __('Space name'));
        $grid->column('City')->display(function () {
            return $this->city->name ;
        });

        $grid->column('Intersted in v2')->display(function () {
            if(isset($this->intersted_in_v2) && !empty($this->intersted_in_v2) && $this->intersted_in_v2 == "1")
            return $this->intersted_in_v2 ;
            else
            return 0;
        });

        $grid->disableRowSelector();
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableFilter();


        $grid->filter(function($filter){
            $filter->disableIdFilter();
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
        $show = new Show(Space::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('city_id', __('City id'));
       
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Space());

        $form->number('user_id', __('User id'));
       

        return $form;
    }
}
