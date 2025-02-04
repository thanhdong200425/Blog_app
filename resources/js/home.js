document.addEventListener("DOMContentLoaded", () => {
    if (!document.querySelector('meta[name="user-id"]').getAttribute("content")) return;
    setActiveStateFromCurrentUrl();
    setEventForModal();
    setEventForLogoutButton();
});

const setActiveStateFromCurrentUrl = () => {
    const currentPath = window.location.pathname.split("/").pop();
    const navButtons = document.querySelectorAll(".nav-button li a");
    navButtons.forEach((navButton) => navButton.classList.toggle("active", currentPath === navButton.id));
};

const setEventForLogoutButton = () => {
    document.querySelector("#logout").addEventListener("click", () => {
        document.querySelector("#logout-form").submit();
    });
};

const setEventForModal = () => {
    const avatarButton = document.querySelector(".avatar-button"),
        userModal = document.getElementById("userModal");
    // Toggle modal on avatar click
    avatarButton.addEventListener("click", (e) => {
        e.preventDefault();
        userModal.classList.toggle("active");
    });

    // Close modal when clicking outside
    document.addEventListener("click", (e) => {
        if (!avatarButton.contains(e.target) && !userModal.contains(e.target)) {
            userModal.classList.remove("active");
        }
    });
};
