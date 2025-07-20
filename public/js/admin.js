function showNotif(msg) {
    $('#notif').html(`<p class="notif success">${msg}</p>`);
}

function prosesAntrian(id) {
    $.post('/admin/updateStatusAntrian', { id: id }, function (res) {
        showNotif("Antrian berhasil diproses dan pelanggan disimpan");
        loadPage('antrian');
    });
}

function hapusAntrian(id) {
    if (confirm('Yakin ingin menghapus antrian ini?')) {
        $.post('/admin/delete-antrian', { id: id }, function (res) {
            showNotif('Data antrian berhasil dihapus');
            loadPage('antrian');
        });
    }
}

// Ini penting! Agar tombol selalu aktif walaupun konten dimuat ulang
$(document).on('click', '.btn-proses', function () {
    const id = $(this).data('id');
    prosesAntrian(id);
});

$(document).on('click', '.btn-hapus', function () {
    const id = $(this).data('id');
    hapusAntrian(id);
});


function initFormServis() {
    // Isi dropdown jenis_servis dari server
    $.get('/admin/getKategoriServis', function (data) {
        const select = $('[name="jenis_servis"]');
        select.html('<option value="">-- Pilih Jenis --</option>');
        data.forEach(item => {
            select.append(`<option value="${item.nama_servis}" data-harga="${item.harga_default}">${item.nama_servis}</option>`);
        });
    });

    // Saat jenis_servis berubah, isi biaya otomatis
    $(document).on('change', '[name="jenis_servis"]', function () {
        const harga = $(this).find(':selected').data('harga');
        if (harga !== undefined) {
            $('[name="biaya"]').val(harga);
        }
    });

    // AJAX submit form servis
    $('#formServis').on('submit', function (e) {
        e.preventDefault();

        $.post('/admin/save-servis', $(this).serialize(), function () {
            showToast('Data berhasil disimpan');
            $('#formServisContainer').slideUp().html('');
            $('#btnTambahServis').text('+ Tambah Servis');
            formServisTerbuka = false;
            loadPage('servis');
        });
    });
}
