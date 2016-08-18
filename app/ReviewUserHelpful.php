<?php
/**
 * Created by PhpStorm.
 * User: oselwang
 * Date: 7/17/16
 * Time: 10:44 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ReviewUserHelpful extends Model
{

    protected $fillable = ['user_id','review_id'];
    protected $table = 'reviewuserhelpful';
}