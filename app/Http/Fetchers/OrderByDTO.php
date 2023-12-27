<?php

declare(strict_types=1);

namespace App\Http\Fetchers;

class OrderByDTO
{
    public string $userName = 'asc';
    public string $email = 'asc';
    public string $createdAt = 'desc';
    public string $selected = 'userName';
}
