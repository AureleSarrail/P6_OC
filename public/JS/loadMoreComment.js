let links = document.querySelectorAll('a.page-link');

links.forEach(function (link) {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        let url = link.dataset.url;
        $.ajax({
            url: url,
            success: function (comments) {
                comments = JSON.parse(comments);
                console.log(comments);

                let commentContainer = document.getElementById('commentContainer');
                let comment = document.getElementById('blockComment');

                commentContainer.removeChild(comment);

                let blockComment = document.createElement('div');
                blockComment.setAttribute("id", "blockComment");

                comments.forEach(comment => {
                    let oldDate = new Date(comment.createdAt);
                    // let newDate = (oldDate.getDate('dd')+'\\'+(oldDate.getMonth()+1)+'\\'+oldDate.getFullYear());

                    let newDate = oldDate.toLocaleDateString("fr-FR",{
                        year: "numeric",
                        month: "2-digit",
                        day: "2-digit"
                    });

                    console.log(new Date(comment.createdAt));
                    console.log(newDate);

                    blockComment.innerHTML +=
                        `<div class="col-lg-12 css_comment">
                            <p>De ${comment.user.username} le ${newDate}</p>
                            <p>${comment.content}</p>
                        </div>`
                })

                commentContainer.appendChild(blockComment);
            }
        });
    });
});