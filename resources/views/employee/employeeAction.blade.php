<td>
    <a href="{{ route('employee-details.edit', $user) }}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>

    <form action="{{ route('employee-details.destroy', $user) }}" method="POST" style="display: inline;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="csrf_token()">
        <button type="submit" class="btn btn-sm btn-danger" onclick="deleteConfirmation({{ $user->id }})"><i class="fa fa-trash"></i></button>
    </form>
</td>
