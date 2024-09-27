$(function () {

    $('.tombolTambahData').on('click', function () {
        $('#judulModal').html('Tambah Data Mahasiswa');

        $('.modal-footer button[type=submit]').html('Simpan Data');

    });

    $('.tampilModalUbah').on('click', function () {

        $('#judulModal').html('Ubah Data Mahasiswa');

        $('.modal-footer button[type=submit]').html('Update Data');

        $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah');

        const id = $(this).data('id');


        $.ajax({
            url: 'http://localhost/phpmvc/public/mahasiswa/getUbah',
            data: { id: id },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id_mhs);
                $('#nama').val(data.nama);
                $('#nrp').val(data.nrp);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
            }
        });
    })

});