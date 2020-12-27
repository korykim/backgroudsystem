<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\DefaultDatetimeFormat;


/**
 * App\Models\CmsArticle
 *
 * @property int $id id
 * @property string|null $title 标题
 * @property string|null $author 作者
 * @property string|null $article_content 内容
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property string|null $deleted_at 删除时间
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle whereArticleContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CmsArticle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CmsArticle extends Model
{
    use DefaultDatetimeFormat;
    protected $table = 'cms_article';
}