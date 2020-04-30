<?php

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('period', function ($trail, $period) {
    $trail->parent('home');
    $trail->push($period->getName(), route('period.show', $period->getId()));
});

Breadcrumbs::for('user', function ($trail, $user) {
    $trail->parent('home');
    $trail->push($user->getName(), route('user.show', $user->getId()));
});

Breadcrumbs::for('course', function ($trail, $course) {
    $trail->parent('period', $course->period);
    $trail->push($course->getName(), route('course.show', $course->getId()));
});

Breadcrumbs::for('activity', function ($trail, $activity) {
    $trail->parent('course', $activity->course);
    $trail->push($activity->getName(), route('activity.show', $activity->getId()));
});
