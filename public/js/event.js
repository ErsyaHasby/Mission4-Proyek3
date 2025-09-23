document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.course-checkbox');
    const totalSks = document.getElementById('total-sks');
    const form = document.getElementById('enroll-form');
    const errorMessage = document.getElementById('error-message');
    const asyncNotification = document.getElementById('async-notification');
    const deleteButtons = document.querySelectorAll('.delete-btn');

    // Hitung total SKS saat checkbox diubah
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            let total = 0;
            checkboxes.forEach(cb => {
                if (cb.checked && !cb.disabled) {
                    const sksText = cb.parentElement.textContent.match(/$$ SKS: (\d+) $$/)[1];
                    const sks = parseInt(sksText);
                    total += sks;
                }
            });
            totalSks.textContent = total;

            // Contoh setTimeout (async)
            setTimeout(() => {
                asyncNotification.style.display = 'block';
                asyncNotification.textContent = `Pemberitahuan: Total SKS Anda saat ini ${total} setelah 2 detik!`;
                setTimeout(() => {
                    asyncNotification.style.display = 'none';
                }, 2000); // Hilang setelah 2 detik
            }, 2000); // Tampil setelah 2 detik
        });
    });

    // Validasi dan submit form dengan border merah
    form.addEventListener('submit', (event) => {
        const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
        if (checkedBoxes.length === 0) {
            event.preventDefault();
            errorMessage.textContent = 'Pilih setidaknya satu course!';
            errorMessage.style.display = 'block';
            form.classList.add('was-validated');
        } else {
            errorMessage.style.display = 'none';
            form.classList.remove('was-validated');
        }
    });

    // Inisialisasi validasi Bootstrap
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Konfirmasi delete dengan dialog
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const sks = button.getAttribute('data-sks');
            const confirmed = confirm(`Yakin ingin menghapus course "${title}" (SKS: ${sks})?`);
            if (confirmed) {
                window.location.href = button.getAttribute('href');
            }
        });
    });
});