jQuery(document).ready(function ($) {

    function initializeSortable() {
        $(".variation-gallery-container").each(function () {
            const container = $(this);

            container.sortable({
                items: ".variation-gallery-item",
                cursor: "move",
                placeholder: "sortable-placeholder",
                forcePlaceholderSize: true,
                tolerance: "pointer",
                stop: function (event, ui) {
                    const variationId = container.attr("id").split("-").pop();
                    const inputField = $(`#variation-gallery-input-${variationId}`);

                    const updatedOrder = container.find(".variation-gallery-item").map(function () {
                        return $(this).data("image-id");
                    }).get();

                    inputField.val(updatedOrder.join(","));
                },
            });
        });
    }

// Use a delay to ensure dynamic content is loaded
    setTimeout(initializeSortable, 500);

// Alternatively, listen for changes in the DOM
    const observer = new MutationObserver((mutationsList, observer) => {
        initializeSortable(); // Re-initialize sortable on DOM changes
    });
    observer.observe(document.body, { childList: true, subtree: true });



    // Upload images
    // Upload images
    // Upload images
    // Upload images
    $(document).on("click", ".upload-variation-gallery-image", function (e) {
        e.preventDefault();

        const button = $(this);
        const variationId = button.data("variation-id");
        const inputField = $(`#variation-gallery-input-${variationId}`);
        const galleryContainer = $(`#gallery-container-${variationId}`);

        const mediaUploader = wp.media({
            title: "Select Images",
            button: { text: "Add to Gallery" },
            multiple: true,
        }).on("select", function () {
            const attachments = mediaUploader.state().get("selection").toJSON();
            let imageIds = inputField.val().split(",").filter(Boolean); // Get current image IDs

            attachments.forEach(attachment => {
                if (!imageIds.includes(String(attachment.id))) {
                    imageIds.push(attachment.id); // Add new ID
                    galleryContainer.append(`
                    <li class="variation-gallery-item" data-image-id="${attachment.id}">
                        <img src="${attachment.url}" alt="" width="60" height="60">
                        <button type="button" class="variation-gallery-remove" data-image-id="${attachment.id}">&times;</button>
                    </li>
                `);
                }
            });

            // Debugging: Log updated image IDs
            console.log("Updated image IDs:", imageIds);

            inputField.val(imageIds.join(",")); // Update the input field
        });

        mediaUploader.open();
    });




    // Remove image
    // Remove image
    // Remove image
    // Remove image
    // Remove image
    $(document).on("click", ".variation-gallery-remove", function () {
        const button = $(this);
        const imageId = button.data("image-id");
        const container = button.closest(".variation-gallery-item");
        const inputField = button.closest(".form-row").find("input[type=hidden][id^=variation-gallery-input-]");

        // Debugging: Log current image IDs
        console.log("Before removal:", inputField.val());

        // Remove image ID from input value
        let imageIds = inputField.val().split(",").filter(Boolean); // Ensure array
        imageIds = imageIds.filter(id => String(id) !== String(imageId)); // Remove the selected ID
        inputField.val(imageIds.join(",")); // Update the input field value

        // Debugging: Log updated image IDs
        console.log("After removal:", inputField.val());

        // Remove the image from the DOM
        container.remove();
    });


});


document.addEventListener('DOMContentLoaded', function() {
    var helpButton = document.querySelector('.help-button-carousel');
    var helpImageContainer = document.querySelector('.help-image');
    var popup = document.getElementById('popup-container');
    var imageSrc = popup.getAttribute('value');
    var closeBtn = document.querySelector('.close');

    helpButton.addEventListener('click', function() {
        // Clear existing content to avoid duplicating the image
        helpImageContainer.innerHTML = '';

        // Dynamically create and insert the image
        var img = document.createElement('img');
        img.src = imageSrc;
        img.alt = "Quick Cart Help Image";

        helpImageContainer.appendChild(img);
        popup.style.display = 'flex'; // Show the popup

    });

    closeBtn.addEventListener('click', function() {
        popup.style.display = 'none'; // Hide the popup
    });

    // Close popup when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none'; // Hide the popup
        }
    });
});


function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}



document.addEventListener("DOMContentLoaded", function () {
    const selectElement = document.getElementById('select-design');
    const designTemplateContainer = document.getElementById('show-template-image');
    const closeButtons = document.querySelectorAll('.close-design');
    const designTemplates = document.querySelectorAll('.design-template');

    // Template image paths
    const templateImages = {
        template_1: designTemplateContainer.dataset.imageTemplate1,
        template_2: designTemplateContainer.dataset.imageTemplate2,
        template_3: designTemplateContainer.dataset.imageTemplate3,
        template_4: designTemplateContainer.dataset.imageTemplate4
    };

    // Function to dynamically create and display the selected template image
    function updateImageDisplay() {
        const selectedValue = selectElement.value;

        // Clear any existing image inside the design template container
        designTemplateContainer.innerHTML = `
            <div class="design-template">
                <div style="display: flex; justify-content: end">
                    <span class="close-design">&times;</span>
                </div>
            </div>
        `;

        // Create the image element dynamically
        if (templateImages[selectedValue]) {
            const img = document.createElement('img');
            img.src = templateImages[selectedValue];
            img.alt = `${selectedValue} image`;
            img.style.display = 'block';

            // Customize styles for specific templates (if needed)
            if (selectedValue === 'template_3') {
                img.style.height = '200px';
                img.style.width = '400px';
            }

            // Append the image to the design template container
            const designTemplate = designTemplateContainer.querySelector('.design-template');
            designTemplate.appendChild(img);

            // Add close functionality to the new close button
            const closeButton = designTemplate.querySelector('.close-design');
            closeButton.addEventListener('click', function () {
                designTemplate.style.display = 'none';
            });
        }
    }

    // Initial update
    updateImageDisplay();

    // Listen for changes in the select dropdown
    selectElement.addEventListener('change', updateImageDisplay);
});