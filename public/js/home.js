$(document).ready(function () {
    users.forEach(function (e, i) {
        user_data[e.user_id] = e;
    })
    articles.forEach(function (e, i) {
        article_data[e.article_id] = e;
    })
})

var user_data = {};
var article_data = {};

// DATATABLE INIT
LANG_DT = {
    "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
    "sProcessing": "Sedang memproses...",
    "sLengthMenu": "Tampilkan _MENU_ entri",
    "sZeroRecords": "Tidak ditemukan data yang sesuai",
    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    "sInfoPostFix": "",
    "sSearch": "Cari:",
    "sUrl": "",
    "oPaginate": {
        "sFirst": "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext": "Selanjutnya",
        "sLast": "Terakhir"
    }
}
DT_USER = $("#user_table").DataTable({
    "language": LANG_DT,
    "fnDrawCallback": function (oSettings) {
    }
})
DT_ARTICLE = $("#article_table").DataTable({
    "language": LANG_DT,
    "fnDrawCallback": function (oSettings) {
    }
})

function editUser(user_id) {
    $("#name").val(user_data[user_id].name);
    $("#username").val(user_data[user_id].username);
    $("#password").val('');

    $("#formEditUser").attr('action', '/' + user_id + '/updateUser');

    $("#modalUser").modal('show');
}

function createUser() {
    $("#name").val('');
    $("#username").val('');
    $("#password").val('');
    $("#formEditUser").attr('action', '/storeUser');
    $("#modalUser").modal('show');
}

function editArticle(article_id) {
    $("#formEditArticle").attr('action', '/' + article_id + '/updateArticle');

    if (article_data[article_id].file != null) {
        $("#article_file").show();
        $("#article_file").attr('href', '/uploads/' + article_data[article_id].file);
    } else {
        $("#article_file").hide();
        $("#article_file").attr('href', '#');
    }

    $("#modalArticle").modal('show');
}

function editUserAssignment(user_id) {
    $("#formAssignUser").attr('action', '/' + user_id + '/updateAssignment');

    $("#modalUserAssessment").modal('show');
}
function deleteArticle(article_id) {
    Swal.fire({
        title: 'Yakin ingin menghapus data?',
        text: "Data tersebut tidak dapat dikembalikan",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-primary',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonClass: 'btn btn-danger',
        cancelButtonText: 'Batalkan',
        cancelButtonClass: 'btn btn-danger ml-1',
        buttonsStyling: false
    }).then((result) => {
        if (result.value) {
            document.getElementById("formDeleteArticle" + article_id).submit();
        }
    })
}