<!DOCTYPE html>
<html>
<head>
	<title>Login | Register</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">

		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="{{ route('registrasi') }}"  method="POST"
                enctype="multipart/form-data">
                @csrf
                  {{-- untuk memunculkan notif --}}

{{--
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                {{-- @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ Session::get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif --}}

					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="fullname" placeholder="Full Name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
                    {{-- <input type="text" name="alamat" placeholder="Address" required="">
                    <input type="number" name="umur" placeholder="Umur" required=""> --}}
                    <input type="file" name="gambar" placeholder="Upload Profile" required="">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form action="{{ route('auth') }}" method="POST">
                    @csrf
                    {{-- untuk memunculkan notif --}}
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif --}}

					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button>Login</button>
				</form>
			</div>
	</div>
</body>
</html>
