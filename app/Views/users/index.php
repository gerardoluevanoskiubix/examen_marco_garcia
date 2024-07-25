<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="css/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('js/user.js'); ?>"></script>
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container">
            <h3 class="my-3" id="titulo">Users</h3>

            <a href="<?= base_url('users/newUser'); ?>" class="btn btn-success">Add User</a>

            <table class="table table-hover table-bordered my-3" aria-describedby="titulo">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($users as $user_data): ?>
                        <tr>
                            <td><?= $user_data['ID']; ?></td>
                            <td><?= $user_data['name']; ?></td>
                            <td><?= $user_data['email']; ?></td>
                            <td><?= $user_data['phone']; ?></td>
                            <td>
                                <a href="<?= base_url('users/'.$user_data['ID'].'/editUser'); ?>" class="btn btn-warning btn-sm me-2">Edit</a>
                                
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-bs-url="<?= base_url('users/'. $user_data['ID']); ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>                                
                </tbody>
            </table> 

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">Warning</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Are you sure you want to delete this record?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="form-delete" action="" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>

        const lastResponse = localStorage.getItem('lastResponse');  
        if (lastResponse) {
            console.log(JSON.parse(lastResponse));
        }

        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const url = button.getAttribute('data-bs-url');
            const form = document.getElementById('form-delete');
            form.action = url;
        });

        var baseUrl = '<?= base_url('users') ?>';
        var jsonUrl = baseUrl + '?json=true';
    </script>
</body>
</html>