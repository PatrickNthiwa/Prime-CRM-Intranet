<div class="row">
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            <label for="name" class="control-label">{{ 'Name' }}</label>
            <input class="form-control" name="name" type="text" id="name" value="{{ isset($file->name) ? $file->name : ''}}">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        @if(isset($file->file) && !empty($file->file))
            <a href="{{ url('uploads/files/' . $file->file) }}"><i class="fa fa-download"></i> {{$file->file}}</a>
        @endif
        <div class="form-group {{ $errors->has('file') ? 'has-error' : ''}}">
            <label for="file" class="control-label">{{ 'File' }}</label>
            <input class="form-control" name="file" type="file" id="file">
            {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            <label for="type" class="control-label">{{ 'File Type' }}</label>
            <select name="type" id="type" class="form-control">
                @foreach($file_types as $file_type)
                    <option value="{{ $file_type->id }}" {{ isset($file->file_type) && $file ->file_type == $file_type->id ? 'selected':'' }}>{{ $file_type->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('$file_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
{{--    <div class="col-md-6">--}}
{{--        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">--}}
{{--            <label for="type" class="control-label">{{ 'Type' }}</label>--}}
{{--            <select name="type" id="type" class="form-control">--}}
{{--                @foreach($file_types as $file_type)--}}
{{--                    <option value="{{ $file_type->id }}" {{ isset($file->type) && $file->type == $file_type->id?"selected":"" }}>{{ $file_type->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
{{--<div class="row">--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="form-group {{ $errors->has('publish_date') ? 'has-error' : ''}}">--}}
{{--            <label for="publish_date" class="control-label">{{ 'Publish Date' }}</label>--}}
{{--            <input class="form-control" name="publish_date" type="text" id="publish_date" value="{{ isset($file->publish_date) ? $file->publish_date : ''}}" >--}}
{{--            {!! $errors->first('publish_date', '<p class="help-block">:message</p>') !!}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-6">--}}
{{--        <div class="form-group {{ $errors->has('expiration_date') ? 'has-error' : ''}}">--}}
{{--            <label for="expiration_date" class="control-label">{{ 'Expiration Date' }}</label>--}}
{{--            <input class="form-control" name="expiration_date" type="text" id="expiration_date" value="{{ isset($file->expiration_date) ? $file->expiration_date : ''}}" >--}}
{{--            {!! $errors->first('expiration_date', '<p class="help-block">:message</p>') !!}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@if(\Auth::user()->is_admin == 1)
    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
        <label for="user_id" class="control-label">{{ 'Assigned User' }}</label>
        <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ isset($file->user_id) && $file->user_id == $user->id?"selected":"" }}>{{ $user->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
@endif
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

