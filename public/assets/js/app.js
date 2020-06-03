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
