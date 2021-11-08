<div class="table-responsive">
    <table class="table" id="estimates-table">
        <thead>
        <tr>
            <th>Lanud From</th>
        <th>Lanud To</th>
        <th>Est Time</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($estimates as $estimate)
            <tr>
                <td>{{ $estimate->lanud_from }}</td>
            <td>{{ $estimate->lanud_to }}</td>
            <td>{{ $estimate->est_time }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['estimates.destroy', $estimate->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('estimates.show', [$estimate->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('estimates.edit', [$estimate->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
