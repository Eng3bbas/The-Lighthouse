<?php


namespace App\Services;


trait ServiceHelpers
{

    protected function idValidator($id)
    {
        validator()->make(['id' => $id],[
            'id' => ['required','integer','min:1']
        ])->validate();
    }
}
