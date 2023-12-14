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

    public function __construct(Request $request)
    {
        $this->userFetcher = new UserFetcher();
        $this->usersArray = $this->userFetcher->getListArray();
        if (!isset($this->signedUser)) {
            $this->signedUser = $this->usersArray[array_rand($this->usersArray)];
        }
        else {
            $this->setSignedUser((int)$request->input('userDialer'));
        }
    }

    public function setSignedUser(int $id): void
    {
        $this->signedUser = $this->usersArray[$id];
    }

}
