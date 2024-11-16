<div class="form-group">
    <label for="">Category Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', ($category->name ?? '')) }}">
    @error('name')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Parent</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach ($parents as $parent)
            <option value="{{$parent->id}}" @selected(old('parent_id', ($category->parent_id ?? '')) === $parent->id)> {{ $parent->id }}</option>
        @endforeach
    </select>
    @error('parent_id')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Description</label>
    <textarea name="description" class="form-control">{{ old('description', ($category->description ?? '')) }}</textarea>
    @error('description')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Image</label>
    <input type="file" name="image" accept="image/*" class="form-control">
    @if (isset($category->image))
        <img src="{{ asset('storage/'. $category->image) }}" alt="" height="50">
    @endif
    @error('image')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Status</label>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active" @checked(old('status', ($category->status ?? '')) === "active")>
        <label class="form-check-label" for="flexRadioDefault1">
          Active
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="archived" @checked(old('status', ($category->status ?? '')) === "archived")>
        <label class="form-check-label" for="flexRadioDefault2">
          Archived
        </label>
      </div>
      @error('status')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>
