<?php

$course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
$courses = get_courses();

$course = null;
foreach ($courses as $c) {
    if ($c['courseID'] == $course_id) {
        $course = $c;
        break;
    }
}

include('view/header.php');
?>

<section class="assignment-container">
    <h2>Update Course</h2>

    <form action="." method="post">
        <input type="hidden" name="action" value="update_course">
        <input type="hidden" name="course_id" value="<?= $course['courseID'] ?>">

        <label>Course Name:</label>
        <input type="text" name="course_name" maxlength="30"
               value="<?= htmlspecialchars($course['courseName']) ?>" required autofocus>

        <button type="submit">Update</button>
        <a href=".?action=list_courses">Cancel</a>
    </form>
</section>

<?php
include('view/footer.php');
?>