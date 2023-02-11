
   <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    <label for="name" class="control-label">{{ 'Client Name' }}</label>
                    <input class="form-control" name="name" type="text" id="name" value="{{ isset($contact->first_name) ? $contact->first_name : ''}}" >
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            <label for="type" class="control-label">{{ 'Project Type' }}</label>
            <select name="type" id="type" class="form-control">
                @foreach(array(1 => "Water Drilling", 2 => "Building and Construction") as $key => $value)
                    <option value="{{ $key }}" {{ isset($project->type) && $project->type == $key?"selected":"" }}>{{ $value }}</option>
                @endforeach
            </select>
            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
   </div>
   <div class="row">
   <div class="col-md-6">
                <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                    <label for="status" class="control-label">{{ 'Status' }}</label>
                    <select name="status" id="status" class="form-control">
                        @foreach($project_status as $status)
                            <option value="{{ $status->id }}" {{ isset($project->status) && $project->status == $status->id ? 'selected':'' }}>{{ $status->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('project_description') ? 'has-error' : ''}}">
                    <label for="project_description" class="control-label">{{ 'Project Description' }}</label>
                    <input class="form-control" name="description" type="text" id="project_description" value="{{ isset($project->project_description) ? $project->project_description : ''}}" >
                    {!! $errors->first('project_description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
   </div>
   <div class="row">
   <div class="col-md-6">
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                    <label for="amount" class="control-label">{{ 'Project Amount' }}</label>
                    <input class="form-control" name="amount" type="text" id="amount" value="{{ isset($project->amount) ? $project->amount : ''}}" >
                    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
   </div>
   <div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>