// Data Mahasiswa
const mahasiswaData = [
    {
        id: 1,
        NIM: '072',
        nama: 'ersya',
        umur: 19,
        password: '$2y$10$/5sm2tFRGCCJGBhuQMLEeu6djZY7NKGgslIQsEMPTnruGJNas7hTy'
    },
    {
        id: 2,
        NIM: '082',
        nama: 'gema',
        umur: 19,
        password: '$2y$10$/5sm2tFRGCCJGBhuQMLEeu6djZY7NKGgslIQsEMPTnruGJNas7hTy'
    },
    {
        id: 4,
        NIM: '044',
        nama: 'Sukadana',
        umur: 29,
        password: '$2y$10$/5sm2tFRGCCJGBhuQMLEeu6djZY7NKGgslIQsEMPTnruGJNas7hTy'
    },
    {
        id: 5,
        NIM: '082',
        nama: 'Bretus',
        umur: 21,
        password: '$2y$10$/5sm2tFRGCCJGBhuQMLEeu6djZY7NKGgslIQsEMPTnruGJNas7hTy'
    },
    {
        id: 6,
        NIM: '009',
        nama: 'ibung',
        umur: 14,
        password: '$2y$10$/5sm2tFRGCCJGBhuQMLEeu6djZY7NKGgslIQsEMPTnruGJNas7hTy'
    },
    {
        id: 7,
        NIM: '087',
        nama: 'Isam',
        umur: 30,
        password: '$2y$10$/5sm2tFRGCCJGBhuQMLEeu6djZY7NKGgslIQsEMPTnruGJNas7hTy'
    }
];

// Data Courses
const coursesData = [
    {
        id: 1,
        title: 'Proyek 3',
        description: 'Belajar dasar HTML, CSS, JavaScript, PHP, CodeIgniter...',
        sks: 3
    },
    {
        id: 2,
        title: 'Basis Data',
        description: 'Pengenalan SQL, desain ERD, dan optimisasi query.',
        sks: 3
    },
    {
        id: 3,
        title: 'Aljabar Linear',
        description: 'Mempelajari Matriks, OBE, Determinan, Invers',
        sks: 3
    },
    {
        id: 4,
        title: 'Komputer Grafik',
        description: 'Mempelajari Grafika komputer implementasi pada game...',
        sks: 3
    },
    {
        id: 5,
        title: 'Pengantar Rekayasa Perangkat Lunak',
        description: 'Mempelajari cara menjadi software developer yang baik...',
        sks: 3
    },
    {
        id: 6,
        title: 'Matematika Diskrit 2',
        description: 'Mempelajari penalaran matematika, kombinatorial dan...',
        sks: 3
    },
    {
        id: 7,
        title: 'Matematika',
        description: 'Kursus dasar matematika',
        sks: 3
    }
];

// Buat variabel global agar bisa diakses
window.mahasiswaData = mahasiswaData;
window.coursesData = coursesData;