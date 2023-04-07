window.onload = init;
function init(){
document.querySelectorAll('.vote-button').forEach((button) => {
    button.addEventListener('click', (event) => {
        
        console.log('Vote button clicked');

        const target = event.target;
        const postId = target.dataset.postId;
        const isUpvote = target.classList.contains('upvote');
        const voteCountElement = target.parentElement.querySelector('.vote-count');
  
        fetch('updatevotes.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              post_id: postId,
              upvote: isUpvote,
            }),
        })    
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    voteCountElement.textContent = data.new_vote_count;
                } else {
                    console.error('Failed to update votes');
                }
            })
            .catch((error) => {
                console.error('Error updating votes:', error);
            });
        });
    });
}