var postId = 0;
$(".like").on("click", function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset["postid"];
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: "POST",
        url: urlLike,
        data: { isLike: isLike, postId: postId, _token: token }
    }).done(function(response) {
        event.target.textContent = isLike
            ? event.target.textContent == "Like"
                ? "You like this post"
                : "Like"
            : "Like";
        if (isLike) {
            event.target.nextElementSibling.textContent = "Like";
        } else {
            // event.target.nextElementSibling.textContent = "Like";
        }

        console.log("dsfedfgeresponse");
    });
});
