
    @if ($query)

    @foreach ($query as $rows)
    <div class="show" align="left"><span class="name">{{ $rows->name }}</span></div>
    @endforeach
    @else
    <div class="show" align="left">No matching records.</div>
@endif