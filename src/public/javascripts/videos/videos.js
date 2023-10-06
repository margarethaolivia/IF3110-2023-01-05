function dateTimeToString(datetime) {
  const dateTimeObj = new Date(datetime);
  const options = { year: "numeric", month: "short", day: "numeric" };
  return dateTimeObj.toLocaleDateString(undefined, options);
}

document.addEventListener("DOMContentLoaded", function () {

  const descContainer = document.getElementById("desc-text-container");

  if (descContainer) {
    const showMoreButton = document.getElementById("show-more");
    const showLessButton = document.getElementById("show-less");

    // Check if the text exceeds 2 lines
    if (descContainer.scrollHeight > descContainer.clientHeight) {
      showMoreButton.style.display = "block";
    }

    // Handle "Show more" button click
    showMoreButton.addEventListener("click", function () {
      descContainer.classList.add("expanded");
      showMoreButton.style.display = "none";
      showLessButton.style.display = "block";
    });

    // Handle "Show less" button click
    showLessButton.addEventListener("click", function () {
      descContainer.classList.remove("expanded");
      showMoreButton.style.display = "block";
      showLessButton.style.display = "none";
    });
  }

  fetchComments();
});

const fetchComments = () => {
  console.log("what");
  const path = window.location.pathname;
  const pathSegments = path.split('/');
  const lastSegment = pathSegments.pop(); // Removes the last segment from the array and returns it

  const videoId = lastSegment;

  const xhr = new XMLHttpRequest();
  const apiUrl = `/api/videos/${videoId}/comments`;

  xhr.open("GET", apiUrl, true);
  xhr.onload = function () {
    const jsonResponse = JSON.parse(xhr.responseText);
    if (xhr.status === 200) {

      // Assuming that the response is a valid HTML string
      const parser = new DOMParser();
      const doc = parser.parseFromString(jsonResponse.body.comment_list_html, "text/html");

      // Assuming the video-list is a div element where you want to append the HTML
      const commentContainer = document.getElementById("comment-section");

      // Clear existing content in the container
      commentContainer.innerHTML = "";

      // Append the new content
      const bodyChildren = Array.from(doc.body.children);
      bodyChildren.forEach((child) => {
        commentContainer.appendChild(child.cloneNode(true));
      });

      document.querySelector('.comment-title').textContent = `${bodyChildren.length} Comment(s)`
    } else {

      showToast(jsonResponse.message);
    }
  };

  xhr.send();
}

const createVideoComment = (e, videoId) => {
  e.preventDefault();

  // Create a FormData object from the form
  const formData = new FormData(e.target);

  // Get values using FormData.get
  const comment_text = formData.get("comment_text_input");

  if (!comment_text) {
    e.preventDefault();
    showToast("Comment text is required");
    return;
  }

  showPopUp("popup-post-comment", () => submitCreateComment(videoId, formData));
};

const submitCreateComment = (videoId, formData) => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", `/api/videos/${videoId}/comments`, true);

  xhr.onload = function () {

    const data = JSON.parse(xhr.responseText);

    const parser = new DOMParser();
    const commentCardContainer = parser.parseFromString(
      data.body.comment_card_html,
      "text/html"
    );

    console.log(commentCardContainer);

    const newCommentCard = commentCardContainer.body.firstChild;

    // Get the parent element where you want to append the comment card
    const commentSection = document.getElementById("comment-section");

    // Append the new comment card to the comment section
    commentSection.appendChild(newCommentCard);

    // Get a reference to the input element by its ID
    const inputElement = document.getElementById("comment_text_input");

    // Clear the value by setting it to an empty string
    inputElement.value = "";

    if (xhr.status === 201) {
      closeCommentButtons();
    }

    showToast(data.message);
  };

  // Set up the callback for errors
  xhr.onerror = function (error) {
    // Handle errors
    showToast(error);
  };

  xhr.send(
    JSON.stringify({ comment_text: formData.get("comment_text_input") })
  );
};

