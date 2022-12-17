<?php
$students = [
    [
        "name" => "Mark",
        "surname" => "Butov",
        "year" => 2003,
        "marks" => [
            "PHP" => 5,
            "JS" => 5,
            "HTML" => 5,
            "CSS" => 5,
        ]
    ],
    [
        "name" => "Joan",
        "surname" => "Joanson",
        "year" => 2005,
        "marks" => [
            "PHP" => 4,
            "JS" => 3,
            "HTML" => 5,
            "CSS" => 5,
        ]
    ],
    [
        "name" => "Jack",
        "surname" => "Smith",
        "year" => 2003,
        "marks" => [
            "PHP" => 3,
            "JS" => 3,
            "HTML" => 4,
            "CSS" => 4,
        ]
    ],
    [
        "name" => "Martin",
        "surname" => "Miller",
        "year" => 2004,
        "marks" => [
            "PHP" => 4,
            "JS" => 4,
            "HTML" => 5,
            "CSS" => 3,
        ]
    ]
];

// $s_students = serialize($students);
// $file = fopen("students.txt", "w");
// fwrite($file, $s_students);
// fclose($file);

$users = [
    "user" => password_hash("user", PASSWORD_DEFAULT),
    "admin" => password_hash("admin", PASSWORD_DEFAULT),
    "pit" => password_hash("w123", PASSWORD_DEFAULT),
];
// $s_students = serialize($users);
// $file = fopen("db.txt", "w");
// fwrite($file, $s_students);
// fclose($file);
