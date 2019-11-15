const loadMoreButton = document.querySelector('button.load_more');
const url = loadMoreButton.dataset.url;

const tricksContainer = document.getElementById('Tricks_Block');

loadMoreButton.addEventListener('click', function (event) {

    let page = Number(loadMoreButton.dataset.nextPage);
    $.ajax({
        url: url,
        type: 'POST',
        data: {page: page},
        dataType: 'json',
        success: function (tricks) {

            tricks = JSON.parse(tricks);
            console.log(tricks);


            loadMoreButton.dataset.nextPage = page + 1;
            tricks.forEach(function (trick) {
                createTrickCard(trick);
            });

            loadMoreButton.remove();
        }
    });
});


function createTrickCard(trick) {
    let div = document.createElement('div');

    div.classList.add('col-lg-3');

    div.innerHTML = `<div class="row trickHome">
        <div class="col-lg-12">
            <img src="${trick.images[0].url}" alt="" class="col-lg-12">
        </div>
        <div class="col-lg-6">
            <a href="{{ path('show_one_trick', {'slug': ${trick.slug}}) }}" ><p class="col-lg-6">${trick.name}</p></a>
         </div>
        <div class="col-lg-3">
            <a href="update_trick/${trick.slug}" class="col-lg-3"><img
                        src="../public/Images/pencil.png" alt=""></a>
        </div>
        <div class="col-lg-3">
            <a href="{{ path('deleteTrick', {'id': " + ${trick.id} + "} }}" class="col-lg-3"><img
                        src="../public/Images/Trash.png" alt=""></a>
        </div>
    </div>`;

    tricksContainer.appendChild(div);


}