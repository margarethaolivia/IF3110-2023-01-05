document.addEventListener('DOMContentLoaded', function () {
  const descContainer = document.getElementById('desc-text-container');

  if (descContainer)
  {
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
  }
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

const submitTakeDown = (e, videoId) =>
{
  e.preventDefault();
  // Create a FormData object from the form
  const formData = new FormData(e.target);

  // Get values using FormData.get
  const take_down_comment = formData.get("take_down_comment");
  if (!take_down_comment) {
    showToast("Takedown comment is required");
    return;
  }

  // Create headers for the request
  const headers = new Headers();
  headers.append('Content-Type', 'application/json');

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Set up the request
  xhr.open("PATCH", `/api/videos/${videoId}`, true);
  xhr.setRequestHeader('Content-Type', 'application/json');

  // Set up the event handler for when the request completes
  xhr.onload = function () {
    
      const data = JSON.parse(xhr.responseText);
      if (xhr.status == 200) {
          const undoTakeDownButton = document.getElementById('undo-takedown-button');
          const showTakeDownButton = document.getElementById('show-takedown-button');
          const takeDownForm = document.getElementById('takedown-form');

          undoTakeDownButton.style.display = "block";
          showTakeDownButton.style.display = "none";
          takeDownForm.style.display = "none";
          
          showToast("Video is taken down");
      } else {

          // Handle the response data
          showToast(data.message);
      }
  };

  // Set up the event handler for network errors
  xhr.onerror = function () {
      // Handle errors
      console.error('Error:', xhr.statusText);
  };

   // Send the request with the body
  xhr.send(JSON.stringify({take_down_comment, is_taken_down: true}));
}

const undoTakeDown = (e, videoId) =>
{
  e.preventDefault();

  // Create headers for the request
  const headers = new Headers();
  headers.append('Content-Type', 'application/json');

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Set up the request
  xhr.open("PATCH", `/api/videos/${videoId}`, true);
  xhr.setRequestHeader('Content-Type', 'application/json');

  // Set up the event handler for when the request completes
  xhr.onload = function () {
      const data = JSON.parse(xhr.responseText);
      if (xhr.status == 200) {

          const undoTakeDownButton = document.getElementById('undo-takedown-button');
          const showTakeDownButton = document.getElementById('show-takedown-button');

          undoTakeDownButton.style.display = "none";
          showTakeDownButton.style.display = "block";

          showToast("Takedown undone");
      } else {

          // Handle the response data
          showToast(data.message);
      }
  };

  // Set up the event handler for network errors
  xhr.onerror = function () {
      // Handle errors
      console.error('Error:', xhr.statusText);
  };

   // Send the request with the body
  xhr.send(JSON.stringify({take_down_comment: null, is_taken_down: false}));
}


const showTakeDown = (e) => {
  const form = document.getElementById('takedown-form');
  const showButton = document.getElementById('show-takedown-button');
  form.style.display = "block";
  showButton.style.display = "none";
}

const closeTakeDownButtons = (e) => {
  e.preventDefault();
  const form = document.getElementById('takedown-form');
  const showButton = document.getElementById('show-takedown-button');
  form.style.display = "none";
  showButton.style.display = "block";
}

const showCommentButtons = (e) => {
  const container = document.getElementById('comment-button-container');
  container.style.display = "flex";
}

const closeCommentButtons = (e) => {
  e.preventDefault();
  const container = document.getElementById('comment-button-container');
  container.style.display = "none";
}