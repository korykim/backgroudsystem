<?php


namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;


// use Encore\Admin\Grid\Exporters\AbstractExporter;
// use Maatwebsite\Excel\Facades\Excel;

class CmsArticlesExporter extends ExcelExporter
{

    //Carbon::now()->toDateTimeString()

    protected $fileName = 'CmsArticle.xlsx';

    protected $columns = [
        'id'      => 'ID',
        'title'   => '标题',
        'author' => '作者',
        'article_content' => '内容',
    ];


}



