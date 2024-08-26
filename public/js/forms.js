
document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
        const entityType = this.getAttribute('data-entity');
        document.getElementById('entityDropdown').innerText = this.innerText;
        loadFormFields(entityType);
    });
});

function loadFormFields(entityType) {
    const formFields = document.getElementById('formFields');
    formFields.innerHTML = '';

    let fileName;

    if (entityType === 'product') {
        fileName = 'product.blade.php';
    }

    if (fileName) {
        fetch(`/html/${fileName}`)
            .then(response => response.text())
            .then(html => {
                formFields.innerHTML = html; // Вставляем загруженный HTML
            })
            .catch(error => {
                console.error('Error loading HTML:', error);
            });
    }
}
