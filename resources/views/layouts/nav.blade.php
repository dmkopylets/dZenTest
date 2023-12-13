<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand">You are currently signed in as a random user:</a>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" placeholder="{{ $signedUser['email'] }}" value="{{ $signedUser['email'] }}">
                    <label for="email">Email address</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="User_Name" placeholder="{{ $signedUser['name'] }}" value="{{ $signedUser['name'] }}">
                    <label for="User_Name">User name</label>
                </div>
            </div>
        </div>

        <form class="d-flex" role="select">
            <div>
                <p class="lead d-inline-flex align-items-center rounded text-decoration-none" style="margin-right:10pt; color: white!important;">select another commenter: </p>
            </div>
            <div class="input-group-prepend">
                <select class="form-control userDialer" id="userDialer" name="userDialer" OnChange=SelectUser() required>
                    @foreach($usersList as $user)
                    <option @if ($user['id']===$signedUser['id']) {{ ' selected ' }} @endif value="{{$user['id']}}">{{$user['name']}}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</nav>
