
document.getElementById('loadMoreComment').addEventListener('click', function() {
    hiddenComments = document.querySelectorAll('div.blockComment[hidden]');
    console.log(hiddenComments);
    for (let comment of hiddenComments)
    {
        comment.removeAttribute('hidden');
    }

    loadButton = document.getElementById('loadMoreComment');
    parent = loadButton.parentElement;
    parent.removeChild(loadButton);
});