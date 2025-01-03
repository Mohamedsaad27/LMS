<?php
return [
    'roles' => [
        'admin' => ['administrator-access'],
        'school' => ['school-create', 'school-view', 'school-edit', 'school-delete'],
        'organization' => ['organization-create', 'organization-view', 'organization-edit', 'organization-delete'],
        'grade' => ['grade-create', 'grade-view', 'grade-edit', 'grade-delete'],
        'subject' => ['subject-create', 'subject-view', 'subject-edit', 'subject-delete'],
        'student' => ['student-create', 'student-view', 'student-edit', 'student-delete'],
        'teacher' => ['teacher-create', 'teacher-view', 'teacher-edit', 'teacher-delete'],
    ]
];