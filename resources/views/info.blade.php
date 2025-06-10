<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS SYSTEM</title>
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


    <div class="container min-vh-100 my-5">
        <a href="{{ route('index') }}" class="btn btn-danger mb-3">Back</a>
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-6 mb-4"> <div class="card">
                    <div class="card-body">
                        <div class="fw-bold text-center">
                            <h2 class="text-danger mb-3">💼 Project Description: POS System</h2> <div>
                                <p class="text-secondary">
                                This project is a Point of Sale (POS) system designed as part of a real-world application to simulate retail transactions and inventory management. The focus of this system is on building strong backend functionality, including handling user roles, managing product stocks, recording sales, and maintaining order history with accuracy and efficiency.
                                While the UI/UX design may appear basic, that’s intentional I’m currently focused on strengthening my backend development skills. I believe solid logic, security, and database structure come first. This project helped me dive deep into database handling (MySQL), server-side scripting (PHP/Laravel), and session management.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-lg-6"> <div class="card">
                    <div class="card-body">
                        <div class="fw-bold mb-3"> <h2 class="text-danger">⚙️ Core Features:</h2>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2">✅ User Authentication with Roles (Admin, Cashier, Customer)</li>
                            <li class="mb-2">✅ Product Management (CRUD operations)</li>
                            <li class="mb-2">✅ Order Processing with live stock updates & discount logic</li>
                            <li class="mb-2">✅ Responsive Layout with Bootstrap (ongoing UI improvements)</li>
                            <li class="mb-2">✅ Product Filtering by Category, Price, and Availability</li>
                            <li class="mb-2">✅ Action Logging (e.g., product views, added to cart, purchases)</li>
                            <li class="mb-2">✅ Comment Section and Product Rating System</li>
                            <li class="mb-2">✅ Basic Analytics (e.g., most viewed products, top-rated items)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="border p-3 shadow mt-5"> <p class="text-center">©2025 All Rights are reserved.</p> </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</html>
