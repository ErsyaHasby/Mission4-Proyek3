// Pilih elemen dengan querySelector
const mahasiswaList = document.querySelector('#mahasiswa-list');
const viewStudentLink = document.querySelector('#view-student-list');
const navMenu = document.querySelector('#nav-menu');

// Fungsi untuk menampilkan daftar mahasiswa dari backend
async function displayMahasiswaList() {
    if (mahasiswaList) {
        mahasiswaList.innerHTML = ''; // Bersihkan daftar sebelum diisi ulang
        mahasiswaList.style.display = 'block'; // Tampilkan div

        try {
            const response = await fetch('/admin/list_students');
            const data = await response.json();

            // Pengecekan jika data bukan array atau kosong
            if (!Array.isArray(data)) {
                mahasiswaList.innerHTML = '<p>Data mahasiswa tidak tersedia.</p>';
                return;
            }

            if (data.length === 0) {
                mahasiswaList.innerHTML = '<p>Tidak ada mahasiswa yang terdaftar.</p>';
                return;
            }

            data.forEach(mahasiswa => {
                const div = document.createElement('div');
                div.className = 'alert alert-info mb-2';
                div.textContent = `NIM: ${mahasiswa.NIM} - Nama: ${mahasiswa.nama} (Umur: ${mahasiswa.umur})`;
                mahasiswaList.appendChild(div);
            });
        } catch (error) {
            mahasiswaList.innerHTML = '<p>Error memuat data: ' + error.message + '</p>';
        }
    }
}

// Tambah event listener untuk link
if (viewStudentLink) {
    viewStudentLink.addEventListener('click', function (event) {
        event.preventDefault(); // Hindari reload halaman
        displayMahasiswaList();
    });
}

// Sembunyikan daftar saat halaman dimuat ulang
if (mahasiswaList) {
    mahasiswaList.style.display = 'none';
}

// Set menu aktif berdasarkan URL
if (navMenu) {
    const currentPath = window.location.pathname;
    const menuItems = navMenu.getElementsByClassName('list-group-item');
    Array.from(menuItems).forEach(item => {
        const menu = item.getAttribute('data-menu');
        if ((menu === 'courses' && currentPath.includes('/student/courses')) ||
            (menu === 'profile' && currentPath.includes('/student/profile')) ||
            (menu === 'logout' && currentPath.includes('/logout'))) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}