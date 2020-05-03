<?php

Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Admin panel', route('admin.index'));
});

Breadcrumbs::for('admin-comments', function ($trail) {
    $trail->parent('admin');
    $trail->push('Reported Comments', route('admin.comments'));
});

Breadcrumbs::for('admin-posts', function ($trail) {
    $trail->parent('admin');
    $trail->push('Reported posts', route('admin.posts'));
});

Breadcrumbs::for('period', function ($trail, $period) {
    $trail->push($period->getName(), route('period.show', $period->getId()));
});

Breadcrumbs::for('course', function ($trail, $course) {
    $trail->parent('period', $course->period);
    $trail->push($course->getName(), route('course.show', $course->getId()));
});

Breadcrumbs::for('activity', function ($trail, $activity) {
    $trail->parent('course', $activity->course);
    $trail->push($activity->getName(), route('activity.show', $activity->getId()));
});
