<?php

namespace App\Http\Validation;

use App\Core\Http\Request;
use App\Core\Http\Validation\Validation;

class TaskValidation extends Validation
{
    public function check(Request $request)
    {
        $name = $request->get('username');
        $mail = $request->get('mail');
        $text = $request->get('text');

        $this->checkValue($name)->min(1)->max(100);
        $this->checkValue($mail)->mail()->max(100);
        $this->checkValue($text)->min(1)->max(255);
    }
}