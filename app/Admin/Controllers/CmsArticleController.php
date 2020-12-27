<?php

namespace App\Admin\Controllers;

use App\Models\CmsArticle;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Extensions\CmsArticlesExporter;
use App\Admin\Actions\CmsArticle\Replicate;
use App\Admin\Actions\CmsArticle\BatchReplicate;



class CmsArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CmsArticle';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CmsArticle());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->qrcode();
        $grid->column('author', __('Author'));
        $grid->column('article_content', __('Article content'))->filter('like');
        $grid->column('created_at', __('Created at'))->filter('range','datetime');
        $grid->column('updated_at', __('Updated at'));
        //$grid->column('deleted_at', __('Deleted at'));


        $grid->enableHotKeys();


        $grid->quickSearch('title','author','article_content');

        $grid->exporter(new CmsArticlesExporter());

        $grid->actions(function ($actions) {
            $actions->add(new Replicate);
        });

        $grid->batchActions(function ($batch) {
            $batch->add(new BatchReplicate());
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
        $show = new Show(CmsArticle::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('author', __('Author'));
        $show->field('article_content', __('Article content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        //$show->field('deleted_at', __('Deleted at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {



        $form = new Form(new CmsArticle());

        $form->text('title', __('Title'));
        $form->text('author', __('Author'));
        $form->textarea('article_content', __('Article content'));



        return $form;
    }

    public function dialog()
    {
        $this->confirm('确定复制？');
    }
}
