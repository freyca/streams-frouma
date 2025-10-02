// Shows last question on opening chat
$("#chat-button").on("click", function() {
    scrollLastQuestionIntoView();
});


function scrollLastQuestionIntoView() {
    $("#chat-content").children().last()[0].scrollIntoView();
}
