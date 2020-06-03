var postBodyElement = null;

$(".post")
    .find(".interaction")
    .find(".edit")
    .on("click", function (event) {
        event.preventDefault();
        postBodyElement = event.target.parentNode.parentNode.childNodes[1];
        var postBody = postBodyElement.textContent;
        postId = event.target.parentNode.parentNode.dataset["postId"];
        $("#post-body").val(postBody);
        $("#exampleModal").modal();
    });
