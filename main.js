// main.js
document.addEventListener('DOMContentLoaded', function () {
    const productType = document.getElementById('type');
    const dimensionContainer = document.getElementById('dimension-container');
    const dimensionLabel = document.getElementById('dimension-label');
    const dimensionInput = document.getElementById('dimension');
    const furnitureDimensions = document.getElementById('furniture-dimensions');

    // Hide or show fields based on selected product type
    productType.addEventListener('change', updateDimensionInput);

    function updateDimensionInput() {
        const selectedType = productType.value;

        // Hide the dimension fields by default
        dimensionContainer.style.display = 'none';
        dimensionInput.style.display = 'block';
        furnitureDimensions.style.display = 'none';

        if (selectedType === '') {
            return;
        }

        // Show the dimension container
        dimensionContainer.style.display = 'block';

        switch (selectedType) {
            case 'dvd':
                dimensionLabel.innerHTML = 'Size (MB):';
                dimensionInput.placeholder = 'Enter size in MB';
                dimensionInput.style.display = 'block';
                furnitureDimensions.style.display = 'none';
                break;

            case 'book':
                dimensionLabel.innerHTML = 'Weight (Kg):';
                dimensionInput.placeholder = 'Enter weight in Kg';
                dimensionInput.style.display = 'block';
                furnitureDimensions.style.display = 'none';
                break;

            case 'furniture':
                dimensionLabel.innerHTML = 'Dimensions (Width, Height, Length in cm):';
                dimensionInput.style.display = 'none'; // Hide single dimension input
                furnitureDimensions.style.display = 'block'; // Show separate fields for furniture dimensions
                break;

            default:
                dimensionContainer.style.display = 'none';
        }
    }
});
