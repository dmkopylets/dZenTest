<?php

declare(strict_types=1);

namespace App\Http\Fetchers;

use App\Models\User;

class UserFetcher
{
public function getListArray()

    {
        return User::select('id', 'name')->orderBy('name', 'asc')->get()->toArray();
    }
}
