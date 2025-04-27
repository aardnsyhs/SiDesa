<div class="modal fade" id="approveModal-{{ $user->id }}" tabindex="-1" aria-labelledby="approveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('account-request.approval', $user) }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="approveModalLabel">Konfirmasi Setujui</h5>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="for" value="approve">
                    <p class="mb-0">Apakah Anda yakin untuk menyetujui akun ini? Aksi ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="confirmApprove">Setujui</button>
                </div>
            </div>
        </form>
    </div>
</div>