<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">You are currently signed in as a random user:</a>
    <div class="row g-2">
    <div class="col-md">
    <div class="form-floating">
      <input type="email" class="form-control" id="email" placeholder="{{ $singedUser['email'] }}" value="{{ $singedUser['email'] }}">
      <label for="email">Email address</label>
    </div>
  </div>
  <div class="col-md">
    <div class="form-floating">
      <input type="text" class="form-control" id="User_Name" placeholder="{{ $singedUser['name'] }}" value="{{ $singedUser['name'] }}">
      <label for="User_Name">User name</label>
    </div>
  </div>
  </div>

    <form class="d-flex" role="search">
    <div>
    <a class="navbar-brand; margin-right:10pt;">select a commenter: </a>
                </div>
                <div class="input-group-prepend">
                    <select class="form-control userDialer" id="userDialer" name="userDialer" required>
                        @foreach($usersList as $user)
                        <option value="{{$user['id']}}">{{$user['name']}}</option>
                        @endforeach
                    </select>
                </div>
    </form>
  </div>
</nav>




