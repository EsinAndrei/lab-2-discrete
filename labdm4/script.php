<?php
/*
Изначальная работа с массивом а
strval - объявляем как строку(вызов методом post из textarea "a")
explode - разбиваем на массив через \n или пробел
array_filter - сортировка массива по длине строки
array_values - возвращение массива с индексами
trim - удаление пробелов
*/
/**
 * Изначальная работа с массивом а
 * strval - объявляем как строку(вызов методом post из textarea "a")
 * explode - разбиваем на массив через \n или пробел
 * array_filter - сортировка массива по длине строки
 * array_values - возвращение массива с индексами
 * trim - удаление пробелов
 */
$a = strval($_POST['a']);;
$a = explode("\n", $a);
$a = array_filter($a, 'strlen');

for ($i = 0; $i < count($a); $i++) {
    $a[$i] = explode(" ", $a[$i]);
    $a[$i] = array_filter($a[$i], 'strlen');
    $a[$i] = array_values($a[$i]);
    for ($j = 0; $j < count($a[$i]); $j++) {
        $a[$i][$j] = trim($a[$i][$j]);
    }
}
/*
Настройка стиля вывода таблиц расстояний через CSS
font-size - размер шрифта 
font-family - тип шрифта
*/
echo ("<style type='text/css'> 
    textarea { 
    font-size: 18pt;
    font-family: Arial;
    } 
    </style>");
/**
 * function validate отвечает за проверку введенных данных 
 * первый цикл - проверка на наличие 0 на главной диагонали
 * второй цикл - проверка на то, что матрица квадратная
 * третий цикл - проверка на то, что все элементы матрицы это числа и то, что они не отрицательны
 */
    function validate($a) {
		$c  = count($a);
        for ($i = 0; $i < count($a); $i++) {
            if ($a[$i][$i] != 0) return false;
        }
        for ($i = 0; $i != count($a); $i++) {
            if (count($a[$i]) > $c) return false; 
        }        
        for ($i = 0; $i < count($a); $i++) {
            for ($j = 0; $j < count($a[$i]); $j++) {
                if (!is_numeric($a[$i][$j]) || $a[$i][$j] < 0) {
                    return false;
                }
            }
        }
        return true;
    }
    /**
     * function kratchPut используется метод Флойда-Уоршелла для нахождения кратчайшего пути в графе
     */
    function kratchPut($a) {
        for ($k = 0; $k < count($a); $k++) {
            for ($i = 0; $i < count($a); $i++) {
                for ($j = 0; $j < count($a); $j++) { 
                    if ($a[$i][$k] != 0 && $a[$k][$j] != 0 && $i != $j) {
                        if ($a[$i][$j] > $a[$i][$k] + $a[$k][$j] || $a[$i][$j] == 0) {
                            $a[$i][$j] = $a[$i][$k] + $a[$k][$j];
                        }
                        if (($a[$j][$i] < $a[$i][$k] + $a[$k][$j] && $a[$j][$i] != 0) && $a[$j][$i] < $a[$i][$j]) {
                            $a[$i][$j] = $a[$j][$i];
                        }
                    }
                    if ($a[$k][$i] != 0 && $a[$j][$k] != 0 && $i != $j) {
                        if ($a[$i][$j] > $a[$k][$i] + $a[$j][$k] || $a[$i][$j] == 0) {
                            $a[$i][$j] = $a[$k][$i] + $a[$j][$k];
                        }
                        if (($a[$j][$i] < $a[$k][$i] + $a[$j][$k] && $a[$j][$i] != 0) && $a[$j][$i] < $a[$i][$j]) {
                            $a[$i][$j] = $a[$j][$i];
                        }
                    }
                    if ($a[$i][$k] != 0 && $a[$j][$k] != 0 && $i != $j) {
                        if ($a[$i][$j] > $a[$i][$k] + $a[$j][$k] || $a[$i][$j] == 0) {
                            $a[$i][$j] = $a[$i][$k] + $a[$j][$k];
                        }
                        if (($a[$j][$i] < $a[$i][$k] + $a[$j][$k] && $a[$j][$i] != 0) && $a[$j][$i] < $a[$i][$j]) {
                            $a[$i][$j] = $a[$j][$i];
                        }
                    }
                    if ($a[$k][$i] != 0 && $a[$k][$j] != 0 && $i != $j) {
                        if ($a[$i][$j] > $a[$k][$i] + $a[$k][$j] || $a[$i][$j] == 0) {
                            $a[$i][$j] = $a[$k][$i] + $a[$k][$j];
                        }
                        if (($a[$j][$i] < $a[$k][$i] + $a[$k][$j] && $a[$j][$i] != 0) && $a[$j][$i] < $a[$i][$j]) {
                            $a[$i][$j] = $a[$j][$i];
                        }
                    }
                }
            }
        }
        return $a;
    }
   /**
    * function prMatric отвечает за вывод массива в виде таблицы
    * вывод осуществляется в textarea
    */

    function prMatric($a) {      
      echo ("<textarea rows = '7' cols = '12' style = 'resize:none;' >");
      for($i = 0; $i < count($a); $i++) {
          for ($j = 0;$j < count($a);$j++){
            $a[$i][$j] = strval($a[$i][$j]);
            echo ($a[$i][$j] . " ");
          }
          echo ("\n");
      }
      echo ("</textarea>");
    }
	
    /**
    * Вызов всех функций и окончательный вывод
    */
    if (!validate($a)) {
    echo "Некорректный ввод";
    }
    else {
        echo "<h3>Вы ввели:<br><br></h3>";
        echo prMatric($a);
        echo "<h3><br>Матрица с кратчайшими расстояниями:<br><br></h3>";
        echo prMatric(kratchPut($a));
    }
?>