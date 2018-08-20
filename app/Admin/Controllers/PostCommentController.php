<?php

namespace App\Admin\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PostCommentController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('Post comments');
            $content->description('Post comments');
            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $content->header('header');
            $content->description('description');
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {
            $content->header('header');
            $content->description('description');
            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(PostComment::class, function (Grid $grid) {

            if ($post = request('post_id')) {
                $grid->model()->ofPost($post);
            }

            $grid->id('ID')->sortable();
            $grid->post()->title('Post');
            $grid->content()->editable();
            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter) {
                $filter->like('content');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(PostComment::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('post_id')->options(Post::all()->pluck('title', 'id'))->value(request('post_id'));
            $form->textarea('content');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
