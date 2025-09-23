document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.course-checkbox');
    const totalSks = document.getElementById('total-sks');
    const form = document.getElementById('enroll-form');
    const errorMessage = document.getElementById('error-message');

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
        });
    });

    // Validasi dan submit form
    form.addEventListener('submit', (event) => {
        const checkedBoxes = document.querySelectorAll('.course-checkbox:checked');
        if (checkedBoxes.length === 0) {
            event.preventDefault();
            errorMessage.textContent = 'Pilih setidaknya satu course!';
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }
    });
});