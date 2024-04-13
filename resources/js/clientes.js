$(document).ready(function (e) {
    $("#imagen").change(function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $("#imagenSeleccionada").attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });
});
