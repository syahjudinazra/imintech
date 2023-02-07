<!DOCTYPE html>

<html lang="en">
<head>
  @include('layout.header')
</head>
<body>
<div class="row loginpage justify-content-center align-items-center">
      <div class="col-md-5">
      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      
      <form method="post" action="./register" class="form-registration text-center">
        @csrf
        <img class="mb-4" src="{{asset('images/iminlogo.png')}}" alt="iminlogo" width="72" height="72">
          <label for="name" class="sr-only">Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is_invalid @enderror" placeholder="Name" required autofocus>
          @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror

          <label for="username" class="sr-only">Username</label>
                <input type="text" name="username" id="username" class="form-control @error('username') is_invalid @enderror" placeholder="Username" required>
          @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror

          <label for="email" class="sr-only">Email Address</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is_invalid @enderror" placeholder="imin@example.com" required>
          @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror

          <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is_invalid @enderror" placeholder="Password" required>
          @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
          @enderror
        <button class="btn btn-lg btn-danger btn-block" type="submit">Register</button>
    </form>
    <small class="d-block text-center mt-3">Already Registered? <a href="./login">Login Now!</a></small>
  </div>
</div>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('frontend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('frontend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('frontend/dist/js/adminlte.min.js')}}"></script>
</body>
</html>