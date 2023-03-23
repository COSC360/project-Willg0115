function showCommentForm(element) {
    const commentForm = element.nextElementSibling;
    commentForm.style.display = "block";
}

function hideCommentForm(element) {
    const commentForm = element.parentElement.parentElement;
    commentForm.style.display = "none";
}
