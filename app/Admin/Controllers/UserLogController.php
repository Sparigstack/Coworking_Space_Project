<?php

namespace App\Admin\Controllers;

use App\Logs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Logs';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Logs());
        $grid->model()->orderBy('created_at', 'desc');
        $grid->column('id', __('Id'));
        $grid->column('User name')->display(function () {
            return $this->user->first_name . ' ' . $this->user->last_name;
        });
        $grid->column('Space Name')->display(function () {
            if(isset($this->space) && !empty($this->space))
            return $this->space->space_name ;
            else
            return '';
            
        });

        $grid->column('City')->display(function () {
            if(isset($this->space) && !empty($this->space))
            return $this->space->city->name ;
            else
            return '';
            
        });

       
        // $grid->column('description', __('Description'));

        $grid->column('description')->filter([
            'user  logged in' => 'user logged in',
            'Passport Participation changed' => 'Passport Participation changed',
            'space accessed' => 'space accessed',
           
        ]);

    
        // $grid->column('created_at', __('Created at'));
        $grid->column('created_at')->filter('range', 'datetime');
      
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
        $show = new Show(Logs::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('space_id', __('Space id'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Logs());

        $form->number('user_id', __('User id'));
        $form->number('space_id', __('Space id'));
        $form->text('description', __('Description'));

        return $form;
    }
}
