document.addEventListener('DOMContentLoaded', function() {
    let imageCollectionHolder = document.querySelector('#image-collection');
    let addImageButton = document.getElementById('add-image');
    let newImageIndex = parseInt(imageCollectionHolder.dataset.newImageIndex, 10);

    let prototypeTemplate = imageCollectionHolder.dataset.prototype;

    addImageButton.addEventListener('click', function() {
        let newForm = prototypeTemplate.replace(/__name__/g, newImageIndex);
        newImageIndex++;

        let newFormElement = document.createElement('div');
        newFormElement.innerHTML = newForm;
        imageCollectionHolder.appendChild(newFormElement);

        addRemoveButton(newFormElement);
    });

    function addRemoveButton(element) {
        let removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('remove-image', 'btn', 'btn-outline-primary');
        removeButton.innerText = 'Supprimer l\'image';

        element.appendChild(removeButton);

        removeButton.addEventListener('click', function() {
            element.remove();
        });
    }

    document.querySelectorAll('.remove-image').forEach(function(button) {
        button.addEventListener('click', function() {
            button.parentElement.remove();
        });
    });
});