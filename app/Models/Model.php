<?php
/**
 * Created by PhpStorm.
 * User: yunus
 * Date: 8/16/2017
 * Time: 1:14 PM
 */

namespace  App\Models;

use App\Traits\uuids;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    //
    use uuids;

    protected $guarded = [];
    public $incrementing = false;

}
