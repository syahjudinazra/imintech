<!DOCTYPE html>

<html lang="en">
<head>
  @include('layout.header')
</head>
<body>
<div class="row loginpage justify-content-center align-items-center">
      <div class="col-md-4">

      @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
       {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
      @endif

      <form method="post" action="./login" class="form-signin text-center">
        @csrf
        <img class="mb-4" src="{{asset('images/iminlogo.png')}}" alt="iminlogo" width="72" height="72">
          <label for="email" class="sr-only">Email address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required autofocus>

          <label for="password" class="sr-only">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          
          <a href="#" class="float-right">Forgot Password?</a>
        <button class="btn btn-lg btn-danger btn-block mt-5" type="submit">Login</button>
    </form>
    <small class="d-block text-center mt-3">Not Registered? <a href="./register">Register Now!</a></small>
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