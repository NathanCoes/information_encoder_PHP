<?php
    session_start();
    $content;
    
    if (isset($_SESSION['process'])){

        if ($_SESSION['process'] == "error"){
            $alert = "<div class='alert alert-warning' role='alert'>
                    Oops! Something went wrong...
                </div>";

            $content = "
                <div class='container mt-2'>
                    $alert
                </div>";
        }
    }
    session_destroy();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Encrypt a file</title>
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <div class="container">
            <form action="encrypt_files.php" method="post" enctype="multipart/form-data">
                <div class="mb-6">
                    <label for="formFileMultiple" class="form-label">Choose a file to encrypt</label>
                    <input class="form-control" type="file" name="file" id="file">
                    <input type="hidden" name="encrypt">
                </div>
                <div class="mb-6 mt-2">
                    <button type="submit" class="btn btn-outline-primary">Encrypt</button>
                </div>
            </form>
        </div>
    
        <div class="container mt-6">
            <form action="encrypt_files.php" method="post" enctype="multipart/form-data">
                <div class="mb-6">
                    <label for="formFileMultiple" class="form-label">Choose a file to decrypt</label>
                    <?//Is important to know that if you gonna use a different extension for your encrypted files, you must change the "accept" argument?>
                    <input class="form-control" type="file" name="file" id="file" accept=".enc">
                    <input type="hidden" name="decrypt">
                </div>
                <div class="mb-6 mt-2">
                    <button type="submit" class="btn btn-outline-primary">Decrypt</button>
                </div>
            </form>
            
        </div>
        
        <?php
            if (isset($content)) echo $content;
        ?>
        
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>