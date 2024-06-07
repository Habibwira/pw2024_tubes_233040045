let menu = document.querySelector("#menu_icon");
let navbar = document.querySelector(".navbar");

menu.addEventListener("click", function () {
    navbar.classList.toggle("active");
});

window.onscroll = () => {
    navbar.classList.remove("active");
};

document.getElementById('menu_icon').addEventListener('click', function () {
    var navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
});


// Fungsi Ajax
$(document).ready(function () {
    $('#search').on('input', function () {
        var query = $(this).val();
        $.ajax({
            url: 'search.php',
            method: 'GET',
            data: { q: query },
            success: function (response) {
                $('#results').html(''); // Mengosongkan hasil pencarian sebelum menambahkan yang baru
                if (response && response.length > 0) { // Memastikan respons tidak kosong dan memiliki data
                    response.forEach(function (item) {
                        $('#results').append('<div>' + item.name + '</div>');
                    });
                } else {
                    $('#results').html('<div>No results found.</div>'); // Menampilkan pesan jika tidak ada hasil pencarian
                }
            },
            error: function (xhr, status, error) {
                console.error("Error:", error); // Menampilkan pesan error jika terjadi kesalahan dalam permintaan AJAX
            }
        });
    });
});
