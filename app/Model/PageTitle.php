<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\PageTitle
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $page
 * @property string|null $title
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PageTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PageTitle whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PageTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PageTitle wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PageTitle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\PageTitle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PageTitle extends Model
{
    //

    protected $table='page_title';
    protected $fillable = ['page','title','description'];
//    protected $


}
