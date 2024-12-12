document.addEventListener('DOMContentLoaded', function() {
    let imageCollectionHolder = document.querySelector('#image-collection');
    let addImageButton = document.getElementById('add-image');
    let newImageIndex = parseInt(imageCollectionHolder.dataset.newImageIndex, 10); // Récupération de l'index initial

    let prototypeTemplate = imageCollectionHolder.dataset.prototype;

    addImageButton.addEventListener('click', function() {
        let newForm = prototypeTemplate.replace(/__name__/g, newImageIndex);
        newImageIndex++; // Incrémentez l'index

        let newFormElement = document.createElement('div');
        newFormElement.classList.add('image-form', 'm-3', 'p-4', 'rounded');
        newFormElement.style.backgroundColor = '#ebeae6';
        newFormElement.innerHTML = newForm;
        imageCollectionHolder.appendChild(newFormElement);

        addRemoveButton(newFormElement); // Ajout du bouton "Supprimer l'image"
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

    // Ajout d'un bouton de suppression pour les éléments déjà présents dans le formulaire
    document.querySelectorAll('.remove-image').forEach(function(button) {
        button.addEventListener('click', function() {
            button.parentElement.remove();
        });
    });
});