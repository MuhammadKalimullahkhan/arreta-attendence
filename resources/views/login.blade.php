<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/styles.css" />
    <link rel="stylesheet" href="/css/login.css" />

</head>

<body>
    <main id="loginPage">
        <div class="container">
            <div class="card mx-auto flex-row">
                <!-- <div class="card-img d-none d-lg-block rounded-3"></div> -->
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">
                            Login
                        </h4>
                        <p class="text-muted">Welcome Back, Please login to continue</p>
                    </div>
                    <form action="{{ route('account.authenticate') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="text" name="email" placeholder="example@email.com"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror" />
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mt-lg-4">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </div>
                    </form>

                    <p class="card-text mt-4 text-center">
                        Don't have an <a href="signup.html">account</a>?
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
