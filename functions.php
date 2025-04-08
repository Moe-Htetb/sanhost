<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function isStudent() {
    return isLoggedIn() && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'student';
}

function isAdmin() {
    return isLoggedIn() && isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin';
}

function getUserName() {
    return $_SESSION['user_name'] ?? '';
}

// Convert marks to letter grade
function getLetterGrade($marks) {
    if ($marks >= 90) return 'A+';
    if ($marks >= 80) return 'A';
    if ($marks >= 75) return 'A-';
    if ($marks >= 70) return 'B+';
    if ($marks >= 65) return 'B';
    if ($marks >= 60) return 'B-';
    if ($marks >= 55) return 'C+';
    if ($marks >= 50) return 'C';
    if ($marks >= 40) return 'D';
    return 'F';
}

// Convert letter grade to grade score
function getGradeScore($letterGrade) {
    switch ($letterGrade) {
        case 'A+': return 4.0;
        case 'A': return 4.0;
        case 'A-': return 3.67;
        case 'B+': return 3.33;
        case 'B': return 3.0;
        case 'B-': return 2.67;
        case 'C+': return 2.33;
        case 'C': return 2.0;
        case 'D': return 1.0;
        default: return 0.0;
    }
}

// Calculate grade point (ACUs * Grade Score)
function calculateGradePoint($acus, $gradeScore) {
    return $acus * $gradeScore;
}

// Calculate GPA
function calculateGPA($totalGradePoints, $totalACUs) {
    if ($totalACUs == 0) return 0;
    return $totalGradePoints / $totalACUs;
}
?> 