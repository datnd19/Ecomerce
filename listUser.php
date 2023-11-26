<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <?php include './components/sideBar.php' ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <h1>List User</h1>
            <form class="d-flex mb-4 formSearch">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-info searchBtn" type="button">Search</button>
            </form>
            <div class="d-flex justify-content-end ">
                <a href="addUser.php" class="btn btn-primary px-3 py-2 mb-3"><i class="fa-solid fa-circle-plus mr-2"></i>Add User</a>
            </div>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">UserID</th>
                        <th scope="col">Email</th>
                        <th scope="col">UserName</th>
                        <th scope="col">Phone</th>
                        <th scope="col">FullName</th>
                        <th scope="col">Address</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="bodyTable">

                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-end">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        const showAllUsers = () => {
            $.ajax({
                url: 'http://localhost:3000/Ecomerce/database/controller/userController.php',
                type: 'POST',
                data: {
                    action: "view",
                },
                success: (response) => {
                    $('.bodyTable').html(response)
                }
            })
        }
        showAllUsers();
        const search = document.querySelector('.searchBtn');
        const formSearch = document.querySelector('.formSearch');
        const getListUser = function(usernameSearch) {
            $.ajax({
                url: 'http://localhost:3000/Ecomerce/database/controller/userController.php',
                type: 'POST',
                data: {
                    action: "view",
                    usernameSearch: usernameSearch,
                },
                success: function(response) {
                    console.log(response);
                    $('.bodyTable').html(response);
                },
            });
        };

        formSearch.onsubmit = function(e) {
            e.preventDefault();
            const usernameSearch = document.querySelector('.form-control').value;
            getListUser(usernameSearch);
        };

        search.onclick = function() {
            const usernameSearch = document.querySelector('.form-control').value;
            getListUser(usernameSearch);
        };
    </script>
</body>

</html>