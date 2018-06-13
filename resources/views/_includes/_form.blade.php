
    {{csrf_field()}}
    <div class="form-group">
        <label for="title">Question</label>
        <input type="text" name="title" id="title" value="{{ old('title') ?? $question->title }}" class="form-control">
    </div>
    <div class="form-group">
        <label for="description">More information</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') ?? $question->description }}</textarea>
    </div>
    <input type="submit" class="btn btn-success" value="{{ $submitButtonText ?? 'Submit Question' }}">
