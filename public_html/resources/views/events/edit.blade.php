@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit event</div>

                    <div class="card-body">
                        <form action="{{ route('events.update', $event->id) }}" method="post">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" value="{{old('title', $event->title)}}"
                                       class="{{ $errors->has('title') ? ' is-invalid ' : '' }} form-control" id="title"
                                       maxlength="50"
                                       aria-describedby="titleHelp" placeholder="Event title" required>
                                <small id="titleHelp" class="form-text text-muted">Please enter the title of the event
                                    (min 2 characters and max 50 characters).
                                </small>
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input name="date" type="text" value="{{old('date', $event->date)}}"
                                       class="{{ $errors->has('date') ? ' is-invalid ' : '' }} date form-control"
                                       id="date" maxlength="50"
                                       aria-describedby="dateHelp" placeholder="Date" required>
                                <small id="dateHelp" class="form-text text-muted">Please select the date by clicking on
                                    the field and using the date
                                    picker.
                                </small>
                                @if ($errors->has('date'))
                                    <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                                @endif
                            </div>
                            <input type="submit" value="Update" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
