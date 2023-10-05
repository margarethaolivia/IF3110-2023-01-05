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
