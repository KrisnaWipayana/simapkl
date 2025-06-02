<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class lowongan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lowongans')->insert([
            [
                'perusahaan_id' => 1,
                'judul' => 'Web Developer Internship',
                'deskripsi' => 'Bergabunglah dengan tim pengembangan web kami untuk mengembangkan aplikasi web modern menggunakan teknologi terkini seperti Laravel, Vue.js, dan MySQL. Peserta magang akan belajar full-stack development, implementasi API RESTful, dan best practices dalam coding. Mendapatkan mentoring langsung dari senior developer dan kesempatan untuk terlibat dalam proyek nyata perusahaan.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 2,
                'judul' => 'Human Resource Internship',
                'deskripsi' => 'Kesempatan untuk mempelajari seluruh aspek manajemen SDM mulai dari rekrutmen, training, employee engagement, hingga performance management. Peserta akan terlibat dalam proses screening kandidat, menyusun job description, mengelola database karyawan, dan membantu dalam kegiatan corporate culture. Pengalaman yang sangat berharga untuk memahami dinamika HR di perusahaan teknologi.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'UI/UX Designer Internship',
                'deskripsi' => 'Program magang untuk calon desainer UI/UX yang ingin mengembangkan kemampuan dalam user research, wireframing, prototyping, dan visual design. Menggunakan tools seperti Figma, Adobe XD, dan Sketch untuk menciptakan interface yang user-friendly. Peserta akan bekerja sama dengan tim product dan developer untuk menghasilkan desain yang dapat diimplementasikan dengan baik.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 3,
                'judul' => 'Software Engineer Internship',
                'deskripsi' => 'Bergabung dengan tim engineering untuk mengembangkan software berkualitas tinggi. Fokus pada pengembangan aplikasi menggunakan Java, Python, atau C#, dengan penerapan design patterns, clean code principles, dan test-driven development. Peserta akan mendapatkan exposure terhadap software architecture, database design, dan deployment strategies menggunakan cloud services.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 2,
                'judul' => 'Administrative Assistant Internship',
                'deskripsi' => 'Program magang untuk mendukung operasional perusahaan dalam berbagai aspek administratif. Meliputi pengelolaan dokumen, koordinasi meeting, komunikasi dengan vendor, data entry, dan pembuatan laporan. Kesempatan untuk mempelajari sistem ERP perusahaan dan mengembangkan kemampuan organizational skills yang sangat dibutuhkan di dunia kerja.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'General Support Internship',
                'deskripsi' => 'Posisi magang yang memberikan exposure ke berbagai departemen dalam perusahaan. Peserta akan berrotasi di berbagai divisi untuk memahami business process secara menyeluruh, mulai dari operations, customer service, quality assurance, hingga project management. Ideal untuk fresh graduate yang ingin mengeksplorasi minat dan bakat sebelum memilih spesialisasi karir.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 3,
                'judul' => 'Mechanical Engineer Internship',
                'deskripsi' => 'Program magang untuk mahasiswa teknik mesin yang ingin mengaplikasikan teori dalam praktik industri. Meliputi design mechanical components, troubleshooting equipment, preventive maintenance, dan analisis performance mesin. Menggunakan software CAD seperti AutoCAD dan SolidWorks, serta belajar tentang manufacturing processes dan quality control standards.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 2,
                'judul' => 'Frontend Developer Internship',
                'deskripsi' => 'Fokus pada pengembangan antarmuka pengguna yang responsive dan interactive menggunakan HTML5, CSS3, JavaScript, dan framework modern seperti React atau Vue.js. Peserta akan mempelajari component-based architecture, state management, API integration, dan performance optimization. Kesempatan untuk bekerja dengan UX designer dalam mentransformasi mockup menjadi aplikasi web yang fungsional.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'Finance Administration Internship',
                'deskripsi' => 'Program magang di divisi keuangan untuk mempelajari financial reporting, budgeting, accounts payable/receivable, dan tax compliance. Peserta akan menggunakan software accounting seperti SAP atau Oracle, melakukan rekonsiliasi bank, memproses invoice, dan membantu dalam penyusunan laporan keuangan bulanan. Pengalaman yang sangat berharga untuk memahami aspek finansial bisnis.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'Backend Developer Internship',
                'deskripsi' => 'Kesempatan untuk mendalami server-side development menggunakan teknologi seperti Node.js, PHP Laravel, atau Python Django. Fokus pada pengembangan API, database optimization, security implementation, dan server deployment. Peserta akan belajar tentang microservices architecture, caching strategies, dan monitoring applications. Mentoring intensif dari senior backend engineers.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 2,
                'judul' => 'System Analyst Internship',
                'deskripsi' => 'Program magang untuk mempelajari analisis sistem informasi, business process mapping, requirement gathering, dan documentation. Peserta akan terlibat dalam project assessment, stakeholder interview, system design, dan UAT coordination. Menggunakan tools seperti Visio, JIRA, dan Confluence untuk mendokumentasikan business requirements dan technical specifications.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'Network Engineer Internship',
                'deskripsi' => 'Mempelajari design, implementasi, dan maintenance infrastructure jaringan perusahaan. Meliputi konfigurasi router, switch, firewall, dan wireless access points. Peserta akan belajar tentang network security, troubleshooting connectivity issues, network monitoring, dan disaster recovery planning. Sertifikasi Cisco atau CompTIA Network+ akan menjadi nilai tambah.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 3,
                'judul' => 'AI/Machine Learning Developer Internship',
                'deskripsi' => 'Program magang untuk mengembangkan aplikasi berbasis artificial intelligence dan machine learning. Menggunakan Python, TensorFlow, dan PyTorch untuk membangun model prediktif, natural language processing, dan computer vision. Peserta akan terlibat dalam data preprocessing, model training, evaluation, dan deployment. Proyek real-world dengan dataset perusahaan.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'Mobile App Developer Internship',
                'deskripsi' => 'Kesempatan untuk mengembangkan aplikasi mobile native menggunakan React Native atau Flutter. Peserta akan mempelajari mobile UI/UX principles, state management, API integration, push notifications, dan app store deployment. Proyek mencakup pengembangan aplikasi iOS dan Android dengan fitur-fitur modern seperti offline capability dan real-time synchronization.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 2,
                'judul' => 'Digital Marketing Internship',
                'deskripsi' => 'Program magang komprehensif dalam digital marketing meliputi social media management, content creation, SEO/SEM, email marketing, dan analytics. Peserta akan menggunakan tools seperti Google Analytics, Facebook Ads Manager, dan Hootsuite untuk mengelola campaign dan menganalisis performance. Kesempatan untuk mengembangkan strategi marketing untuk produk teknologi.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 3,
                'judul' => 'Quality Assurance Internship',
                'deskripsi' => 'Mempelajari software testing methodologies, test case design, automation testing, dan bug reporting. Menggunakan tools seperti Selenium, Postman untuk API testing, dan JIRA untuk bug tracking. Peserta akan terlibat dalam functional testing, performance testing, dan user acceptance testing. Pengalaman dalam agile development environment dengan continuous integration practices.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'DevOps Engineer Internship',
                'deskripsi' => 'Program magang untuk mempelajari infrastructure as code, containerization dengan Docker, orchestration dengan Kubernetes, dan CI/CD pipeline. Peserta akan bekerja dengan cloud platforms seperti AWS atau Google Cloud, monitoring tools, dan automation scripts. Fokus pada deployment strategies, scalability, dan system reliability engineering.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 2,
                'judul' => 'Data Analyst Internship',
                'deskripsi' => 'Kesempatan untuk menganalisis big data menggunakan SQL, Python, dan tools visualisasi seperti Tableau atau Power BI. Peserta akan mempelajari statistical analysis, data mining, predictive modeling, dan business intelligence reporting. Proyek meliputi customer behavior analysis, sales forecasting, dan operational efficiency metrics untuk mendukung business decision making.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 3,
                'judul' => 'Cybersecurity Internship',
                'deskripsi' => 'Program magang untuk mempelajari information security, penetration testing, vulnerability assessment, dan incident response. Menggunakan tools seperti Nmap, Wireshark, Metasploit untuk security analysis. Peserta akan terlibat dalam security audit, policy development, dan security awareness training. Pengalaman hands-on dalam mengidentifikasi dan mitigasi security threats.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'perusahaan_id' => 1,
                'judul' => 'Product Manager Internship',
                'deskripsi' => 'Mempelajari product lifecycle management, market research, user story development, dan product roadmap planning. Peserta akan bekerja sama dengan cross-functional teams untuk mengidentifikasi user needs, define product requirements, dan coordinate product launches. Menggunakan tools seperti JIRA, Confluence, dan analytics platforms untuk product performance monitoring.',
                'tanggal_mulai' => now(),
                'tanggal_selesai' => now()->addMonths(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}