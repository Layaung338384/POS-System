<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS SYTEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar bg-body-tertiary p-3">
        <div class="container-fluid">
           <div class="fs-4 fw-bold">
            <a class="navbar-brand text-danger">Super Mental Solution</a>
           </div>
           <div class="d-flex justify-content-between">
                <div class="">
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                    Login
                </a>
                <a href="{{ route("register") }}" class="btn btn-secondary">
                    SignUp
                </a>
                </div>
           </div>

        </div>
    </nav>

    <section class="px-3 d-flex align-items-center min-vh-100">
        <div class="container-fluid container-lg">
            <div class="row">
                <div class="col">
                    <div class="fw-bold">
                        <h2 class="text-danger">POS SYSTEM PROJECT</h2>
                        <div class="mt-3">
                            <p class="text-secondary">
                            This project is a Point of Sale (POS) system designed as part of a real-world application to simulate retail transactions and inventory management. The focus of this system is on building strong backend functionality, including handling user roles, managing product stocks, recording sales, and maintaining order history with accuracy and efficiency.
                            While the UI/UX design may appear basic, that’s intentional I’m currently focused on strengthening my backend development skills. I believe solid logic, security, and database structure come first. This project helped me dive deep into database handling (MySQL), server-side scripting (PHP/Laravel), and session management.
                        </p>
                        </div>
                        <a href="{{ route("register") }}" class="btn btn-outline-danger" >Get Started</a>
                        <a href="{{ route("info") }}" class="btn btn-outline-success" >More Info</a>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <div class="text-center">
                                <img
                                    src="{{ asset('White Chic Minimalist Fashion Photo….jpg') }}"
                                    class="img-thumbnail rounded shadow"
                                    alt="POS Image"
                                    style="max-width: 250px; height: auto;"
                                >
                                </div>
                        </div>
                    </div>
                </div>
            </div> <!-- ← This closing tag was missing -->
        </div>
    </section>

    <footer class=" border p-3 shadow">
        <p class="text-center">©2025 All Righst are reserved.</p>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</html>
