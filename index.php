<?php

$resources = [];
$result = [];

echo "Сколько различных ресурсов в деревне?\n";
$count = (int)readline();

echo "\nВведите количество каждого из ресурсов:\n";
for ($i = 0; $i < $count; $i++) {
    $resources[] = (int)readline();
}

echo "\nКакова грузоподъемность армии?\n";
$army_load = (int)readline();

function plunder($resources)
{

    /* передал перменные грузоподъемности и массива
     * с будущим результатом набега, объявленные глобально */
    global $army_load, $result;

    // случай, когда одно из значений ресурса оказалось отрицательным
    foreach ($resources as $elem) {
        if ($elem < 0) {
            echo "Значение ресурса не может быть меньше нуля";
            return -1;
        }
    }
    // случай маленьких величин
    foreach ($resources as $elem) {
        if (array_sum($resources) > $army_load && $elem == $army_load) {
            array_push($result, $elem);
            echo "[ " . $result[0] . " ]";
            return 11;
        }
    }

    // случай, когда массив оказался нулевой длины или грузоподъемность равна нулю
    if (count($resources) == 0 || $army_load == 0) {
        echo "Одно из значений не может быть нулевым";
        return 0;
    } // случай, когда в деревне всего один ресурс
    elseif (count($resources) == 1) {
        if ($resources[0] >= $army_load) {
            array_push($result, $army_load);
        } else {
            array_push($result, $resources[0]);
        }
        //return 1;
    } // случай, когда сумма всех ресурсов не превышает групоподъемности
    elseif (array_sum($resources) <= $army_load) {
        foreach ($resources as $elem) {
            array_push($result, $elem);
        }
    } else {
        $ratio = $army_load / array_sum($resources); // вычисляем коэффициент
        foreach ($resources as $elem) {
            array_push($result, (int)($elem * $ratio)); // кол-во награбленного = изначальное кол-во * коэф
        }
    }

    // распределение остатка
    $left = $army_load - array_sum($result);
    if ($army_load < array_sum($resources)) {
        for ($i = 0; $i < $left; $i++) {
            $result[$i] += 1;
        }
    }


    // проверяем, что количество награбленных ресурсов не превосходит грузоподъемности и выводим результат
    if (array_sum($result) <= $army_load) {
        echo "[ ";
        for ($i = 0; $i < count($result); $i++) {
            echo $result[$i];
            echo $i == count($result) - 1 ? '' : ', ';
        }
        echo " ]";
    }
}

plunder($resources);
