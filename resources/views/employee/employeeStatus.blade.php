<td>
    <div class="form-check form-switch d-flex justify-content-center">
        <input type="checkbox" class="form-check-input status-toggle" id="status-toggle-{{ $user->id }}" data-id="{{ $user->id }}" {{ $user->status === 'active' ? 'checked' : '' }}>
    </div>
</td>
