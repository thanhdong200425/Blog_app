document.addEventListener("DOMContentLoaded", function () {
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

    // Add click handler to delete buttons/icons
    // document.querySelector(".article-statistical .delete-action").addEventListener("click", (e) => {
    //     e.preventDefault();
    //     showDeleteConfirmation(handleSubmitForm);
    // });

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
            entityTypeId = parseInt(e.currentTarget.dataset.entityTypeId),
            route = e.currentTarget.dataset.url;
        toggleLike(route, entityId, entityTypeId);
    });
};

const toggleLike = async (route, entityId, entityTypeId) => {
    try {
        const request = await fetch(route, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                entityId: entityId,
                entityTypeId: entityTypeId,
            }),
        });

        const response = await request.json();
        console.log("Response: " + response);
    } catch (error) {
        console.log(error);
    }
};
