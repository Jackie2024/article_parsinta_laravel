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
    <label for="category">Category</label>
    <select name="category" value ="" id="category" class="form-control @error('category') is-invalid @enderror">
        <option disabled selected>Choose One!</option>
        @foreach ($categories as $category)
            <option {{$category->id == $post->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    @error('category')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <select name="tags[]" value ="" id="tags" class="form-control @error('tags') is-invalid @enderror select2" multiple>
        @foreach ($post->tags as $tag)
            <option selected value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach

        @foreach ($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach

    </select>
    @error('tags')
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
