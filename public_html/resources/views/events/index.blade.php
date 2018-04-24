@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('fail'))
                    <div class="alert alert-danger">
                        {{ session('fail') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Actions</div>

                    <div class="card-body">
                        <a href="{{ route('events.create') }}" class="btn btn-primary btn-xs">New Event</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Events</div>
                    <div class="card-body">

                        @if($events->count())
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Event name</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->date }}</td>
                                        <td><a href="{{ route('events.edit', $event->id) }}"
                                               class="btn btn-sm btn-warning">Edit</a>
                                            <button type="button" class="delete-event btn btn-sm btn-danger"
                                                    data-event-id="{{$event->id}}" data-toggle="modal"
                                                    data-target="#confirmDelete">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            No events found. You may create a <a href="{{ route('events.create') }}">new event</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Events calendar</div>

                    <div class="card-body">
                        <div id="calendar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('modals')

<!-- Modal -->

<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Delete event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you wish to delete this event?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="delete-event-form" action="" method="post">
                    <input type="hidden" name="_method" value="delete"/>
                    @csrf
                    <input type="submit" value="Delete" class="btn btn btn-danger">
                </form>
            </div>
        </div>
    </div>
</div>

@endpush
