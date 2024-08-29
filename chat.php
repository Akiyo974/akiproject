<div class="toto">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Utilisateurs et bouton à droite (sur grand écran) -->
            <div class="col-md-4 bg-light order-md-2 order-1">
                <div class="py-2">
                    <button class="btn btn-primary w-100" id="newConversationBtn">Nouvelle conversation</button>
                </div>
                <div id="userList">
                    <!-- Utilisateurs chargés ici -->
                </div>
            </div>
            <!-- Espace de chat à gauche (sur grand écran) -->
            <div class="col-md-8 chat-container order-md-1 order-2" id="chatArea">
                <div id="activeChat" class="chat-history" style="display: none; overflow-y: scroll; height: 90%;">
                    <!-- Contenu du chat ici -->
                </div>
                <div class="message-input-container" style="display: none;" id="messageInputContainer">
                    <input type="text" id="messageInput" class="form-control" placeholder="Écrire un message...">
                    <button id="sendMessageBtn" class="btn btn-primary">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</div>
