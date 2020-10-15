<div class="form-group">
    <label for="title">Title</label>
<input type="text" name="title" value ="{{old('title') ??$post->title}}" id="title" class="form-control @error('title') is-invalid @enderror">
    @error('title')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" id="body" class="form-control">{{old('body') ?? $post->body}}</textarea>
    @error('body')
        <div class="text-danger mt-2">
            {{$message}}
        </div>
    @enderror
</div>
<button type="submit" class="btn btn-primary">{{$submit ?? 'Update'}}</button>
