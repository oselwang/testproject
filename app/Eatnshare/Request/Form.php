<?php
/**
 * Created by PhpStorm.
 * User: oselwang
 * Date: 4/24/16
 * Time: 1:40 AM
 */

namespace App\Eatnshare\Request;


use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

abstract class Form
{

    use ValidatesRequests;

    protected $request;

    protected $rules;

    abstract function create();


    public function __construct(Request $request = null)
    {
        $this->request = $request ?: request();
    }

    public function isValid()
    {

        $this->validate($this->request, $this->rules);

        return true;
    }

    public function fields($property)
    {
        return $this->request->get($property);
    }

}