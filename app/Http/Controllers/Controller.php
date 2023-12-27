<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use App\Http\Fetchers\ArticleCommentsFetcher;
use App\Http\Fetchers\UserFetcher;
use App\Http\Fetchers\OrderByDTO;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected Model $model;
    protected UserFetcher $userFetcher;
    protected ArticleCommentsFetcher $commentsFetcher;
    protected array $usersArray = [];
    protected array $signedUser;
    protected OrderByDTO $orderingSets;
    protected Request $myRequest;

    public function __construct()
    {
        $this->userFetcher = new UserFetcher();
        $this->commentsFetcher = new ArticleCommentsFetcher;
        $this->usersArray = $this->userFetcher->getListArray();
        $this->orderingSets = new OrderByDTO;
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