const openEditInput = (event, paragraphId) => {
  const container = event.target.closest("#edit-delete-button-container");
  container.classList.add("hidden");

  const paragraphElement = document.getElementById(paragraphId);
  const formElement = paragraphElement.closest('#comment-content').querySelector('.edit-form-container');
  const input = formElement.querySelector('textarea');

  input.value = paragraphElement.textContent;
  paragraphElement.classList.add("hidden");
  formElement.classList.remove("hidden");
};

const closeEditCommentButtons = ({e=null, target=null, cancel=false}) => {

  if (e)
  {
    e.preventDefault();
    target = e.currentTarget;
  }

  if (target)
  {
    const container = document.getElementById("edit-delete-button-container");
    container.classList.remove("hidden");

    // Get references to the <p> and <textarea> elements
    parent = target.closest('#comment-content');
    const formContainer = parent.querySelector('.edit-form-container');
    const textareaElement = formContainer.querySelector('textarea');
    const paragraphElement = parent.querySelector("p");

    // Copy the content of the <textarea> element to the <p>
    if (!cancel) paragraphElement.textContent = textareaElement.value;
    textareaElement.value = null;
    formContainer.classList.add("hidden");
    paragraphElement.classList.remove("hidden");

  }
};

const submitEditComment = (target, videoId, commentId, formData) => {
  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Set up the request
  const requestUrl = `/api/videos/${videoId}/comments/${commentId}`;
  xhr.open("POST", requestUrl, true);

  // Set up the event handler for when the request completes
  xhr.onload = function () {
    const data = JSON.parse(xhr.responseText);
    if (xhr.status == 200) {
      closeEditCommentButtons({target});
    }

    showToast(data.message);
  };

  // Set up the event handler for network errors
  xhr.onerror = function () {
    // Handle errors
    console.error("Error:", xhr.statusText);
  };

  // Send the request with the body
  xhr.send(formData);
};

const submitEditAction = (e, videoId, commentId) => {
  e.preventDefault();
  const target = e.currentTarget;
  const formData = new FormData(e.target);

  const comment_text = formData.get(`comment_text`);
  if (!comment_text) {
    showToast("Comment text is required");
    return;
  }

  showPopUp("popup-edit-comment", () =>
    submitEditComment(target, videoId, commentId, formData)
  );
};

const submitDeleteAction = (videoId, commentId) => {
  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Set up the request
  const requestUrl = `/api/videos/${videoId}/comments/${commentId}`;
  xhr.open("DELETE", requestUrl, true);

  // Set up the event handler for when the request completes
  xhr.onload = function () {
    if (xhr.status == 200) {
      // Remove the DOM element with the ID "card-{commentId}"
      const commentCardElement = document.getElementById(`card-${commentId}`);
      if (commentCardElement) {
        commentCardElement.remove();
      }

      // If not a redirect, proceed with handling the response
      const data = JSON.parse(xhr.responseText);
      // Handle the response data
      showToast(data.message);
    } else {
      // If not a redirect, proceed with handling the response
      const data = JSON.parse(xhr.responseText);
      // Handle the response data
      showToast(data.message);
    }
  };

  // Set up the event handler for network errors
  xhr.onerror = function () {
    // Handle errors
    console.error("Error:", xhr.statusText);
  };

  // Send the request with the body
  xhr.send();
};

const deleteMyComment = (e, videoId, commentId, popUpId) => {
  e.preventDefault();
  showPopUp(popUpId, () => submitDeleteAction(videoId, commentId));
};

