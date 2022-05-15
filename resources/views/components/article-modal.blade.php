<div class="modal fade" id="deleteModal{{$article->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
            Select "Delete" below if you want to delete <strong>{{$article->title}}</strong> article from your list.
            This article will not appear in your article list after deletion
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="/articles/{{$article->id}}"
        onclick="event.preventDefault();
                      document.getElementById('delete-form').submit();">
        Delete
        </a>
        <form id="delete-form" action="/articles/{{$article->id}}" method="POST" style="display: none;">
            @csrf
            @method('delete')
        </form>
        </div>
    </div>
    </div>
</div>
