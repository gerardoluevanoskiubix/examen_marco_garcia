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
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <div class="container">
            <h3 class="my-3" id="titulo">Users</h3>

            <button data-bs-toggle="modal" class="btn btn-success" data-bs-target="#Add_Modal">Add User</button>

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
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['ID']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['phone']; ?></td>
                            <td>
                                <button data-bs-toggle="modal" class="btn btn-warning btn-sm me-2" data-id="<?php echo $user['ID']; ?>" data-bs-target="#Edit_Modal">Edit User</button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-bs-url="<?php echo site_url('UserController/delete/' . $user['ID']); ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Modal for adding new users -->
            <div class="modal fade" id="Add_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addUserForm" action="<?php echo site_url('UserController/save'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-form-label">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="btn_save" class="btn btn-primary">Save User</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for update the users -->
            <div class="modal fade" id="Edit_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editUserForm" action="<?php echo site_url('UserController/update'); ?>" method="POST">
                            <input type="hidden" id="edit_id" name="ID">
                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-form-label">Phone:</label>
                                    <input type="text" class="form-control" id="edit_phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input type="email" class="form-control" id="edit_email" name="email" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="btn_update" class="btn btn-primary">Udpate User</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para la eliminación -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">Warning</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete the data?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
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
    $(document).ready(function() {
        showData();

        $('#btn_save').on('click', function() {
            addUser();
        });

        //Muestra los datos en el modal
        $(document).on('click', '.btn-warning', function() {
            var userId = $(this).data('id');
            showUserData(userId);
        });

        //Manejo para actualizar
        $('#btn_update').on('click', function() {
            updateData('#editUserForm');
        });

        // Manejo del botón de eliminación
        $(document).on('click', '#confirm-delete', function() {
            const id = $(this).data('id');
            deleteUser(id);
        });
    });

    function showData() {
        $.ajax({
            url: "<?php echo site_url('get-users-json'); ?>",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Datos de usuarios:", data);
                setTimeout(function(){
                    console.clear()
                }, 10000);
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
    }

    function addUser() {
        $.ajax({
            url: $('#addUserForm').attr('action'),
            type: $('#addUserForm').attr('method'),
            data: $('#addUserForm').serialize(),
            dataType: 'json',
            success: function(resp) {
                console.log('Response:', resp);
                localStorage.setItem('lastResponse', JSON.stringify(resp)); // Guardar el JSON en localStorage
                if (resp.status === 'success') {
                    $('#Add_Modal').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
            }
        });
    }

    //Muestra los valores dentro del modal para actualizar
    function showUserData(id) {
        $.ajax({
            url: "<?php echo site_url('UserController/get_user'); ?>/" + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#edit_id').val(data.ID);
                $('#edit_name').val(data.name);
                $('#edit_phone').val(data.phone);
                $('#edit_email').val(data.email);
            },
            error: function(xhr, status, error) {
                console.log("Error:", error);
            }
        });
    }

    function updateData(form) {
        var formData = $(form).serialize();
        $.ajax({
            url: $(form).attr("action"),
            type: $(form).attr("method"),
            data: formData,
            dataType: 'json',
            success: function(resp) {
                console.log('Response:', resp);
                localStorage.setItem('lastResponse', JSON.stringify(resp)); // Guardar el JSON en localStorage
                if (resp.status === 'success') {
                    $('#Edit_Modal').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseText);
            }
        });
    }

    function deleteUser(id) {
        $.ajax({
            url: '<?php echo site_url('UserController/delete'); ?>/' + id,
            type: 'POST',
            data: { _method: 'DELETE' },
            dataType: 'json',
            success: function(resp) {
                console.log('Response:', resp);
                localStorage.setItem('lastResponse', JSON.stringify(resp)); // Guardar el JSON en localStorage
                if (resp.status === 'success') {
                    $('tr').filter(function() {
                        return $(this).find('td').first().text() == id; // Encuentra la fila con el ID
                    }).remove();

                    $('#deleteModal').modal('hide');
                } else {
                    console.log('Error:', resp.message);
                }
            },
            error: function(xhr, status, error) {
                console.log("Error:", xhr.responseText);
            }
        });
    }

    const deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-bs-url').split('/').pop(); // Obtener el ID del URL
        const confirmButton = document.getElementById('confirm-delete');
        if (confirmButton) {
            confirmButton.setAttribute('data-id', id); // Guardar el ID en el botón de confirmación
        } else {
            console.error('Confirm button not found');
        }
    });
    </script>

</body>
</html>
