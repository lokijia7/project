<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }

    header {
        text-align: center;
        padding: 50px 0;
    }

    main section {
        padding: 50px;
        text-align: center;
    }

    main section h2 {
        margin-bottom: 30px;
    }

    main section ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    main section li {
        margin: 0 20px 40px;
        max-width: 300px;
        text-align: center;
    }

    main section li img {
        width: 100%;
        height: auto;
        margin-bottom: 10px;
    }

    main section li h3 {
        margin: 0;
        font-size: 24px;
    }

    main section li p {
        margin: 10px 0;
    }

    main section li button {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

    main section li button:hover {
        background-color: #555;
    }

    footer {
        text-align: center;
        background-color: #333;
        color: #fff;
        padding: 20px 0;
    }
</style>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-2 px-lg-3">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="product_create.php">Create
                            Product</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="product_read.php">Products
                            List</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="customer_create.php">Create
                            Customer</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="customer_read.php">Customers
                            List</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.html">Contact Us</a>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="login.php">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <h1>My Product Store</h1>

    </header>
    <main>
        <section>
            <h2>Welcome to our store</h2>
            <p>We offer a wide variety of products at competitive prices. From electronics to clothing to home goods, we
                have it all.</p>
            <button>Shop now</button>
        </section>
    </main>
</body>

</html>