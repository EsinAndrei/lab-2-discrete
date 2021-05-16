<!DOCTYPE html>
<html>
	<head>		
		<meta charset="utf-8">
		<style type="text/css">
			textarea {
				font-size: 18pt;
				font-family: Arial;
			} 
		</style>
		<title>lab 4 MLMD</title>
	</head>
	<body>
		<h1>Лабораторная работа №4</h1>	
		<h3>Найдите кратчайший путь в неориентрованом графе<br>
		</h3>	
		Вводить расстояния матрицей<br>
		На главной диагонали должны быть 0<br>
		Вместо неизвестного расстояния вводить 0<br>	
		<form action = "script.php" method = "post">
			<div>				
			<textarea rows = "10" cols = "20" name = "a" style = "resize:none;"></textarea><br><br>
			</div>
			<div>
			<input  type = "submit" value = "Подсчет">
			</div>
		</form>		
	</body>
</html>