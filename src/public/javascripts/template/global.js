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