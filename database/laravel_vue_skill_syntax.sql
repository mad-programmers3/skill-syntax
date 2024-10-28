-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2024 at 11:51 AM
-- Server version: 8.0.39-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_vue_skill_syntax`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `thumbnail_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `thumbnail_id`, `title`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Web Development', 'Courses on building websites and web applications.', 1, '2024-10-28 05:39:21', '2024-10-28 05:39:21'),
(2, NULL, 'Data Science', 'Courses focused on data analysis, machine learning, and AI.', 1, '2024-10-28 05:39:21', '2024-10-28 05:39:21'),
(3, NULL, 'Graphic Design', 'Courses on visual communication and design principles.', 1, '2024-10-28 05:39:21', '2024-10-28 05:39:21'),
(4, NULL, 'Digital Marketing', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(5, NULL, 'Art Design', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(6, NULL, 'Consolating', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(7, NULL, 'Content Writing', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(8, NULL, 'Finance', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(9, NULL, 'Marketing', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(10, NULL, 'Music & Audio', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(11, NULL, 'Networking', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:22', '2024-10-28 05:39:22'),
(12, NULL, 'Photography', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:23', '2024-10-28 05:39:23'),
(13, NULL, 'Science', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:23', '2024-10-28 05:39:23'),
(14, NULL, 'Videography', 'Courses covering SEO, social media, and online advertising.', 1, '2024-10-28 05:39:23', '2024-10-28 05:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `sub_category_id` bigint UNSIGNED NOT NULL,
  `thumbnail_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(8,2) NOT NULL DEFAULT '0.00',
  `sits` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `category_id`, `sub_category_id`, `thumbnail_id`, `title`, `description`, `price`, `sits`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, 'Java & DSA Course for Placement', '<h2>This Tutorial</h2><p>This tutorial is made to help you learn Data Structures and Algorithms (DSA) fast and easy.</p><p>Animations, like the one below, are used to explain ideas along the way.</p><p>First, you will learn the fundamentals of DSA: understanding different data structures, basic algorithm concepts, and how they are used in programming.</p><p>Then, you will learn more about complex data structures like trees and graphs, study advanced sorting and searching algorithms, explore concepts like time complexity, and more.</p><p>This tutorial will give you a solid foundation in Data Structures and Algorithms, an essential skill for any software developer.</p><p><br></p><h2>What You Should Already Know</h2><p>Although Data Structures and Algorithms is actually not specific to any programming language, you should have a basic understanding of programming in one of these common programming languages:</p><ul><li><a href=\"https://www.w3schools.com/python/default.asp\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: inherit;\">Python</a></li><li><a href=\"https://www.w3schools.com/c/index.php\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: inherit;\">C</a></li><li><a href=\"https://www.w3schools.com/cpp/default.asp\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: inherit;\">C++</a></li><li><a href=\"https://www.w3schools.com/java/default.asp\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: inherit;\">Java</a></li><li><a href=\"https://www.w3schools.com/js/default.asp\" rel=\"noopener noreferrer\" target=\"_blank\" style=\"color: inherit;\">JavaScript</a></li></ul><h2>DSA History</h2><p>The word \'algorithm\' comes from \'al-Khwarizmi\', named after a Persian scholar who lived around year 800.</p><p>The concept of algorithmic problem-solving can be traced back to ancient times, long before the invention of computers.</p><p>The study of Data Structures and Algorithms really took off with the invention of computers in the 1940s, to efficiently manage and process data.</p><p>Today, DSA is a key part of Computer Science education and professional programming, helping us to create faster and more powerful software.</p><p><br></p>', '3598.00', 50, '2024-01-01', '2024-03-01', 1, '2024-10-28 05:39:23', '2024-10-28 05:39:23'),
(2, 2, 2, 2, NULL, 'Data Science Bootcamp', 'Become a data scientist in this comprehensive bootcamp covering Python, R, and machine learning.', '199.99', 30, '2024-02-01', '2024-04-01', 1, '2024-10-28 05:39:24', '2024-10-28 05:39:24'),
(3, 1, 3, 3, NULL, 'Graphic Design Fundamentals', 'An introduction to graphic design concepts, tools, and techniques.', '89.99', 40, '2024-03-01', '2024-05-01', 1, '2024-10-28 05:39:24', '2024-10-28 05:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `course_likes`
--

CREATE TABLE `course_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_likes`
--

INSERT INTO `course_likes` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-28 05:39:35', '2024-10-28 05:39:35'),
(2, 2, 1, '2024-10-28 05:39:35', '2024-10-28 05:39:35'),
(3, 3, 1, '2024-10-28 05:39:36', '2024-10-28 05:39:36'),
(4, 4, 1, '2024-10-28 05:39:36', '2024-10-28 05:39:36'),
(5, 5, 1, '2024-10-28 05:39:36', '2024-10-28 05:39:36'),
(6, 6, 1, '2024-10-28 05:39:37', '2024-10-28 05:39:37'),
(7, 7, 1, '2024-10-28 05:39:37', '2024-10-28 05:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `course_quizzes`
--

CREATE TABLE `course_quizzes` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `quiz_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_quizzes`
--

INSERT INTO `course_quizzes` (`id`, `course_id`, `quiz_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-28 05:39:24', '2024-10-28 05:39:24'),
(2, 1, 2, '2024-10-28 05:39:25', '2024-10-28 05:39:25'),
(3, 1, 3, '2024-10-28 05:39:25', '2024-10-28 05:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `course_reviews`
--

CREATE TABLE `course_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `review_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_reviews`
--

INSERT INTO `course_reviews` (`id`, `course_id`, `review_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-28 05:39:30', '2024-10-28 05:39:30'),
(2, 1, 2, '2024-10-28 05:39:30', '2024-10-28 05:39:30'),
(3, 1, 3, '2024-10-28 05:39:30', '2024-10-28 05:39:30'),
(4, 1, 4, '2024-10-28 05:39:31', '2024-10-28 05:39:31'),
(5, 1, 5, '2024-10-28 05:39:32', '2024-10-28 05:39:32');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `thumbnail_id` bigint UNSIGNED DEFAULT NULL,
  `video_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `thumbnail_id`, `video_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'Introduction to Java Language | Lecture 1', 'This is the detailed description for Introduction to Java Language | Lecture 1 of the course Java & DSA Course for Placement, covering essential concepts and exercises.', 1, '2024-10-28 05:39:26', '2024-10-28 05:39:26'),
(2, 1, NULL, NULL, 'Variables in Java | Input Output', 'This is the detailed description for Variables in Java | Input Output of the course Java & DSA Course for Placement, covering essential concepts and exercises.', 1, '2024-10-28 05:39:26', '2024-10-28 05:39:26'),
(3, 1, NULL, NULL, 'Conditional Statements | If-else, Switch Break', 'This is the detailed description for Conditional Statements | If-else, Switch Break of the course Java & DSA Course for Placement, covering essential concepts and exercises.', 1, '2024-10-28 05:39:26', '2024-10-28 05:39:26'),
(4, 1, NULL, NULL, 'Loops in Java', 'This is the detailed description for Loops in Java of the course Java & DSA Course for Placement, covering essential concepts and exercises.', 1, '2024-10-28 05:39:26', '2024-10-28 05:39:26'),
(5, 1, NULL, NULL, '9 Best Patterns Questions in Java (for Beginners)', 'This is the detailed description for 9 Best Patterns Questions in Java (for Beginners) of the course Java & DSA Course for Placement, covering essential concepts and exercises.', 1, '2024-10-28 05:39:27', '2024-10-28 05:39:27'),
(6, 1, NULL, NULL, 'Advanced Pattern Questions in Java', 'This is the detailed description for Advanced Pattern Questions in Java of the course Java & DSA Course for Placement, covering essential concepts and exercises.', 1, '2024-10-28 05:39:27', '2024-10-28 05:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_likes`
--

CREATE TABLE `lesson_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `lesson_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_likes`
--

INSERT INTO `lesson_likes` (`id`, `user_id`, `lesson_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-28 05:39:37', '2024-10-28 05:39:37'),
(2, 2, 1, '2024-10-28 05:39:37', '2024-10-28 05:39:37'),
(3, 3, 1, '2024-10-28 05:39:37', '2024-10-28 05:39:37'),
(4, 4, 1, '2024-10-28 05:39:38', '2024-10-28 05:39:38'),
(5, 5, 1, '2024-10-28 05:39:38', '2024-10-28 05:39:38'),
(6, 6, 1, '2024-10-28 05:39:38', '2024-10-28 05:39:38'),
(7, 7, 1, '2024-10-28 05:39:38', '2024-10-28 05:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_quizzes`
--

CREATE TABLE `lesson_quizzes` (
  `id` bigint UNSIGNED NOT NULL,
  `lesson_id` bigint UNSIGNED NOT NULL,
  `quiz_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_quizzes`
--

INSERT INTO `lesson_quizzes` (`id`, `lesson_id`, `quiz_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2024-10-28 05:39:27', '2024-10-28 05:39:27'),
(2, 2, 5, '2024-10-28 05:39:28', '2024-10-28 05:39:28'),
(3, 3, 6, '2024-10-28 05:39:28', '2024-10-28 05:39:28'),
(4, 4, 7, '2024-10-28 05:39:29', '2024-10-28 05:39:29'),
(5, 5, 8, '2024-10-28 05:39:29', '2024-10-28 05:39:29');

-- --------------------------------------------------------

--
-- Table structure for table `lesson_reviews`
--

CREATE TABLE `lesson_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `lesson_id` bigint UNSIGNED NOT NULL,
  `review_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lesson_reviews`
--

INSERT INTO `lesson_reviews` (`id`, `lesson_id`, `review_id`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2024-10-28 05:39:32', '2024-10-28 05:39:32'),
(2, 1, 7, '2024-10-28 05:39:33', '2024-10-28 05:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(178, '2014_10_12_000000_create_roles_table', 1),
(179, '2014_10_12_000001_create_users_table', 1),
(180, '2014_10_12_100000_create_password_resets_table', 1),
(181, '2019_08_19_000000_create_failed_jobs_table', 1),
(182, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(183, '2024_09_22_040923_create_categories_table', 1),
(184, '2024_09_22_040933_create_sub_categories_table', 1),
(185, '2024_09_22_041924_create_quizzes_table', 1),
(186, '2024_09_22_041925_create_questions_table', 1),
(187, '2024_09_22_045939_create_courses_table', 1),
(188, '2024_09_22_051225_create_reviews_table', 1),
(189, '2024_09_23_013105_create_modules_table', 1),
(190, '2024_09_23_013127_create_permissions_table', 1),
(191, '2024_09_23_013213_create_role_modules_table', 1),
(192, '2024_09_23_013233_create_role_permissions_table', 1),
(193, '2024_09_23_100524_create_lessons_table', 1),
(194, '2024_09_24_034750_create_course_reviews_table', 1),
(195, '2024_09_24_034915_create_lesson_reviews_table', 1),
(196, '2024_09_24_035049_create_testimonials_table', 1),
(197, '2024_09_24_103203_create_course_likes_table', 1),
(198, '2024_09_24_103204_create_review_likes_table', 1),
(199, '2024_09_24_103253_create_lesson_likes_table', 1),
(200, '2024_09_25_043747_create_my_files_table', 1),
(201, '2024_10_15_021011_create_settings_table', 1),
(202, '2024_10_21_102322_create_course_quizzes_table', 1),
(203, '2024_10_22_043129_create_lesson_quizzes_table', 1),
(204, '2024_10_22_091434_create_purchased_courses_table', 1),
(205, '2024_10_23_060601_create_solved_questions_table', 1),
(206, '2024_10_25_113928_create_student_lessons_table', 1),
(207, '2024_10_27_061012_create_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `parent_id`, `name`, `link`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', '/admin/dashboard', 'mdi mdi-home', 1, '2024-10-28 05:39:39', '2024-10-28 05:39:39'),
(2, 0, 'Course', '#', 'fa fa-book', 1, '2024-10-28 05:39:40', '2024-10-28 05:39:40'),
(3, 2, 'Courses', '/admin/course/courses', NULL, 1, '2024-10-28 05:39:40', '2024-10-28 05:39:40'),
(4, 2, 'Lessons', '/admin/course/lessons', NULL, 1, '2024-10-28 05:39:41', '2024-10-28 05:39:41'),
(5, 2, 'Categories', '/admin/course/categories', NULL, 1, '2024-10-28 05:39:42', '2024-10-28 05:39:42'),
(6, 2, 'Sub Categories', '/admin/course/sub-categories', NULL, 1, '2024-10-28 05:39:43', '2024-10-28 05:39:43'),
(7, 2, 'Pending', '/admin/course/pending', NULL, 1, '2024-10-28 05:39:45', '2024-10-28 05:39:45'),
(8, 0, 'Quiz', '#', 'fas fa-clipboard-list', 1, '2024-10-28 05:39:46', '2024-10-28 05:39:46'),
(9, 8, 'Quizzes', '/admin/quiz/quizzes', NULL, 1, '2024-10-28 05:39:47', '2024-10-28 05:39:47'),
(10, 8, 'Questions', '/admin/quiz/questions', NULL, 1, '2024-10-28 05:39:48', '2024-10-28 05:39:48'),
(11, 0, 'Review', '#', 'fas fa-star', 1, '2024-10-28 05:39:50', '2024-10-28 05:39:50'),
(12, 11, 'Reviews', '/admin/review/reviews', NULL, 1, '2024-10-28 05:39:50', '2024-10-28 05:39:50'),
(13, 11, 'Course Reviews', '/admin/review/course-review', NULL, 1, '2024-10-28 05:39:51', '2024-10-28 05:39:51'),
(14, 11, 'Lesson Reviews', '/admin/review/lesson-review', NULL, 1, '2024-10-28 05:39:58', '2024-10-28 05:39:58'),
(15, 11, 'Testimonials', '/admin/review/testimonials', NULL, 1, '2024-10-28 05:40:16', '2024-10-28 05:40:16'),
(16, 0, 'User', '#', 'fas fa-user', 1, '2024-10-28 05:40:21', '2024-10-28 05:40:21'),
(17, 16, 'Users', '/admin/user/users', NULL, 1, '2024-10-28 05:40:22', '2024-10-28 05:40:22'),
(18, 16, 'Profile', '/admin/user/profile', NULL, 1, '2024-10-28 05:40:31', '2024-10-28 05:40:31'),
(19, 0, 'Configuration', '#', 'fas fa-check-square', 1, '2024-10-28 05:40:35', '2024-10-28 05:40:35'),
(20, 19, 'Roles', '/admin/config/roles', NULL, 1, '2024-10-28 05:40:36', '2024-10-28 05:40:36'),
(21, 19, 'Modules', '/admin/config/modules', NULL, 1, '2024-10-28 05:40:40', '2024-10-28 05:40:40'),
(22, 19, 'Permissions', '/admin/config/permissions', NULL, 1, '2024-10-28 05:40:45', '2024-10-28 05:40:45'),
(23, 19, 'Role Configs', '/admin/config/manage-roles', NULL, 1, '2024-10-28 05:40:51', '2024-10-28 05:40:51'),
(24, 0, 'Settings', '/admin/settings', 'fas fa-cog', 1, '2024-10-28 05:40:55', '2024-10-28 05:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `my_files`
--

CREATE TABLE `my_files` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `duration` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'dashboard_view', 1, '2024-10-28 05:39:39', '2024-10-28 05:39:39'),
(2, 1, 'dashboard_add', 1, '2024-10-28 05:39:39', '2024-10-28 05:39:39'),
(3, 1, 'dashboard_edit', 1, '2024-10-28 05:39:39', '2024-10-28 05:39:39'),
(4, 1, 'dashboard_delete', 1, '2024-10-28 05:39:39', '2024-10-28 05:39:39'),
(5, 3, 'course_view', 1, '2024-10-28 05:39:40', '2024-10-28 05:39:40'),
(6, 3, 'course_add', 1, '2024-10-28 05:39:40', '2024-10-28 05:39:40'),
(7, 3, 'course_edit', 1, '2024-10-28 05:39:40', '2024-10-28 05:39:40'),
(8, 3, 'course_delete', 1, '2024-10-28 05:39:41', '2024-10-28 05:39:41'),
(9, 3, 'course_accept', 1, '2024-10-28 05:39:41', '2024-10-28 05:39:41'),
(10, 4, 'lesson_view', 1, '2024-10-28 05:39:41', '2024-10-28 05:39:41'),
(11, 4, 'lesson_add', 1, '2024-10-28 05:39:41', '2024-10-28 05:39:41'),
(12, 4, 'lesson_edit', 1, '2024-10-28 05:39:42', '2024-10-28 05:39:42'),
(13, 4, 'lesson_delete', 1, '2024-10-28 05:39:42', '2024-10-28 05:39:42'),
(14, 5, 'category_view', 1, '2024-10-28 05:39:42', '2024-10-28 05:39:42'),
(15, 5, 'category_add', 1, '2024-10-28 05:39:43', '2024-10-28 05:39:43'),
(16, 5, 'category_edit', 1, '2024-10-28 05:39:43', '2024-10-28 05:39:43'),
(17, 5, 'category_delete', 1, '2024-10-28 05:39:43', '2024-10-28 05:39:43'),
(18, 6, 'sub_category_view', 1, '2024-10-28 05:39:44', '2024-10-28 05:39:44'),
(19, 6, 'sub_category_add', 1, '2024-10-28 05:39:44', '2024-10-28 05:39:44'),
(20, 6, 'sub_category_edit', 1, '2024-10-28 05:39:44', '2024-10-28 05:39:44'),
(21, 6, 'sub_category_delete', 1, '2024-10-28 05:39:44', '2024-10-28 05:39:44'),
(22, 7, 'pending_view', 1, '2024-10-28 05:39:45', '2024-10-28 05:39:45'),
(23, 7, 'pending_add', 1, '2024-10-28 05:39:45', '2024-10-28 05:39:45'),
(24, 7, 'pending_edit', 1, '2024-10-28 05:39:45', '2024-10-28 05:39:45'),
(25, 7, 'pending_delete', 1, '2024-10-28 05:39:46', '2024-10-28 05:39:46'),
(26, 9, 'quiz_view', 1, '2024-10-28 05:39:47', '2024-10-28 05:39:47'),
(27, 9, 'quiz_add', 1, '2024-10-28 05:39:48', '2024-10-28 05:39:48'),
(28, 9, 'quiz_edit', 1, '2024-10-28 05:39:48', '2024-10-28 05:39:48'),
(29, 9, 'quiz_delete', 1, '2024-10-28 05:39:48', '2024-10-28 05:39:48'),
(30, 10, 'question_view', 1, '2024-10-28 05:39:49', '2024-10-28 05:39:49'),
(31, 10, 'question_add', 1, '2024-10-28 05:39:49', '2024-10-28 05:39:49'),
(32, 10, 'question_edit', 1, '2024-10-28 05:39:49', '2024-10-28 05:39:49'),
(33, 10, 'question_delete', 1, '2024-10-28 05:39:49', '2024-10-28 05:39:49'),
(34, 12, 'review_view', 1, '2024-10-28 05:39:50', '2024-10-28 05:39:50'),
(35, 12, 'review_add', 1, '2024-10-28 05:39:50', '2024-10-28 05:39:50'),
(36, 12, 'review_edit', 1, '2024-10-28 05:39:51', '2024-10-28 05:39:51'),
(37, 12, 'review_delete', 1, '2024-10-28 05:39:51', '2024-10-28 05:39:51'),
(38, 13, 'course_review_view', 1, '2024-10-28 05:39:56', '2024-10-28 05:39:56'),
(39, 13, 'course_review_add', 1, '2024-10-28 05:39:57', '2024-10-28 05:39:57'),
(40, 13, 'course_review_edit', 1, '2024-10-28 05:39:57', '2024-10-28 05:39:57'),
(41, 13, 'course_review_delete', 1, '2024-10-28 05:39:58', '2024-10-28 05:39:58'),
(42, 14, 'lesson_review_view', 1, '2024-10-28 05:39:59', '2024-10-28 05:39:59'),
(43, 14, 'lesson_review_add', 1, '2024-10-28 05:40:00', '2024-10-28 05:40:00'),
(44, 14, 'lesson_review_edit', 1, '2024-10-28 05:40:02', '2024-10-28 05:40:02'),
(45, 14, 'lesson_review_delete', 1, '2024-10-28 05:40:14', '2024-10-28 05:40:14'),
(46, 15, 'testimonial_view', 1, '2024-10-28 05:40:17', '2024-10-28 05:40:17'),
(47, 15, 'testimonial_add', 1, '2024-10-28 05:40:18', '2024-10-28 05:40:18'),
(48, 15, 'testimonial_edit', 1, '2024-10-28 05:40:20', '2024-10-28 05:40:20'),
(49, 15, 'testimonial_delete', 1, '2024-10-28 05:40:20', '2024-10-28 05:40:20'),
(50, 17, 'user_view', 1, '2024-10-28 05:40:25', '2024-10-28 05:40:25'),
(51, 17, 'user_add', 1, '2024-10-28 05:40:28', '2024-10-28 05:40:28'),
(52, 17, 'user_edit', 1, '2024-10-28 05:40:29', '2024-10-28 05:40:29'),
(53, 17, 'user_delete', 1, '2024-10-28 05:40:30', '2024-10-28 05:40:30'),
(54, 18, 'profile_show', 1, '2024-10-28 05:40:33', '2024-10-28 05:40:33'),
(55, 18, 'profile_edit', 1, '2024-10-28 05:40:34', '2024-10-28 05:40:34'),
(56, 18, 'profile_delete', 1, '2024-10-28 05:40:34', '2024-10-28 05:40:34'),
(57, 20, 'role_view', 1, '2024-10-28 05:40:37', '2024-10-28 05:40:37'),
(58, 20, 'role_add', 1, '2024-10-28 05:40:37', '2024-10-28 05:40:37'),
(59, 20, 'role_edit', 1, '2024-10-28 05:40:38', '2024-10-28 05:40:38'),
(60, 20, 'role_delete', 1, '2024-10-28 05:40:39', '2024-10-28 05:40:39'),
(61, 20, 'role_manage', 1, '2024-10-28 05:40:39', '2024-10-28 05:40:39'),
(62, 21, 'module_view', 1, '2024-10-28 05:40:41', '2024-10-28 05:40:41'),
(63, 21, 'module_add', 1, '2024-10-28 05:40:42', '2024-10-28 05:40:42'),
(64, 21, 'module_edit', 1, '2024-10-28 05:40:44', '2024-10-28 05:40:44'),
(65, 21, 'module_delete', 1, '2024-10-28 05:40:45', '2024-10-28 05:40:45'),
(66, 21, 'module_manage', 1, '2024-10-28 05:40:45', '2024-10-28 05:40:45'),
(67, 22, 'permission_view', 1, '2024-10-28 05:40:46', '2024-10-28 05:40:46'),
(68, 22, 'permission_add', 1, '2024-10-28 05:40:47', '2024-10-28 05:40:47'),
(69, 22, 'permission_edit', 1, '2024-10-28 05:40:48', '2024-10-28 05:40:48'),
(70, 22, 'permission_delete', 1, '2024-10-28 05:40:49', '2024-10-28 05:40:49'),
(71, 22, 'permission_manage', 1, '2024-10-28 05:40:50', '2024-10-28 05:40:50'),
(72, 23, 'role_config_view', 1, '2024-10-28 05:40:52', '2024-10-28 05:40:52'),
(73, 23, 'role_config_add', 1, '2024-10-28 05:40:53', '2024-10-28 05:40:53'),
(74, 23, 'role_config_edit', 1, '2024-10-28 05:40:54', '2024-10-28 05:40:54'),
(75, 23, 'role_config_delete', 1, '2024-10-28 05:40:54', '2024-10-28 05:40:54'),
(76, 24, 'setting_view', 1, '2024-10-28 05:40:55', '2024-10-28 05:40:55'),
(77, 24, 'setting_add', 1, '2024-10-28 05:40:56', '2024-10-28 05:40:56'),
(78, 24, 'setting_edit', 1, '2024-10-28 05:40:57', '2024-10-28 05:40:57'),
(79, 24, 'setting_delete', 1, '2024-10-28 05:40:57', '2024-10-28 05:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchased_courses`
--

CREATE TABLE `purchased_courses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `current_lesson_id` bigint UNSIGNED DEFAULT NULL,
  `current_quiz_id` bigint UNSIGNED DEFAULT NULL,
  `marks` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `quiz_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `title`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'Which statement is used to exit a switch case in Java?', 'exit', 'return', 'stop', 'break', 'd', '2024-10-28 05:38:35', '2024-10-28 05:38:35'),
(2, 1, 'Which loop will always execute at least once, regardless of the condition?', 'for loop', 'while loop', 'do-while loop', 'foreach loop', 'c', '2024-10-28 05:38:35', '2024-10-28 05:38:35'),
(3, 1, 'How many times will while(false) { System.out.print(\"Loop\"); } execute?', '0 times', '1 time', '2 times', 'Infinite times', 'a', '2024-10-28 05:38:36', '2024-10-28 05:38:36'),
(4, 2, 'Which of these is not a valid type of loop in Java?', 'for', 'while', 'foreach', 'repeat-until', 'd', '2024-10-28 05:38:42', '2024-10-28 05:38:42'),
(5, 2, 'To print a diamond pattern in Java, which type of loop combination is generally used?', 'Only for', 'Only while', 'Combination of for and if-else', 'Only if-else', 'c', '2024-10-28 05:38:42', '2024-10-28 05:38:42'),
(6, 2, 'Which nested loop structure would you use to print a pyramid pattern?', 'One for loop', 'Two for loops', 'Three for loops', 'if condition only', 'b', '2024-10-28 05:38:54', '2024-10-28 05:38:54'),
(7, 3, 'Which of the following is not a Java feature?', 'Object-Oriented', 'Platform-Independent', 'Pointer Manipulation', 'Multithreaded', 'c', '2024-10-28 05:38:54', '2024-10-28 05:38:54'),
(8, 3, 'Which of these is the correct way to start a Java program?', 'public class myProgram', 'public static void main(String[] args)', 'System.out.println(\"Hello\");', 'public void main(String args[])', 'b', '2024-10-28 05:38:55', '2024-10-28 05:38:55'),
(9, 3, 'What is the default value of a boolean in Java?', '0', 'false', 'true', 'null', 'b', '2024-10-28 05:38:56', '2024-10-28 05:38:56'),
(10, 4, 'Which of the following is not a keyword in Java?', 'class', 'try', 'static', 'include', 'd', '2024-10-28 05:38:58', '2024-10-28 05:38:58'),
(11, 4, 'What is the size of the int data type in Java?', '8 bits', '16 bits', '32 bits', '64 bits', 'c', '2024-10-28 05:38:59', '2024-10-28 05:38:59'),
(12, 5, 'Which of the following correctly declares a variable in Java?', 'int num = 5;', 'num int = 5;', 'float = 5.0f', 'string name = \"John\";', 'a', '2024-10-28 05:39:00', '2024-10-28 05:39:00'),
(13, 5, 'Which keyword is used to make a variable unchangeable in Java?', 'static', 'final', 'const', 'volatile', 'b', '2024-10-28 05:39:01', '2024-10-28 05:39:01'),
(14, 5, 'What will System.out.print(\"Hello World\"); output?', 'Hello World', 'Hello World (with a newline)', 'Hello', 'Error', 'a', '2024-10-28 05:39:04', '2024-10-28 05:39:04'),
(15, 5, 'Which of the following is the correct syntax to read input from a user in Java?', 'Scanner input = new Scanner();', 'int num = Scanner.nextInt();', 'Scanner input = new Scanner(System.in);', 'Scanner input = new Scanner(Console);', 'c', '2024-10-28 05:39:13', '2024-10-28 05:39:13'),
(16, 5, 'What data type should you use to store the number 123.456?', 'int', 'long', 'double', 'boolean', 'c', '2024-10-28 05:39:15', '2024-10-28 05:39:15'),
(17, 6, 'What will if (true) { System.out.println(\"Hello\"); } else { System.out.println(\"Bye\"); } print?', 'Hello', 'Bye', 'Nothing', 'Error', 'a', '2024-10-28 05:39:15', '2024-10-28 05:39:15'),
(18, 6, 'Which of the following operators is used for equality checking in Java?', '=', '==', '===', '!=', 'b', '2024-10-28 05:39:15', '2024-10-28 05:39:15'),
(19, 6, 'What will be the output of switch(3) { case 1: System.out.print(\"1\"); case 3: System.out.print(\"3\"); }?', '1', '3', '13', 'Compilation error', 'b', '2024-10-28 05:39:16', '2024-10-28 05:39:16'),
(20, 6, 'What will if (5 > 3) System.out.print(\"Yes\"); else System.out.print(\"No\"); print?', 'Yes', 'No', 'Nothing', 'Error', 'a', '2024-10-28 05:39:16', '2024-10-28 05:39:16'),
(21, 6, 'Which statement is used to exit a switch case in Java?', 'exit', 'return', 'stop', 'break', 'd', '2024-10-28 05:39:18', '2024-10-28 05:39:18'),
(22, 7, 'What is the output of for(int i = 0; i < 3; i++) System.out.print(i);?', '123', '012', '345', '210', 'b', '2024-10-28 05:39:18', '2024-10-28 05:39:18'),
(23, 7, 'Which loop will always execute at least once, regardless of the condition?', 'for loop', 'while loop', 'do-while loop', 'foreach loop', 'c', '2024-10-28 05:39:18', '2024-10-28 05:39:18'),
(24, 7, 'How many times will while(false) { System.out.print(\"Loop\"); } execute?', '0 times', '1 time', '2 times', 'Infinite times', 'a', '2024-10-28 05:39:18', '2024-10-28 05:39:18'),
(25, 7, 'What is the output of for(int i = 1; i <= 5; i++) { if(i == 3) break; System.out.print(i); }?', '12345', '12', '123', '1245', 'b', '2024-10-28 05:39:18', '2024-10-28 05:39:18'),
(26, 7, 'Which of these is not a valid type of loop in Java?', 'for', 'while', 'foreach', 'repeat-until', 'd', '2024-10-28 05:39:19', '2024-10-28 05:39:19'),
(27, 8, 'Which nested loop structure would you use to print a pyramid pattern?', 'One for loop', 'Two for loops', 'Three for loops', 'if condition only', 'b', '2024-10-28 05:39:19', '2024-10-28 05:39:19'),
(28, 8, 'To print a pattern with rows of increasing numbers, which approach is most efficient?', 'Nested loop with increment on i', 'Nested loop with decrement on i', 'Using only if-else', 'Using a while loop only', 'a', '2024-10-28 05:39:19', '2024-10-28 05:39:19'),
(29, 9, 'What does PHP stand for?', 'Personal Home Page', 'PHP: Hypertext Preprocessor', 'Preprocessor Hypertext PHP', 'None of the above', 'b', '2024-10-28 05:39:19', '2024-10-28 05:39:19'),
(30, 9, 'Which of the following is a valid PHP variable?', '$variable_name', 'variable_name', '$variable-name', 'None of the above', 'a', '2024-10-28 05:39:19', '2024-10-28 05:39:19'),
(31, 9, 'What is the correct syntax to output \"Hello World\" in JavaScript?', 'echo \"Hello World\";', 'print(\"Hello World\");', 'console.log(\"Hello World\");', 'None of the above', 'c', '2024-10-28 05:39:20', '2024-10-28 05:39:20'),
(32, 10, 'Which company developed Java?', 'Microsoft', 'Google', 'Sun Microsystems', 'Apple', 'c', '2024-10-28 05:39:20', '2024-10-28 05:39:20'),
(33, 10, 'Which keyword is used to create a class in Java?', 'class', 'public', 'new', 'define', 'a', '2024-10-28 05:39:20', '2024-10-28 05:39:20'),
(34, 10, 'Which method must be implemented by all Java threads?', 'start()', 'run()', 'stop()', 'execute()', 'b', '2024-10-28 05:39:20', '2024-10-28 05:39:20'),
(35, 11, 'What is the default port number for HTTP?', '21', '80', '443', '8080', 'b', '2024-10-28 05:39:20', '2024-10-28 05:39:20'),
(36, 11, 'Which protocol is used to send an email?', 'FTP', 'HTTP', 'SMTP', 'IMAP', 'c', '2024-10-28 05:39:21', '2024-10-28 05:39:21'),
(37, 11, 'Which of the following is a NoSQL database?', 'MySQL', 'PostgreSQL', 'MongoDB', 'SQL Server', 'c', '2024-10-28 05:39:21', '2024-10-28 05:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` int DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `time_limit`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Java & DSA Course for Placement - Quiz 1', 300, 1, '2024-10-28 05:38:26', '2024-10-28 05:39:25'),
(2, 'Java & DSA Course for Placement - Quiz 2', 300, 1, '2024-10-28 05:38:27', '2024-10-28 05:39:25'),
(3, 'Java & DSA Course for Placement - Quiz 3', 300, 1, '2024-10-28 05:38:27', '2024-10-28 05:39:26'),
(4, 'Introduction to Java Language - Quiz', 300, 1, '2024-10-28 05:38:28', '2024-10-28 05:39:28'),
(5, 'Variables in Java - Quiz', 300, 1, '2024-10-28 05:38:28', '2024-10-28 05:39:28'),
(6, 'Conditional Statements - Quiz', 300, 1, '2024-10-28 05:38:29', '2024-10-28 05:39:28'),
(7, 'Loops in Java - Quiz', 300, 1, '2024-10-28 05:38:29', '2024-10-28 05:39:29'),
(8, 'Patterns - Quiz', 300, 1, '2024-10-28 05:38:29', '2024-10-28 05:39:29'),
(9, 'Quiz', 300, 0, '2024-10-28 05:38:30', '2024-10-28 05:38:30'),
(10, 'Quiz', 300, 0, '2024-10-28 05:38:33', '2024-10-28 05:38:33'),
(11, 'Quiz', 300, 0, '2024-10-28 05:38:33', '2024-10-28 05:38:33'),
(12, 'Quiz', 300, 0, '2024-10-28 05:38:34', '2024-10-28 05:38:34'),
(13, 'Quiz', 300, 0, '2024-10-28 05:38:34', '2024-10-28 05:38:34');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `type` tinyint NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `rating`, `comment`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 5, 'Soluta laboriosam magnam eos velit illum rem.', 2, 1, '2024-10-28 05:39:30', '2024-10-28 05:39:30'),
(2, 5, 3, 'Occaecati accusantium ut est beatae et.', 2, 1, '2024-10-28 05:39:30', '2024-10-28 05:39:30'),
(3, 1, 5, 'Omnis ea dicta impedit et.', 2, 1, '2024-10-28 05:39:30', '2024-10-28 05:39:30'),
(4, 1, 4, 'Inventore distinctio error dolores sed saepe voluptatem perspiciatis.', 2, 1, '2024-10-28 05:39:31', '2024-10-28 05:39:31'),
(5, 6, 3, 'Ipsum et velit vitae et aspernatur.', 2, 1, '2024-10-28 05:39:32', '2024-10-28 05:39:32'),
(6, 3, NULL, 'Impedit vel facilis laborum accusantium blanditiis sunt.', 3, 1, '2024-10-28 05:39:32', '2024-10-28 05:39:32'),
(7, 3, NULL, 'Quidem assumenda consequatur et.', 3, 1, '2024-10-28 05:39:32', '2024-10-28 05:39:32'),
(8, 3, 5, 'Repellendus ratione ea accusamus aut officiis quo.', 1, 1, '2024-10-28 05:39:33', '2024-10-28 05:39:33'),
(9, 2, 1, 'Ut error reiciendis libero exercitationem consequatur porro dolor.', 1, 1, '2024-10-28 05:39:33', '2024-10-28 05:39:33'),
(10, 1, 3, 'Perspiciatis deserunt aut eveniet illo laudantium illum nam.', 1, 1, '2024-10-28 05:39:34', '2024-10-28 05:39:34'),
(11, 1, 1, 'Ipsam ducimus rerum expedita occaecati.', 1, 1, '2024-10-28 05:39:34', '2024-10-28 05:39:34'),
(12, 5, 2, 'Et voluptate totam voluptate quod illum fugiat.', 1, 1, '2024-10-28 05:39:35', '2024-10-28 05:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `review_likes`
--

CREATE TABLE `review_likes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `review_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, '2024-10-28 05:38:20', '2024-10-28 05:38:20'),
(2, 'Admin', 1, '2024-10-28 05:38:21', '2024-10-28 05:38:21'),
(3, 'Instructor', 1, '2024-10-28 05:38:22', '2024-10-28 05:38:22'),
(4, 'Student', 1, '2024-10-28 05:38:22', '2024-10-28 05:38:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_modules`
--

CREATE TABLE `role_modules` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `module_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_modules`
--

INSERT INTO `role_modules` (`id`, `role_id`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-28 05:43:17', '2024-10-28 05:43:17'),
(2, 1, 2, '2024-10-28 05:43:17', '2024-10-28 05:43:17'),
(3, 1, 3, '2024-10-28 05:43:18', '2024-10-28 05:43:18'),
(4, 1, 4, '2024-10-28 05:43:18', '2024-10-28 05:43:18'),
(5, 1, 5, '2024-10-28 05:43:18', '2024-10-28 05:43:18'),
(6, 1, 6, '2024-10-28 05:43:19', '2024-10-28 05:43:19'),
(7, 1, 7, '2024-10-28 05:43:19', '2024-10-28 05:43:19'),
(8, 1, 8, '2024-10-28 05:43:19', '2024-10-28 05:43:19'),
(9, 1, 9, '2024-10-28 05:43:20', '2024-10-28 05:43:20'),
(10, 1, 10, '2024-10-28 05:43:20', '2024-10-28 05:43:20'),
(11, 1, 11, '2024-10-28 05:43:20', '2024-10-28 05:43:20'),
(12, 1, 12, '2024-10-28 05:43:20', '2024-10-28 05:43:20'),
(13, 1, 13, '2024-10-28 05:43:21', '2024-10-28 05:43:21'),
(14, 1, 14, '2024-10-28 05:43:21', '2024-10-28 05:43:21'),
(15, 1, 15, '2024-10-28 05:43:21', '2024-10-28 05:43:21'),
(16, 1, 16, '2024-10-28 05:43:22', '2024-10-28 05:43:22'),
(17, 1, 17, '2024-10-28 05:43:22', '2024-10-28 05:43:22'),
(18, 1, 18, '2024-10-28 05:43:22', '2024-10-28 05:43:22'),
(19, 1, 19, '2024-10-28 05:43:22', '2024-10-28 05:43:22'),
(20, 1, 20, '2024-10-28 05:43:23', '2024-10-28 05:43:23'),
(21, 1, 21, '2024-10-28 05:43:23', '2024-10-28 05:43:23'),
(22, 1, 22, '2024-10-28 05:43:24', '2024-10-28 05:43:24'),
(23, 1, 23, '2024-10-28 05:43:24', '2024-10-28 05:43:24'),
(24, 1, 24, '2024-10-28 05:43:24', '2024-10-28 05:43:24'),
(25, 2, 1, '2024-10-28 05:43:25', '2024-10-28 05:43:25'),
(26, 2, 5, '2024-10-28 05:43:25', '2024-10-28 05:43:25'),
(27, 2, 6, '2024-10-28 05:43:25', '2024-10-28 05:43:25'),
(28, 2, 16, '2024-10-28 05:43:26', '2024-10-28 05:43:26'),
(29, 2, 18, '2024-10-28 05:43:26', '2024-10-28 05:43:26'),
(30, 2, 17, '2024-10-28 05:43:27', '2024-10-28 05:43:27'),
(31, 3, 1, '2024-10-28 05:43:28', '2024-10-28 05:43:28'),
(32, 3, 2, '2024-10-28 05:43:32', '2024-10-28 05:43:32'),
(33, 3, 3, '2024-10-28 05:43:43', '2024-10-28 05:43:43'),
(34, 3, 16, '2024-10-28 05:43:44', '2024-10-28 05:43:44'),
(35, 3, 18, '2024-10-28 05:43:45', '2024-10-28 05:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-10-28 05:40:58', '2024-10-28 05:40:58'),
(2, 1, 2, '2024-10-28 05:40:58', '2024-10-28 05:40:58'),
(3, 1, 3, '2024-10-28 05:40:59', '2024-10-28 05:40:59'),
(4, 1, 4, '2024-10-28 05:40:59', '2024-10-28 05:40:59'),
(5, 1, 5, '2024-10-28 05:41:00', '2024-10-28 05:41:00'),
(6, 1, 6, '2024-10-28 05:41:01', '2024-10-28 05:41:01'),
(7, 1, 7, '2024-10-28 05:41:01', '2024-10-28 05:41:01'),
(8, 1, 8, '2024-10-28 05:41:02', '2024-10-28 05:41:02'),
(9, 1, 9, '2024-10-28 05:41:03', '2024-10-28 05:41:03'),
(10, 1, 10, '2024-10-28 05:41:03', '2024-10-28 05:41:03'),
(11, 1, 11, '2024-10-28 05:41:05', '2024-10-28 05:41:05'),
(12, 1, 12, '2024-10-28 05:41:08', '2024-10-28 05:41:08'),
(13, 1, 13, '2024-10-28 05:41:11', '2024-10-28 05:41:11'),
(14, 1, 14, '2024-10-28 05:41:12', '2024-10-28 05:41:12'),
(15, 1, 15, '2024-10-28 05:41:12', '2024-10-28 05:41:12'),
(16, 1, 16, '2024-10-28 05:41:13', '2024-10-28 05:41:13'),
(17, 1, 17, '2024-10-28 05:41:15', '2024-10-28 05:41:15'),
(18, 1, 18, '2024-10-28 05:41:17', '2024-10-28 05:41:17'),
(19, 1, 19, '2024-10-28 05:41:17', '2024-10-28 05:41:17'),
(20, 1, 20, '2024-10-28 05:41:18', '2024-10-28 05:41:18'),
(21, 1, 21, '2024-10-28 05:41:20', '2024-10-28 05:41:20'),
(22, 1, 22, '2024-10-28 05:41:24', '2024-10-28 05:41:24'),
(23, 1, 23, '2024-10-28 05:41:27', '2024-10-28 05:41:27'),
(24, 1, 24, '2024-10-28 05:41:28', '2024-10-28 05:41:28'),
(25, 1, 25, '2024-10-28 05:41:28', '2024-10-28 05:41:28'),
(26, 1, 26, '2024-10-28 05:41:30', '2024-10-28 05:41:30'),
(27, 1, 27, '2024-10-28 05:41:31', '2024-10-28 05:41:31'),
(28, 1, 28, '2024-10-28 05:41:31', '2024-10-28 05:41:31'),
(29, 1, 29, '2024-10-28 05:41:32', '2024-10-28 05:41:32'),
(30, 1, 30, '2024-10-28 05:41:32', '2024-10-28 05:41:32'),
(31, 1, 31, '2024-10-28 05:41:32', '2024-10-28 05:41:32'),
(32, 1, 32, '2024-10-28 05:41:32', '2024-10-28 05:41:32'),
(33, 1, 33, '2024-10-28 05:41:33', '2024-10-28 05:41:33'),
(34, 1, 34, '2024-10-28 05:41:33', '2024-10-28 05:41:33'),
(35, 1, 35, '2024-10-28 05:41:33', '2024-10-28 05:41:33'),
(36, 1, 36, '2024-10-28 05:41:36', '2024-10-28 05:41:36'),
(37, 1, 37, '2024-10-28 05:41:37', '2024-10-28 05:41:37'),
(38, 1, 38, '2024-10-28 05:41:38', '2024-10-28 05:41:38'),
(39, 1, 39, '2024-10-28 05:41:39', '2024-10-28 05:41:39'),
(40, 1, 40, '2024-10-28 05:41:39', '2024-10-28 05:41:39'),
(41, 1, 41, '2024-10-28 05:41:40', '2024-10-28 05:41:40'),
(42, 1, 42, '2024-10-28 05:41:41', '2024-10-28 05:41:41'),
(43, 1, 43, '2024-10-28 05:41:42', '2024-10-28 05:41:42'),
(44, 1, 44, '2024-10-28 05:41:42', '2024-10-28 05:41:42'),
(45, 1, 45, '2024-10-28 05:41:43', '2024-10-28 05:41:43'),
(46, 1, 46, '2024-10-28 05:41:44', '2024-10-28 05:41:44'),
(47, 1, 47, '2024-10-28 05:41:44', '2024-10-28 05:41:44'),
(48, 1, 48, '2024-10-28 05:41:44', '2024-10-28 05:41:44'),
(49, 1, 49, '2024-10-28 05:41:44', '2024-10-28 05:41:44'),
(50, 1, 50, '2024-10-28 05:41:45', '2024-10-28 05:41:45'),
(51, 1, 51, '2024-10-28 05:41:47', '2024-10-28 05:41:47'),
(52, 1, 52, '2024-10-28 05:41:47', '2024-10-28 05:41:47'),
(53, 1, 53, '2024-10-28 05:41:48', '2024-10-28 05:41:48'),
(54, 1, 54, '2024-10-28 05:41:49', '2024-10-28 05:41:49'),
(55, 1, 55, '2024-10-28 05:41:50', '2024-10-28 05:41:50'),
(56, 1, 56, '2024-10-28 05:41:51', '2024-10-28 05:41:51'),
(57, 1, 57, '2024-10-28 05:41:53', '2024-10-28 05:41:53'),
(58, 1, 58, '2024-10-28 05:41:55', '2024-10-28 05:41:55'),
(59, 1, 59, '2024-10-28 05:42:00', '2024-10-28 05:42:00'),
(60, 1, 60, '2024-10-28 05:42:01', '2024-10-28 05:42:01'),
(61, 1, 61, '2024-10-28 05:42:02', '2024-10-28 05:42:02'),
(62, 1, 62, '2024-10-28 05:42:06', '2024-10-28 05:42:06'),
(63, 1, 63, '2024-10-28 05:42:09', '2024-10-28 05:42:09'),
(64, 1, 64, '2024-10-28 05:42:12', '2024-10-28 05:42:12'),
(65, 1, 65, '2024-10-28 05:42:14', '2024-10-28 05:42:14'),
(66, 1, 66, '2024-10-28 05:42:15', '2024-10-28 05:42:15'),
(67, 1, 67, '2024-10-28 05:42:15', '2024-10-28 05:42:15'),
(68, 1, 68, '2024-10-28 05:42:16', '2024-10-28 05:42:16'),
(69, 1, 69, '2024-10-28 05:42:16', '2024-10-28 05:42:16'),
(70, 1, 70, '2024-10-28 05:42:16', '2024-10-28 05:42:16'),
(71, 1, 71, '2024-10-28 05:42:16', '2024-10-28 05:42:16'),
(72, 1, 72, '2024-10-28 05:42:17', '2024-10-28 05:42:17'),
(73, 1, 73, '2024-10-28 05:42:17', '2024-10-28 05:42:17'),
(74, 1, 74, '2024-10-28 05:42:18', '2024-10-28 05:42:18'),
(75, 1, 75, '2024-10-28 05:42:19', '2024-10-28 05:42:19'),
(76, 1, 76, '2024-10-28 05:42:19', '2024-10-28 05:42:19'),
(77, 1, 77, '2024-10-28 05:42:20', '2024-10-28 05:42:20'),
(78, 1, 78, '2024-10-28 05:42:20', '2024-10-28 05:42:20'),
(79, 1, 79, '2024-10-28 05:42:21', '2024-10-28 05:42:21'),
(80, 2, 6, '2024-10-28 05:42:22', '2024-10-28 05:42:22'),
(81, 2, 5, '2024-10-28 05:42:22', '2024-10-28 05:42:22'),
(82, 2, 7, '2024-10-28 05:42:23', '2024-10-28 05:42:23'),
(83, 2, 8, '2024-10-28 05:42:27', '2024-10-28 05:42:27'),
(84, 2, 15, '2024-10-28 05:42:27', '2024-10-28 05:42:27'),
(85, 2, 14, '2024-10-28 05:42:28', '2024-10-28 05:42:28'),
(86, 2, 16, '2024-10-28 05:42:28', '2024-10-28 05:42:28'),
(87, 2, 17, '2024-10-28 05:42:29', '2024-10-28 05:42:29'),
(88, 3, 6, '2024-10-28 05:42:29', '2024-10-28 05:42:29'),
(89, 3, 5, '2024-10-28 05:42:30', '2024-10-28 05:42:30'),
(90, 3, 7, '2024-10-28 05:42:30', '2024-10-28 05:42:30'),
(91, 3, 8, '2024-10-28 05:42:34', '2024-10-28 05:42:34'),
(92, 4, 52, '2024-10-28 05:42:38', '2024-10-28 05:42:38'),
(93, 4, 53, '2024-10-28 05:42:39', '2024-10-28 05:42:39'),
(94, 4, 35, '2024-10-28 05:42:51', '2024-10-28 05:42:51'),
(95, 4, 36, '2024-10-28 05:42:53', '2024-10-28 05:42:53'),
(96, 4, 37, '2024-10-28 05:42:53', '2024-10-28 05:42:53'),
(97, 4, 39, '2024-10-28 05:42:59', '2024-10-28 05:42:59'),
(98, 4, 40, '2024-10-28 05:42:59', '2024-10-28 05:42:59'),
(99, 4, 41, '2024-10-28 05:43:00', '2024-10-28 05:43:00'),
(100, 4, 43, '2024-10-28 05:43:03', '2024-10-28 05:43:03'),
(101, 4, 44, '2024-10-28 05:43:05', '2024-10-28 05:43:05'),
(102, 4, 45, '2024-10-28 05:43:06', '2024-10-28 05:43:06'),
(103, 4, 47, '2024-10-28 05:43:10', '2024-10-28 05:43:10'),
(104, 4, 48, '2024-10-28 05:43:16', '2024-10-28 05:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `name`, `type`, `group`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'application_name', 'Application Name', 'text', 'general', 'SkillSyntax', 1, '2024-10-28 05:38:19', '2024-10-28 05:38:19'),
(2, 'application_slogan', 'Application Slogan', 'text', 'general', ' Be A Skilled Soul', 1, '2024-10-28 05:38:19', '2024-10-28 05:38:19'),
(3, 'default_course_status', 'Default course Status', 'select', 'general', '2', 1, '2024-10-28 05:38:19', '2024-10-28 05:38:19'),
(4, 'default_user_role', 'Default User Role', 'select', 'general', '4', 1, '2024-10-28 05:38:20', '2024-10-28 05:38:20'),
(5, 'default_course_duration', 'Default Course Duration (Weeks)', 'number', 'general', '26', 1, '2024-10-28 05:38:20', '2024-10-28 05:38:20'),
(6, 'default_quiz_time_limit', 'Default Quiz Time Limit (Second)', 'number', 'general', '300', 1, '2024-10-28 05:38:20', '2024-10-28 05:38:20'),
(7, 'items_per_page', 'Show Items/Page', 'number', 'general', '10', 1, '2024-10-28 05:38:20', '2024-10-28 05:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `solved_questions`
--

CREATE TABLE `solved_questions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_lessons`
--

CREATE TABLE `student_lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `lesson_id` bigint UNSIGNED NOT NULL,
  `current_quiz_id` bigint UNSIGNED DEFAULT NULL,
  `marks` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'HTML & CSS', 1, '2024-10-28 05:39:23', '2024-10-28 05:39:23'),
(2, 1, 'JavaScript Frameworks', 1, '2024-10-28 05:39:23', '2024-10-28 05:39:23'),
(3, 1, 'Backend Development', 1, '2024-10-28 05:39:23', '2024-10-28 05:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `review_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `review_id`, `created_at`, `updated_at`) VALUES
(1, 8, '2024-10-28 05:39:33', '2024-10-28 05:39:33'),
(2, 9, '2024-10-28 05:39:34', '2024-10-28 05:39:34'),
(3, 10, '2024-10-28 05:39:34', '2024-10-28 05:39:34'),
(4, 11, '2024-10-28 05:39:35', '2024-10-28 05:39:35'),
(5, 12, '2024-10-28 05:39:35', '2024-10-28 05:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `avatar_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `avatar_id`, `name`, `email`, `bio`, `mobile`, `website`, `github`, `gender`, `date_of_birth`, `location`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Mehedi Hasan', 'mehedi@gmail.com', 'Super Admin at the course management system.', '1234567890', 'https://www.google.com', 'https://github.com/mad-programmers3/skill-syntax', 'Male', '2002-09-02', 'Dhaka, Bangladesh', 1, '2024-10-28 05:38:22', '$2y$10$A.3QaiF7VbtBRo.YbK4ErO8bo8GdSpjwsBb7q5/uRi9bhasQzhtVy', NULL, '2024-10-28 05:38:24', '2024-10-28 05:38:24'),
(2, 1, NULL, 'Al Mamun', 'mamun@gmail.com', 'Super Admin at the course management system.', '1234567891', 'https://www.google.com', 'https://github.com/mad-programmers3/skill-syntax', 'Male', '2002-09-03', 'Dhaka, Bangladesh', 1, '2024-10-28 05:38:22', '$2y$10$f5p4ZGaU2QvZa7CLU9w/.eJDWLyMpBMoYPbNBFrchyk/Wt41VNu5y', NULL, '2024-10-28 05:38:24', '2024-10-28 05:38:24'),
(3, 1, NULL, 'Shihab', 'shihab@gmail.com', 'Super Admin at the course management system.', '1234567892', 'https://www.google.com', 'https://github.com/mad-programmers3/skill-syntax', 'Male', '2002-09-04', 'Dhaka, Bangladesh', 1, '2024-10-28 05:38:22', '$2y$10$Uezgd2Wanjt46crKmzh8y.fHxKTkhD.A3xnlcMK55R/cSC.P19TNG', NULL, '2024-10-28 05:38:25', '2024-10-28 05:38:25'),
(4, 1, NULL, 'Super Admin', 'superadmin@gmail.com', 'Super Admin at the course management system.', '1234567893', 'https://www.google.com', 'https://github.com/mad-programmers3/skill-syntax', 'Male', '2002-09-05', 'Dhaka, Bangladesh', 1, '2024-10-28 05:38:23', '$2y$10$3JQZDXtiTqzUYvTT8DuMbOQxfqTe0j0xItwZRZOpByZ4InQr8X3nq', NULL, '2024-10-28 05:38:25', '2024-10-28 05:38:25'),
(5, 2, NULL, 'Our Admin', 'admin@gmail.com', 'Admin at the course management system.', '1234567894', 'https://www.google.com', 'https://github.com/mad-programmers3/skill-syntax', 'Male', '2002-09-06', 'Dhaka, Bangladesh', 1, '2024-10-28 05:38:23', '$2y$10$atbnvGfuDOe5D3niS3EnQuQ2Z0.WCafBr9wPV5R3LCgc0SsKu5WGq', NULL, '2024-10-28 05:38:25', '2024-10-28 05:38:25'),
(6, 3, NULL, 'Our Teacher', 'teacher@gmail.com', 'Instructor at the course management system.', '1234567895', 'https://www.google.com', 'https://github.com/mad-programmers3/skill-syntax', 'Male', '2002-09-07', 'Dhaka, Bangladesh', 1, '2024-10-28 05:38:23', '$2y$10$ktnv2OttlXPToeA3HujMe.fhb1x.Oka3QUfuayrUADDZkFW5ax86y', NULL, '2024-10-28 05:38:25', '2024-10-28 05:38:25'),
(7, 4, NULL, 'Our Student', 'student@gmail.com', 'Student at the course management system.', '1234567896', 'https://www.google.com', 'https://github.com/mad-programmers3/skill-syntax', 'Male', '2002-09-08', 'Dhaka, Bangladesh', 1, '2024-10-28 05:38:23', '$2y$10$NAWcXchNRvWpFcxixowjJeo9D8PE8oQpR5Eyw/Cy09cUyQq96QuaO', NULL, '2024-10-28 05:38:26', '2024-10-28 05:38:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_user_id_foreign` (`user_id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `course_likes`
--
ALTER TABLE `course_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_likes_user_id_foreign` (`user_id`),
  ADD KEY `course_likes_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_quizzes_course_id_foreign` (`course_id`),
  ADD KEY `course_quizzes_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_reviews_course_id_foreign` (`course_id`),
  ADD KEY `course_reviews_review_id_foreign` (`review_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`);

--
-- Indexes for table `lesson_likes`
--
ALTER TABLE `lesson_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_likes_user_id_foreign` (`user_id`),
  ADD KEY `lesson_likes_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `lesson_quizzes`
--
ALTER TABLE `lesson_quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_quizzes_lesson_id_foreign` (`lesson_id`),
  ADD KEY `lesson_quizzes_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `lesson_reviews`
--
ALTER TABLE `lesson_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_reviews_lesson_id_foreign` (`lesson_id`),
  ADD KEY `lesson_reviews_review_id_foreign` (`review_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_files`
--
ALTER TABLE `my_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `my_files_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_module_id_foreign` (`module_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchased_courses`
--
ALTER TABLE `purchased_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchased_courses_user_id_foreign` (`user_id`),
  ADD KEY `purchased_courses_course_id_foreign` (`course_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `review_likes`
--
ALTER TABLE `review_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_likes_user_id_foreign` (`user_id`),
  ADD KEY `review_likes_review_id_foreign` (`review_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_modules`
--
ALTER TABLE `role_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_modules_role_id_foreign` (`role_id`),
  ADD KEY `role_modules_module_id_foreign` (`module_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_permissions_role_id_foreign` (`role_id`),
  ADD KEY `role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `solved_questions`
--
ALTER TABLE `solved_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solved_questions_user_id_foreign` (`user_id`),
  ADD KEY `solved_questions_question_id_foreign` (`question_id`);

--
-- Indexes for table `student_lessons`
--
ALTER TABLE `student_lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_lessons_user_id_foreign` (`user_id`),
  ADD KEY `student_lessons_lesson_id_foreign` (`lesson_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_review_id_foreign` (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_likes`
--
ALTER TABLE `course_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_reviews`
--
ALTER TABLE `course_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lesson_likes`
--
ALTER TABLE `lesson_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lesson_quizzes`
--
ALTER TABLE `lesson_quizzes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lesson_reviews`
--
ALTER TABLE `lesson_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `my_files`
--
ALTER TABLE `my_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchased_courses`
--
ALTER TABLE `purchased_courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review_likes`
--
ALTER TABLE `review_likes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_modules`
--
ALTER TABLE `role_modules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `solved_questions`
--
ALTER TABLE `solved_questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_lessons`
--
ALTER TABLE `student_lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_likes`
--
ALTER TABLE `course_likes`
  ADD CONSTRAINT `course_likes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_quizzes`
--
ALTER TABLE `course_quizzes`
  ADD CONSTRAINT `course_quizzes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_quizzes_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_reviews`
--
ALTER TABLE `course_reviews`
  ADD CONSTRAINT `course_reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_reviews_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson_likes`
--
ALTER TABLE `lesson_likes`
  ADD CONSTRAINT `lesson_likes_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson_quizzes`
--
ALTER TABLE `lesson_quizzes`
  ADD CONSTRAINT `lesson_quizzes_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_quizzes_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lesson_reviews`
--
ALTER TABLE `lesson_reviews`
  ADD CONSTRAINT `lesson_reviews_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lesson_reviews_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `my_files`
--
ALTER TABLE `my_files`
  ADD CONSTRAINT `my_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchased_courses`
--
ALTER TABLE `purchased_courses`
  ADD CONSTRAINT `purchased_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchased_courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `review_likes`
--
ALTER TABLE `review_likes`
  ADD CONSTRAINT `review_likes_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_modules`
--
ALTER TABLE `role_modules`
  ADD CONSTRAINT `role_modules_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_modules_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `solved_questions`
--
ALTER TABLE `solved_questions`
  ADD CONSTRAINT `solved_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solved_questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_lessons`
--
ALTER TABLE `student_lessons`
  ADD CONSTRAINT `student_lessons_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_lessons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
