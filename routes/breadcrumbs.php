<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push(__('messages.dashboard'), route('period.index'));
});

Breadcrumbs::for('period', function ($trail, $period) {
    $trail->parent('dashboard');
    $trail->push(__('messages.period') . ': ' . $period->getName(), route('period.show', $period->getId()));
});

Breadcrumbs::for('course', function ($trail, $course) {
    $trail->parent('period', $course->period);
    $trail->push(__('messages.course') . ': ' . $course->getName(), route('course.show', $course->getId()));
});

Breadcrumbs::for('activity', function ($trail, $activity) {
    $trail->parent('course', $activity->course);
    $trail->push(__('messages.activity') . ': ' . $activity->getName(), route('activity.show', $activity->getId()));
});
