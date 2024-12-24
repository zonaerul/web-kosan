<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kosan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}">
    <!-- Link ke Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link ke Font Awesome untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Link ke SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        progress#kekuatan-password {
            width: 100%;
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
            appearance: none;
        }

        progress#kekuatan-password::-webkit-progress-bar {
            background-color: #ccc;
        }

        progress#kekuatan-password::-webkit-progress-value {
            background-color: orange;
            transition: width 0.3s ease;
        }

        .password-strength {
            text-align: center;
            margin-top: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm" style="width: 400px;">
            <div class="card-body">
                <h2 class="card-title text-center">Daftar Akun</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form id="registerForm" action="{{route('register')}}" method="POST">
                    @csrf

                    <!-- Nama Input -->
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>

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

                    <!-- Nomor Telepon Input -->
                    <div class="form-group">
                        <label for="nomer">Nomor Telepon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nomer" name="number" placeholder="Masukkan nomor telepon" required>
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role" required>
                            @foreach ($artist as $role)
                            <option value="{{ $role->title }}">{{ $role->title }}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="form-group">
                        <label for="confirm-password">Konfirmasi Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="confirm-password" name="password_confirmation" placeholder="Konfirmasi password" required>
                        </div>
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="show-password" onclick="showPassword()">
                        <label class="form-check-label" for="show-password">Tampilkan password</label>
                    </div>


                    <p>Password harus terdiri dari minimal 8 karakter</p>
                    <progress value="0" max="100" id="kekuatan-password"></progress>
                    <p id="password-strength-text" class="password-strength">Lemah</p>


                    <!-- Register Button -->
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-user-plus"></i> Daftar
                    </button>

                    <!-- Login Link -->
                    <div class="text-center mt-3">
                        <p>Sudah punya akun? <a href="login">Masuk</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Link ke jQuery, Bootstrap JS, dan SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>

    <!-- Script untuk toggle visibility password -->
    <script>
        function showPassword() {
            var passwordInput = document.getElementById("password");
            var confirmPasswordInput = document.getElementById("confirm-password");
            var showPasswordCheckbox = document.getElementById("show-password");
            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
                confirmPasswordInput.type = "text";
            } else {
                passwordInput.type = "password";
                confirmPasswordInput.type = "password";
            }
        }
        $(document).ready(function() {
            $('#nomer').on('input', function() {
                var input = $(this).val();
                $(this).val(input.replace(/[^0-9]/g, '').substr(0, 12));
                if (input.length > 12) {
                    $(this).val(input.substr(0, 12));
                }
            });



            $("#email").on('blur', function() {
                var input = $(this).val();
                if (!input.includes('@')) {
                    $(this).val(input + '@gmail.com');
                }
            });

            $("#password").on('input', function() {
                var strongPass = $("#kekuatan-password");
                var strengthText = $("#password-strength-text");
                var password = $(this).val();
                var strength = 0;

                // Cek panjang password
                if (password.length >= 8) {
                    strength += 20;
                }
                // Cek huruf besar
                if (/[A-Z]/.test(password)) {
                    strength += 20;
                }
                // Cek huruf kecil
                if (/[a-z]/.test(password)) {
                    strength += 20;
                }
                // Cek angka
                if (/[0-9]/.test(password)) {
                    strength += 20;
                }
                // Cek karakter spesial
                if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
                    strength += 20;
                }

                // Set nilai progress bar
                strongPass.attr('value', strength);

                // Ubah warna dan teks berdasarkan kekuatan
                if (strength < 40) {
                    $("#kekuatan-password").css('background', 'red');
                    strengthText.text('Lemah').css('color', 'red');
                } else if (strength < 80) {
                    $("#kekuatan-password").css('background', 'orange');
                    strongPass.css('background-color', 'orange');
                    strengthText.text('Sedang').css('color', 'orange');
                } else {
                    $("#kekuatan-password").css('background', 'green');
                    strongPass.css('background-color', 'green');
                    strengthText.text('Kuat').css('color', 'green');
                }
            });
        });
    </script>
</body>

</html>