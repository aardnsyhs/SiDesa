<div class="modal fade" id="rejectModal-{{ $user->id }}" tabindex="-1" aria-labelledby="rejectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('account-request.approval', $user->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="rejectModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="for" value="deactivate">
                    <p class="mb-0">Apakah Anda yakin untuk menonaktifkan akun ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-danger" id="confirmReject">Nonaktifkan</button>
                </div>
            </div>
        </form>
    </div>
</div>
