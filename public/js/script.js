$(document).ready(function () {
    $('#penduduk').DataTable({
        responsive: true,
        autoWidth: false,
        scrollX: true,
        columnDefs: [
            { targets: [0, 1, 2, 3, 4], className: 'text-nowrap' },
            { targets: '_all', className: 'align-middle' }
        ],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya"
            },
            zeroRecords: "Tidak ada data ditemukan"
        }
    });
});
