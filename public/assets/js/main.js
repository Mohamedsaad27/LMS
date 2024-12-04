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

//--------------------------------------------
// Make labal permistion like removed 
function togglePermissionStyle(checkbox, roleIdPermissionId) {
    const label = document.getElementById('permissionLabel' + roleIdPermissionId);
    if (checkbox.checked) {
        label.style.textDecoration = 'line-through';
        label.classList.add('text-gray-500');
        checkbox.closest('div').classList.remove('hover-bg-gray-200');
    } else {
        label.style.textDecoration = 'none';
        label.classList.remove('text-gray-500');
        checkbox.closest('div').classList.add('hover-bg-gray-200');
    }
}

// Run the function for all checkboxes on page load
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[name="permissions[]"]').forEach(function (checkbox) {
        togglePermissionStyle(checkbox, checkbox.id.replace('permissionCheck', ''));
    });
}); 