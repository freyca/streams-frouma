<div class="position-static">
    <div class="position-absolute bottom-0 start-0">
        <button id="chat-button" class="btn rounded-0 rounded-top bg-light-subtle text-light ask-question" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChat" aria-controls="offcanvasChat">
            Tes unha pregunta?
        </button>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasChat" aria-labelledby="offcanvasChatLabel">
    <div class="offcanvas-header bg-body-tertiary text-light-subtle">
        <h5 class="offcanvas-title" id="offcanvasChatLabel">Aquí podes facer preguntas sobre o contenido do streaming</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="chat-content" class="text-start overflow-scroll" style="overflow: auto;">
        </div>
        <br />
    </div>

    <div class="position-absolute fixed-bottom">
        <div class="input-group">
            <input id="question-content" type="text" class="form-control border-dark rounded-0 rounded-top bg-body-secondary" aria-label="Text input">
            <button id="send-question" type="button" class="btn btn-info rounded-0 rounded-top border-0 btn-send">Enviar</button>
        </div>
    </div>
</div>