document.addEventListener("DOMContentLoaded", function () {
    const isOwner = document.querySelector('input[name="isOwner"]');
    if (isOwner) {
        // Create popup elements
        createPopUp();

        // Select popup elements
        const deletePopup = document.querySelector(".delete-popup");
        const overlay = document.querySelector(".overlay");
        const cancelBtn = document.querySelector(".popup-cancel");
        const deleteBtn = document.querySelector(".popup-delete");

        // Store the callback for delete action
        let deleteCallback = null;

        // Function to show popup
        function showDeleteConfirmation(callback) {
            deleteCallback = callback;
            deletePopup.classList.add("active");
            overlay.classList.add("active");
        }

        // Function to hide popup
        function hideDeleteConfirmation() {
            deletePopup.classList.remove("active");
            overlay.classList.remove("active");
            deleteCallback = null;
        }

        // Event listeners
        cancelBtn.addEventListener("click", hideDeleteConfirmation);
        overlay.addEventListener("click", hideDeleteConfirmation);
        deleteBtn.addEventListener("click", () => {
            if (deleteCallback) {
                deleteCallback();
            }
            hideDeleteConfirmation();
        });

        document.querySelector(".delete-action").addEventListener("click", () => {
            showDeleteConfirmation(() => handleSubmitForm());
        });
    }

    setEventForLikeButton();
});

const createPopUp = () => {
    const popupHTML = `
    <div class="overlay"></div>
    <div class="delete-popup">
        <h3>Confirm Delete</h3>
        <p>Are you sure you want to delete this item? This action cannot be undone.</p>
        <div class="popup-actions">
            <button class="popup-cancel">Cancel</button>
            <button class="popup-delete">Delete</button>
        </div>
    </div>
`;
    document.body.insertAdjacentHTML("beforeend", popupHTML);
};

const handleSubmitForm = () => {
    document.querySelector("#delete-form-article").submit();
};

// Set event for like button
const setEventForLikeButton = () => {
    const likeButton = document.querySelector(".votes .upvote");
    likeButton.addEventListener("click", (e) => {
        const entityId = parseInt(e.currentTarget.dataset.entityId),
            route = e.currentTarget.dataset.url;
        toggleLike(route, entityId);
    });
};

const toggleLike = async (route, entityId) => {
    try {
        const request = await fetch(route, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                entityId,
            }),
        });

        const response = await request.json();

        if (!request.ok) {
            showToast(response.error);
            return;
        }

        updateUI();
    } catch (error) {
        console.log(error);
    }
};

const updateUI = () => {
    document.querySelector(".upvote").classList.add("active");
    const likeCount = document.querySelector(".figure");
    likeCount.classList.add("active");
    likeCount.textContent = parseInt(likeCount.textContent) + 1;
};

const showToast = (message) => {
    const toast = `
        <div class="error-message">
            <div class="error-content">
                <svg viewBox="0 0 24 24" class="error-icon">
                    <path fill="currentColor"
                        d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                </svg>
                <span>${message}</span>
            </div>
        </div>
    `;
    document.body.insertAdjacentHTML("beforeend", toast);

    setTimeout(() => {
        const toastElement = document.querySelector(".error-message");
        if (toastElement) document.body.removeChild(toastElement);
    }, 6000);
};
