document.addEventListener('DOMContentLoaded', function() {
    const dropdownBtn = document.getElementById('category-dropdown-btn');
    const dropdownMenu = document.getElementById('category-dropdown-menu');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
    const selectedCategoriesDisplay = document.getElementById('selected-categories-display');
    const newCategoryInput = document.getElementById('new-category-input');
    const addNewCategoryBtn = document.getElementById('add-new-category-btn');
    const newCategoriesInput = document.getElementById('new-categories');

    // Custom categories added by user
    let customCategories = [];

    // Toggle dropdown
    dropdownBtn.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Update display when checkboxes are clicked
    categoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateDisplay);
    });

    // Add new category
    addNewCategoryBtn.addEventListener('click', function() {
        const categoryName = newCategoryInput.value.trim();
        if (categoryName) {
            // Add to custom categories
            if (!customCategories.includes(categoryName)) {
                customCategories.push(categoryName);

                // Create a new checkbox option
                const newCategoryDiv = document.createElement('div');
                newCategoryDiv.className = 'flex items-center py-1 px-2 hover:bg-bgPrimary rounded';
                newCategoryDiv.innerHTML = `
                    <input type="checkbox" id="category-custom-${categoryName}" 
                        class="category-checkbox mr-2" checked>
                    <label for="category-custom-${categoryName}" class="cursor-pointer flex-1 text-tertiary">
                        ${categoryName} (New)
                    </label>
                `;

                // Add event listener to new checkbox
                const newCheckbox = newCategoryDiv.querySelector('input');
                newCheckbox.addEventListener('change', updateDisplay);

                // Add to the dropdown menu before the "Add new category" section
                dropdownMenu.querySelector('.p-2').appendChild(newCategoryDiv);

                // Update the hidden input with custom categories
                newCategoriesInput.value = customCategories.join(',');

                // Update the display
                updateDisplay();

                // Clear the input
                newCategoryInput.value = '';
            }
        }
    });


    newCategoryInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addNewCategoryBtn.click();
        }
    });


    updateDisplay();

    function updateDisplay() {
        const selectedCategories = [];

        categoryCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const label = checkbox.nextElementSibling.textContent.trim();
                selectedCategories.push(label.replace(' (New)', ''));
            }
        });


        document.querySelectorAll('[id^="category-custom-"]').forEach(checkbox => {
            if (checkbox.checked && !checkbox.classList.contains('category-checkbox')) {
                const label = checkbox.nextElementSibling.textContent.trim();
                selectedCategories.push(label.replace(' (New)', ''));
            }
        });
        selectedCategoriesDisplay.value = selectedCategories.join(', ');
    }
});