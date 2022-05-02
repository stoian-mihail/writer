<?php

namespace App\Http\Traits;


trait CheckFileNameTrait
{

    public function nameAlreadyExists($name, $namesList)
    {
        foreach ($namesList as $existingName) {
            if ($name == $existingName) {
                return true;
            }
        }
        return false;
    }
}
