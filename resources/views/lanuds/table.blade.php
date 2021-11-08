<div class="table-responsive">
    <table class="table" id="lanuds-table">
        <thead>
        <tr>
            <th>Initial</th>
        <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lanuds as $lanud)
            <tr>
                <td>{{ $lanud->initial }}</td>
            <td>{{ $lanud->name }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['lanuds.destroy', $lanud->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('lanuds.show', [$lanud->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('lanuds.edit', [$lanud->id]) }}"
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
