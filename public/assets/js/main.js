// Remove Preloader When load page
window.addEventListener("load", function () {
    const preloader = document.getElementById("preloader");

    // Fade out the preloader
    preloader.style.opacity = 0;

    // Remove z-index after the fade out
    setTimeout(() => {
        preloader.classList.remove('z-[50000]');
        preloader.style.display = "none"; // Optionally remove from view
    }, 300); // Match the duration of your fade-out animation (500ms)
})

//-----------------------------------------
//Function for copy text 

function copyToClipboard(elementId, message) {
    const roleText = document.getElementById(elementId).textContent;
    navigator.clipboard.writeText(roleText).then(() => {
        iziToast.success({
            title: 'OK',
            message: message,
        });
    });
}