<?php
include "db.php";

ob_start();

session_start();

ob_end_flush();

const PASS_MARK = 3;

function check_autorize($log, $pas)
{
    $users = get_users();
    return array_key_exists($log, $users) && (password_verify($pas, $users[$log] || $pas == $users[$log]));
}

function check_user($log, $pas)
{
    $users = get_users();
    if (array_key_exists($log, $users) && (password_verify($pas, $users[$log]) || $pas == $users[$log])) {
        $_SESSION['authorized'] = 1;
        return true;
    }
    return false;
}

function add_user($log, $pas)
{
    $users = get_users();

    if (!check_log($log)) {
        $users[$log] = password_hash($pas, PASSWORD_DEFAULT);
        $_SESSION['authorized'] = 1;
        update_users($users);
        return true;
    }
    return false;
}

function update_users($users)
{
    $su = serialize($users);
    $file = fopen("db.txt", "w");
    if (fwrite($file, $su)) {
        fclose($file);
        return true;
    }
    fclose($file);
    return false;
}

function get_users()
{
    $file_name = "db.txt";
    $file = fopen($file_name, "r");
    $users = fread($file, filesize($file_name));
    fclose($file);
    return unserialize($users);
}

function check_admin()
{
    return isset($_SESSION['authorized']) && $_SESSION['login'] == "admin" && isset($_SESSION['authorized']);
}

function check_log($log)
{
    $users = get_users();
    return array_key_exists($log, $users);
}
function check_log_admin($log)
{
    return $log == "admin";
}

function get_students()
{
    $file_name = "students.txt";
    $file = fopen($file_name, "r");
    $students = fread($file, filesize($file_name));
    fclose($file);
    return unserialize($students);
}
function get_bad_students()
{
    $students = get_students();
    $bad_students = [];
    foreach ($students as $key => $student) {
        if ($student["marks"] < PASS_MARK)
            array_push($bad_students, $student);
    }
    return $bad_students;
}
function out_arr()
{
    $students = get_students();
    // делаем переменную $countries глобальной
    $arr_out = [];
    $arr_out[] = "<table  class=\"table text-white-50\">";
    $arr_out[] = "<tr><td>№</td><td>Student</td><td>
    Second name</td><td>Date of birth</td><td>Mark for PHP</td><td>Mark for JS</td><td>Mark for HTML</td><td>Mark for CSS</td><td>Average mark</td</td>";
    foreach ($students as $student) {
        static $i = 1;
        //статическая глобальная переменная-счетчик
        $str = "<tr>";
        $str .= "<td>" . $i . "</td>";
        foreach ($student as $key => $value) {
            if (!is_array($value)) {
                $str .= "<td>$value</td>";
            } else {
                foreach ($value as $k => $v) {
                    $str .= "<td>$v</td>";
                }
            }
        }
        $str .= "<td>" . (array_sum($student['marks']) / count($student['marks'])) . "</td>";
        $str .= "</tr>";
        $arr_out[] = $str;
        $i++;
    }
    $arr_out[] = "</table>";
    return $arr_out;
}
function out_arr_bad_students()
{
    $students = get_bad_students();
    // делаем переменную $countries глобальной
    $arr_out = [];
    $arr_out[] = "<table  class=\"table text-white-50\">";
    $arr_out[] = "<tr><td>№</td><td>Student</td><td>
    Second name</td><td>Date of birth</td><td>Mark for PHP</td><td>Mark for JS</td><td>Mark for HTML</td><td>Mark for CSS</td><td>Average mark</td</td>";
    foreach ($students as $student) {
        static $i = 1;
        //статическая глобальная переменная-счетчик
        $str = "<tr>";
        $str .= "<td>" . $i . "</td>";
        foreach ($student as $key => $value) {
            if (!is_array($value)) {
                $str .= "<td>$value</td>";
            } else {
                foreach ($value as $k => $v) {
                    $str .= "<td>$v</td>";
                }
            }
        }
        $str .= "<td>" . (array_sum($student['marks']) / count($student['marks'])) . "</td>";
        $str .= "</tr>";
        $arr_out[] = $str;
        $i++;
    }
    $arr_out[] = "</table>";
    return $arr_out;
}
function name($a, $b)
{
    return $a["name"] <=> $b["name"];
}
function age($a, $b)
{
    return $a["year"] <=> $b['year'];
}
function average_mark($a, $b)
{
    return (array_sum($a['marks']) / count($a['marks'])) <=> (array_sum($b['marks']) / count($b['marks']));
}

function sorting($p)
{
    $students = get_students();
    uasort($students, $p);
}

function out_arr_search(array $arr_index = null)
{
    $students = get_students();
    $arr_out = array();

    $arr_out[] = "<h3>Search result</h3><hr><table  class=\"table text-white-50\">";
    $arr_out[] = "<tr><td>№</td><td>Student</td><td>
    Second name</td><td>Date of birth</td><td>Mark for PHP</td><td>Mark for JS</td><td>Mark for HTML</td><td>Mark for CSS</td><td>Average mark</td</td>";
    foreach ($students as $index => $student) {
        if ($arr_index != null && in_array($index, $arr_index)) {
            static $i = 1;
            $str = "<tr>" . "<td>" . $i . "</td>";
            foreach ($student as $key => $value) {
                if (!is_array($value)) {
                    $str .= "<td>$value</td>";
                } else {
                    foreach ($value as $k => $v) {
                        $str .= "<td>$v</td>";
                    }
                }
            }
            $str .= "<td>" . (array_sum($student['marks']) / count($student['marks'])) . "</td>";
            $arr_out[] = $str;
            $i++;
        }
    }
    $arr_out[] = "</table>";
    return $arr_out;
}

function out_search($data)
{
    $students = get_students();
    $arr_index = array();
    foreach ($students as $country_number => $country) {
        foreach ($country as $key => $value) {
            if (!is_array($value)) {
                if (stristr($value, $data)) {
                    $arr_index[] = $country_number;
                }
            } else {
                foreach ($value as $k => $v) {
                    if (stristr($v, $data) || strstr($k, $data)) {
                        $arr_index[] = $country_number;
                    }
                }
            }
        }
    }
    return out_arr_search(array_unique($arr_index));
}

function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
