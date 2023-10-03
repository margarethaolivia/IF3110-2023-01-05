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
