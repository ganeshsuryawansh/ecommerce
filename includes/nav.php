<?php
session_start();

?>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/ecommerce">mycart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="col">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="cart.php">Cart</a>
                        </li>
                        <?php
                        if (isset($_SESSION['loggedin'])) {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active text-warning" aria-current="page" href="profile.php"><?= $_SESSION['email'] ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active text-danger" aria-current="page" href="logout.php">Logout</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="login.php">login</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>

                </div>
                <div class="col">
                    <div class="col-md-8 d-flex">
                        <input class="form-control" id="search" type="search" placeholder="Search">
                        <ul id="drdp" class="dropdown-menu dropdown mt-5 w-full px-2">
                        </ul>
                        <button class="btn btn-outline-warning" type="button" onclick="search()">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function search() {
            document.getElementById('drdp').classList.add('show');
            let val = document.getElementById('search').value;

            if (val == "") {

            } else {


                $.ajax({
                    type: 'POST',
                    url: 'includes/request.php',
                    data: {
                        search: val
                    },
                    success: function(data) {
                        document.getElementById('drdp').innerHTML = data;
                    }
                })
            }
        }
    </script>

    <style>
        .dropdown-menu.show {
            display: block;
        }
    </style>