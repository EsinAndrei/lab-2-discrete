<?php
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
/**
* Настройка стиля вывода таблиц расстояний через CSS
* font-size - размер шрифта 
* font-family - тип шрифта
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
    * function matricD
    * в первых циклах ставятся 1 по главной диагонали и ставятся единицы на местах ребер, которые имеют вес
    * используется метод Флойда-Уоршелла для того чтобы узнать есть ли путь между вершинами
    */ 
    function matricD($a) {
        $s = array();
        for ($i = 0; $i < count($a); $i++) {
            for ($j = 0; $j < count($a); $j++) {
                $s[$i][$j] = 0;
                if ($a[$i][$j] != 0 || $i == $j) {
                    $s[$i][$j] = 1;
                }
            }
        }
        for ($k = 0; $k < count($a); $k++) {
            for ($i = 0; $i < count($a); $i++) {
                for ($j = 0; $j < count($a); $j++) {
                    if (k != j && k != i){                    
                        if ($a[$i][$k] + $a[$k][$j] >= 2 && ($a[$i][$k] != 0 && $a[$k][$j] != 0)){
                            $s[$i][$j] = 1;
                        }
                    }
                }
            }
        }
        for ($k = 0; $k < count($a); $k++) {
            for ($i = 0; $i < count($a); $i++) {
                for ($j = 0; $j < count($a); $j++) {
                    if (k != j && k != i){                    
                        if ($s[$i][$k] + $s[$k][$j] >= 2 && ($s[$i][$k] != 0 && $s[$k][$j] != 0)){
                            $s[$i][$j] = 1;
                        }
                    }
                }
            }
        }
        return $s;
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
    echo "НЕКОРРЕКТНЫЙ ВВОД!";
    }
    else {
        echo "<h3>Вы ввели:<br><br></h3>";
        echo prMatric($a);
        echo "<h3><br>Матрица достижимости:<br><br></h3>";
        echo prMatric(matricD($a));
    }
?>