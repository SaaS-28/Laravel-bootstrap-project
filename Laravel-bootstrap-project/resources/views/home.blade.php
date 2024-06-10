<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <div class="container">
    <!-- Logout -->
    @auth
    <div class="my-3">
      <div class="alert alert-success" role="alert">
        <strong>Welcome!</strong> You are logged in as <strong>{{ Auth::user()->username }}</strong>. <!-- This shows the name of woh is logged in --> 
        <form action="/logout" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-outline-danger btn-sm ml-3">Log out</button>
        </form>
      </div>
    </div>


    <!-- Create post -->
    <div class="my-3 border p-3"> 
      <h2>Create a new post</h2>
      <form action="/create-post" method="POST">
        @csrf
        <div class="form-group">
          <input type="text" class="form-control" name="title" placeholder="Post title">
        </div>
        <div class="form-group">
          <textarea class="form-control" name="body" placeholder="Body content..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save post</button>
      </form>
    </div>

    <!-- See all posts with possibility of deleting or updating a post (only if you are the owner)-->
    <div class="my-3 border p-3"> 
      <h2>All posts</h2>
      @foreach($posts as $post)
        <div class="bg-light p-3 my-3">
          <h3>{{$post['title']}} <small class="text-muted">
            @if($post->created_at == $post->updated_at)
              Created by {{$post->user->username}} at: {{$post->created_at}}
            @else
              Last updated by {{$post->user->username}} at: {{$post->updated_at}}
            @endif
          </small></h3>
          <p>{{$post['body']}}</p>
          @if(Auth::check() && $post->user->id === Auth::user()->id)
            <a href="/edit-post/{{$post->id}}" class="btn btn-secondary">Edit</a>
            <form action="/delete-post/{{$post->id}}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          @else
            <div class="alert alert-danger">You are not authorized to edit or delete this post.</div>
          @endif
        </div>
      @endforeach
    </div>

    @else

    <div class="container">
      <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
          <!-- Register -->
          <div class="my-3 border p-3">
            <h2>Register</h2>
            <!-- Register errors -->
            @if ($errors->any() && !$errors->hasBag('login'))
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="/register" method="POST">
              @csrf <!-- this allows us to make a registration -->
              <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password">
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
            </form>
          </div>

          <!-- Login -->
          <div class="my-3 border p-3">
            <h2>Login</h2> 
            <!-- Login errors -->
            @if ($errors->hasBag('login'))
              <div class="alert alert-danger">
                @foreach ($errors->getBag('login')->all() as $error)
                  <p>{{ $error }}</p>
                @endforeach
              </div>
            @endif
            <form action="/login" method="POST">
              @csrf <!-- this allows us to make a registration -->
              <div class="form-group">
                <input type="text" class="form-control" name="loginusername" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="loginpassword" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    @endauth
  </div>
  </body>
</html>
