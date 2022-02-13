<div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }} mb-4">
    <label for="input-title" class="form-label">제목</label>
    <input type="text" name="title" id="input-title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="제목" value="{{ old('title', $article->title) }}" autofocus>
    @if ($errors->has('vendor_index'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>

<div class="form-group{{ $errors->has('body') ? ' has-danger' : '' }} mb-4">
    <label for="input-body" class="form-label">내용</label>
    <textarea name="body" id="input-body" rows="15"
              class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}"
              placeholder="내용을 입력해주세요">{{ old('body', $article->body) }}</textarea>
    @if ($errors->has('body'))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first('body') }}</strong>
    </span>
    @endif
</div>

<div class="d-flex justify-content-between align-items-center">
    <a class="btn btn-sm btn-primary" href="{{ route('articles.index') }}">목록으로</a>
    <button type="submit" class="btn btn-outline-success">완료</button>
</div>
