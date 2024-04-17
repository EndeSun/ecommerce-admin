// Seleccionar todos los inputs de color y los inputs de texto
const colorPickers = document.querySelectorAll('.colorPicker');
const colorPickerTexts = document.querySelectorAll('.colorPickerText');

let oldColor = "";

// Iterar sobre cada input de color y asignar el evento de cambio
colorPickers.forEach((colorPicker, index) => {
    colorPicker.addEventListener('input', function() {
        // Obtener el valor seleccionado en el input de color
        const selectedColor = colorPicker.value;
        // Actualizar el valor del input de texto correspondiente con el color seleccionado
        colorPickerTexts[index].value = selectedColor;
    });
});

/* When update modal is opened */
$('.modal-put').on('show.bs.modal', function () {
    const modal = $(this);
    oldColor = modal.find('.colorPickerText').val();
});

/* When update modal is closed */
$('.modal-put').on('hide.bs.modal', function () {
    const modal = $(this);
    // Restaurar el color anterior a cada input de texto correspondiente
    modal.find('.colorPickerText').val(oldColor);
    modal.find('.colorPicker').val(oldColor);
});


/* ---------- */
/* ---------- */
/* ---------- */

//Para el modal de añadir categorías:
const colorPickersAdd = document.getElementById('colorPickerAdd');
const colorPickerTextsAdd = document.getElementById('colorPickerTextAdd');

/* When update modal is closed */
$('.modal-add').on('hide.bs.modal', function () {
    colorPickerTextsAdd.value = '#effadc';
    colorPickersAdd.value = '#effadc';
});

colorPickersAdd.addEventListener('input', function() {
    colorPickerTextsAdd.value = colorPickersAdd.value;
});