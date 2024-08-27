-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2024 at 06:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms619`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assignments`
--

CREATE TABLE `Assignments` (
  `AssignmentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SubmissionDate` datetime NOT NULL,
  `FileURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Assignments`
--

INSERT INTO `Assignments` (`AssignmentID`, `CourseID`, `SubmissionDate`, `FileURL`) VALUES
(1, 1, '2024-02-29 11:59:59', 'uploads/assignment_bc987654321_65c01c55a97ef5.08246192.doc'),
(2, 5, '2024-03-10 23:59:00', 'uploads/assignment_1709699558_65e7f1e633d4b.docx'),
(3, 3, '2024-03-06 09:36:00', 'uploads/assignment_1709699779_65e7f2c350d98.docx');

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `CourseID` int(11) NOT NULL,
  `CourseCode` varchar(20) DEFAULT NULL,
  `CourseName` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `InstructorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`CourseID`, `CourseCode`, `CourseName`, `Description`, `StartDate`, `EndDate`, `InstructorID`) VALUES
(1, 'CS101', 'introduction to computing', 'introduction to computing', NULL, NULL, NULL),
(2, 'FE101', 'Fundamentals of Front End', 'Fundamentals of Front End', NULL, NULL, NULL),
(3, 'BE101', 'Back End learn what mater ', 'Back End learn what mater ', NULL, NULL, NULL),
(4, 'PHP101', 'Hypertext Preprocessor', 'Hypertext Preprocessor', NULL, NULL, NULL),
(5, 'JS201', 'Advanced JavaScript', 'Advanced JavaScript', NULL, NULL, NULL),
(6, 'PRO302', 'introduction to modern programming  ', 'introduction to modern programming  ', NULL, NULL, NULL),
(7, 'FYP619', 'Final Year Project', 'Final Year Project', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE `Courses` (
  `CourseID` int(11) NOT NULL,
  `CourseCode` varchar(20) NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `InstructorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`CourseID`, `CourseCode`, `CourseName`, `Description`, `StartDate`, `EndDate`, `InstructorID`) VALUES
(1, 'CS101', 'introduction to computing', 'introduction to computing', NULL, NULL, NULL),
(2, 'FE101', 'Fundamentals of Front End', 'Fundamentals of Front End', NULL, NULL, NULL),
(3, 'BE101', 'Back End learn what mater ', 'Back End learn what mater ', NULL, NULL, NULL),
(4, 'PHP101', 'Hypertext Preprocessor', 'Hypertext Preprocessor', NULL, NULL, NULL),
(5, 'JS201', 'Advanced JavaScript', 'Advanced JavaScript', NULL, NULL, NULL),
(6, 'PRO302', 'introduction to modern programming  ', 'introduction to modern programming  ', NULL, NULL, NULL),
(7, 'FYP619', 'Final Year Project', 'Final Year Project', NULL, NULL, NULL),
(8, 'ENG101', 'English Compulsory ', 'English Compulsory ', NULL, NULL, NULL),
(9, 'MTH101', 'Advanced Math', 'Advanced Math', NULL, NULL, NULL),
(10, 'DBMS', 'Data Base Management system', 'Data Base Management system', NULL, NULL, NULL),
(11, 'CS2011', 'introduction to programming', 'for building strong understanding of basic programming', NULL, NULL, NULL),
(12, 'CS201', 'introduction to programming', 'for building strong understanding of basic programming', NULL, NULL, NULL),
(13, 'CS301', 'oop', 'object op', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Quizzes`
--

CREATE TABLE `Quizzes` (
  `QuizID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `Score` int(11) NOT NULL,
  `AttemptDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `StudentCourses`
--

CREATE TABLE `StudentCourses` (
  `StudentID` varchar(50) NOT NULL,
  `CourseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `StudentCourses`
--

INSERT INTO `StudentCourses` (`StudentID`, `CourseID`) VALUES
('bc123456789', 1),
('bc123456789', 2),
('bc123456789', 3),
('bc123456789', 4),
('bc123456789', 5),
('bc147852369', 4),
('bc147852369', 5),
('bc987654321', 1),
('bc987654321', 4),
('bc987654321', 6),
('bc987654321', 7);

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `StudentID` varchar(50) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CNIC` varchar(15) NOT NULL,
  `image` varchar(200) NOT NULL,
  `yoAdmission` year(4) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`StudentID`, `UserName`, `Email`, `Password`, `CNIC`, `image`, `yoAdmission`) VALUES
('bc123456780', 'Ali Hassan', 'bc123456780@lms.edu.pk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '34501-0980054-1', 'stdImages/std5.jpeg', '2024'),
('bc123456789', 'Ali Raza', 'bc123456789@lms.edu.pk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '34500-0987654-1', 'stdImages/std2.jpeg', '2024'),
('bc147852369', 'Adnan', 'bc147852369@lms.edu.pk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '34501-0987654-0', 'stdImages/std1jpeg', '2024'),
('bc23567909', 'alis', 'alsssssi@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '34501-0987654-1', 'stdImages/std4.jpeg', '2024'),
('bc987321456', 'usman', 'bc987321456@lms.edu.pk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '34501-1232487-6', 'stdImages/std5.jpeg', '2024'),
('bc987654321', 'salman', 'bc987654321@lms.edu.pk', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '00501-0987654-1', 'stdImages/sd8.png', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `SubmittedAssignments`
--

CREATE TABLE `SubmittedAssignments` (
  `SubmissionID` int(11) NOT NULL,
  `AssignmentID` int(11) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `FileURL` varchar(255) NOT NULL,
  `SubmissionDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` varchar(20) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `UserName`, `Email`, `Password`, `Role`) VALUES
(1, 'admin', 'admin619@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Assignments`
--
ALTER TABLE `Assignments`
  ADD PRIMARY KEY (`AssignmentID`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- Indexes for table `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `Quizzes`
--
ALTER TABLE `Quizzes`
  ADD PRIMARY KEY (`QuizID`);

--
-- Indexes for table `StudentCourses`
--
ALTER TABLE `StudentCourses`
  ADD PRIMARY KEY (`StudentID`,`CourseID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`StudentID`);

--
-- Indexes for table `SubmittedAssignments`
--
ALTER TABLE `SubmittedAssignments`
  ADD PRIMARY KEY (`SubmissionID`),
  ADD KEY `AssignmentID` (`AssignmentID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Assignments`
--
ALTER TABLE `Assignments`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Course`
--
ALTER TABLE `Course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Courses`
--
ALTER TABLE `Courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Quizzes`
--
ALTER TABLE `Quizzes`
  MODIFY `QuizID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `SubmittedAssignments`
--
ALTER TABLE `SubmittedAssignments`
  MODIFY `SubmissionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `StudentCourses`
--
ALTER TABLE `StudentCourses`
  ADD CONSTRAINT `StudentCourses_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `Students` (`StudentID`),
  ADD CONSTRAINT `StudentCourses_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `Course` (`CourseID`);

--
-- Constraints for table `SubmittedAssignments`
--
ALTER TABLE `SubmittedAssignments`
  ADD CONSTRAINT `SubmittedAssignments_ibfk_1` FOREIGN KEY (`AssignmentID`) REFERENCES `Assignments` (`AssignmentID`),
  ADD CONSTRAINT `SubmittedAssignments_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `Students` (`StudentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
