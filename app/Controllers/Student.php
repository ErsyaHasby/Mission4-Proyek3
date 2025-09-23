<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\MahasiswaModel;
use Config\Database;

class Student extends BaseController
{
    public function dashboard()
    {
        return view('student/dashboard', [
            'title' => 'Dashboard Mahasiswa'
        ]);
    }

    public function enroll($courseId)
    {
        $userId = session()->get('user_id');
        $enrollmentModel = new EnrollmentModel();

        // Cek apakah sudah pernah enroll course ini
        $exists = $enrollmentModel
            ->where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();

        if ($exists) {
            return redirect()->to('/student/courses')->with('error', 'Anda sudah enroll course ini.');
        }

        // Simpan enroll baru
        $enrollmentModel->save([
            'user_id' => $userId,
            'course_id' => $courseId,
            'enrolled_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/student/courses')->with('success', 'Berhasil enroll ke course!');
    }

    public function profile()
    {
        $mahasiswaModel = new MahasiswaModel();
        $student = $mahasiswaModel->where('id', session()->get('user_id'))->first();

        if (!$student) {
            return redirect()->to('/student/dashboard')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        return view('student/profile', [
            'title' => 'Data Diri Mahasiswa',
            'student' => $student
        ]);
    }

    public function courses()
    {
        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();
        $db = Database::connect();

        $userId = session()->get('user_id');

        // Semua courses dengan SKS
        $allCourses = $courseModel->findAll();

        // Course yang sudah diambil mahasiswa ini
        $takenCourses = $db->table('enrollments e')
            ->select('c.id, c.title, c.description, c.sks, e.id as enrollment_id')
            ->join('courses c', 'c.id = e.course_id')
            ->where('e.user_id', $userId)
            ->get()->getResultArray();

        return view('student/courses', [
            'title' => 'Daftar Courses',
            'allCourses' => $allCourses,
            'takenCourses' => $takenCourses
        ]);
    }

    public function deleteEnroll($enrollmentId)
    {
        $userId = session()->get('user_id');
        $enrollmentModel = new EnrollmentModel();

        $enrollment = $enrollmentModel->where('id', $enrollmentId)->where('user_id', $userId)->first();

        if ($enrollment) {
            $enrollmentModel->delete($enrollmentId);
            return redirect()->to('/student/courses')->with('success', 'Course berhasil dihapus dari enrollment');
        }

        return redirect()->to('/student/courses')->with('error', 'Enrollment tidak ditemukan');
    }

    public function enrollMultiple()
    {
        $enrollmentModel = new EnrollmentModel();
        $userId = session()->get('user_id');
        $selectedCourses = $this->request->getPost('courses');

        if (empty($selectedCourses)) {
            return redirect()->to('/student/courses')->with('error', 'Pilih setidaknya satu course!');
        }

        $courseModel = new CourseModel();
        $db = Database::connect();
        $existingEnrollments = $db->table('enrollments')
            ->where('user_id', $userId)
            ->get()->getResultArray();

        $existingCourseIds = array_column($existingEnrollments, 'course_id');

        foreach ($selectedCourses as $courseId) {
            if (!in_array($courseId, $existingCourseIds)) {
                $enrollmentModel->insert([
                    'user_id' => $userId,
                    'course_id' => $courseId
                ]);
            }
        }

        return redirect()->to('/student/courses')->with('success', 'Courses berhasil di-enroll!');
    }

    public function getCourses()
    {
        $courseModel = new CourseModel();
        $courses = $courseModel->findAll();
        return $this->response->setJSON($courses);
    }

    public function enrollCourse()
    {
        $userId = session()->get('user_id');
        $courseId = $this->request->getPost('course_id');

        if (!$courseId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Course ID required'], 400);
        }

        $enrollmentModel = new EnrollmentModel();
        $exists = $enrollmentModel->where('user_id', $userId)->where('course_id', $courseId)->first();

        if ($exists) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Already enrolled'], 400);
        }

        $enrollmentModel->insert([
            'user_id' => $userId,
            'course_id' => $courseId
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Enrolled successfully']);
    }
}