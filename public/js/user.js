$(document).ready(function() {

    showData(); //LLama a la función para mostrar los datos

    $("form").submit(function(event) {
        event.preventDefault(); // Previene que se ejecute la acción

        if($(this).attr("method") === "post"){
            addUser(this);
        }else{
            updateData(this);
        }
    });

    $(document).on('click', '.delete-btn', function(){
        var userId = $(this).data('id');
        deleteUser(userId);
    });
});

function addUser(form){
    $.ajax({
        url: $(form).attr("action"),
        type: $(form).attr("method"),
        data: $(form).serialize(),
        success: function(resp) {
            console.log(resp);
            localStorage.setItem('lastResponse', JSON.stringify(resp)); // Guardar el JSON en localStorage

            setTimeout(function(){
                console.clear()
            }, 10000);

            if (resp.status === 'success') {
                window.location.href = resp.redirect; // Redirigir a la lista de usuarios
            }
        },
        error: function(xhr, status, error) {
            console.log("Error: " + error);
        }
    });
}

function showData() {
    $.ajax({
        url: jsonUrl,
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

function updateData(form) {
    // Recolecta los datos del formulario
    var formData = $(form).serialize();
    $.ajax({
        url: $(form).attr("action"), 
        type: $(form).attr("method"), 
        data: formData,
        dataType: 'json', 
        success: function(resp) {
            console.log(resp); 
            localStorage.setItem('lastResponse', JSON.stringify(resp)); // Guardar el JSON en localStorage

            setTimeout(function() {
                console.clear();
            }, 10000);

            if (resp.status === 'success') {
                window.location.href = resp.redirect; // Redirigir a la lista de usuarios
            }
        },
        error: function(xhr, status, error) {
            console.log("Error: " + error);
        }
    });
}

function deleteUser(id){
    $.ajax({
        url: 'users/' + id,
        type: 'DELETE',
        success: function(resp) {
            console.log(resp);
            localStorage.setItem('lastResponse', JSON.stringify(resp)); // Guardar el JSON en localStorage
            if (resp.status === 'success') {
                window.location.href = resp.redirect; // Redirigir a la lista de usuarios
            }
        },
        error: function(xhr, status, error) {
            console.log("Error: " + error);
        }
    });
}