<!DOCTYPE html>
<html lang="es" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('js/user.js'); ?>"></script>
</head>


<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container">
            <h3 class="my-3">Edit User</h3>

            <?php if(session()->getFlashdata('error') !== null) { ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php } ?>

            <form action="<?= base_url('users/'.$user['ID']); ?>" class="row g-3" method="post" autocomplete="off">

                <input type="hidden" name="_method" value="PUT">

                <div class="col-md-8">
                    <label for="name" class="form-label">Name: </label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone: </label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                </div>

                <div class="col-12">
                    <a href="<?= base_url('users'); ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Udpate User</button>
                </div>

            </form>

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <script>
    var jsonUrl = '<?= base_url('users/'.$user['ID'].'?json=true') ?>'; // URL para obtener los datos del usuario específico
</script>

</body>

</html>