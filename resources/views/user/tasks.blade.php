@extends('layouts.user')

@section('title', 'Workspace')

@section('content')

<div class="task-header">
    <div class="left">
        <button onclick="history.back()" class="btn-back">⬅</button>
        <h2>Workspace</h2>
    </div>

    <button onclick="openModal('addModal')" class="btn-add">+ Add Task</button>
</div>

<div class="board">

@foreach(['todo','progress','done'] as $status)
<div class="column" data-status="{{ $status }}">
    <h3>{{ ucfirst($status) }}</h3>

    <div class="column-content">
        @forelse($tasks->where('status',$status) as $task)
        <div class="card" draggable="true" data-id="{{ $task->id }}">
            <span class="task-title">{{ $task->title }}</span>

            <div class="actions">
                <button onclick="editTask({{ $task->id }}, '{{ $task->title }}')">✏️</button>
                <button onclick="deleteTask({{ $task->id }})">🗑️</button>
            </div>
        </div>
        @empty
            <p class="empty">No task</p>
        @endforelse
    </div>
</div>
@endforeach

</div>

{{-- ADD MODAL --}}
<div id="addModal" class="modal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Add Task</h3>
            <span class="close" onclick="closeModal('addModal')">✖</span>
        </div>
        <input type="text" id="newTask" placeholder="Task name">
        <button onclick="addTask()">Add</button>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="modal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Edit Task</h3>
            <span class="close" onclick="closeModal('editModal')">✖</span>
        </div>
        <input type="text" id="editInput">
        <button onclick="saveEdit()">Save</button>
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="deleteModal" class="modal">
    <div class="modal-box">
        <h3>Yakin hapus task?</h3>
        <div class="modal-actions">
            <button onclick="confirmDelete()">Yes</button>
            <button onclick="closeModal('deleteModal')">Cancel</button>
        </div>
    </div>
</div>

<div id="toast"></div>

@endsection


@section('scripts')
<script>
let dragged = null;
let editId = null;
let deleteId = null;

/* MODAL */
function openModal(id){
    document.getElementById(id).style.display='flex';
}
function closeModal(id){
    document.getElementById(id).style.display='none';
}

/* TOAST */
function showToast(msg){
    let t = document.getElementById('toast');
    t.innerText = msg;
    t.classList.add('show');
    setTimeout(()=>t.classList.remove('show'),2000);
}

/* ADD */
function addTask(){
    let title = document.getElementById('newTask').value;

    fetch('/tasks',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        body: JSON.stringify({title})
    })
    .then(res=>res.json())
    .then(data=>{
        location.reload();
    });
}

/* DELETE */
function deleteTask(id){
    deleteId = id;
    openModal('deleteModal');
}

function confirmDelete(){
    fetch('/tasks/delete',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        body: JSON.stringify({id: deleteId})
    }).then(()=>{
        location.reload();
    });
}

/* EDIT */
function editTask(id, title){
    editId = id;
    document.getElementById('editInput').value = title;
    openModal('editModal');
}

function saveEdit(){
    let val = document.getElementById('editInput').value;

    fetch('/tasks/edit',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        body: JSON.stringify({id: editId, title: val})
    }).then(()=>{
        location.reload();
    });
}

/* DRAG */
function initDrag(card){
    card.addEventListener('dragstart', ()=>{
        dragged = card;
        card.classList.add('dragging');
    });

    card.addEventListener('dragend', ()=>{
        card.classList.remove('dragging');
    });
}

document.querySelectorAll('.card').forEach(initDrag);

document.querySelectorAll('.column-content').forEach(col=>{
    col.addEventListener('dragover', e=>e.preventDefault());

    col.addEventListener('drop', ()=>{
        col.appendChild(dragged);

        fetch('/tasks/update',{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: dragged.dataset.id,
                status: col.closest('.column').dataset.status
            })
        });

        showToast("Task moved 📦");
    });
});
</script>
@endsection