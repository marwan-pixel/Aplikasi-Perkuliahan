<?php
session_start();
if(isset($_SESSION['username'])){
    header("Location: home.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Aplikasi Pembayaran Perkuliahan</title>
</head>

<body>
    <div style="height: 100vh;" class=" row d-flex justify-content-center align-items-center bg-success ">
        <div class="card col-sm-6">
            <div class="card-body text-center my-auto">
                <img width="50" src="assets/payment-card-svgrepo-com.svg" alt="">
                <h3 class="card-title"> Payment APP</h3>
            </div>
            <div class="card-body">
                <form id="login">
                    <input hidden name="role" type="text" value="mahasiswa" id="">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">ID</label>
                        <input type="number" name="npm" class="form-control" id="npm" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto ">
                        <button type="button" class="my-3 btn btn-success">Log In</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){
            let values = $('#login').serialize();
            if($('#npm').val() == ''){
                console.log('ID Kosong!');
            } else if($('#password').val() == '') {
                console.log('Password Kosong!');
            } else {
                $.ajax({
                    url: "loginService.php",
                    type: "post",
                    data: values,
                    success: function(response) {
                        if(response == 'success') {
                            window.location.href = "home.php";
                        } else {
                            console.log(response)
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        });
    });
</script>