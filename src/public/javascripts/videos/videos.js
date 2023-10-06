function dateTimeToString(datetime) {
  const dateTimeObj = new Date(datetime);
  const options = { year: "numeric", month: "short", day: "numeric" };
  return dateTimeObj.toLocaleDateString(undefined, options);
}

function createCommentCard(
  comment,
  noUser = false,
  settings = false,
  deleteAction = "",
  editAction = "",
  cardId = "",
  videoId
) {
  // Create a div element for the comment card
  const commentCardElement = document.createElement("div");
  commentCardElement.id = `card-${cardId}`;
  commentCardElement.className = "comment-box my-1";

  // Create the HTML content for the comment card
  const innerHTML = `
      <div class="flex justify-between">
          <div>
              <h4 class="text-bold">${comment.first_name} ${
    comment.last_name
  }</h4>
              <h5 class="text-grey">${dateTimeToString(comment.created_at)}
                  ${
                    comment.updated_at !== comment.created_at
                      ? `| updated ${dateTimeToString(comment.updated_at)}`
                      : ""
                  }
              </h5>
          </div>
          
          <div class="flex justify-center items-center">
              <a onclick="openEditInput(${videoId}, ${comment.comment_id}, '${
    comment.comment_text
  }')" class="video-card-button video-edit-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="2 2 20 20" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z" />
                </svg>
              </a>
              <button onclick="${deleteAction}" class="video-card-button video-delete-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="2 2 20 20" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>
              </button>
          </div>
      </div>
      <div id="comment-content">
        <p class="pt-2" id="paragraph-${comment.comment_id}">${
    comment.comment_text
  }</p>
      </div>
  `;

  // Set the HTML content for the comment card
  commentCardElement.innerHTML = innerHTML;

  return commentCardElement;
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

  // const xhr = new XMLHttpRequest();
  // const apiUrl = `/api/videos/${videoId}/comments`;

  // xhr.open("GET", apiUrl, true);
  // xhr.onload = function () {
  //   const htmlResponse = xhr.responseText;
  //   if (xhr.status === 200) {
  //     const htmlResponse = xhr.responseText;

  //     // Assuming that the response is a valid HTML string
  //     const parser = new DOMParser();
  //     const doc = parser.parseFromString(htmlResponse, "text/html");

  //     // Assuming the video-list is a div element where you want to append the HTML
  //     const commentContainer = document.getElementById("comment-section");

  //     // Clear existing content in the container
  //     commentContainer.innerHTML = "";

  //     // Append the new content
  //     const bodyChildren = Array.from(doc.body.children);
  //     bodyChildren.forEach((child) => {
  //       commentContainer.appendChild(child.cloneNode(true));
  //     });
  //   } else {
  //     jsonResponse = JSON.parse(xhr.responseText);
  //     showToast(jsonResponse.message);
  //   }
  // };
});

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

    // Assuming you have the comment data and other necessary variables
    const commentData = data.body.comment;

    const newCommentCard = createCommentCard(
      commentData,
      undefined, // noUser
      undefined, // settings
      "deleteMyComment(event, " +
        videoId +
        ", " +
        commentData.comment_id +
        ", 'popup-delete-comment')", // deleteAction
      undefined, // editAction
      commentData.comment_id, // cardId
      videoId
    );

    // Get the parent element where you want to append the comment card
    const commentSection = document.getElementById("comment-section");

    // Append the new comment card to the comment section
    commentSection.appendChild(newCommentCard);

    // Get a reference to the input element by its ID
    const inputElement = document.getElementById("comment_text_input");

    // Clear the value by setting it to an empty string
    inputElement.value = "";

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

  xhr.send(
    JSON.stringify({ comment_text: formData.get("comment_text_input") })
  );
};

const openEditInput = (video_id, comment_id, comment_text) => {
  const container = document.getElementById("edit-delete-button-container");
  container.classList.add("hidden");

  const paragraphElement = document.getElementById(`paragraph-${comment_id}`);

  const inputElement = document.createElement("div");
  inputElement.className = "pt-2";

  inputElement.innerHTML = `
  <form onsubmit="submitEditAction(event, ${video_id}, ${comment_id})">
    <textarea type="text" autocomplete="off" id="comment_text" name="comment_text" placeholder="Type your comment here" autofocus>${comment_text}</textarea>
    <div class="flex flex-col justify-end action-button-container" id="edit-button-container-${comment_id}">
        <button type="reset" onclick="closeEditCommentButtons(event, ${comment_id}, '${comment_text}')" id="cancel-comment-button" >Cancel</button>
        <button class="submit-comment-button" id="submit-comment-button" type="submit">Edit</button>
    </div>
  </form>
  `;

  // Replace the <p> element with the <textarea> element
  paragraphElement.parentNode.replaceChild(inputElement, paragraphElement);
};

const closeEditCommentButtons = (e, comment_id, comment_text) => {
  e.preventDefault();

  const container = document.getElementById("edit-delete-button-container");
  container.classList.remove("hidden");

  // Get references to the <p> and <textarea> elements
  const textareaElement = document.getElementById(`comment_text`);
  const paragraphElement = document.createElement("p");
  paragraphElement.id = `paragraph-${comment_id}`;
  // paragraphElement.className = "pt-2";

  // Copy the content of the <textarea> element to the <p>
  paragraphElement.textContent = comment_text;

  // Replace the <textarea> element with the <p> element
  textareaElement.parentNode.replaceChild(paragraphElement, textareaElement);

  // remove the buttons
  const buttonContainer = document.getElementById(
    `edit-button-container-${comment_id}`
  );
  if (buttonContainer) {
    buttonContainer.remove();
  }
};

const submitEditComment = (e, videoId, commentId, formData) => {
  // Create a new XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Set up the request
  const requestUrl = `/api/videos/${videoId}/comments/${commentId}`;
  xhr.open("POST", requestUrl, true);

  // Set up the event handler for when the request completes
  xhr.onload = function () {
    const data = JSON.parse(xhr.responseText);
    if (xhr.status == 200) {
      showToast(data.message);
    } else {
      showToast(data.message);
    }
  };

  // Set up the event handler for network errors
  xhr.onerror = function () {
    // Handle errors
    console.error("Error:", xhr.statusText);
  };

  // Send the request with the body
  xhr.send(formData);

  closeEditCommentButtons(e, commentId, formData.get(`comment_text`));
};

const submitEditAction = (e, videoId, commentId) => {
  e.preventDefault();
  const formData = new FormData(e.target);

  const comment_text = formData.get(`comment_text`);
  if (!comment_text) {
    showToast("Comment text is required");
    return;
  }

  showPopUp("popup-edit-comment", () =>
    submitEditComment(e, videoId, commentId, formData)
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

const closeCommentButtons = (e) => {
  e.preventDefault();
  const container = document.getElementById("comment-button-container");
  container.style.display = "none";

  const input = document.getElementById("comment_text_input");
  input.value = null;
};
