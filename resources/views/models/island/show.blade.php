@extends('layouts.show')

@section('parent')
    <div class="object-parent">
        <div>{{ trans('sea.name') }}</div>
        <span>
            <a href="{{ url('sea/' . $oObject->parent->url) }}">{{ $oObject->parent->name }}</a>
        </span>
    </div>
@endsection

@section('child-elements')
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">
                <a data-toggle="collapse" href="#landscape">
                    <span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>
                    <span>{{ trans('landscape.assigned') }}</span>
                </a>
            </span>

            @can('create', new \App\Models\Landscape())
                <div class="pull-right">
                    <a href="{{ url('landscape/create/island/' . $oObject->url) }}">
                        {{ trans('landscape.add') }}
                    </a>
                </div>
            @endcan
        </div>

        <div id="landscape" class="panel-body collapse">
            @include('widget.defaultList', ['aObjects' => \App\Models\Island::landscapes($oObject), 'sTarget' => 'landscape'])
        </div>
    </div>
@endsection