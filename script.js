	/*
	глобальные переменные
	*/	
	let arr1 = new Array();
	let s1 = 0;
	let s2 = new Array();

		                                                             
	/* Функция refl проверка на рефлексивность                    
	                                                             
	Проверяем введенное отношение на свойство рефлексивности. Находим количество пар вида xRx, причем (x,x) принадлежат R. Значит отношение рефлексивно    
	Для проверки проходимся циклом по диагонали, если количествое единиц на главной диагонали равно s1 - отношение рефлексивно                       
	                                     
	*/

	function refl() {
		var d = 0;
		j = 0;
		for (let i = 0; i < s1; i++) {
			j = i;
			if (arr1[i][j] == 1) {
				d++;
			}
		}
		if (d == s1) {
			document.getElementById("t2").innerHTML += "Свойство рефлексивности <b>соблюдается</b> <br>"
		}
		if (d != s1) {
			document.getElementById("t2").innerHTML += "Свойство рефлексивности <b>не соблюдается</b> <br>"
		}
	}

	/*                                                              
	Функция simm проверка на симметричность                       
	                                                              
	Проверяем отношения на симметричность, т.е находим наличие пары xRy и yRx в массиве проходимся циклом по матрице и проверяем наличие в матрице 
	симметричных относительно главной диагонали элементов              
	                                               
	*/

	function simm() {
		var f = true;
		for (var i = 0; i < s1; ++i){
			if (f){
				for (var j = 0; j < s1; ++j){
					if (arr1[i][j] != arr1[j][i]){
						f = false;
						break;
					}
				}
			}
		}
		if (f) {
			document.getElementById("t2").innerHTML += "Свойство симметричности <b>соблюдается</b><br>"
		}
		if (f == false) {
			document.getElementById("t2").innerHTML += "Свойство симметричности <b>не соблюдается</b><br>"
		}		
	}
	

	/*                                                              
	Функция cossimm проверка на кососимметричность  т.е проверяем отстутсвие пары xRy и yRx в массиве, учитывая исключение 0R0                                    
	проходим циклом по матрице и проверяем, что элементы, симметричные главной диагонали противоположны и не лежат на главной диагонали.                                                                                                   
	*/

	function cossimm(){
		var f = true;
		for (var i = 0; i < s1; ++i){
			if (f){
				for (var j = 0; j < s1; ++j){
					if (arr1[i][j] != arr1[j][i] && i != j){
						f = false;
						break;
					}
				}
			}
		}
		if(f){
			document.getElementById("t2").innerHTML += "Свойство кососимметричности <b>не соблюдается</b><br>"
		}
		else{
			document.getElementById("t2").innerHTML += "Свойство кососимметричности <b>соблюдается</b><br>"
		}
	}

	/*                                                             
	Функция trns проверка на транзитивность              
	                                                              
	Проверяем на транзитивность , то есть проверяем наличие пар вида xRy yRz xRz в массиве  \
	создаём второй массив, который является первым массивом умноженным на самого себя и проходимся циклом по второму массиву, проверяя наличие единиц на месте нулей	                                               
	*/
	function trns(){
		var s3 = new Array();
		for(var i = 0; i < s1; i++) {
			s3[i] = new Array();
			for(var j = 0; j < s1; j++) {
				s3[i][j] = 0;
			}
		}
		for(var i = 0; i < s1; i++ ) {
			for(var j = 0; j < s1; j++) {
				for (var d = 0; d < s1; d++) {
					if ((arr1[d][j] == 1) && (arr1[i][d] == 1)){
						s3[i][j] = 1;
						break;
					}
					s3[i][j] = 0;
				}
			}
		}
		var k = 0;
		for (var i = 0; i < s1; i++) {
			for (var j = 0; j < s1; j++) {
				if ((arr1[i][j] == 0) && (s3[i][j] == 1)){
				k++;
				}
			}
		}
		if (k == 0) {
			document.getElementById("t2").innerHTML += "Свойство транзитивности <b>соблюдается</b><br>"
		}
		else{
			document.getElementById("t2").innerHTML += "Свойство транзитивности <b>не соблюдается</b><br>"
		}
	}
	
	
	function test() {
		document.getElementById('t1').innerHTML = '';
		document.getElementById('t1').innerHTML += "<br>";
		document.getElementById('t2').innerHTML = '';
		a1 = document.getElementById('a1').value;
		a2 = document.getElementById('a2').value;
		s2 = a2.split(' ');
		s1 = a1;

		for(var i = 0; i < s2.length; i++) {
			var arr = s2[i].split(",");        
			if(arr[0] < 0){
				alert("Неверно введена " + (i+1) +"-я пара");
				return false;
			}
			if(arr[1] < 0){
				alert("Неверно введена " + (i+1) +"-я пара");
				return false;
			}
			if(arr[0] > s1){
				alert("Первый элемент "+ (i+1) +"-ой пары превышает размерность матрицы");
				return false;
			}
			if(arr[1] > s1){
				alert("Второй элемент "+ (i+1) +"-ой пары превышает размерность матрицы");
				return false;
			}
		}

		for(var i = 0; i < s1; i++) {  
			arr1[i] = new Array();
			for(var j = 0; j < s1; j++){
				arr1[i][j] = 0;				
			}
		}
		
		for(var i = 0; i < s2.length; i++) {   
			var a = s2[i].split(",");
			arr1[a[0] - 1][a[1] - 1] = 1;
		}


		for(var i = 0; i < s1; i++) {  			
			for(var j = 0; j < s1; j++){
				document.getElementById('t1').innerHTML += arr1[i][j];
				document.getElementById('t1').innerHTML += " ";				
			}
			document.getElementById('t1').innerHTML += "<br>";
		}	

		refl();
		simm();
		cossimm();	
		trns();	
	}
