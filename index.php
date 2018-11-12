<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>League Of Legends!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">    <title>Bootstrap 4!</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
</head>
<body>

    <section class="first-page">
    <div class="container-fluid">
    <div class="container">
    <div class="row h100 d-flex justify-content-center align-items-center">
        <div class="col-lg-8 text-center">
        <?php if(isset($_SESSION['alert'])):?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>We have a problem... <bR> The problem can be:</strong> <br> 
            <?php echo $_SESSION['alert']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif;?>
            <h1 class="text-white font-weight-bold mb-3">LEAGUE OF LEGENDS</h1>
            <h1 class="text-white mb-5">Analyze your <span class="text-blue font-weight-bold">FIGHT!</span></h1>

            <form action="match.php" method="get" class="mb-5">
            <div class="form-group">
                <div class="input-group">
                    <input name="summoner" class="form-control" placeholder="SummonerName" type="text">

                    <div class="input-group-addon eune" title="This app is form EUNE">
                        EUNE
                    </div>

                    <div class="input-group-addon">
                        <button type="submit" class="btn btn-md btn-primary search">Search</button>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
    </div>
    </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
<?php if(isset($_SESSION['alert'])){ unset($_SESSION['alert']);}?>