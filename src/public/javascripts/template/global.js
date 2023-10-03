function closeToast(toastContainer, toastElement) {
    // Remove the provided toast element
    toastElement.classList.add('disappear');
    setTimeout(() => {
        toastContainer.removeChild(toastElement);
    }, 500); 
}

function showToast(message, duration = 5000) {
    const limit = 3;

    const toastContainer = document.querySelector('.toast-container');
    // Check if the maximum limit is reached
    
    var num = toastContainer.children.length;

    while (num >= limit) {
        // Check if the first child is an element node
        if (toastContainer.firstChild instanceof Element) {
            toastContainer.removeChild(toastContainer.firstChild);
        } else {
            // If it's not an element node, remove it in a different way
            toastContainer.removeChild(toastContainer.childNodes[0]);
        }
    
        // Update the count after removing a child
        num = toastContainer.children.length;
    }
    
    // Create a new toast element
    const newToast = document.createElement('div');
    newToast.classList.add('flex', 'flex-col', 'items-center', 'justify-between', 'toast');
    newToast.innerHTML = `
        <div class="toast-value-container no-scrollbar">
            <p>${message}</p>
        </div>
        <button class="close-button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    `;

    const closeButton = newToast.querySelector('.close-button');
    closeButton.addEventListener('click', () => {
        closeToast(toastContainer, newToast);
    });

    // Add the new toast to the container
    toastContainer.appendChild(newToast);
    setTimeout(() => {
        newToast.classList.add('appear');
    }, 10); // Adjust the delay as needed

    setTimeout(() => {
        // Check if the toast still exists in the DOM before attempting to remove it
        if (newToast.parentNode === toastContainer) {
            newToast.classList.add('disappear');
        }
    }, duration);

    // Set a timer to remove the toast after the specified duration
    setTimeout(() => {
        // Check if the toast still exists in the DOM before attempting to remove it
        if (newToast.parentNode === toastContainer) {
            toastContainer.removeChild(newToast);
        }
    }, duration + 500);
}

const addPopUpAction = (popUpElement, action) => {
    const actionButton = popUpElement.querySelector('.action-button');
    const initialAction = actionButton.onclick;

    if (actionButton && initialAction) {
        const actions = () => {
            action();
            closePopUp({target: actionButton});
            actionButton.onclick = initialAction;
        }
        
        actionButton.onclick = actions;
    }
}

const closePopUp = (e) => {

    const targetElement = e.target;
    const popupContainers = document.getElementsByClassName('popup-container');

    // Check if the clicked element is a child of any popup container
    Array.from(popupContainers).forEach((popupContainer) => {
        if (popupContainer.contains(targetElement)) {
            popupContainer.style.display = 'none';
        }
    });
    
}
