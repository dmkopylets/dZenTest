<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use App\Http\Fetchers\UserFetcher;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected Model $model;
    protected UserFetcher $userFetcher;
    protected array $usersArray = [];
    protected array $signedUser;
    protected Request $myRequest;

    public function __construct()
    {
        $this->userFetcher = new UserFetcher();
        $this->usersArray = $this->userFetcher->getListArray();
        $this->myRequest = new Request();
    }

    public function setSignedUser(int $id): void
    {
        $this->signedUser = $this->usersArray[$id];
    }
    public function getSignedUser(): array
    {
        $this->setSignedUser((int)$this->myRequest->input('userDialer'));
        return $this->signedUser;
    }
}
