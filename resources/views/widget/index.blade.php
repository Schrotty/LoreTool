<table class="index-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.dungeon_master') }}</th>
        <th>{{ trans('general.edit') }}</th>
    </tr>

    @if( count($aObjects) != 0 )
        @foreach($aObjects as $oObject)
            <tr>
                <td><a href="{{ url($sModel . '/' . $oObject->url) }}">{{ $oObject->name }}</a></td>
                <td>{{ $oObject->dungeonMaster->name }}</td>
                <td><a href="{{ action(ucfirst($sModel) . 'Controller@edit', $oObject->url) }}">{{ trans('general.edit') }}</a></td>
            </tr>
        @endforeach
    @else
        <tr>
            <td>-</td>
            <td>-</td>
        </tr>
    @endif
</table>