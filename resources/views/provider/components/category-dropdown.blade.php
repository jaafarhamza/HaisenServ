<div class="col-span-2 mt-4">
    <label class="block text-sm font-medium text-textParagraph mb-2">{{ $label ?? 'Categories of Services You Provide' }}</label>

    <div class="mb-2">
        <input type="text" id="selected-categories-display" readonly
            class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading"
            placeholder="Click below to select categories">
    </div>

    <!-- Dropdown container -->
    <div class="relative">
        <button type="button" id="category-dropdown-btn"
            class="w-full bg-bgPrimary border border-secondary rounded-lg px-4 py-2 text-textHeading flex justify-between items-center">
            <span>Select Categories</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="category-dropdown-menu"
            class="absolute z-10 mt-1 w-full bg-bgSecondary border border-secondary rounded-lg shadow-lg hidden">
            <div class="p-2 max-h-60 overflow-y-auto">
                @foreach ($categories as $category)
                    <div class="flex items-center py-1 px-2 hover:bg-bgPrimary rounded">
                        <input type="checkbox" id="category-{{ $category->id }}"
                            name="categories[]" value="{{ $category->id }}"
                            class="category-checkbox mr-2"
                            {{ in_array($category->id, $selectedCategories ?? []) ? 'checked' : '' }}>
                        <label for="category-{{ $category->id }}" class="cursor-pointer flex-1">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <!-- Add new category option -->
            <div class="border-t border-secondary p-2">
                <div class="flex items-center">
                    <input type="text" id="new-category-input"
                        class="w-full bg-bgPrimary border border-secondary rounded-lg px-3 py-1 text-textHeading"
                        placeholder="Add a new category">
                </div>
                <button type="button" id="add-new-category-btn"
                    class="mt-2 w-full bg-buttonPrimary hover:bg-opacity-80 text-buttonText py-1 px-2 rounded-lg transition-all duration-200">
                    Add Category
                </button>
            </div>
        </div>
    </div>

    <!-- Hidden input for new categories -->
    <input type="hidden" id="new-categories" name="new_categories">
</div>