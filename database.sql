-- Fresh install database
-- Import this file into the database you want to use for the project.

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `school_notice`;
DROP TABLE IF EXISTS `carousel_images`;
DROP TABLE IF EXISTS `gallery_images`;
DROP TABLE IF EXISTS `web_content`;
DROP TABLE IF EXISTS `staffs`;
DROP TABLE IF EXISTS `schoolroutine`;
DROP TABLE IF EXISTS `notification`;
DROP TABLE IF EXISTS `management_committee`;
DROP TABLE IF EXISTS `gallery_album`;
DROP TABLE IF EXISTS `flash_notice`;
DROP TABLE IF EXISTS `holidays`;
DROP TABLE IF EXISTS `contactfeedback`;
DROP TABLE IF EXISTS `admission_form`;
DROP TABLE IF EXISTS `admins`;

SET FOREIGN_KEY_CHECKS = 1;

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `identity_code` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','scribe') NOT NULL DEFAULT 'scribe',
  `image` varchar(500) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `identity_code`, `password`, `role`, `image`, `updated_at`) VALUES
(1, 'admin', '7267864', '$2y$10$sPwbofpNxeKPWgqiugXGAuF1KtQkw37Tu0ZGHMSkAe3lhtjEqMc6G', 'admin', 'assets/images/admin/admin.png', NULL)
ON DUPLICATE KEY UPDATE
  `username` = VALUES(`username`),
  `identity_code` = VALUES(`identity_code`),
  `password` = VALUES(`password`),
  `role` = VALUES(`role`),
  `image` = VALUES(`image`),
  `updated_at` = VALUES(`updated_at`);

-- --------------------------------------------------------

--
-- Table structure for table `admission_form`
--

