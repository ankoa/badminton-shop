const initSlider = () => {
    const imageList = document.querySelector(".slider-wrapper .image-list");
    const slideButtons = document.querySelectorAll(".slider-wrapper .slide-button");
    const maxScrollLeft = imageList.scrollWidth - imageList.clientWidth;
    const imageWidth = imageList.children[0].clientWidth; // Assuming all images have the same width
    const bigImageContainer = document.querySelector('.big-img');

    // Function to slide images
    const slideImages = (direction) => {
        const scrollAmount = direction === -1 ? -imageWidth - 18 : imageWidth + 18;
        imageList.scrollBy({ left: scrollAmount, behavior: "smooth" });
    };

    // Slide images according to the slide button clicks
    slideButtons.forEach(button => {
        button.addEventListener("click", () => {
            const direction = button.id === "prev-slide" ? -1 : 1;
            slideImages(direction);
        });
    });

    // Show or hide slide buttons based on scroll position
    const handleSlideButtons = () => {
        slideButtons[0].style.display = imageList.scrollLeft <= 0 ? "none" : "flex";
        slideButtons[1].style.display = imageList.scrollLeft >= maxScrollLeft ? "none" : "flex";
    };

    // Call handleSlideButtons function initially
    handleSlideButtons();

    // Call handleSlideButtons function when image list scrolls
    imageList.addEventListener("scroll", handleSlideButtons);

    // Function to display the clicked image in the big-img container
    const displayBigImage = (src) => {
        const bigImage = document.createElement('img');
        bigImage.src = src;
        bigImage.style.maxWidth = '100%';
        bigImage.style.maxHeight = '100%';
        bigImage.style.objectFit = 'cover';
        // Clear previous big image
        bigImageContainer.innerHTML = '';
        // Append new big image
        bigImageContainer.appendChild(bigImage);
    };

    const handleClickOnImage = (event) => {
        // Remove class .testimg from all images in the slider
        imageList.querySelectorAll('.image-item').forEach(image => {
            image.classList.remove('img-chosen-border');
        });
    
        // Add class .testimg to the clicked image
        event.target.classList.add('img-chosen-border');
    
        const clickedImageSrc = event.target.src;
        displayBigImage(clickedImageSrc);
    };

    // Add event listener to images in the slider
    imageList.querySelectorAll('.image-item').forEach(image => {
        image.addEventListener('click', handleClickOnImage);
    });

    // Display the first image in the big-img container on page load
    const firstImageSrc = imageList.querySelector('.image-item').src;
    displayBigImage(firstImageSrc);

    // Select the first image in the slider
    const firstImage = imageList.querySelector('.image-item');

    // Add class .testimg to the first image
    firstImage.classList.add('img-chosen-border');
};



// Call initSlider function on window resize and page load
window.addEventListener("resize", initSlider);
window.addEventListener("load", initSlider);

document.addEventListener("DOMContentLoaded", function() {
    const tabButtons = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".tab-content");

    tabButtons.forEach(button => {
        button.addEventListener("click", () => {
            const tabId = button.getAttribute("data-tab");

            // Deactivate all tab buttons and hide tab contents
            tabButtons.forEach(btn => btn.classList.remove("active"));
            tabContents.forEach(content => content.style.display = "none");

            // Activate the clicked tab button and display its content
            button.classList.add("active");
            document.getElementById(tabId).style.display = "block";
        });
    });
});
