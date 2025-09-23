<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\MahasiswaModel;
use App\Models\EnrollmentModel;

class Admin extends BaseController
{
    // ===================== DASHBOARD =====================
    public function dashboard()
    {
        return view('admin/dashboard', [
            'title' => 'Dashboard Admin'
        ]);
    }

    // ===================== COURSES =====================
    public function courses()
    {
        $model = new CourseModel();
        $data['courses'] = $model->findAll();
        $data['title'] = 'Daftar Courses';
        return view('admin/courses/index', $data);
    }

    public function createCourse()
    {
        return view('admin/courses/create', ['title' => 'Tambah Course']);
    }

    public function storeCourse()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new CourseModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/admin/courses')->with('success', 'Course berhasil ditambahkan');
    }

    public function editCourse($id)
    {
        $model = new CourseModel();
        $data['course'] = $model->find($id);
        if (!$data['course']) {
            return redirect()->to('/admin/courses')->with('error', 'Course tidak ditemukan');
        }
        $data['title'] = 'Edit Course';
        return view('admin/courses/edit', $data);
    }

    public function updateCourse($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[3]|max_length[255]',
            'description' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new CourseModel();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('/admin/courses')->with('success', 'Course berhasil diperbarui');
    }

    public function deleteCourse($id)
    {
        $model = new CourseModel();
        if (!$model->find($id)) {
            return redirect()->to('/admin/courses')->with('error', 'Course tidak ditemukan');
        }
        $model->delete($id);
        return redirect()->to('/admin/courses')->with('success', 'Course berhasil dihapus');
    }

    // ===================== STUDENTS (MAHASISWA) =====================
    public function students()
    {
        $model = new MahasiswaModel();
        $data['students'] = $model->findAll();
        $data['title'] = 'Daftar Mahasiswa';
        return view('admin/students/index', $data);
    }

    public function createStudent()
    {
        return view('admin/students/create', ['title' => 'Tambah Mahasiswa']);
    }

    public function storeStudent()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'NIM' => 'required|min_length[3]|max_length[20]|is_unique[mahasiswa.NIM]',
            'nama' => 'required|min_length[3]|max_length[255]',
            'umur' => 'required|numeric|greater_than[0]|less_than[100]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new MahasiswaModel();
        $model->save([
            'NIM' => $this->request->getPost('NIM'),
            'nama' => $this->request->getPost('nama'),
            'umur' => $this->request->getPost('umur'),
        ]);

        return redirect()->to('/admin/students')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function editStudent($id)
    {
        $model = new MahasiswaModel();
        $data['student'] = $model->find($id);
        if (!$data['student']) {
            return redirect()->to('/admin/students')->with('error', 'Mahasiswa tidak ditemukan');
        }
        $data['title'] = 'Edit Mahasiswa';
        return view('admin/students/edit', $data);
    }

    public function updateStudent($id)
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'NIM' => 'required|min_length[3]|max_length[20]|is_unique[mahasiswa.NIM,id,' . $id . ']',
            'nama' => 'required|min_length[3]|max_length[255]',
            'umur' => 'required|numeric|greater_than[0]|less_than[100]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new MahasiswaModel();
        $model->update($id, [
            'NIM' => $this->request->getPost('NIM'),
            'nama' => $this->request->getPost('nama'),
            'umur' => $this->request->getPost('umur'),
        ]);

        return redirect()->to('/admin/students')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    public function deleteStudent($id)
    {
        $model = new MahasiswaModel();
        if (!$model->find($id)) {
            return redirect()->to('/admin/students')->with('error', 'Mahasiswa tidak ditemukan');
        }
        $model->delete($id);
        return redirect()->to('/admin/students')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function detail($id)
    {
        $mahasiswaModel = new MahasiswaModel();
        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();

        // Ambil data mahasiswa
        $student = $mahasiswaModel->find($id);
        if (!$student) {
            return redirect()->to('/admin/students')->with('error', 'Mahasiswa tidak ditemukan');
        }

        // Ambil course yang diambil mahasiswa
        $courses = $enrollmentModel
            ->select('courses.id, courses.title, courses.description')
            ->join('courses', 'courses.id = enrollments.course_id')
            ->where('enrollments.user_id', $id)
            ->findAll();

        // Debug: Uncomment untuk cek data
        // dd($student, $courses);

        return view('admin/students/detail', [
            'title' => 'Detail Mahasiswa',
            'student' => $student,
            'courses' => $courses
        ]);
    }
    public function listStudents()
    {
        $mahasiswaModel = new MahasiswaModel();
        $students = $mahasiswaModel->findAll();

        // Pastikan data adalah array, jika kosong kembalikan array kosong
        if ($students === null) {
            $students = [];
        }

        return $this->response->setJSON($students);
    }
}
