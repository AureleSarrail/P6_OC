const loadMoreButton = document.querySelector('button.load_more');
const url = loadMoreButton.dataset.url;

const tricksContainer = document.getElementById('Tricks_Block');

const loadMoreContainer = document.getElementById('load_more_container');

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

            let pageMax = Number(tricks[1]);
            console.log('pagemax : ' + pageMax);

            if(loadMoreButton.dataset.nextPage <= pageMax) {
                console.log('bonjour');
                tricks[0].forEach(function (trick) {
                    createTrickCard(trick);
                })
            }

            loadMoreButton.dataset.nextPage = page + 1;

            console.log('nextpage : ' + loadMoreButton.dataset.nextPage);

            if(loadMoreButton.dataset.nextPage > pageMax ) {
                // loadMoreButton.remove();
                parent = loadMoreButton.parentElement;
                parent.removeChild(loadMoreButton);
                // document.body.removeChild(loadMoreContainer);
            }
        }
    });
});


function createTrickCard(trick) {
    let div = document.createElement('div');

    let urlOnePost = Routing.generate('show_one_trick', {slug: trick.slug});
    let urlUpdate = Routing.generate('update_trick', {slug: trick.slug});
    let urlDelete = Routing.generate('deleteTrick', {id: trick.id});

    let imgUrl = trick.image;

    div.classList.add('col-lg-3');

    if(loadMoreButton.dataset.admin == 1){
        div.innerHTML = `<div class="row trickHome">
        <div class="col-lg-12">
            <img src="${imgUrl}" alt="" class="col-lg-12 trickPic">
        </div>
        <div class="col-lg-9">
            <a href="${urlOnePost}" ><p class="col-lg-12">${trick.name}</p></a>
         </div> 
         <div class="col-lg-1">
            <a href="${urlUpdate}" class="col-lg-3"><img
                        src="/Images/pencil.png" alt=""></a>
        </div>
        <div class="col-lg-1">
            <a href="${urlDelete}" class="col-lg-3"><img
                        src="/Images/Trash.png" alt=""></a>
        </div>
    </div>`;
    }
    else {
        div.innerHTML = `<div class="row trickHome">
        <div class="col-lg-12">
            <img src="${imgUrl}" alt="" class="col-lg-12 trickPic">
        </div>
        <div class="col-lg-12">
            <a href="${urlOnePost}" ><p class="col-lg-12">${trick.name}</p></a>
         </div> 
         </div>`;
    }



    tricksContainer.appendChild(div);


}

//