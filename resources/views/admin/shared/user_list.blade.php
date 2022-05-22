<table class="table">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Created At</td>
        <td>Roles</td>
        <td>Blocked</td>
        <td>Actions</td>
    </tr>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td><a href="{{ url('admin/author/show', $user->id) }}">{{ $user->name }}</a></td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td>@foreach($user->roles as $role) {{ $role->name }} | @endforeach</td>
            <td>-</td>
            <td>
                <a href="{{ route('admin.user.edit', $user->id) }}">Edit</a>
                <a href="#" >Delete</a>
                @if ($user->blocked)
                    <form action="{{ route('admin.user.unblock', $user->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-success">
                            Unblock
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.user.block', $user->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn-danger">
                            Block
                        </button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
</table>
