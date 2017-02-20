@extends('layouts.create')

@section('left-block')
        <div class="realm-gamemaster">
            <div>{{ trans('realm.ocean') }}</div>
            <span>
                @include('widget.dropdown', ['oParent' => $oObject->parent, 'aObjects' => $oObject->possibleParents(['Ocean'])])
            </span>
        </div>
@endsection

@section('right-block')
        <div class="realm-player">
            <div>{{ trans('general.known_by') }}</div>
            @include('widget.elements.user_dropdown_multi', ['obj' => new \App\Models\Sea()])
        </div>
@endsection