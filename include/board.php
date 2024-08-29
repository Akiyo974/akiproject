<div class="container-fluid mt-5">
    <div id="taskContainer">
        <div class="task-column">
            <div class="card">
                <div class="card-header  text-white">
                    <h4>To Do</h4>
                </div>
                <div class="card-body ">
                    <div class="card">
                        <div class="card-header">
                            <h5>Task 1</h5>
                            <button class="btn-close" aria-label="Close"
                                style="position: absolute; top: 10px; right: 10px;"></button>
                            <button class="btn-edit" aria-label="Edit"
                                style="position: absolute; top: 10px; right: 40px;">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <p>Task description</p>
                            <div class="d-flex flex-wrap">
                                <span class="badge bg-primary">Low Priority</span>
                                <span class="badge bg-warning">Medium Priority</span>
                                <span class="badge bg-danger">High Priority</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Task 1</h5>
                            <button class="btn-close" aria-label="Close"
                                style="position: absolute; top: 10px; right: 10px;"></button>
                            <button class="btn-edit" aria-label="Edit"
                                style="position: absolute; top: 10px; right: 40px;">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <p>Task description</p>
                            <div class="d-flex flex-wrap">
                                <span class="badge bg-primary">Low Priority</span>
                                <span class="badge bg-warning">Medium Priority</span>
                                <span class="badge bg-danger">High Priority</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mt-3 add-task-btn">Create New Task</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="task-column">
            <div class="card">
                <div class="card-header text-white">
                    <h4>Doing</h4>
                </div>
                <div class="card-body">
                    <!-- Tasks will be dynamically added here -->
                </div>
            </div>
        </div>
        <div class="task-column ">
            <div class="card">
                <div class="card-header  text-white">
                    <h4>Finished</h4>
                </div>
                <div class="card-body">
                    <!-- Tasks will be dynamically added here -->
                </div>
            </div>
        </div>
        <div class="task-column">
            <div class="card">
                <div class="card-header text-white">
                    <h4>+ New</h4>
                </div>
                <div class="card-body">
                    <p>Create a new task</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Modifier la tâche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <div class="mb-3">
                        <label for="taskTitle" class="form-label">Titre de la tâche</label>
                        <input type="text" class="form-control" id="taskTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="taskDescription" class="form-label">Description de la tâche</label>
                        <textarea class="form-control" id="taskDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Priorité</label>
                        <div id="taskPriorityBadges" class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary text-white priority-badge" data-priority="Low Priority">Low Priority</span>
                            <span class="badge bg-warning text-dark priority-badge" data-priority="Medium Priority">Medium Priority</span>
                            <span class="badge bg-danger text-white priority-badge" data-priority="High Priority">High Priority</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="saveTaskBtn">Enregistrer les modifications</button>
            </div>
        </div>
    </div>
</div>
