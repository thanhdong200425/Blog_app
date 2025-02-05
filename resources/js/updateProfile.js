document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#image_url").addEventListener("change", (e) => {
        previewImage(e.target);
    });
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("preview-image").src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