CREATE TABLE `admission_form` (
  `id` int NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address` varchar(80) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob_date` date DEFAULT NULL,
  `father_name` varchar(50) NOT NULL,
  `mother_name` varchar(50) NOT NULL,
  `admit_to` varchar(100) NOT NULL,
  `previous_school` varchar(50) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(30) NOT NULL,
  `intro` varchar(500) NOT NULL,
  `registered_at` datetime DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contactfeedback`
--

CREATE TABLE `contactfeedback` (
  `id` int NOT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousel_images`
--

CREATE TABLE `carousel_images` (
  `id` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carousel_images`
--

INSERT INTO `carousel_images` (`id`, `image_url`, `alt_text`, `sort_order`, `is_enabled`) VALUES
(1, 'assets/images/school_images/zangiotaim_front.webp', 'Zangiota Tuman school front', 1, 1),
(2, 'assets/images/school_images/zangiotaim_001.jpg', 'School building', 2, 1),
(3, 'assets/images/school_images/fullschool.jpg', 'School building', 3, 1),
(4, 'assets/images/school_images/mainschool.jpg', 'Main school building', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `month` tinyint DEFAULT NULL,
  `day` tinyint DEFAULT NULL,
  `is_floating` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `title`, `note`, `month`, `day`, `is_floating`, `sort_order`, `is_enabled`) VALUES
(1, 'Yangi yil', 'Yilning birinchi kuni', 1, 1, 0, 1, 1),
(2, 'Vatan himoyachilari kuni', 'Mamlakat mudofaasi kuni', 1, 14, 0, 2, 1),
(3, 'Xalqaro xotin-qizlar kuni', 'Bahor oldi bayrami', 3, 8, 0, 3, 1),
(4, 'Navroʻz', 'Bahor va yangilanish bayrami', 3, 21, 0, 4, 1),
(5, 'Ramazon hayiti', 'Ramazon hayiti', NULL, NULL, 1, 5, 1),
(6, 'Qurbon hayiti', 'Qurbon hayiti', NULL, NULL, 1, 6, 1),
(7, 'Mustaqillik kuni', 'Milliy bayram', 9, 1, 0, 7, 1),
(8, 'Oʻqituvchi va murabbiylar kuni', 'Ustozlar va taʼlim fidoyilari kuni', 10, 1, 0, 8, 1),
(9, 'Konstitutsiya kuni', 'Davlat bayrami', 12, 8, 0, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `flash_notice`
--

CREATE TABLE `flash_notice` (
  `id` int NOT NULL,
  `title` varchar(500) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flash_notice`
--

INSERT INTO `flash_notice` (`id`, `title`, `image_url`, `message`, `is_enabled`) VALUES
(1, 'Admission is open!!!', 'assets/images/flash_notice/admission.png', 'Admissions are open at your school name school! Explore our Aniq fanlar stream from grade 5 and Tabiiy fanlar stream from grade 7, along with Computer Engineering and Management. Apply now and build a brighter future!\n\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_album`
--

CREATE TABLE `gallery_album` (
  `id` int NOT NULL,
  `album_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gallery_album`
--

INSERT INTO `gallery_album` (`id`, `album_name`) VALUES
(8, 'Garden'),
(9, 'Group'),
(15, 'Nischal acharya'),
(7, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int NOT NULL,
  `album_id` int NOT NULL,
  `image_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `management_committee`
--

CREATE TABLE `management_committee` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `position` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `image_src` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `management_committee`
--

INSERT INTO `management_committee` (`id`, `name`, `position`, `contact_no`, `image_src`) VALUES
(1, 'Yubaraj Rajbanshi', 'Chairman', '980000000', ''),
(2, 'Thir Kumar Dahal', 'Member Secretary', '9844640316', 'assets/images/staff/thir_kumar_dahal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `page` varchar(30) NOT NULL,
  `site` varchar(20) NOT NULL,
  `total_notification` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `page`, `site`, `total_notification`) VALUES
(1, 'join_us', 'new_students', 0),
(2, 'contact_us', 'new_feedback', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schoolroutine`
--

CREATE TABLE `schoolroutine` (
  `id` int NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `routine_url` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schoolroutine`
--

INSERT INTO `schoolroutine` (`id`, `class_name`, `routine_url`, `updated_at`) VALUES
(1, 'Nursery', NULL, NULL),
(2, '1 ( English Medium )', NULL, NULL),
(3, '2 ( English Medium )', NULL, NULL),
(4, '3 ( English Medium )', NULL, NULL),
(5, '4 ( English Medium )', 'assets/images/routines/screenshot_7.png', '2024-03-29 10:42:00'),
(6, '5 ( English Medium )', NULL, NULL),
(7, '6 ( English Medium )', NULL, NULL),
(8, '6 ( Nepali Medium )', NULL, NULL),
(9, '7 ( English Medium )', NULL, NULL),
(10, '7 ( Nepali Medium )', NULL, NULL),
(11, '8 ( English Medium )', NULL, NULL),
(12, '8 ( Nepali Medium )', NULL, NULL),
(13, '9 ( Nepali Medium )', NULL, NULL),
(14, '10 ( Nepali Medium )', NULL, NULL),
(15, '9 ( Computer Engineering )', NULL, NULL),
(16, '10 ( Computer Engineering )', NULL, NULL),
(17, '11 ( Computer Engineering )', NULL, NULL),
(18, '12 ( Computer Engineering )', NULL, NULL),
(19, '+2 ( Commerce )', 'assets/images/routines/2023_12_23_14_02_img_6275.jpg', '2024-03-29 11:40:00'),
(20, '+2 ( Computer Science )', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school_notice`
--

CREATE TABLE `school_notice` (
  `id` int NOT NULL,
  `logo` varchar(999) NOT NULL,
  `posted_by_id` int DEFAULT NULL,
  `image_url` varchar(999) NOT NULL,
  `about` varchar(500) NOT NULL,
  `notice_description` varchar(9999) NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `total_views` int NOT NULL,
  `total_downloads` int NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `image_src` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `name`, `post`, `subject`, `qualification`, `contact`, `image_src`) VALUES
(1, 'Thir Kumar Dahal', 'Principal', '', 'M.Ed', '9844640316', 'assets/images/staff/thir_kumar_dahal.jpg'),
(2, 'Supen Chandra Singh Rajbanshi', 'Teacher', '', 'MA / M.Ed', '9804903845', 'assets/images/staff/img_639aad4227d326_28248876.jpg'),
(3, 'Laxmi Kafle', 'Teacher', '', 'M.Ed', '9842438801', 'assets/images/staff/img_639aad71bc1723_67601627.jpg'),
(4, 'Sabita Rajbanshi\r\n', 'Teacher', '', 'M.Ed', '9860155878', 'assets/images/staff/img_639aad94333361_83266687.jpg'),
(5, 'Dilli Ram Bhattarai', 'Teacher', '', 'M.Ed', '9842751110', 'assets/images/staff/dilli_ram_bhattarai.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `web_content`
--

CREATE TABLE `web_content` (
  `id` int NOT NULL,
  `content_about` varchar(500) NOT NULL,
  `one` varchar(1000) NOT NULL,
  `two` varchar(1000) NOT NULL,
  `three` varchar(1000) NOT NULL,
  `four` varchar(1000) NOT NULL,
  `five` varchar(1000) NOT NULL,
  `six` varchar(1000) NOT NULL,
  `seven` varchar(1000) NOT NULL,
  `eight` varchar(1000) NOT NULL,
  `nine` varchar(500) NOT NULL,
  `ten` varchar(500) NOT NULL,
  `eleven` varchar(500) NOT NULL,
  `twelve` varchar(500) NOT NULL,
  `thirteen` varchar(500) NOT NULL,
  `fourteen` varchar(500) NOT NULL,
  `fifteen` varchar(1000) NOT NULL,
  `sixteen` varchar(1000) NOT NULL,
  `seventeen` varchar(500) NOT NULL,
  `eighteen` varchar(500) NOT NULL,
  `ninteen` varchar(500) NOT NULL,
  `twenty` varchar(500) NOT NULL,
  `twentyone` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `web_content`
--

INSERT INTO `web_content` (`id`, `content_about`, `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`, `nine`, `ten`, `eleven`, `twelve`, `thirteen`, `fourteen`, `fifteen`, `sixteen`, `seventeen`, `eighteen`, `ninteen`, `twenty`, `twentyone`) VALUES
(1, 'index', 'We embrace students from diverse faiths, races, and backgrounds, offering enhanced facilities to cater to their educational requirements. As a dynamic and inspiring educational institution, our school serves as a model for the broader learning community. We uphold the highest standards of education across various specializations, providing excellent teachers, quality support materials, and a welcoming atmosphere to foster skill development in students. Our educational reach extends from nursery to grade 12, including Computer Engineering courses for classes 9 to 12.', 'Numerous compelling reasons make us the ideal choice for your education at our school. Here, we provide:\n\n', 'A highly qualified teacher is integral to our education system, making learning enjoyable and engaging. With innovative teaching techniques, our educators ensure swift and effective learning. Choose our team for an enlightening and tailored educational experience that enhances your learning journey.', 'Your study environment significantly influences learning effectiveness. A tidy, tranquil space aids information absorption. Our serene and clean setting promotes efficient studying, ensuring a positive impact on your academic focus and productivity', 'Digital learning leverages technologies such as multimedia and the internet, fostering comprehensive student development and enhancing societal digital literacy. Our offerings include audio-visual learning experiences and computer labs equipped with high-speed internet, enriching the educational journey.', 'Discover an educational haven where excellence meets innovation! Our school provides a vibrant environment that fuels curiosity and sparks creativity. With qualified teachers, state-of-the-art facilities, and a focus on holistic development, we pave the way for a bright future. Enroll today for an inspiring educational journey!', 'The school setting is highly invigorating, characterized by openness and brightness, and our staff members are truly exceptional. Our time spent in school is enjoyable, thanks to the presence of good-natured and approachable teachers. Within the school, we delve into a variety of topics that pique our interest and are relevant to our future endeavors. The presence of supportive teachers is instrumental in helping us comprehend and navigate challenges seamlessly. Additionally, the school frequently organizes extracurricular activities, contributing to the development of our interpersonal skills and more.', 'The inaugural batch of Computer Engineering, commencing from class 9, was initiated in the year 2078 B.S. Presently, we conduct regular engineering classes spanning from class 9 to class 11. Computer engineering, situated at the intersection of electrical engineering and computer science, amalgamates various facets of both disciplines essential for the development of computer hardware and software. This field not only employs techniques and principles from electrical engineering and computer science but also encompasses domains like artificial intelligence (AI), robotics, computer networks, computer architecture, and operating systems.', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'about', 'Your school name school, established in 2019 B.S., offers education from nursery to grade 12, including Computer Engineering from class 9 to 12. Led by the school leadership team, the school operates with a structured daily routine and a strong focus on student growth. With dedicated staff and a vibrant student community, the campus provides a peaceful environment, including open play space and well-equipped classrooms. Basic facilities such as clean water, separate washrooms, and student support services are ensured. The school emphasizes practical learning, incorporating labs for computer, physics, chemistry, network, and electric experiments. Extracurricular activities like singing, dancing, quizzes, speeches, and essay writing are organized, contributing to the overall growth of disciplined and confident students.', 'I\'m really excited to be the Principal at your school name school. Thanks to the school management team for trusting me with this role. We\'re committed to giving top-notch education that inspires our students to love learning and become valuable members of society. Our goal is to help each student reach their full potential. Parents, feel free to drop by anytime to chat about your child\'s education. We\'re building a fantastic learning community here, where everyone is dedicated to excellence. I\'m here to lead the school with energy and passion to help us achieve our goals. Looking forward to a great journey together!', 'Our school rules focus on being polite, using common sense, and staying safe. We expect everyone to behave well and dress appropriately. If students don\'t follow these rules or struggle with their work, we address it seriously.', 'Be prepared for class each day', 'Be on time for school', 'Follow the teacher\'s directions the first time they are given', 'Be polite to the teacher and your classmates', 'Help keep the school environment clean and tidy', 'Have a good attitude', 'Complete homework and assignments on time', 'Respect other student\'s personal belongings', 'Treat others the way you want to be treated', 'Always use your inside voice. (No yelling)', 'Your school name school offers courses from nursery to grade 12, including specialized Computer Engineering classes (grades 9-12). Our emphasis on practical learning is evident in well-equipped labs for computer, physics, chemistry, network, and electric studies. We prioritize innovation with digital learning, CCTV-equipped classrooms, and activities to enhance writing and public speaking skills.', 'The inaugural batch of Computer Engineering at your school name school began in 2076 B.S., starting from class 9. Currently, we offer regular classes in engineering spanning from class 9 to class 12. Computer engineering, a branch of electrical engineering and computer science, integrates various fields essential for the development of computer hardware and software. The curriculum encompasses principles of electrical engineering and computer science, along with areas like artificial intelligence, robotics, computer networks, architecture, and operating systems.', 'Management, in essence, involves overseeing and directing an organization\'s functions. A management course signals your commitment to growing as a manager, instilling confidence in your team. It goes beyond handling singular activities, encompassing the control of both things and people. The scope spans across various organizations, from private institutions to government bodies, schools to universities, and profit-driven businesses to non-profit organizations. Recognizing the significance of this field, our campus offers courses in management to equip individuals with the essential skills for effective organizational leadership.', 'Our school boasts state-of-the-art facilities, including a Physics Lab for hands-on experiments, a Computer Lab for programming and projects, and other specialized labs, all contributing to an enriched learning environment.', 'Our well-managed physics lab caters to the needs of students up to grade 12, starting their practical experiments from class 6. Equipped with modern apparatus such as lenses, magnets, and advanced tools like voltmeters, the lab accommodates 15 students working in pairs.', 'Specifically designed for programming and project works, the computer lab supports engineering students and provides information about computer technology to general students. The lab, equipped with the latest computers, is supervised by a lab assistant who aids students in their projects and tasks.', 'This laboratory is designed to facilitate the general electronics engineering experiments and project works by the students. The laboratory has workstations each equipped with laboratory power supply, and oscilloscope. Most of the general purpose electronic components are kept in the stock and are issued as per the need of students.', 'Our extensive library boasts a collection of textbooks, reference books, study materials, newspapers, and magazines. With around 1000 books available for reference, students can use the library reading room for uninterrupted reading or borrow books for self-study.'),
(3, 'notice', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'contactus', 'Welcome to our school, a hub of dynamic education where diversity converges, creating an enriching and inspiring learning environment. For inquiries, enrollment details, or any information about our courses, feel free to contact us.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'join', 'Unlock a world of boundless opportunities at your school name school! Calling all students to embark on a transformative educational journey with us. Enroll now and experience dynamic learning in a vibrant and inspiring environment. Explore your potential, fuel your passion, and join our community where success begins. Contact us for enrollment details and step into a future of academic excellence!', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 'extras', 'This page at our school captures vibrant moments, events, picnics, and lasting memories. Aligned with the national education vision, our daily routine, holidays, and diverse subjects enrich our academic journey. A digital repository grants access to useful learning material, and our staff, committee, and PTA ensure a supportive environment. Noteworthy, our students developed the website, a portal to our dynamic educational community.', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_admins_identity_code` (`identity_code`),
  ADD UNIQUE KEY `uq_admins_username` (`username`);

--
-- Indexes for table `admission_form`
--
ALTER TABLE `admission_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactfeedback`
--
ALTER TABLE `contactfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_notice`
--
ALTER TABLE `flash_notice`
  ADD PRIMARY KEY (`id`);

--
--
-- Indexes for table `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_gallery_album_name` (`album_name`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_gallery_images_album_id` (`album_id`);

--
-- Indexes for table `management_committee`
--
ALTER TABLE `management_committee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_notification_page_site` (`page`,`site`);

--
-- Indexes for table `schoolroutine`
--
ALTER TABLE `schoolroutine`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_schoolroutine_class_name` (`class_name`);

--
-- Indexes for table `school_notice`
--
ALTER TABLE `school_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_school_notice_posted_by_id` (`posted_by_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_content`
--
ALTER TABLE `web_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_web_content_content_about` (`content_about`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admission_form`
--
ALTER TABLE `admission_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `contactfeedback`
--
ALTER TABLE `contactfeedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `flash_notice`
--
ALTER TABLE `flash_notice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `management_committee`
--
ALTER TABLE `management_committee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schoolroutine`
--
ALTER TABLE `schoolroutine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `school_notice`
--
ALTER TABLE `school_notice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `web_content`
--
ALTER TABLE `web_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD CONSTRAINT `fk_gallery_images_album` FOREIGN KEY (`album_id`) REFERENCES `gallery_album` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `school_notice`
--
ALTER TABLE `school_notice`
  ADD CONSTRAINT `fk_school_notice_posted_by` FOREIGN KEY (`posted_by_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
