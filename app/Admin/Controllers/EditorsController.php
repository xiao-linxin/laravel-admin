<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;
use Encore\Admin\Widgets\Form;

class EditorsController extends Controller
{
    public function markdown(Content $content)
    {
        $form = new Form();
        $form->simplemde('content');

        return $content
            ->header('Markdown Editor')
            ->row($this->info('https://github.com/laravel-admin-extensions/simplemde', 'Simplemde'))
            ->row(new Box('Markdown editor', $form));
    }

    public function wangEditor(Content $content)
    {
        $form = new Form();
        $form->editor('content');

        return $content
            ->header('wang Editor')
            ->row($this->info('https://github.com/laravel-admin-extensions/wangEditor', 'wangEditor'))
            ->row(new Box('wang Editor', $form));
    }

    public function summernote(Content $content)
    {
        $form = new Form();
        $form->summernote('content');

        return $content
            ->header('Summernote Editor')
            ->row($this->info('https://github.com/laravel-admin-extensions/summernote', 'Summernote'))
            ->row(new Box('Summernote editor', $form));
    }

    protected function info($url, $title)
    {
        $content = "<a href=\"{$url}\" target='_blank'>{$url}</a>";

        return new Callout($content, $title, 'info');
    }
}