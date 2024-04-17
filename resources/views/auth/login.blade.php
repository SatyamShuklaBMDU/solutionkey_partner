<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            background-image: url('https://img.freepik.com/free-photo/business-man-financial-inspector-secretary-making-report-calculating-checking-balance-internal-revenue-service-inspector-checking-document-audit-concept_1423-126.jpg');
            /* Replace this URL with your image */
            background-size: cover;
            background-position: center;
            font-family: "Poppins", sans-serif;
        }

        .ghjkl {
            background-color: rgba(7, 5, 5, 0.5);
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
            /* Adding some transparency to make text readable */
        }
    </style>
</head>

<body>
    <div class="ghjkl">
        <div class="container">
            <div class="card col-lg-6">
                <h2 class="text-center mb-4 fw-800 text-warning">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="py-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Enter email">
                    </div>
                    <div class="pb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                    </div>
                    {{-- <div class="pb-3">
                        <a href="{{ route('password.request') }}" style="text-decoration: none;"><span class="text-primary" style="font-weight:5px !important;">Forgot your password</span></a>
                    </div> --}}
                    <div class="py-2" style="text-align: center;">
                        <button type="submit" class="btn btn-warning form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