const requestTakeDown = (videoId, take_down_comment) => {
  // Create headers for the request
  const headers = new Headers();
  headers.append("Content-Type", "application/json");

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Set up the request
  xhr.open("PATCH", `/api/videos/${videoId}`, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  // Set up the event handler for when the request completes
  xhr.onload = function () {
    const data = JSON.parse(xhr.responseText);
    if (xhr.status == 200) {
      const undoTakeDownButton = document.getElementById(
        "undo-takedown-button"
      );
      const showTakeDownButton = document.getElementById(
        "show-takedown-button"
      );
      const takeDownForm = document.getElementById("takedown-form");

      undoTakeDownButton.classList.remove("hidden");
      showTakeDownButton.classList.add("hidden");
      takeDownForm.classList.add("hidden");

      const parser = new DOMParser();
      const takeDownInfo = parser.parseFromString(
        data.body.take_down_info_html,
        "text/html"
      );

      const takeDownContainer = document.getElementById("takedown-container");

      // Clear existing content in the container
      takeDownContainer.innerHTML = "";

      // Append the new content
      const bodyChildren = Array.from(takeDownInfo.body.children);
      bodyChildren.forEach((child) => {
        takeDownContainer.appendChild(child.cloneNode(true));
      });

      showToast("Video is taken down");
    } else {
      // Handle the response data
      showToast(data.message);
    }
  };

  // Set up the event handler for network errors
  xhr.onerror = function () {
    // Handle errors
    console.error("Error:", xhr.statusText);
  };

  // Send the request with the body
  xhr.send(JSON.stringify({ take_down_comment, is_taken_down: true }));
};

const submitTakeDown = (e, videoId, popUpId) => {
  e.preventDefault();
  // Create a FormData object from the form
  const formData = new FormData(e.target);

  // Get values using FormData.get
  const take_down_comment = formData.get("take_down_comment");
  if (!take_down_comment) {
    showToast("Takedown comment is required");
    return;
  }

  showPopUp(popUpId, () => requestTakeDown(videoId, take_down_comment));
};

const submitTakeDownUndo = (videoId) => {
  // Create headers for the request
  const headers = new Headers();
  headers.append("Content-Type", "application/json");

  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Set up the request
  xhr.open("PATCH", `/api/videos/${videoId}`, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  // Set up the event handler for when the request completes
  xhr.onload = function () {
    const data = JSON.parse(xhr.responseText);
    if (xhr.status == 200) {
      const undoTakeDownButton = document.getElementById(
        "undo-takedown-button"
      );
      const showTakeDownButton = document.getElementById(
        "show-takedown-button"
      );

      const takeDownContainer = document.getElementById("takedown-container");
      takeDownContainer.innerHTML = "";

      undoTakeDownButton.classList.add("hidden");
      showTakeDownButton.classList.remove("hidden");

      showToast("Takedown undone");
    } else {
      // Handle the response data
      showToast(data.message);
    }
  };

  // Set up the event handler for network errors
  xhr.onerror = function () {
    // Handle errors
    console.error("Error:", xhr.statusText);
  };

  // Send the request with the body
  xhr.send(JSON.stringify({ take_down_comment: null, is_taken_down: false }));
};

const undoTakeDown = (e, videoId, popUpId) => {
  e.preventDefault();
  showPopUp(popUpId, () => submitTakeDownUndo(videoId));
};

const showTakeDown = (e) => {
  const form = document.getElementById("takedown-form");
  const showButton = document.getElementById("show-takedown-button");
  form.classList.remove("hidden");
  showButton.classList.add("hidden");
};

const closeTakeDownButtons = (e) => {
  e.preventDefault();
  const form = document.getElementById("takedown-form");
  const showButton = document.getElementById("show-takedown-button");
  const input = document.getElementById("take-down-comment-input");
  form.classList.add("hidden");
  showButton.classList.remove("hidden");
  input.value = null;
};

const showCommentButtons = (e) => {
  const container = document.getElementById("comment-button-container");
  container.classList.remove("hidden");
  container.style.display = "flex";
};

const closeCommentButtons = (e=null) => {
  if (e)
  {
    e.preventDefault();
  }
  console.log("bruh");

  const container = document.getElementById("comment-button-container");
  container.classList.add("hidden");

  const input = document.getElementById("comment_text_input");
  input.value = null;
};
