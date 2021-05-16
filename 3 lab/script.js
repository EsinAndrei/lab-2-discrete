
		/*
			Глобальные переменные
		*/
		
		let s1,s2,s3;
		let i,j;
		
		/*
			Функция отвечает за проверку "есть ли в массиве данное значение"
		*/
		
		function contains(elem, arr) {
			for (var i = 0; i < arr.length; i++) {
				if (arr[i] == elem) {
					return true;
				}
			}
			return false;
		}
		
		/*
			Функция для валидации
			Проверяется ввод
		*/
		
		function validate(a1, a2, s) {
			for (var i = 0; i < s.length; ++i) {
				if (s[i].length != 2 || !contains(s[i][0], a1) || !contains(s[i][1], a2)) {
					document.getElementById('t1').innerHTML += "Пара на ";
					document.getElementById('t1').innerHTML += i+1;
					document.getElementById('t1').innerHTML += " месте в отношении задана неверно<br>";
					return false;
				}
			}
			for (var i = 0; i < s.length-1; ++i) {
				for (var j = i+1; j < s.length; ++j) {
					if (s[i][0] == s[j][0] && s[i][1] == s[j][1]) {
						document.getElementById('t1').innerHTML += "Пары "
						document.getElementById('t1').innerHTML += i + 1;
						document.getElementById('t1').innerHTML += " и ";
						document.getElementById('t1').innerHTML += j + 1;
						document.getElementById('t1').innerHTML += " в отношении заданы одинаково<br>";
						return false;
					}
				}
			}
			return true;
		}
		
		/*
			Функция для проверки, является ли отношение функцией						 
			Функция проверяет множество с введёными отношениями на наличие элементов из массива А и массива В					
		*/
		
		function MainCheck(a1, a2, s) {			
			for (i = 0; i < s.length; i++) {
				if ((contains(s[i][0],a1)) && (contains(s[i][1],a2))) {
					continue;
				} else {
					document.getElementById('t1').innerHTML += "Ошибка в отношении, в ";
					document.getElementById('t1').innerHTML += i + 1;
					document.getElementById('t1').innerHTML += " паре"					
					return false;
				}				             
			}
			for (var i = 0; i < s.length-1; ++i) {
				for (var j = i+1; j < s.length; ++j) {
					if (s[i][0] == s[j][0]) {
						document.getElementById('t1').innerHTML += "В парах ";
						document.getElementById('t1').innerHTML += i + 1;
						document.getElementById('t1').innerHTML += " и ";
						document.getElementById('t1').innerHTML += j + 1;
						document.getElementById('t1').innerHTML += " встречается один и тот же элемент из первого множества<br>";
						return false;
					}
				}
			}
			if (s.length < a1.length){
				document.getElementById('t1').innerHTML += "Не всем элементам из первого множества соответствует элемент из второго множества";
				return false;
			}
        return true;
		}
		
		/*
			Основное тело программы						
			здесь вызываются все необходимые программе функции
		*/	
		
		function test(){
			document.getElementById('t1').innerHTML = "";
			a1 = document.getElementById('a1').value;
			a2 = document.getElementById('a2').value;
			a3 = document.getElementById('a3').value;
			s1 = a1.split(' ');
			s2 = a2.split(' ');
			s3 = a3.split(' ');
			for (i = 0; i < s3.length; i++){
				s3[i] = s3[i].split(',');
			}
			
			
			if(validate(s1, s2, s3)){
				if (MainCheck(s1, s2, s3)){
					document.getElementById('t1').innerHTML +="<h3>Отношение является функцией</h3>";
				} else {
					document.getElementById('t1').innerHTML +="<h3>Отношение не является функцией</h3>";
				}					
			}			
		}
		