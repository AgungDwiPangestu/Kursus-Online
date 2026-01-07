<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengajar;
use App\Models\Kursus;

class KursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Instructors
        $pengajars = [
            [
                'nama_pengajar' => 'Dr. Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'keahlian' => 'Backend Development & Database'
            ],
            [
                'nama_pengajar' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'keahlian' => 'Frontend Development & UI/UX'
            ],
            [
                'nama_pengajar' => 'Ahmad Hidayat',
                'email' => 'ahmad.hidayat@example.com',
                'keahlian' => 'DevOps & Cloud Infrastructure'
            ],
            [
                'nama_pengajar' => 'Lisa Martinez',
                'email' => 'lisa.martinez@example.com',
                'keahlian' => 'Mobile Development'
            ],
            [
                'nama_pengajar' => 'Rudi Hermawan',
                'email' => 'rudi.hermawan@example.com',
                'keahlian' => 'Data Science & Machine Learning'
            ],
            [
                'nama_pengajar' => 'Maya Putri',
                'email' => 'maya.putri@example.com',
                'keahlian' => 'Full Stack Development'
            ]
        ];

        foreach ($pengajars as $data) {
            Pengajar::create($data);
        }

        // Create Courses
        $kursus = [
            [
                'pengajar_id' => 1,
                'nama_kursus' => 'Backend Development dengan Laravel',
                'deskripsi' => 'Pelajari cara membangun aplikasi web backend yang scalable menggunakan Laravel framework. Materi mencakup RESTful API, database design, authentication, dan best practices dalam pengembangan backend.'
            ],
            [
                'pengajar_id' => 1,
                'nama_kursus' => 'Node.js & Express Backend Development',
                'deskripsi' => 'Kuasai pengembangan backend menggunakan Node.js dan Express. Pelajari tentang asynchronous programming, middleware, database integration dengan MongoDB, dan deployment.'
            ],
            [
                'pengajar_id' => 2,
                'nama_kursus' => 'Frontend Development dengan React',
                'deskripsi' => 'Belajar membangun user interface modern dan responsive menggunakan React. Materi meliputi components, hooks, state management dengan Redux, dan integration dengan backend API.'
            ],
            [
                'pengajar_id' => 2,
                'nama_kursus' => 'Vue.js untuk Pemula',
                'deskripsi' => 'Pelajari Vue.js dari dasar hingga mahir. Materi mencakup Vue components, Vuex state management, Vue Router, dan cara membangun single page applications yang powerful.'
            ],
            [
                'pengajar_id' => 3,
                'nama_kursus' => 'DevOps dengan Docker & Kubernetes',
                'deskripsi' => 'Master DevOps practices menggunakan Docker untuk containerization dan Kubernetes untuk orchestration. Pelajari CI/CD pipelines, monitoring, dan deployment strategies.'
            ],
            [
                'pengajar_id' => 3,
                'nama_kursus' => 'Cloud Computing dengan AWS',
                'deskripsi' => 'Pelajari cara deploy dan manage aplikasi di Amazon Web Services. Materi mencakup EC2, S3, RDS, Lambda, dan best practices untuk cloud architecture.'
            ],
            [
                'pengajar_id' => 4,
                'nama_kursus' => 'Mobile Development dengan Flutter',
                'deskripsi' => 'Bangun aplikasi mobile cross-platform menggunakan Flutter. Pelajari Dart programming, widget system, state management, dan cara publish aplikasi ke App Store dan Play Store.'
            ],
            [
                'pengajar_id' => 4,
                'nama_kursus' => 'React Native untuk Mobile Apps',
                'deskripsi' => 'Develop aplikasi mobile native menggunakan React Native. Materi meliputi navigation, native modules, performance optimization, dan integration dengan device features.'
            ],
            [
                'pengajar_id' => 5,
                'nama_kursus' => 'Data Science dengan Python',
                'deskripsi' => 'Pelajari data analysis, visualization, dan machine learning menggunakan Python. Materi mencakup pandas, numpy, matplotlib, scikit-learn, dan real-world data science projects.'
            ],
            [
                'pengajar_id' => 5,
                'nama_kursus' => 'Machine Learning Fundamentals',
                'deskripsi' => 'Pahami fundamental machine learning dari teori hingga praktik. Pelajari supervised learning, unsupervised learning, neural networks, dan cara deploy ML models.'
            ],
            [
                'pengajar_id' => 6,
                'nama_kursus' => 'Full Stack Web Development',
                'deskripsi' => 'Menjadi full stack developer dengan menguasai frontend dan backend development. Pelajari HTML, CSS, JavaScript, Node.js, database, dan cara membangun complete web applications.'
            ],
            [
                'pengajar_id' => 6,
                'nama_kursus' => 'MERN Stack Development',
                'deskripsi' => 'Master MERN stack (MongoDB, Express, React, Node.js) untuk membangun modern web applications. Dari setup environment hingga deployment production-ready applications.'
            ]
        ];

        foreach ($kursus as $data) {
            Kursus::create($data);
        }
    }
}
