document.addEventListener('DOMContentLoaded', function () {
  const descContainer = document.getElementById('desc-text-container');
  const showMoreButton = document.getElementById('show-more');
  const showLessButton = document.getElementById('show-less');

  // Check if the text exceeds 2 lines
  if (descContainer.scrollHeight > descContainer.clientHeight) {
      showMoreButton.style.display = 'block';
  }

  // Handle "Show more" button click
  showMoreButton.addEventListener('click', function () {
      descContainer.classList.add('expanded');
      showMoreButton.style.display = 'none';
      showLessButton.style.display = 'block';
  });

  // Handle "Show less" button click
  showLessButton.addEventListener('click', function () {
      descContainer.classList.remove('expanded');
      showMoreButton.style.display = 'block';
      showLessButton.style.display = 'none';
  });
});

const createVideoComment = (e) => {
  e.preventDefault();

  // Create a FormData object from the form
  const formData = new FormData(e.target);

  // Get values using FormData.get
  const comment_text = formData.get("comment_text");

  console.log(comment_text);

  if (!comment_text) {
    showToast("Comment text is required");
    return;
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/comment", true);

  xhr.onload = function () {
    console.log(xhr.responseText);
    const data = JSON.parse(xhr.responseText);
    if (xhr.status === 200) {
      showToast(data.message);
    } else {
      showToast(data.message);
    }
  };

  // Set up the callback for errors
  xhr.onerror = function (error) {
    // Handle errors
    showToast(error);
  };

  xhr.send(formData);
};

const deleteMyComment = (e, commentId, popUpId) => {
  e.preventDefault();
  showPopUp(popUpId, () => submitDeleteAction(commentId));
};

const showCommentButtons = (e) => {
  const container = document.getElementById('comment-button-container');
  container.style.display = "flex";
}

const closeCommentButtons = (e) => {
  e.preventDefault();
  const container = document.getElementById('comment-button-container');
  container.style.display = "none";
}