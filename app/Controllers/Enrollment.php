<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\UserModel;
use App\Models\CourseModel;

class Enrollment extends BaseController
{
    // Tampilkan daftar enrollment
    public function index()
    {
        $enrollmentModel = new EnrollmentModel();
        $userModel = new UserModel();
        $courseModel = new CourseModel();

        $data['title'] = 'Manajemen Enrollment';
        $data['enrollments'] = $enrollmentModel->findAll();
        $data['users'] = $userModel->findAll();
        $data['courses'] = $courseModel->findAll();

        return view('admin/enrollments/index', $data);
    }

    // Tambah enrollment
    public function store()
    {
        $enrollmentModel = new EnrollmentModel();

        $enrollmentModel->save([
            'user_id' => $this->request->getPost('user_id'),
            'course_id' => $this->request->getPost('course_id'),
            'enrolled_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/enrollment')->with('success', 'Enrollment berhasil ditambahkan');
    }

    // Hapus enrollment
    public function delete($id)
    {
        $enrollmentModel = new EnrollmentModel();
        $enrollmentModel->delete($id);

        return redirect()->to('/enrollment')->with('success', 'Enrollment berhasil dihapus');
    }
}
