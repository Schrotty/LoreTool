@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('landscape.landscape') }}</div>
        <span>
            <a href="{{ url($oObject->parent->getModel() . '/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection