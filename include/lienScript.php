<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery/jquery-ui.js"></script>
<script src="js/main.js"></script>
<script>
    $(".task-column .card-body").sortable({
        connectWith: ".task-column .card-body", // Permet le déplacement entre les colonnes mais pas dans les cartes
        handle: ".card-header", // Utilise seulement l'entête des cartes pour les déplacer
        cursor: "move",
        opacity: 0.7,
        items: "> .card", // Sélectionne seulement les cartes directes, excluant le glissement à l'intérieur d'autres cartes
        start: function (event, ui) {
            ui.item.addClass('dragging');
            ui.item.css({
                'transform': 'rotate(5deg)',
                'opacity': 1
            });
        },
        sort: function (event, ui) {
            var rotateDeg = ui.position.left / 10;
            rotateDeg = Math.max(Math.min(rotateDeg, 15), -15);
            var opacity = 1 - Math.abs(rotateDeg) / 30;

            ui.item.css({
                'transform': 'rotate(' + rotateDeg + 'deg)',
                'opacity': opacity
            });
        },
        stop: function (event, ui) {
            ui.item.removeClass('dragging');
            ui.item.css({
                'transform': '',
                'opacity': 1
            });
        }
    });
</script>
<script>
let taskIdCounter = 0;

function createTaskCard(title, description, priority) {
    taskIdCounter++;
    return $('<div class="card mt-3" data-task-id="' + taskIdCounter + '">\
                <div class="card-header">\
                    <h5>' + title + '</h5>\
                    <button class="btn-close" aria-label="Close" style="position: absolute; top: 10px; right: 10px;"></button>\
                    <button class="btn-edit" aria-label="Edit" style="position: absolute; top: 10px; right: 40px;">\
                        <i class="bi bi-pencil"></i>\
                    </button>\
                </div>\
                <div class="card-body">\
                    <p>' + description + '</p>\
                    <div class="d-flex flex-wrap">\
                        <span class="badge bg-' + priority.split(' ')[0].toLowerCase() + '">' + priority + '</span>\
                    </div>\
                </div>\
            </div>');
}

$(document).ready(function () {
    // Event listener for the add task button
    $('.add-task-btn').click(function () {
        var newTaskCard = createTaskCard('New Task', 'New task description', 'Low Priority');
        $(newTaskCard).insertBefore($(this));
    });

    // Event listener for the close button
    $(document).on('click', '.btn-close', function () {
        $(this).closest('.card').remove();
    });

    // Event listener for the edit button
    $(document).on('click', '.btn-edit', function () {
        var card = $(this).closest('.card');
        var taskId = card.data('task-id');
        var taskTitle = card.find('h5').text();
        var taskDescription = card.find('p').text();
        var taskPriority = card.find('.badge').text();

        $('#taskForm').data('task-id', taskId);
        $('#taskTitle').val(taskTitle);
        $('#taskDescription').val(taskDescription);
        $('#taskPriority').val(taskPriority);

        $('#taskModal').modal('show');
    });

    // Event listener for saving task changes
    $('#saveTaskBtn').click(function () {
        var taskId = $('#taskForm').data('task-id');
        var card = $('.card[data-task-id="' + taskId + '"]');

        var newTitle = $('#taskTitle').val();
        var newDescription = $('#taskDescription').val();
        var newPriority = $('#taskPriority').val();

        card.find('h5').text(newTitle);
        card.find('p').text(newDescription);
        card.find('.badge').attr('class', 'badge').addClass('bg-' + newPriority.split(' ')[0].toLowerCase()).text(newPriority);

        $('#taskModal').modal('hide');
    });
});


</script>

<script>
    var colors = new Array(
        [62, 35, 255],
        [60, 255, 60],
        [255, 35, 98],
        [45, 175, 230],
        [255, 0, 255],
        [255, 128, 0]);

    var step = 0;
    //color table indices for: 
    // current color left
    // next color left
    // current color right
    // next color right
    var colorIndices = [0, 1, 2, 3];

    //transition speed
    var gradientSpeed = 0.002;

    function updateGradient() {

        if ($ === undefined) return;

        var c0_0 = colors[colorIndices[0]];
        var c0_1 = colors[colorIndices[1]];
        var c1_0 = colors[colorIndices[2]];
        var c1_1 = colors[colorIndices[3]];

        var istep = 1 - step;
        var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
        var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
        var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
        var color1 = "rgb(" + r1 + "," + g1 + "," + b1 + ")";

        var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
        var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
        var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
        var color2 = "rgb(" + r2 + "," + g2 + "," + b2 + ")";

        $('#gradient').css({
            background: "-webkit-gradient(linear, left top, right top, from(" + color1 + "), to(" + color2 + "))"
        }).css({
            background: "-moz-linear-gradient(left, " + color1 + " 0%, " + color2 + " 100%)"
        });

        step += gradientSpeed;
        if (step >= 1) {
            step %= 1;
            colorIndices[0] = colorIndices[1];
            colorIndices[2] = colorIndices[3];

            //pick two new target color indices
            //do not pick the same as the current one
            colorIndices[1] = (colorIndices[1] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;
            colorIndices[3] = (colorIndices[3] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length;

        }
    }

    setInterval(updateGradient, 10);
</script>
<script>
$(document).ready(function() {
    function checkNewMessages() {
        $.ajax({
            url: 'requete/check_new_messages.php',
            method: 'GET',
            success: function(response) {
                var data = JSON.parse(response);
                if (data.unreadMessagesCount > 0) {
                    $('.bi-chat-left-text .badge-number').text(data.unreadMessagesCount).show();
                    var messagesHtml = '';
                    data.unreadMessages.forEach(function(message) {
                        messagesHtml += '<li class="message-item">';
                        messagesHtml += '<a href="#">';
                        messagesHtml += '<img src="images/default-profile.jpg" alt="" class="rounded-circle">';
                        messagesHtml += '<div>';
                        messagesHtml += '<h4>' + message.prenom + ' ' + message.nom + '</h4>';
                        messagesHtml += '<p>' + message.texte.substring(0, 50) + '...</p>';
                        messagesHtml += '<p>' + message.date_envoi + ' hrs. ago</p>';
                        messagesHtml += '</div>';
                        messagesHtml += '</a>';
                        messagesHtml += '</li>';
                        messagesHtml += '<li><hr class="dropdown-divider"></li>';
                    });
                    $('.messages').html(messagesHtml);
                } else {
                    $('.bi-chat-left-text .badge-number').hide();
                }
            }
        });
    }

    // Vérifier les nouveaux messages toutes les 30 secondes
    setInterval(checkNewMessages, 30000);
});

</script>


