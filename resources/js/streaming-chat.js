// Fills chat on load and detects screen size
window.onload = function () {
    refreshChat();
    setCookieScreenSize();
};

// Saves question when sent
$("#send-question").on("click", function () {
    sendQuestion();
});

// Shows last question on opening chat
$("#chat-button").on("click", function() {
    scrollLastQuestionIntoView();
});

// Refreshes chat every 5 secods
setInterval(function () {
    refreshChat();
}, 5000);

// Refreshes chat
function refreshChat() {
    var jqxhr = $.post({
        url: 'api/get-messages',
        dataType: 'json',
        type: 'GET',
        cache: false,
    });

    jqxhr.done(function (response) {
        var chatContents = $("#chat-content");
        var numChilds = chatContents.children().length;

        if (numChilds === response.length) {
            return;
        }

        // Para eliminar los elementos que no queremos y pintar los que nos quedan
        newElements = response.slice(numChilds);

        newElements.forEach(element => {
            appendQuestion(element.date, element.user, element.question);
        });

        scrollLastQuestionIntoView();
    });
}

// Saves question on server
function sendQuestion() {
    // Prevent blank
    if ($("#question-content").val() === '') {
        return;
    }

    var question = $("#question-content").val();
    var cookies = document.cookie.split(';');

    cookies.forEach(cookie => {
        cookie_name  = cookie.split('=')[0].trim();
        cookie_value = cookie.split('=')[1].trim();

        if(cookie_name === 'name_data') {
            usr_cookie_val = cookie_value;
            return;
        }
    });

    var date = getFormattedDate();

    $("#question-content").val("");
    $("#send-question").prop("disabled", true);

    var jqxhr = $.post({
        url: '/api/message',
        dataType: 'json',
        type: 'POST',
        cache: false,
        data: {
            "user": usr_cookie_val,
            "question": question
        }
    })
        .done(function (response) {
            appendQuestion(date, usr_cookie_val.replace('%40', '@'), question);
        })

        .fail(function (response) {
            appendFailedQuestion(date, usr_cookie_val.replace('%40', '@'), question);
        })

        .always(function (response) {
            $("#send-question").prop("disabled", false);
            scrollLastQuestionIntoView();
        });
}

function scrollLastQuestionIntoView() {
    $("#chat-content").children().last()[0].scrollIntoView();
}

// Writes question on chat
function appendQuestion(date, user, question) {
    var text = '<p class="rounded p-2 bg-dark-subtle bubble-chat"><small class="text-secondary">' + date;
    text += ' </small><span class="user-email">' + user.replaceAll('%2B', ' ');
    text += '</span>: ' + question + '</p>';

    $("#chat-content").append(text);
}

// If something fails with a question, write it in red
function appendFailedQuestion(date, user, question) {
    var text = '<p class="rounded p-2 bg-danger-subtle"><small>' + date;
    text += ' </small><del>' + user.replaceAll('%2B', ' ');
    text += ': ' + question + '</del></p>';

    $("#chat-content").append(text);
}

// Formats date
function getFormattedDate() {
    var date = new Date();
    currentHours = date.getHours();
    currentHours = ("0" + currentHours).slice(-2);

    currentMinutes = date.getMinutes();
    currentMinutes = ("0" + currentMinutes).slice(-2);

    return currentHours + ':' + currentMinutes;
}

// Gets the input field so if someone presses enter, saves the question
var input = document.getElementById("question-content");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function (event) {
    // If the user presses the "Enter" key on the keyboard
    if (event.key === "Enter") {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        document.getElementById("send-question").click();
    }
}); 