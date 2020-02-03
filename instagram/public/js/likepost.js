var postId = 0;
$(".like").on("click", function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset["postnajib"];
    console.log(postId);
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: "POST",
        url: urlLike,
        data: { isLike: isLike, postId: postId, _token: token }
    }).done(function(response) {
        console.log(response);
        var like_count = $("#-bs3");
        like_count.text(response);

        event.target.innerText = isLike
            ? event.target.textContent == "Like"
                ? "Dislike"
                : "Like"
            : event.target.textContent == "Dislike"
            ? "You dont like this post"
            : "Dislike";
        if (isLike) {
            event.target.nextElementSibling.innerText = "Dislike";
        } else {
            event.target.previousElementSibling.innerText = "Like";
        }
    });
});
