(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

document.getElementById('image').addEventListener('change', function(e){
    if(e.target.files.length > 0){
        var src = URL.createObjectURL(e.target.files[0]);
        var preview = document.getElementById("selectedImage");
        preview.src = src;
        preview.style.display = "block";
    }
});

document.getElementById('selectedImage').addEventListener('click', function(){
    document.getElementById('image').click();
});