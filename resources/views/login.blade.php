<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kosan</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link ke Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
</head>

<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-body">
                <h2 class="card-title text-center">Login</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                

                <form id="login-form" method="post" action="{{route('login')}}">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="eye-icon" style="cursor: pointer;"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group">
                        <label for="role">Masuk</label>
                        <select class="form-control" id="role" name="role" required>
                            @foreach ($artist as $artis)
                                <option value="{{$artis->title}}">{{$artis->title}}</option>
                            @endforeach
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="remember">
                            <input type="checkbox" name="remember" id="remember"> Remember Me
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </button>

                    <div class="text-center mt-3">
                        <a href="{{url('register')}}">Buat Akun Baru</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS dan dependensinya -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script untuk toggle mata pada password -->
    <script>
        
        // Ambil elemen input password dan ikon eye
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        // Menambahkan event listener pada ikon eye
        eyeIcon.addEventListener('click', function() {
            // Toggle antara tipe password dan text
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.innerHTML = '<i class="fas fa-eye-slash"></i>'; // Ganti ikon jadi mata tertutup
            } else {
                passwordInput.type = "password";
                eyeIcon.innerHTML = '<i class="fas fa-eye"></i>'; // Ganti ikon jadi mata terbuka
            }
        });
        
    </script>
</body>

</html>
