var postId = 0;
var postBodyTexts = null;

$('.post').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();
    postBodyTexts = event.target.parentNode.parentNode.childNodes[1];
    var postbody = postBodyTexts.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postbody);
    $('#editpost').modal();
});

$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: url,
        data: {body: $('#post-body').val(), postId: postId, _token: token}
    }).done(function (msg) {
        $(postBodyTexts).text(msg['new_body']);
        $('#editpost').modal('hide');
    })
})