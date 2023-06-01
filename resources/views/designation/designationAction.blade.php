<td>
    <a href="{{ route('designation-details.edit', $designation) }}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>

    <form action="{{ route('designation-details.destroy', $designation) }}" method="POST" style="display: inline;">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-sm btn-danger" onclick="deleteConfirmation({{ $designation->id }})"><i class="fa fa-trash"></i></button>
    </form>
</td>
