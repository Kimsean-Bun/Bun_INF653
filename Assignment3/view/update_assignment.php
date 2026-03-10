<?php

$assignment_id = filter_input(INPUT_GET, 'assignment_id', FILTER_VALIDATE_INT);
$assignment = get_assignment($assignment_id);
$courses = get_courses();

include('view/header.php');
?>

<section class="assignment-container">
    <h2>Update Assignment</h2>

    <form action="." method="post">
        <input type="hidden" name="action" value="update_assignment">
        <input type="hidden" name="assignment_id" value="<?= $assignment['ID'] ?>">

        <label>Course:</label>
        <select name="course_id" required>
            <option value="">Please select</option>
            <?php foreach ($courses as $course) : ?>
                <option value="<?= $course['courseID'] ?>"
                    <?= $course['courseID'] == $assignment['courseID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($course['courseName']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Description:</label>
        <input type="text" name="description" maxlength="120"
               value="<?= htmlspecialchars($assignment['Description']) ?>" required>

        <button type="submit">Update</button>
        <a href=".?action=list_assignments">Cancel</a>
    </form>
</section>

<?php
include('view/footer.php');
?>