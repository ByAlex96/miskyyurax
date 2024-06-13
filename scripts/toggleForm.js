function toggleForm(idCita) {
    var form1 = document.getElementById('form_info-' + idCita);
    var form2 = document.getElementById('form-' + idCita);
    if (form2.classList.contains('show')) {
        form2.classList.remove('show');
        form1.classList.remove('hide');
    } else {
        form2.classList.add('show');
        form1.classList.add('hide');
    }
}

function toggleForm(formId) {
    var crearForm = document.getElementById('crearForm');
    var modificarForm = document.getElementById('modificarForm');

    if (formId === 'crear') {
        window.location.href = '/miskyyurax/views/perfil/registrar.php';
        // Aquí podrías ocultar otros formularios si es necesario
    } else if (formId === 'modificar') {
        modificarForm.style.display = modificarForm.style.display === 'none' ? 'block' : 'none';
        crearForm.style.display = 'none';
    }
}
