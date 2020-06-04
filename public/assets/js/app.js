var postBodyElement = null;
var postId = 0;

$(".post")
    .find(".interaction")
    .find(".edit")
    .on("click", function (event) {
        event.preventDefault();
        postBodyElement = event.target.parentNode.parentNode.childNodes[1];
        var postBody = postBodyElement.textContent;
        postId = event.target.parentNode.parentNode.dataset["postid"];
        $("#post-body").val(postBody);
        // console.log(postId);
        $("#exampleModal").modal();
    });
$("#modal-save").on("click", function () {
    // console.log(token);
    $.ajax({
        method: "POST",
        url: urlEdit,
        data: { body: $("#post-body").val(), postId: postId, _token: token },
    }).done(function (msg) {
        $("#exampleModal").modal("hide");
        $(postBodyElement).text(msg["new_body"]);
    });
});

$(".like").on("click", function (event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset["postid"];
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: "POST",
        url: urlLike,
        data: { isLike: isLike, postId: postId, isLike, _token: token },
    }).done(function () {
        event.target.innerText = isLike
            ? event.target.innerText == "Like"
                ? "You liked this post"
                : "Like"
            : event.target.innerText == "Dislike"
            ? "You don't liked this post"
            : "Dislike";
        if (isLike) {
            event.target.nextElementSibling.innerText = "Dislike";
        } else {
            event.target.previousElementSibling.innerText = "Like";
        }
    });
});
