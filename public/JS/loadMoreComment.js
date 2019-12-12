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
                    blockComment.innerHTML +=
                        `<div class="col-lg-12 css_comment">
                            <p>De ${comment.user.username} le ${comment.createdAt}</p>
                            <p>${comment.content}</p>
                        </div>`
                })

                commentContainer.appendChild(blockComment);
            }
        });
    });
});