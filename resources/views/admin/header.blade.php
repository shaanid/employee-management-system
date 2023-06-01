<link rel="stylesheet" href="/css/dashboard.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>
    <nav class="navbar navbar-expand-lg navbar-light py-2" style="background-color: #0e476b">
        <a class="navbar-brand" href="{{route('dashboard')}}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="{{ route('employee-details.index')}}">Employees <span class="sr-only"></span></a>
            <a class="nav-item nav-link" href="{{ route('designation-details.index') }}">Designation</a>
            <a class="nav-item nav-link" href="{{route('logout')}}" onclick="event.preventDefault();logoutConfirmation();">Logout</a>
          </div>
        </div>
    </nav><br><br>

      <script>
        function logoutConfirmation()
        {
          Swal.fire({
                    title: 'Are you sure to log out?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'gray',
                    confirmButtonText: 'Logout'
            })
          .then((result) => {
                            if (result.isConfirmed)
                {
          $.ajax({
                  url: "{{route('logout')}}",
                  type: "get",
                  data: {_token: "{{ csrf_token() }}"},
                  success: function(response){
                  console.log(response);
                  window.location.href = "{{route('showLogin')}}";
                },
              });
            }
          })
        }
      </script>
</body>
