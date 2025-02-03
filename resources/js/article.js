import { formatDistanceToNow } from "date-fns";

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

    setEventForLikeButton(".votes .upvote", "upvote", "downvote", "figure");
    setEventForLikeButton(".votes .downvote", "upvote", "downvote", "figure");
    setEventForCommentButton();

    document.querySelectorAll(".comment-item").forEach(setupReplyHandlers);
    document.querySelectorAll(".reactions .reaction-btn[data-id]").forEach((button) => setCommentLikeHandlers(button));
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

const setEventForCommentButton = () => {
    document.querySelector(".submit-btn").addEventListener("click", async (e) => {
        try {
            e.preventDefault();
            const contentPart = document.querySelector("#content"),
                articleId = document.querySelector('input[name="article_id"]').value,
                url = document.querySelector('input[name="url"]').value;
            const newComment = await addAComment(url, contentPart.value.trim(), articleId);
            contentPart.value = "";
            createCommentComponent(newComment.data);
        } catch (error) {
            console.log("Error in setCommentButton: " + error);
        }
    });
};

const addAComment = async (url, content, articleId, parentId = null) => {
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                content,
                articleId,
                ...(parentId && { parentId }),
            }),
        });

        const data = await response.json();
        return data;
    } catch (error) {
        console.log("Error in addAComment function: " + error);
        return;
    }
};

const createCommentComponent = (newCommentData, targetComment = null) => {
    const listComment = document.querySelector(".comments-list");
    const newCommentPart = document.createElement("div");
    newCommentPart.classList.add("comment-item");
    newCommentPart.style.marginLeft = `${Math.min(newCommentData.path.split(".").length - 1, 3) * 60}px`;
    newCommentPart.dataset.id = newCommentData.id;
    newCommentPart.innerHTML = `
                        <div class="comment-user">
                            <img src="${newCommentData.author.image_url}" alt="Commenter avatar" />
                        </div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <div class="user-info">
                                    <h4>${newCommentData.author.username}</h4>
                                    <span class="time">${formatDistanceToNow(new Date(newCommentData.created_at))}</span>
                                </div>
                                <div class="comment-actions">
                                    <button class="action-btn">
                                        <img src="/icons/dots-icon.svg" alt="More actions" />
                                    </button>
                                </div>
                            </div>
                            <p>${newCommentData.content}</p>
                            <div class="comment-footer">
                                <div class="reactions">
                                    <button class="reaction-btn" data-id="${newCommentData.id}">
                                        <img src="/icons/like-icon.svg" alt="Like" />
                                        <span class="comment-figure">0</span>
                                    </button>
                                    <button class="reaction-btn reply-trigger">
                                        <img src="/icons/reply-icon.svg" alt="Reply" />
                                        <span>Reply</span>
                                    </button>
                                </div>
                            </div>
                            <div class="reply-section">
                                <div class="reply-input-wrapper">
                                    <div class="user-avatar">
                                        <img src="${newCommentData.author.image_url}" alt="Your avatar" />
                                    </div>
                                    <div class="reply-content">
                                        <textarea placeholder="Write a reply..."></textarea>
                                        <div class="reply-actions">
                                            <button class="reply-cancel">Cancel</button>
                                            <button class="reply-submit">Reply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    `;
    setupReplyHandlers(newCommentPart);
    setCommentLikeHandlers(newCommentPart.querySelector(".reaction-btn"));
    targetComment && targetComment.parentNode ? targetComment.parentNode.insertBefore(newCommentPart, targetComment.nextSibling) : listComment.appendChild(newCommentPart);
};

function setupReplyHandlers(commentElement) {
    const replyTrigger = commentElement.querySelector(".reply-trigger");
    const replySection = commentElement.querySelector(".reply-section");
    const replyCancel = commentElement.querySelector(".reply-cancel");
    const replySubmit = commentElement.querySelector(".reply-submit");
    const replyTextarea = commentElement.querySelector(".reply-content textarea");

    replyTrigger.addEventListener("click", () => {
        document.querySelectorAll(".reply-section.active").forEach((section) => {
            if (section !== replySection) {
                section.classList.remove("active");
            }
        });
        replySection.classList.toggle("active");
        if (replySection.classList.contains("active")) {
            replyTextarea.focus();
        }
    });

    replyCancel.addEventListener("click", () => {
        replySection.classList.remove("active");
        replyTextarea.value = "";
    });

    replySubmit.addEventListener("click", async (e) => {
        try {
            const replyContent = replyTextarea.value.trim(),
                parentCommentId = commentElement.dataset.id,
                articleId = document.querySelector('input[name="article_id"]').value,
                url = document.querySelector('input[name="url"]').value,
                parentComponent = e.target.closest(".comment-item");

            if (!replyContent) return;

            const newComment = await addAComment(url, replyContent, articleId, parentCommentId);
            replySection.classList.remove("active");
            createCommentComponent(newComment.data, parentComponent);
        } catch (error) {
            console.log("Error when hit reply button: " + error);
        }
    });
}

// Set event for like button (article)
const setEventForLikeButton = (className, likeClassName, unlikeClassName, figureClassName) => {
    document.querySelector(className).addEventListener("click", (e) => {
        const entityId = parseInt(e.currentTarget.dataset.entityId),
            route = e.currentTarget.dataset.url;
        toggleLike(route, entityId, "article", likeClassName, unlikeClassName, figureClassName);
    });
};

// Set event for like button (comment)
const setCommentLikeHandlers = (button) => {
    button.addEventListener("click", (e) => {
        const commentId = parseInt(e.currentTarget.dataset.id);
        const likeRoute = document.querySelector("span.upvote").dataset.url;

        toggleLike(likeRoute, commentId, "comment", `reaction-btn[data-id="${commentId}"]`, null, `reaction-btn[data-id="${commentId}"] .comment-figure`);
    });
};

const toggleLike = async (route, entityId, type, likeClassName, unlikeClassName, figureClassName) => {
    try {
        const request = await fetch(route, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({
                entityId,
                type,
            }),
        });

        const response = await request.json();

        if (!request.ok) {
            showToast(response.error);
            return;
        }
        updateUI(likeClassName, unlikeClassName, figureClassName, response.liked);
    } catch (error) {
        console.log(error);
    }
};

const updateUI = (likeClassName, unlikeClassName, figureClassName, isLike) => {
    document.querySelector(`.${likeClassName}`).classList.toggle("active");
    unlikeClassName && document.querySelector(`.${unlikeClassName}`).classList.toggle("active");
    const likeCount = document.querySelector(`.${figureClassName}`);
    likeCount.classList.toggle("active", isLike);
    likeCount.textContent = isLike ? parseInt(likeCount.textContent) + 1 : parseInt(likeCount.textContent) - 1;
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
