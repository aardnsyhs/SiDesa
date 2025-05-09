<div class="modal fade" id="detailAccount-{{ $resident->id }}" tabindex="-1" aria-labelledby="detailAccountLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailAccountLabel">Detail Akun</h5>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-0">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ $resident->user?->nama }}" class="form-control"
                        readonly>
                </div>
                <div class="form-group mb-0">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ $resident->user?->email }}"
                        class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
