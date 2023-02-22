<form action="{{ route($action, $project->id) }}" method="POST">
    @csrf
    @method($method)
    
    <h4 class="mb-3 fw-bold">
        {{ Auth::user()->name }}
    </h4>
    <form>
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}">
        </div>

        <div class="mb-3">
            <label for="post_date" class="form-label">Data di pubblicazione</label>
            <input type="date" class="form-control" id="post_date" name="post_date" 
            value="{{ old('post_date', $project->post_date) }}" >
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto del post</label>
            <textarea type="text" class="form-control" id="content" name="content">
                {{ old('content', $project->content) }}
            </textarea>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-{{$buttonClass}}">{{$buttonText}}</button>
        </div>
    </form>
</form>