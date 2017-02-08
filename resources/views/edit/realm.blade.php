@extends('layouts.restricted_edit')

@section('restricted')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/realm/' . $realm->id . '/save') }}">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">
                @include('widgets.edit.title', ['oObject' => $realm, 'sType' => 'realm'])
            </div>

            <div class="panel-body">
                <div class="row">
                    @include('widgets.edit.description', ['oObject' => $realm])

                    <div class="col-md-6">
                        <div class="realm-gamemaster">
                            <div>{{ trans('realm.dungeon_master') }}</div>
                            <span>
                                @include('widgets.elements.user_dropdown', ['user' => $realm->dungeonMaster])
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="realm-player">
                            <div>{{ trans('general.known_by') }}</div>
                            @include('widgets.elements.user_dropdown_multi', ['obj' => $realm])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('widgets.edit.submit')
    </form>
@endsection