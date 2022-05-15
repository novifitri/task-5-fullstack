<div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
            Select "Delete" below if you want to delete <strong>{{$category->name}}</strong> category from your list.
            This category will not appear in your category list after deletion
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="/categories/{{$category->id}}"
        onclick="event.preventDefault();
                      document.getElementById('delete-form').submit();">
        Delete
        </a>
        <form id="delete-form" action="/categories/{{$category->id}}" method="POST" style="display: none;">
            @csrf
            @method('delete')
        </form>
        </div>
    </div>
    </div>
</div>
