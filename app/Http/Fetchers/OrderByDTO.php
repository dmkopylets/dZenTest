<?php

declare(strict_types=1);

namespace App\Http\Fetchers;

class OrderByDTO
{
    public ?string $userName = 'none';
    public ?string $email = 'none';
    public ?string $createdAt = 'desc';


    public function toArray(): array
    {
        $array['userName'] = $this->userName;
        $array['email'] = $this->email;
        $array['createdAt'] = $this->createdAt;
        return $array;
    }

    public function fromArray($array): orderByDTO
    {
        $this->userName = $array['userName'];
        $this->email = $array['email'];
        $this->createdAt = $array['createdAt'];
        return $this;
    }
}
